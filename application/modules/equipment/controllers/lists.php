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
                $this->load->model('equipmenttypemodel', '', TRUE);
                
                $equipment_types = $this->equipmenttypemodel->getEquipmentTypes();
                //dump($zones);die;
                $arr = array('EQUIPMENT_TYPES' => $equipment_types );
                $data['results'] = $arr;
                $data['param'] = $equipment_types['param'];

                break;
            
            case "equipment":
                $this->load->model('equipmentmodel', '', TRUE);
                
                $equipments = $this->equipmentmodel->getEquipments();
                //dump($zones);die;
                $arr = array('EQUIPMENTS' => $equipments );
                $data['results'] = $arr;
                $data['param'] = $equipments['param'];

                break;
            
            case "equipment_inventory":
                $this->load->model('equipmentmodel', '', TRUE);
                
                $equipment_inventories = $this->equipmentmodel->getEquipmentInventories();
                //dump($zones);die;
                $arr = array('EQUIPMENT_INVENTORIES' => $equipment_inventories );
                $data['results'] = $arr;
                $data['param'] = $equipment_inventories['param'];

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
                $this->load->model('equipmenttypemodel', '', TRUE);
                $equipmentTypeId = $this->input->post('record_id');
                //$zone = array();
                $arr = array();
                if(isset($equipmentTypeId) && $equipmentTypeId !='' && !empty($equipmentTypeId) ) {
                    $equipment_type = $this->equipmenttypemodel->getEquipmentTypeFromId($equipmentTypeId);
                    $arr = array('EQUIPMENT_TYPE' => $equipment_type);
                }
                $data['results'] = $arr;
                break;
                
            case "equipment":
                $this->load->model('equipmentmodel', '', TRUE);
                $equipmentId = $this->input->post('record_id');
                
                $copyaction = $this->input->post('copyaction');
                
                $this->load->model('brand/brandmodel', '', TRUE);
                $brands = $this->brandmodel->getAllBrands();
                
                $this->load->model('equipmenttypemodel', '', TRUE);
                $equipmentTypes = $this->equipmenttypemodel->getAllEquipmenttypes();
                
                $arr = array();
                if(isset($equipmentId) && $equipmentId!='' && !empty($equipmentId) ) {
                    $equipment = $this->equipmentmodel->getEquipmentFromId($equipmentId);
                    $arr['EQUIPMENT'] =$equipment;
                }
                
                $arr['BRANDS'] =$brands;
                $arr['TYPE'] = $copyaction;
                $arr['EQUIPMENT_TYPES'] =$equipmentTypes;
                
                
                $arr['TYPE'] = $copyaction;
                
                $data['results'] = $arr;
                break;
                
            case "equipment_inventory":
                $this->load->model('equipmentmodel', '', TRUE);
                
                $equipmentInventoryId = $this->input->post('record_id');
                
                $equipmentId = $this->input->post('equipmentId');
                
                $copyaction = $this->input->post('copyaction');
                
                $this->load->model('seller/sellermodel', '', TRUE);
                $sellers = $this->sellermodel->getAllSellers();
                
                $arr = array();
                
                
                if(!empty($equipmentInventoryId)) {
                    $equipment_inventory = $this->equipmentmodel->getEquipmentInventoryFromId($equipmentInventoryId);
                    $arr['EQUIPMENT_INVENTORY'] = $equipment_inventory;
                }
                
                if(isset($equipmentId) && $equipmentId!='' && !empty($equipmentId) ) {
                    $equipment = $this->equipmentmodel->getEquipmentFromId($equipmentId);
                    $arr['EQUIPMENT'] = $equipment ;
                }
                
                
                $arr['SELLERS'] =$sellers;
                $arr['TYPE'] = $copyaction;
                
                
                $data['results'] = $arr;
                break;    

        }

        return $data;
    }
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */