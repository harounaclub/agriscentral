<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Project extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if(checkAdminAccess() === 0){
            redirect('/user/login');
        } else if(checkAdminAccess() === 'user') {
            redirect('/map', 'refresh');
        } 
        
        $this->load->model('project/projectmodel');
    }

    public function index() {
        
        $data = array();
        $this->load->model('project/projectmodel');
        $projects = $this->projectmodel->getProjects();
        
        $data['BRANDS'] = $projects ;
        $data['footer_assets'] = '/project/project_footer_list_assets';
        $data['main_content'] = '/project/project_list';
           
        $this->load->view('admin_template', $data);
    }
    
    public function get_project_from_html() {
        $html = array();
        $data = array();
        $projectId = $this->input->post('projectId');
        
        if(isset($projectId) && $projectId !='' && !empty($projectId) ) {
            $project = $this->projectmodel->getProjectFromId($projectId);
            $data['BRAND'] = $project ;
        }
        
        $html['html'] = $this->load->view('/project/project_form', $data, true);
        echo json_encode($html);
        
    }
    
    public function update() {
        $data = array();
        $projects = $this->projectmodel->getProjects();
        
        $data['BRANDS'] = $projects ;
        $data['footer_assets'] = '/project/project_footer_list_assets';
        $data['main_content'] = '/project/project_list';
        $this->load->view('admin_template', $data);
    
    }
    
    public function save_add() {
        $data = array();
        $GLOBALS = array();
        if($this->projectmodel->addProject()) {
            $this->session->set_flashdata('message', 'Project has been added!');
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
        if($this->projectmodel->updateProject()) {
            $this->session->set_flashdata('message', 'Project has been updated!');
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
        if($this->projectmodel->deleteProject()) {
            //$this->session->set_flashdata('message', 'Project has been updated!');
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
