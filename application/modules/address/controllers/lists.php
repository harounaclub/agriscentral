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
        if($formType == 'type') {
            $html = $this->load->view('/type/dynamic_list/' . $formType, $data, true);
        } else {
            $html = $this->load->view('/'.$section.'/dynamic_list/' . $formType, $data, true);
        }
        return $html;
    }

    function getData($formType, $record_id) {
        $data = array();
        
        switch ($formType) {

            case "type":
                $this->load->model('addresstypemodel', '', TRUE);
                
                $address_types = $this->addresstypemodel->getAddressTypes();
                
                $arr = array('ADDRESS_TYPES' => $address_types );
                $data['results'] = $arr;
                $data['param'] = $address_types['param'];

                break;
            
            case "address":
                $this->load->model('addressmodel', '', TRUE);
                
                $addresses = $this->addressmodel->getAddresses();
                
                $arr = array('ADDRESSES' => $addresses );
                $data['results'] = $arr;
                $data['param'] = $addresses['param'];

                break;
            
            case "information":
                $record_id = $this->input->post('record_id');
                $this->load->model('addressmodel', '', TRUE);
                $arr = array();
                $address = $this->addressmodel->getAddressFromId($record_id);
                
                
                $arr = array('ADDRESS' => $address );
                $data['results'] = $arr;
                //$data['param'] = $address['param'];
                $data['param'] = array();

                break;
            
            case "equipment":
                $this->load->model('addressmodel', '', TRUE);
                $addressId = $this->input->post('record_id');
                
                $address_equipment = $this->addressmodel->getAddressEquipments($addressId);
                //dump($address_equipment);
                $arr = array();
                $arr = array(
                    'ADDRESS_EQUIPMENT' => $address_equipment,
                    'ADDRESS_ID'=> $addressId
                );
                
                $data['results'] = $arr;
                $data['param'] = $address_equipment['param'];
                //$data['param'] = array();
                
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
                $this->load->model('addresstypemodel', '', TRUE);
                $addressTypeId = $this->input->post('record_id');
                //$zone = array();
                $arr = array();
                if(isset($addressTypeId) && $addressTypeId !='' && !empty($addressTypeId) ) {
                    $address_type = $this->addresstypemodel->getAddressTypeFromId($addressTypeId);
                    $arr = array('ADDRESS_TYPE' => $address_type);
                }
                $data['results'] = $arr;
                break;
                
            case "address":
                $this->load->model('addressmodel', '', TRUE);
                $addressId = $this->input->post('record_id');
                
                $this->load->model('addresstypemodel', '', TRUE);
                $addressTypes = $this->addresstypemodel->getAllAddressTypes();
                
                $this->load->model('zone/zonemodel', '', TRUE);
                $zones = $this->zonemodel->getAllZones();
                //dump($zones);die;
                
                $arr = array();
                if(isset($addressId) && $addressId!='' && !empty($addressId) ) {
                    $address = $this->addressmodel->getAddressFromId($addressId);
                    $arr = array('ADDRESS' => $address);
                }
                
                $arr['ADDRESS_TYPES'] = $addressTypes;
                $arr['ZONES'] = $zones;
                
                $data['results'] = $arr;
                break;

        }

        return $data;
    }
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */