<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_administrator extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function login() {
        //debugPrint($_POST);

        $this->db->where(DBConfig::TABLE_ADMIN_ATT_USERNAME, $this->input->post(DBConfig::TABLE_ADMIN_ATT_USERNAME));
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_PASSWORD, md5($this->input->post(DBConfig::TABLE_ADMIN_ATT_PASSWORD)));

        $query = $this->db->get(DBConfig::TABLE_ADMIN);

        if ($query->num_rows() == 1) {
            $result = $query->row_array();
            $data['adminLogin'] = TRUE;
            $data['adminId'] = $result[DBConfig::TABLE_ADMIN_ATT_ID];

            $this->session->set_userdata($data);

            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD));
        } else {
            $data['errorLogin'] = TRUE;
            $this->session->set_userdata($data);

            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function getDoctorList() {
        return $this->db->get(DBConfig::TABLE_DOCTOR)->result_array();
    }

    public function getAppointmentList() {
        $sql = 'SELECT '
                . DBConfig::TABLE_APPOINTMENT . '.' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID . ','
                . DBConfig::TABLE_APPOINTMENT . '.' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE . ','
                . DBConfig::TABLE_APPOINTMENT . '.' . DBConfig::TABLE_APPOINTMENT_ATT_USERNAME . ','
                . DBConfig::TABLE_APPOINTMENT . '.' . DBConfig::TABLE_APPOINTMENT_ATT_FEE . ','
                . DBConfig::TABLE_APPOINTMENT . '.' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ','
                . DBConfig::TABLE_APPOINTMENT . '.' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN . ','
                . DBConfig::TABLE_DOCTOR . '.' . DBConfig::TABLE_DOCTOR_ATT_DOCTOR_NAME
                . ' FROM ' . DBConfig::TABLE_APPOINTMENT
                . ' LEFT JOIN ' . DBConfig::TABLE_DOCTOR . ' ON ' . DBConfig::TABLE_DOCTOR . '.' . DBConfig::TABLE_DOCTOR_ATT_DOCTOR_ID
                . ' = ' . DBConfig::TABLE_APPOINTMENT . '.' . DBConfig::TABLE_APPOINTMENT_ATT_DOCTOR_ID
                . ' ORDER BY ' . DBConfig::TABLE_APPOINTMENT . '.' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE . ' ASC';
//        echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    public function addAppointment() {


        $data[DBConfig::TABLE_APPOINTMENT_ATT_USERNAME] = $this->input->post(DBConfig::TABLE_APPOINTMENT_ATT_USERNAME, TRUE);

        $date = $this->input->post(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE, TRUE);
        //$time = $this->input->post('appTime', TRUE);
        //$appTime = $date . ' ' . $time . ':00';

        $appToken = str_replace(".", "", microtime());



        $data[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN] = substr($appToken, 1, 7);
        $data[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE] = setAppointmetTime($date);
        //$data[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE] = local_to_gmt(strtotime($date));
        $data[DBConfig::TABLE_APPOINTMENT_ATT_FEE] = $this->input->post(DBConfig::TABLE_APPOINTMENT_ATT_FEE, TRUE);
        $data[DBConfig::TABLE_APPOINTMENT_ATT_DOCTOR_ID] = $this->input->post(DBConfig::TABLE_APPOINTMENT_ATT_DOCTOR_ID, TRUE);

        $insert = $this->db->insert(DBConfig::TABLE_APPOINTMENT, $data);
        if ($insert) {
            $datas['successMessage'] = TRUE;
            $datas['appId'] = $this->db->insert_id();
            $this->session->set_userdata($datas);

            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_APPOINTMENT) . '#upcoming');
        }
    }

    public function deleteAppointment($appId = 0) {
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID, $appId);
        $query = $this->db->get(DBConfig::TABLE_APPOINTMENT);
        if ($query->num_rows() > 0) {
            $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID, $appId);
            $delete = $this->db->delete(DBConfig::TABLE_APPOINTMENT);
            return $delete;
        } else {
            return FALSE;
        }
    }

    public function updateAppointmentStatus($token = 0) {

        $sql = 'UPDATE ' . DBConfig::TABLE_APPOINTMENT . ' 
                SET ' . DBConfig::TABLE_APPOINTMENT_ATT_PATIENT_STATUS . ' = "0",
                    ' . DBConfig::TABLE_APPOINTMENT_ATT_USER_LOGGED . ' = "0",
                    ' . DBConfig::TABLE_APPOINTMENT_ATT_USER_SESSION_STRING . ' = " ",
                    ' . DBConfig::TABLE_APPOINTMENT_ATT_IS_ADMIN_CONNECTED . ' = "0"    
                WHERE ' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ' = "1" 
               ';

        $up = $this->db->query($sql);

        $data[DBConfig::TABLE_APPOINTMENT_ATT_STATUS] = '1';
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_STATUS, '0');
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN, $token);
        $this->db->set($data);
        $u = $this->db->update(DBConfig::TABLE_APPOINTMENT);
    }

    public function changeAppointmentStatus($id, $data) {
        $sql = 'UPDATE ' . DBConfig::TABLE_APPOINTMENT . ' 
                SET ' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ' = "' . $data . '"
                WHERE ' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID . ' = "' . $id . '" AND (' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ' = "1" OR ' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . '="0") 
               ';

        $u = $this->db->query($sql);
        if ($u)
            return '1';
    }

    public function changePatientAppointmentStatus($id) {
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_APPOINTMENT)->row_array();

        if (!empty($result)) {
            if ($result[DBConfig::TABLE_APPOINTMENT_ATT_PATIENT_STATUS] == '1') {
                return '1';
            } else {
                return $result[DBConfig::TABLE_APPOINTMENT_ATT_PATIENT_STATUS];
            }
        } else {
            return '0';
        }
    }

    public function updateAppointmentConnectStatus($id) {
        $data[DBConfig::TABLE_APPOINTMENT_ATT_IS_ADMIN_CONNECTED] = '1';
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_STATUS, '1');
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID, $id);
        $this->db->set($data);
        $u = $this->db->update(DBConfig::TABLE_APPOINTMENT);
    }

    public function tokenDetails($token = "") {
        $sql = 'SELECT *
                FROM (' . DBConfig::TABLE_APPOINTMENT . ')
                WHERE ' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN . ' = "' . $token . '" AND (' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ' = "0" OR ' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ' = "1")';
        $result = $this->db->query($sql)->row_array();

        //echo $sql;

        if (!empty($result)) {

            $result['doctorDetails'] = $this->getDoctorDetails($result[DBConfig::TABLE_APPOINTMENT_ATT_DOCTOR_ID]);
            $result['time'] = date("F j, Y, g:i a", $result[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE]);
            $result['futureAppointment'] = $this->getFutureAppointment($result[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE]);

            $now = time();

            if ($result[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE] >= $now) {



                $data['validToken'] = true;
                $data['_patienttoken'] = $token;
                $this->session->set_userdata($data);
                $result['status'] = '1';
                return $result;
            } else {
                $data['invalidToken'] = true;
                $data['_patienttoken'] = $token;
                $this->session->set_userdata($data);
                $result['status'] = '2';
                return $result;
            }
        } else {
            return '0';
        }
    }

    private function getFutureAppointment($date) {
        $sql = 'SELECT * FROM ' . DBConfig::TABLE_APPOINTMENT . '
                WHERE ' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE . ' > "' . $date . '"
                ORDER BY ' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE . ' ASC LIMIT 1
               ';
        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function getDoctorDetails($dID = 0) {
        $this->db->select(DBConfig::TABLE_DOCTOR_ATT_DOCTOR_NAME);
        $this->db->where(DBConfig::TABLE_DOCTOR_ATT_IS_ACTIVE, '1');
        $this->db->where(DBConfig::TABLE_DOCTOR_ATT_DOCTOR_ID, $dID);
        $result = $this->db->get(DBConfig::TABLE_DOCTOR)->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function settimezone($zone) {
        $sql = 'UPDATE ' . DBConfig::TABLE_SETTING . ' SET ' . DBConfig::TABLE_SETTING_ATT_TIMEZONE . '= "' . $zone . '"';
        $this->db->query($sql);
    }

    public function endappointment($id=0) {
        $data[DBConfig::TABLE_APPOINTMENT_ATT_STATUS] = '0';
        $data[DBConfig::TABLE_APPOINTMENT_ATT_PATIENT_STATUS] = '0';
        $data[DBConfig::TABLE_APPOINTMENT_ATT_USER_LOGGED] = '0';
        $data[DBConfig::TABLE_APPOINTMENT_ATT_USER_SESSION_STRING] = '';
        $data[DBConfig::TABLE_APPOINTMENT_ATT_IS_ADMIN_CONNECTED] = '0';
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID, $id);
        $this->db->set($data);
        $u = $this->db->update(DBConfig::TABLE_APPOINTMENT);
        
        if($u)
            return '1';
    }
    
    public function updateOpentokSetting()
    {
        $data[DBConfig::TABLE_OPENTOK_SETTINGS_ATT_API_KEY] = $_POST['apiKey'];
        $data[DBConfig::TABLE_OPENTOK_SETTINGS_ATT_SESSION_ID] = $_POST['sessionId'];
        $data[DBConfig::TABLE_OPENTOK_SETTINGS_ATT_TOKEN] = $_POST['token'];
        
        $this->db->set($data);
        $u = $this->db->update(DBConfig::TABLE_OPENTOK_SETTINGS);
        
        if($u)
        {
            return '1';
        }
    }

}
