<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() === 'user') {
            redirect('/map', 'refresh');
        } 
    }
    
    function build() {
        
        $formType = $this->input->post('type');
        
        $record_id = $this->input->post('record_id');
        $section = $this->input->post('section');
        
        $data = array();
        $data = $this->getData($formType, $record_id);
        
        $html = $uri ='';
        $html = $this->loadView($formType, $data['results'], $section);
        
        $array = array(
            'html' => $html,
            'param' => $data['param'],
            
        );

        echo json_encode($array);
    }
    
    function loadView($formType, $data, $section = NULL) {
        $html = $this->load->view('/'.$formType.'/dynamic_list/' . $formType, $data, true);
        return $html;
    }

    function getData($formType, $record_id) {
        $data = array();

        switch ($formType) {
            
            case "type":
                $this->load->model('zonetypemodel', '', TRUE);
                
                $zone_types = $this->zonetypemodel->getZoneTypes();
                //dump($zones);die;
                $arr = array('ZONE_TYPES' => $zone_types );
                $data['results'] = $arr;
                $data['param'] = $zone_types['param'];

                break;
            
            case "zone":
                $this->load->model('zonemodel', '', TRUE);
                $zones = $this->zonemodel->getZones();
                //dump($zones);die;
                $arr = array('ZONES' => $zones );
                $data['results'] = $arr;
                $data['param'] = $zones['param'];

                break;

        }

        return $data;
    }
    
    
    
/****************************BUID FORM **************************/
    
    function buildForm() {
        
        
        $formType = $this->input->post('type');
        $record_id = $this->input->post('record_id');
        $section = $this->input->post('section');
        
        $data = array();
        $data = $this->getFormData($formType, $record_id);

        $html = $this->loadForm($formType, $data['results'], $section);
        
        $array = array(
            'html' => $html,
            //'param' => $data['param']
        );

        echo json_encode($array);
        
    }
    
    function loadForm($formType, $data, $section = NULL) {
        $html = $this->load->view('/'.$formType.'/dynamic_form/' . $formType, $data, true);
        return $html;
    }
    
    function getFormData($formType, $record_id) {
        $data = array();

        switch ($formType) {
            case "type":
                $this->load->model('zonetypemodel', '', TRUE);
                $zoneTypeId = $this->input->post('record_id');
                //$zone = array();
                $arr = array();
                if(isset($zoneTypeId) && $zoneTypeId !='' && !empty($zoneTypeId) ) {
                    $zone_type = $this->zonetypemodel->getZoneTypeFromId($zoneTypeId);
                    $arr = array('ZONE_TYPE' => $zone_type);
                }
                $data['results'] = $arr;
                break;
                
            case "zone":
                $this->load->model('zonemodel', '', TRUE);
                $zoneId = $this->input->post('record_id');
                
                $this->load->model('zone/zonetypemodel', '', TRUE);
                $zone_types = $this->zonetypemodel->getAllZonetypes();
                
                //$zone = array();
                $arr = array();
                if(isset($zoneId) && $zoneId !='' && !empty($zoneId) ) {
                    $zone = $this->zonemodel->getZoneFromId($zoneId);
                    $arr = array('ZONE' => $zone);
                }
                $arr['ZONE_TYPES'] =$zone_types;
                $data['results'] = $arr;
                break;

        }

        return $data;
    }
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */