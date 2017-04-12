<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class import extends MX_Controller {

    public function __construct() {
        parent::__construct();
        
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() ==='user'){
            redirect('/map', 'refresh');
        } 
        
        $this->load->model('import/importmodel');
    }

    public function index() { 
        
        $this->importmodel->importCSV();
    }
    
    public function address_import() { 
        $this->importmodel->importAddressFromJighi();
    }
    
}
