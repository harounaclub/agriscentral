<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Seller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() === 'user') {
            redirect('/map', 'refresh');
        } 
        $this->load->model('seller/sellermodel');
    }

    public function index() {
        
        $data = array();
        $this->load->model('seller/sellermodel');
        $sellers = $this->sellermodel->getSellers();
        
        $data['BRANDS'] = $sellers ;
        $data['footer_assets'] = '/seller/footer_list_assets';
        $data['main_content'] = '/seller/seller_list';
           
        $this->load->view('admin_template', $data);
    }
    
    public function get_seller_from_html() {
        $html = array();
        $data = array();
        $sellerId = $this->input->post('sellerId');
        
        if(isset($sellerId) && $sellerId !='' && !empty($sellerId) ) {
            $seller = $this->sellermodel->getSellerFromId($sellerId);
            $data['BRAND'] = $seller ;
        }
        
        $html['html'] = $this->load->view('/seller/seller_form', $data, true);
        echo json_encode($html);
        
    }
    
    public function update() {
        $data = array();
        $sellers = $this->sellermodel->getSellers();
        
        $data['BRANDS'] = $sellers ;
        $data['footer_assets'] = '/seller/footer_list_assets';
        $data['main_content'] = '/seller/seller_list';
        $this->load->view('admin_template', $data);
    
    }
    
    public function save_add() {
        $data = $GLOBALS = array();
        if($this->sellermodel->addSeller()) {
            $this->session->set_flashdata('message', 'Seller has been added!');
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
        if($this->sellermodel->updateSeller()) {
            $this->session->set_flashdata('message', 'Seller has been updated!');
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
        $data = $GLOBALS  =array();
        if($this->sellermodel->deleteSeller()) {
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
