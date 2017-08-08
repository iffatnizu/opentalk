<?php

require_once 'siteConfig.php';
require_once 'dbConfig.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conversation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('model_home');
        $this->load->database();
    }

    public function index() {

        if ($this->session->userdata('validToken')) {


            $data['setting'] = getOpentokSetting();
            $data['tokenDetails'] = $this->model_home->getTokenDetails($this->session->userdata('_patienttoken'));

            //debugPrint($data);

            $currentSessionId = $this->session->userdata('session_id');

            //echo $currentSessionId;
            //exit();
            //if ($data['tokenDetails']['userLogged'] == '1' && $currentSessionId == $data['tokenDetails'][DBConfig::TABLE_APPOINTMENT_ATT_USER_SESSION_STRING]) {


            $data['title'] = 'Conversation||Tuvits.com';

            $page['header'] = $this->load->view(SiteConfig::VIEW_MODULE_HEADER, $data, true);
            $page['conversation'] = $this->load->view(SiteConfig::VIEW_CONVERSATION_OPENTOK, $data, true);
            $page['footer'] = $this->load->view(SiteConfig::VIEW_MODULE_FOOTER, $data, true);

            $this->load->view(SiteConfig::VIEW_MASTER_PAGE, $page);
//            } else {
//                redirect(site_url());
//            }
        } else {
            redirect(site_url());
        }
    }

    public function end() {
        if (isset($_GET['isClick'])) {
            $end = $this->model_home->endAppoinment($this->session->userdata('_patienttoken'));
            if ($end)
                echo '1';
            else
                echo '0';
        }
    }

    public function checkstatus() {
        if ($this->session->userdata('validToken')) {
            if (isset($_GET['check'])) {
                $check = $this->model_home->checkDoctorAppoinmentStatus($this->session->userdata('_patienttoken'));
                echo $check;
            }
        }
    }

    public function updatestatus() {
        if ($this->session->userdata('validToken')) {
            if (isset($_GET['check'])) {
                $check = $this->model_home->updatePatientAppoinmentStatus($this->session->userdata('_patienttoken'));
                //echo $check;
            }
        }
    }

    public function adminConnectStatus() {
        if ($this->session->userdata('validToken')) {
            if (isset($_GET['check'])) {
                $check = $this->model_home->adminConnectStatus($this->session->userdata('_patienttoken'));
                echo $check;
            }
        }
    }

}

?>
