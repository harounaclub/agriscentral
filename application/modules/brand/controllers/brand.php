<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() === 'user') {
            redirect('/map', 'refresh');
        } 
        
        $this->load->model('brand/brandmodel');
    }

    public function index() {
        
        $data = array();
        $this->load->model('brand/brandmodel');
        $brands = $this->brandmodel->getBrands();
        
        $data['BRANDS'] = $brands ;
        $data['footer_assets'] = '/brand/footer_list_assets';
        $data['main_content'] = '/brand/brand_list';
           
        $this->load->view('admin_template', $data);
    }
    
    public function get_brand_from_html() {
        $html = array();
        $data = array();
        $brandId = $this->input->post('brandId');
        
        if(isset($brandId) && $brandId !='' && !empty($brandId) ) {
            $brand = $this->brandmodel->getBrandFromId($brandId);
            $data['BRAND'] = $brand ;
        }
        
        $html['html'] = $this->load->view('/brand/brand_form', $data, true);
        echo json_encode($html);
        
    }
    
    public function update() {
        $data = array();
        $brands = $this->brandmodel->getBrands();
        
        $data['BRANDS'] = $brands ;
        $data['footer_assets'] = '/brand/footer_list_assets';
        $data['main_content'] = '/brand/brand_list';
        $this->load->view('admin_template', $data);
    
    }
    
    public function save_add() {
        $data = array();
        $GLOBALS = array();
        if($this->brandmodel->addBrand()) {
            $this->session->set_flashdata('message', 'Brand has been added!');
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
        $data = array();
        $GLOBALS = array();
        if($this->brandmodel->updateBrand()) {
            $this->session->set_flashdata('message', 'Brand has been updated!');
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
        $data = array();
        $GLOBALS = array();
        if($this->brandmodel->deleteBrand()) {
            //$this->session->set_flashdata('message', 'Brand has been updated!');
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
