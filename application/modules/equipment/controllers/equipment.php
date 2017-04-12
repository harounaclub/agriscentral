<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Equipment extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() === 'user') {
            redirect('/map', 'refresh');
        } 
        $this->load->model('equipment/equipmentmodel');
    }
    
    public function generate() { 
        generateReport();
        exit(0);
    }
    
    

    public function index() { 
        $data = array();
        
        $data['footer_assets'] = '/equipment/equipment_footer_list_assets';
        $data['main_content'] = '/equipment/equipment_list';
           
        $this->load->view('admin_template', $data);
    }
    
    public function equipment_inventory($equipmentId) { 
        $data = array();
        
        $equipment = $this->equipmentmodel->getEquipmentFromId($equipmentId);
        $data['EQUIPMENT'] = $equipment;
        
        $data['footer_assets'] = '/equipment_inventory/equipment_footer_list_assets';
        $data['main_content'] = '/equipment_inventory/equipment_inventory_list';
        
        
           
        $this->load->view('admin_template', $data);
    }
    
    public function update() {
        $data = array();
        $equipments = $this->equipmentmodel->getEquipments();
        
        $data['EQUIPMENT'] = $equipments ;
        $data['footer_assets'] = '/equipment/equipment_footer_list_assets';
        $data['main_content'] = '/equipment/equipment_list';
        $this->load->view('admin_template', $data);
    
    }
    
    public function save_add() {
        
        $data = $GLOBALS =array();
        if($this->equipmentmodel->addEquipment()) {
            $this->session->set_flashdata('message', 'Equipment has been added!');
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }
    
    public function add_equipment_inventory() {
        
        $data = $GLOBALS =array();
        if($this->equipmentmodel->addEquipmentInventory()) {
            $this->session->set_flashdata('message', 'Equipment Inventory has been added!');
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
        if($this->equipmentmodel->updateEquipment()) {
            $this->session->set_flashdata('message', 'Equipment Inventory has been updated!');
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }
    
    public function update_equipment_inventory() {
        $data = $GLOBALS = array();
        if($this->equipmentmodel->updateEquipmentInventory()) {
            $this->session->set_flashdata('message', 'Equipment Inventory has been updated!');
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
        if($this->equipmentmodel->deleteEquipment()) {
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }
    
    public function remove_equipment_inventory() {
        $data = $GLOBALS = array();
        if($this->equipmentmodel->deleteEquipmentInventory()) {
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
