<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        }
        
        if($this->session->userdata('language') == 'english') {
            $this->lang->load("english","english");
        } else if($this->session->userdata('language') == 'french') {
            $this->lang->load("french","french");
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
        $html = $this->load->view('/dynamic_list/' . $formType, $data, true);
        /*
        if($formType == 'type') {
            $html = $this->load->view('/type/dynamic_list/' . $formType, $data, true);
        } else {
            $html = $this->load->view('/'.$section.'/dynamic_list/' . $formType, $data, true);
        }
         * 
         */
        return $html;
    }

    function getData($formType, $record_id) {
        $data = array();
        
        switch ($formType) {

            case "information":
                $this->load->model('map_model');
                $details = $this->map_model->getAddressDetailFromId($record_id);
        
                $arr = array('DETAILS' => $details );
                $data['results'] = $arr;
                
                $data['param'] = array();
                
                break;
            
            case "comment":
                $this->load->model('map_model');
                $comment_status = $this->map_model->getCommentStatus();
                $comments = $this->map_model->getCommentsFromAddressId($record_id);
                
                $arr = array('COMMENT_STATUS' => $comment_status,
                        'COMMENTS' =>$comments
                        );
                $data['results'] = $arr;
                $data['param'] = $comments['param'];

                break;
            
           case "equipment":
                $this->load->model('address/addressmodel');
                $equipments = $this->addressmodel->getAddressEquipments($record_id);
                
                $arr = array('EQUIPMENTS' => $equipments );
                $data['results'] = $arr;
                $data['param'] = $equipments['param'];
                
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
        $html = $this->load->view('/dynamic_form/' . $formType, $data, true);
        return $html;
    }
    
    function getFormData($formType, $record_id) {
        $data = array();

        switch ($formType) {
            case "comment":
                $this->load->model('map_model');
                $comment_status = $this->map_model->getCommentStatus();
                $arr = array();
                $arr = array(
                    'address_id'=> $record_id,
                    'COMMENT_STATUS'=>$comment_status
                );
                /*
                if(isset($addressTypeId) && $addressTypeId !='' && !empty($addressTypeId) ) {
                    $address_type = $this->addresstypemodel->getAddressTypeFromId($addressTypeId);
                    $arr = array('ADDRESS_TYPE' => $address_type);
                }
                 * 
                 */
                $data['results'] = $arr;
                break;
               
        }

        return $data;
    }
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */