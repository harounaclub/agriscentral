<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class EquipmentType extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() === 'user') {
            redirect('/map', 'refresh');
        } 
        $this->load->model('equipment/EquipmentTypeModel');
    }

    public function index() { 
        
        $data = array();
        $equipmentTypes = $this->EquipmentTypeModel->getEquipmentTypes();
        
        $data['EQUIPMENT_TYPES'] = $equipmentTypes ;
        $data['footer_assets'] = '/type/footer_list_assets';
        $data['main_content'] = '/type/equipment_type_list';
           
        $this->load->view('admin_template', $data);
    }
    
    public function save_add() {
        
        $data = $GLOBALS = array();
        if($this->EquipmentTypeModel->addEquipmentType()) {
            $this->session->set_flashdata('message', 'EquipmentType has been added!');
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
        if($this->EquipmentTypeModel->updateEquipmentType()) {
            $this->session->set_flashdata('message', 'EquipmentType has been updated!');
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
        if($this->EquipmentTypeModel->deleteEquipmentType()) {
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
