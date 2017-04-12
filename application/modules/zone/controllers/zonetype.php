<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ZoneType extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() === 'user') {
            redirect('/map', 'refresh');
        } 
        $this->load->model('zone/ZoneTypeModel');
    }

    public function index() { 
        
        $data = array();
        $zoneTypes = $this->ZoneTypeModel->getZoneTypes();
        
        $data['EQUIPMENT_TYPES'] = $zoneTypes ;
        $data['footer_assets'] = '/type/footer_list_assets';
        $data['main_content'] = '/type/zone_type_list';
           
        $this->load->view('admin_template', $data);
    }
    
    public function save_add() {
        
        $data = $GLOBALS = array();
        if($this->ZoneTypeModel->addZoneType()) {
            $this->session->set_flashdata('message', 'Zone Type has been added!');
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }

    public function save_update() {
        $data = $GLOBALS = array();
        if($this->ZoneTypeModel->updateZoneType()) {
            $this->session->set_flashdata('message', 'Zone Type has been updated!');
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }
    
    public function remove() {
        $data = $GLOBALS = array();
        if($this->ZoneTypeModel->deleteZoneType()) {
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }

}
