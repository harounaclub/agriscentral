<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zone extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() === 'user') {
            redirect('/map', 'refresh');
        } 
        
        $this->load->model('zone/zonemodel');
    }

    public function index() {
        
        $data = array();
        $this->load->model('zone/zonemodel');
        $zones = $this->zonemodel->getZones();
        
        $data['ZONES'] = $zones ;
        $data['footer_assets'] = '/zone/footer_list_assets';
        $data['main_content'] = '/zone/zone_list';
           
        $this->load->view('admin_template', $data);
    }
    public function get_zone_from_html() {
        $html = array();
        $data = array();
        $zoneId = $this->input->post('zoneId');
        
        if(isset($zoneId) && $zoneId !='' && !empty($zoneId) ) {
            $zone = $this->zonemodel->getZoneFromId($zoneId);
            $data['BRAND'] = $zone ;
        }
        
        $html['html'] = $this->load->view('/zone/zone_form', $data, true);
        echo json_encode($html);
        
    }
    
    
    public function update() {
        $data = array();
        $zones = $this->zonemodel->getZones();
        
        $data['ZONES'] = $zones ;
        $data['footer_assets'] = '/zone/footer_list_assets';
        $data['main_content'] = '/zone/zone_list';
        $this->load->view('admin_template', $data);
    
    }
    
    public function save_add() {
        $data = $GLOBALS =  array();
        if($this->zonemodel->addZone()) {
            $this->session->set_flashdata('message', 'Zone has been added!');
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
        if($this->zonemodel->updateZone()) {
            $this->session->set_flashdata('message', 'Zone has been updated!');
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
        if($this->zonemodel->deleteZone()) {
            //$this->session->set_flashdata('message', 'Zone has been updated!');
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
