<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SiteConfig {
    
    //All Component
    CONST ADMIN_MASTER='adminMaster';
    
    CONST ADMIN_LOGIN='admin/adminLogin';
    CONST ADMIN_DASHBOARD='admin/adminDashboard';
    CONST ADMIN_APPOINTMENT='admin/adminAppointment';
    CONST ADMIN_ADMIN_CONVERSATION='admin/adminConversation';
    CONST ADMIN_ADMIN_OPENTOK_SETTING='admin/adminOpentokSetting';

    //All Controller
    CONST CONTROLLER_ADMINISTRATOR='administrator';
    CONST CONTROLLER_HOME='home';
    CONST CONTROLLER_CONVERSATION='conversation';
    
    //HOME METHOD DEFINATION
    
    CONST METHOD_HOME_INDEX = '/index';
    CONST METHOD_HOME_SENDREQUEST = '/sendrequest';
    CONST METHOD_HOME_SUPPORT = '/support';
    
    //CONVERSATION METHOD DEFINATION
    
    CONST METHOD_CONVERSATION = '/index';
    CONST METHOD_CONVERSATION_END = '/end';
    CONST METHOD_CONVERSATION_CHECK_STATUS = '/checkstatus';
    CONST METHOD_CONVERSATION_UPDATE_STATUS = '/updatestatus';
    CONST METHOD_CONVERSATION_CHECK_ADMIN_CONNECT_STATUS = '/adminConnectStatus';
    
    
    
    //Define All Administrator Methods
    CONST METHOD_ADMINISTRATOR_INDEX='/index';
    CONST METHOD_ADMINISTRATOR_LOGIN='/login';
    CONST METHOD_ADMINISTRATOR_DASHBOARD='/dashboard';
    CONST METHOD_ADMINISTRATOR_LOGOUT='/logout';
    CONST METHOD_ADMINISTRATOR_APPOINTMENT='/appointment';
    CONST METHOD_ADMINISTRATOR_DELETE_APPOINTMENT='/deleteAppointment';
    CONST METHOD_ADMINISTRATOR_START_APPOINTMENT='/startappointment';
    CONST METHOD_ADMINISTRATOR_COMPLETED_APPOINTMENT='/completedppointment';
    CONST METHOD_ADMINISTRATOR_NO_SHOW='/noshow';
    CONST METHOD_ADMINISTRATOR_END_APPOINTMENT='/endappointment';
    CONST METHOD_ADMINISTRATOR_CHECK_STATUS = '/checkstatus';
    CONST METHOD_ADMINISTRATOR_UPDATE_STATUS = '/updatestatus';
    CONST METHOD_ADMINISTRATOR_OPENTOK_SETTING = '/opentoksetting';
    
    //VIEW PAGE DEFINATION
    
    CONST VIEW_MODULE_HEADER = 'mod/modHeader';
    CONST VIEW_MODULE_SLIDER = 'mod/modSlider';
    CONST VIEW_MODULE_BOTTOM = 'mod/modBottom';
    CONST VIEW_MODULE_FOOTER = 'mod/modFooter';
    CONST VIEW_MASTER_PAGE = 'siteMaster';
    
    CONST VIEW_HOME_SUPPORT = 'comp/home/compSupport';
    
    CONST VIEW_CONVERSATION_OPENTOK = 'comp/conversation/opentok';
    
}
