<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'dbConfig.php';
require_once 'siteConfig.php';

class Administrator extends CI_Controller {

    public function __construct() {
        parent::__construct();



        $selectedzonearr = getTimeZone();
        ini_set('date.timezone', $selectedzonearr[DBConfig::TABLE_SETTING_ATT_TIMEZONE]);

        $this->load->helper(array('form', 'site'));
        $this->load->library('form_validation');
        $this->load->model('model_administrator');
    }

    public function index() {
        redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_LOGIN));
    }

    public function login() {
        if (!$this->session->userdata('adminLogin')) {

            if (isset($_POST['login'])) {
                $this->model_administrator->login();
            }
            $this->load->view(SiteConfig::ADMIN_LOGIN);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD));
        }
    }

    public function dashboard() {
        if ($this->session->userdata('adminLogin')) {

            $page['adminContent'] = $this->load->view(SiteConfig::ADMIN_DASHBOARD, '', TRUE);
            $this->load->view(SiteConfig::ADMIN_MASTER, $page);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function logout() {
        if ($this->session->userdata('adminLogin')) {
            $data['adminLogin'] = FALSE;
            $data['adminId'] = FALSE;
            $this->session->unset_userdata($data);

            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_INDEX));
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function appointment() {
        if ($this->session->userdata('adminLogin')) {
            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules(DBConfig::TABLE_APPOINTMENT_ATT_USERNAME, 'Name', 'trim|required');
            $this->form_validation->set_rules(DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE, 'Appointment Date', 'required');
            //$this->form_validation->set_rules('appTime', 'Appointment Time', 'required');
            $this->form_validation->set_rules(DBConfig::TABLE_APPOINTMENT_ATT_FEE, 'Fee', 'required');
            $this->form_validation->set_rules(DBConfig::TABLE_APPOINTMENT_ATT_DOCTOR_ID, 'Doctor', 'required');
            $this->form_validation->set_message('required', ' %s Required');

            if ($this->form_validation->run()) {
                $this->model_administrator->addAppointment();
            }

            $data['appointmentList'] = $this->model_administrator->getAppointmentList();
            $data['doctorList'] = $this->model_administrator->getDoctorList();
            $page['adminContent'] = $this->load->view(SiteConfig::ADMIN_APPOINTMENT, $data, TRUE);
            $this->load->view(SiteConfig::ADMIN_MASTER, $page);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function deleteAppointment() {
        if ($this->session->userdata('adminLogin')) {
            if (isset($_GET['isclick'])) {
                $delete = $this->model_administrator->deleteAppointment($_GET['appId']);
                if ($delete) {
                    echo '1';
                }
            }
        }
    }

    public function startappointment($token) {
        if ($this->session->userdata('adminLogin')) {
            $this->model_administrator->updateAppointmentStatus($token);
            $data['setting'] = getOpentokSetting();
            $data['tokenDetails'] = $this->model_administrator->tokenDetails($token);
            $page['conversation'] = $this->load->view(SiteConfig::ADMIN_ADMIN_CONVERSATION, $data, true);
            $this->load->view(SiteConfig::ADMIN_MASTER, $page);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function completedppointment() {
        if ($this->session->userdata('adminLogin')) {
            $c = $this->model_administrator->changeAppointmentStatus($_GET['id'], '3');
            if ($c == '1') {
                echo '1';
            }
        }
    }

    public function noshow() {
        if ($this->session->userdata('adminLogin')) {
            $c = $this->model_administrator->changeAppointmentStatus($_GET['id'], '2');
            if ($c == '1') {
                echo '1';
            }
        }
    }

    public function endappointment() {
        if ($this->session->userdata('adminLogin')) {
            $c = $this->model_administrator->endappointment($_GET['id']);
            if ($c == '1') {
                echo '1';
            }
        }
    }

    public function checkstatus() {
        if ($this->session->userdata('adminLogin')) {
            $c = $this->model_administrator->changePatientAppointmentStatus($_GET['id']);
            echo $c;
        }
    }

    public function updatestatus() {
        if ($this->session->userdata('adminLogin')) {
            $c = $this->model_administrator->updateAppointmentConnectStatus($_GET['id']);
        }
    }

    public function timezone() {
        if ($this->session->userdata('adminLogin')) {
            $c = $this->model_administrator->settimezone($_GET['zone']);
        }
    }

    public function opentoksetting() {
        if ($this->session->userdata('adminLogin')) {
            if (isset($_POST['submit'])) {
                $this->form_validation->set_rules('apiKey', 'Api key', 'trim|required');
                $this->form_validation->set_rules('sessionId', 'Session Id', 'required');
                $this->form_validation->set_rules('token', 'Token', 'required');

                if ($this->form_validation->run()) {
                    $u = $this->model_administrator->updateOpentokSetting();

                    if ($u) {
                        $s['_success'] = true;
                        $this->session->set_userdata($s);
                        redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_OPENTOK_SETTING));
                    }
                }
            }
            $data['setting'] = getOpentokSetting();
            $page['adminContent'] = $this->load->view(SiteConfig::ADMIN_ADMIN_OPENTOK_SETTING, $data, TRUE);
            $this->load->view(SiteConfig::ADMIN_MASTER, $page);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

}

