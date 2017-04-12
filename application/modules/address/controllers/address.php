<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Address extends MX_Controller {

    public function __construct() {
        parent::__construct();
        
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() ==='user'){
            redirect('/map', 'refresh');
        } 
        
        $this->load->model('address/addressmodel');
    }

    public function index() { 
        $data = array();
        $data['footer_assets'] = '/address/address_footer_list_assets';
        $data['main_content'] = '/address/address_list';
        $this->load->view('admin_template', $data);
    }
    
    public function add() {
        $data = array();
        
        $this->load->model('addresstypemodel', '', TRUE);
        $addressTypes = $this->addresstypemodel->getAllAddressTypes();

        $this->load->model('zone/zonemodel', '', TRUE);
        $zones = $this->zonemodel->getAllZones();
        
        $this->load->model('countrymodel', '', TRUE);
        $countries = $this->countrymodel->getCountries();
        
        $this->load->model('statemodel', '', TRUE);
        $states = $this->statemodel->getstates();
        
        $data = array(
            'ADDRESS_TYPES' =>$addressTypes,
            'ZONES' =>$zones,
            'COUNTRIES' => $countries,
            'STATES'    => $states
            
        );
        
        $data['main_content'] = '/address/form/address_form';
        $data['footer_assets'] = '/address/address_footer_list_assets';
        
        $this->load->view('admin_template', $data);
    
    }
    
    public function view($id) {
        
        $data = array();
        $address = $this->addressmodel->getAddressFromId($id);
        
        $data['ADDRESS'] = $address ;
        $data['footer_assets'] = '/address/address_footer_list_assets';
        $data['main_content'] = '/address/address_detail';
        $this->load->view('admin_template', $data);
    
    }
    
    public function update($addressId) {
        $data = array();
        
        
        $this->load->model('addresstypemodel', '', TRUE);
        $addressTypes = $this->addresstypemodel->getAllAddressTypes();

        $this->load->model('zone/zonemodel', '', TRUE);
        $zones = $this->zonemodel->getAllZones();
        
        $this->load->model('countrymodel', '', TRUE);
        $countries = $this->countrymodel->getCountries();
        
        $this->load->model('statemodel', '', TRUE);
        $states = $this->statemodel->getstates();
        
        $address = $this->addressmodel->getAddressFromId($addressId);
        
        $data = array(
            'ADDRESS_TYPES' =>$addressTypes,
            'ZONES' =>$zones,
            'COUNTRIES' => $countries,
            'STATES'    => $states,
            'ADDRESS'   =>$address
        );
        
        $data['footer_assets'] = '/address/address_footer_list_assets';
        $data['main_content'] = '/address/form/address_form';
        $this->load->view('admin_template', $data);
    
    }
    
    public function save_add() {
        
        $data = $GLOBALS = array();
        if($this->addressmodel->addAddress()) {
            $this->session->set_flashdata('message', 'Address has been added');
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
        if($this->addressmodel->updateAddress()) {
            $this->session->set_flashdata('message', 'Address has been updated!');
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
        if($this->addressmodel->deleteAddress()) {
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }
    
    public function add_equipment($id) {
        
        $data = array();
        $address = $this->addressmodel->getAddressFromId($id);
        
        $this->load->model('project/projectmodel', '', TRUE);
        $projects = $this->projectmodel->getAllProjects();
        $data = array(
            'PROJECTS' =>$projects,
            'ADDRESS'   =>$address
        );
        
        $data['main_content'] = '/address/form/equipment_address_form';
        $data['footer_assets'] = '/address/address_footer_list_assets';
        
        $this->load->view('admin_template', $data);
    
    }
    
    public function update_equipment($addressId, $equipment_address_id) {
        
        $data = array();
        $address = $this->addressmodel->getAddressFromId($addressId);
        
        $this->load->model('project/projectmodel', '', TRUE);
        $projects = $this->projectmodel->getAllProjects();
        
        $address_equipment= $this->addressmodel->getEquipmentAddressFromId($equipment_address_id);
        $added_project = $this->addressmodel->getAddedProjectForEquipment($equipment_address_id);
        
        $data = array(
            'PROJECTS' =>$projects,
            'ADDRESS'   =>$address,
            'ADDRESS_EQUIPMENT' =>$address_equipment,
            'Added_project' =>$added_project
        );
        
        $data['main_content'] = '/address/form/equipment_address_form';
        $data['footer_assets'] = '/address/address_footer_list_assets';
        
        $this->load->view('admin_template', $data);
    
    }
    
    
    
    public function getEquipments() {
        $equipments = $this->addressmodel->getEquipmentsForAutocomplete();
        
        $json = array();
        foreach ($equipments as $equipment) { 
            // $year = $this->getYear();
            $json [] = array(
                'id' => $equipment->equipment_inventory_id,
                'label' => $equipment->equipment . '( ' . $equipment->brand_name . ')'. '-'.$equipment->serial_number
            );
        }

        echo json_encode($json);
    }
    
    public function add_address_equipment() {
        
        $data = $GLOBALS = array();
        if($this->addressmodel->addAddressEquipment()) {
            $this->session->set_flashdata('message', 'Address Equipment has been added');
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }
    
    public function update_address_equipment() {
        
        $data = $GLOBALS = array();
        if($this->addressmodel->updateAddressEquipment()) {
            $this->session->set_flashdata('message', 'Address Equipment has been Updated');
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }
    
    public function remove_address_equipment() {
        $data = $GLOBALS = array();
        if($this->addressmodel->deleteAddressEquipment()) {
            echo 'yes';
        } else {
            if (!empty($GLOBALS['error']) ) {
                echo $GLOBALS['error'];
            } else {
                echo 'no';
            }
        }
    }
    
    public function getCoordinates() {
        $coordinates = '';
        $coordinates = $this->addressmodel->getCoordinates();
        echo json_encode($coordinates);
        
    }
    
}
