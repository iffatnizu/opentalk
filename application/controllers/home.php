<?php

require_once 'siteConfig.php';
require_once 'dbConfig.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $selectedzonearr = getTimeZone();
        ini_set('date.timezone', $selectedzonearr[DBConfig::TABLE_SETTING_ATT_TIMEZONE]);

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('model_home');
        $this->load->database();
    }

    public function index() {

        $s['validToken'] = false;
        $s['_patienttoken'] = false;
        $s['invalidToken'] = false;

        $this->session->unset_userdata($s);

        $data['title'] = 'Home||Tuvits.com';

        $page['header'] = $this->load->view(SiteConfig::VIEW_MODULE_HEADER, $data, true);
        $page['slider'] = $this->load->view(SiteConfig::VIEW_MODULE_SLIDER, $data, true);
        $page['bottom'] = $this->load->view(SiteConfig::VIEW_MODULE_BOTTOM, $data, true);
        $page['footer'] = $this->load->view(SiteConfig::VIEW_MODULE_FOOTER, $data, true);

        $this->load->view(SiteConfig::VIEW_MASTER_PAGE, $page);
    }

    public function sendrequest() {
        if (isset($_GET['isClick'])) {
            $data = $this->model_home->getTokenDetails($_GET['appToken']);
            if ($data == "0") {
                echo '0';
            } else {
                echo json_encode($data);
            }
        }
    }

    public function support() {
        if (isset($_GET['isClick'])) {
            $output = $this->load->view(SiteConfig::VIEW_HOME_SUPPORT, '', true);
            echo $output;
        }
    }

}
