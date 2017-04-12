<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //$this->lang->load("french","french");
        $this->lang->load("french","french");
        
        $this->load->model('user/loginmodel', '', TRUE);
    }

    public function index() {
        
        if(checkAdminAccess() === 1){
            redirect('/user/dashboard');
        } else if(checkAdminAccess() === 'user'){
            redirect('/map', 'refresh');
        } else if(checkAdminAccess() === 0){
            $this->load->view('/user/login');
        }
        
    }
    
    function authenticate() {
        //print_r($_POST);
        $GLOBALS = array();
        
        if ($this->loginmodel->validateUser()) {
            echo 'yes';
        } else {
            if (isset($GLOBALS['error']) && !empty($GLOBALS['error'])) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }

}
