<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_home extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getTokenDetails($token = 0) {
        $sql = 'SELECT *
                FROM (' . DBConfig::TABLE_APPOINTMENT . ')
                WHERE ' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN . ' = "' . $token . '" AND (' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ' = "0" OR ' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ' = "1")';
        $result = $this->db->query($sql)->row_array();

        //echo $sql;

        if (!empty($result)) {

            $currentSessionId = $this->session->userdata('session_id');

            if ($result[DBConfig::TABLE_APPOINTMENT_ATT_USER_LOGGED] != '1' && $currentSessionId != $result[DBConfig::TABLE_APPOINTMENT_ATT_USER_SESSION_STRING]) {
                $this->updateAppointmentLoggedStatus($token, $result[DBConfig::TABLE_APPOINTMENT_ATT_USER_SESSION_STRING]);
            }

            $result['doctorDetails'] = $this->getDoctorDetails($result[DBConfig::TABLE_APPOINTMENT_ATT_DOCTOR_ID]);
            $result['time'] = date("F j, Y, g:i a", $result[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE]);
            $result['futureAppointment'] = $this->getFutureAppointment($result[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE]);

            $now = time();

            //if ($result[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE] >= $now) {



            $data['validToken'] = true;
            $data['_patienttoken'] = $token;
            $this->session->set_userdata($data);
            $result['status'] = '1';
            return $result;
//            } else {
//                $data['invalidToken'] = true;
//                $data['_patienttoken'] = $token;
//                $this->session->set_userdata($data);
//                $result['status'] = '2';
//                return $result;
//            }
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

    private function updateAppointmentLoggedStatus($token, $loggedSession) {
        if ($loggedSession != $this->session->userdata('session_id')) {
            $result = "1";
            $data[DBConfig::TABLE_APPOINTMENT_ATT_USER_LOGGED] = $result;
            $data[DBConfig::TABLE_APPOINTMENT_ATT_USER_SESSION_STRING] = $this->session->userdata('session_id');
            $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN, $token);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_APPOINTMENT);
        }
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

    public function endAppoinment($token = "") {
//        $sql = 'UPDATE ' . DBConfig::TABLE_APPOINTMENT . ' 
//                SET ' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ' = "3"
//                WHERE ' . DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN . ' = "' . $token . '" AND (' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . ' = "1" OR ' . DBConfig::TABLE_APPOINTMENT_ATT_STATUS . '="0") 
//               ';
//        $result = $this->db->query($sql)->row_array();
//        if (!empty($result)) {

        $data[DBConfig::TABLE_APPOINTMENT_ATT_STATUS] = '0';
        $data[DBConfig::TABLE_APPOINTMENT_ATT_PATIENT_STATUS] = '0';
        $data[DBConfig::TABLE_APPOINTMENT_ATT_USER_LOGGED] = '0';
        $data[DBConfig::TABLE_APPOINTMENT_ATT_USER_SESSION_STRING] = '';
        $data[DBConfig::TABLE_APPOINTMENT_ATT_IS_ADMIN_CONNECTED] = '0';
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN, $token);
        $this->db->set($data);
        $u = $this->db->update(DBConfig::TABLE_APPOINTMENT);

        if ($u) {
            $data['validToken'] = false;
            $data['_patienttoken'] = false;
            $this->session->unset_userdata($data);
            return '1';
        }
        // }
    }

    public function checkDoctorAppoinmentStatus($token = "") {

        $runningApp = $this->checkAnyCoversationIsRunning($token);

        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN, $token);
        $result = $this->db->get(DBConfig::TABLE_APPOINTMENT)->row_array();
        if (!empty($result)) {
            if ($result[DBConfig::TABLE_APPOINTMENT_ATT_STATUS] == '1') {
                return '1';
            } else {
                return $result[DBConfig::TABLE_APPOINTMENT_ATT_STATUS] . "|" . $runningApp;
            }
        } else {
            return '0';
        }
    }

    public function adminConnectStatus($token = "") {



        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN, $token);
        $result = $this->db->get(DBConfig::TABLE_APPOINTMENT)->row_array();
        if (!empty($result)) {
            if ($result[DBConfig::TABLE_APPOINTMENT_ATT_IS_ADMIN_CONNECTED] == '1') {
                return '1';
            } else {
                return $result[DBConfig::TABLE_APPOINTMENT_ATT_IS_ADMIN_CONNECTED];
            }
        } else {
            return '0';
        }
    }

    public function updatePatientAppoinmentStatus($token = "") {
        $data[DBConfig::TABLE_APPOINTMENT_ATT_PATIENT_STATUS] = '1';
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN, $token);
        $this->db->set($data);
        $u = $this->db->update(DBConfig::TABLE_APPOINTMENT);
    }

    public function getTimeZone() {
        $this->db->select(DBConfig::TABLE_SETTING_ATT_TIMEZONE);
        $result = $this->db->get(DBConfig::TABLE_SETTING)->row_array();
        return $result;
    }

    private function checkAnyCoversationIsRunning($token = "") {
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_IS_ADMIN_CONNECTED, '1');
        $this->db->where(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN . " !=" . $token);
        $result = $this->db->get(DBConfig::TABLE_APPOINTMENT)->row_array();

        //echo $this->db->last_query();


        if (!empty($result)) {
            return '1';
        } else {
            return '0';
        }
    }

    public function getOpentokSetting() {
        return $this->db->get(DBConfig::TABLE_OPENTOK_SETTINGS)->row_array();
    }

}