
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        if($this->session->userdata('language') == 'english') {
            $this->lang->load("english","english");
        } else if($this->session->userdata('language') == 'french') {
            $this->lang->load("french","french");
        }
    }
    
    public function test() {
        $this->load->view('front_template_1');
    }
    
    public function index() {
        $data = array();
        $this->load->model('address/addresstypemodel');
        $addresstypes = $this->addresstypemodel->getAllAddressTypes();
        if(!empty($addresstypes)) {
            $data['ADDRESS_TYPES'] = $addresstypes;
        }
        
        if(checkAdminAccess() === 1) {
            if($this->uri->segment(1) === 'map') {
                $data['main_content'] = '/map/map';
                $this->load->view('front_template', $data);
            } else {
                redirect('/user/dashboard');
            }
            
        } else if((checkAdminAccess() === 'user' )) {
            $data['main_content'] = '/map/map';
            $this->load->model('map_model');
            
            $this->load->view('front_template', $data);
        } else if(checkAdminAccess() === 0){
            redirect('/user/dashboard');
        } 
    }
    /*
    public function getAaddressDetails() {
        
        
        $addressId = $this->input->post('addressId');
        
        $this->load->model('map_model');
        $details = $this->map_model->getAddressDetailFromId($addressId);
        
        $comment_status = $this->map_model->getCommentStatus();
        $comments = $this->map_model->getCommentsFromAddressId($addressId);
        
        //$comment_details = $this->load->view('/map/comment_detail_html', $data , true);
        $data = array(
            'COMMENT_STATUS'=>$comment_status,
            'COMMENTS' =>$comments,
            'addressId' =>$addressId,
            'DETAILS'=>$details
        );
        
        $address_details = $this->load->view('/map/map_marker_detail_html', $data , true);
        $arr = array(
            'address_detail_html' => $address_details,
            //'comment_detail_html'=> $comment_details 
        );
        
        echo json_encode($arr);
    }
    */
    
    public function view() {
        $addressId = $this->input->post('addressId');
        
        $this->load->model('map_model');
        $details = $this->map_model->getAddressDetailFromId($addressId);
        $data = array(
            'addressId' =>$addressId,
            'DETAILS'=>$details
        );
        
        $address_details = $this->load->view('/map/map_detail', $data , true);
        $arr = array(
            'address_detail_html' => $address_details,
        );
        
        echo json_encode($arr);
    }
    
    public function get_marker_detail() {
        $data = array();
        $tableName = $this->input->post('table_name');
        $attributeId = $this->input->post('attribute_id');
        $search_string = $this->input->post('search_string');
        
        $this->load->model('map_model');
        $details = $this->map_model->getMapData($tableName, $attributeId,$search_string);
        $data['markers'] = $details;

        echo json_encode($data);
    }
    
    public function addComment() {
        $this->load->model('map_model');
        if($this->map_model->addComment()) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }
            
}
