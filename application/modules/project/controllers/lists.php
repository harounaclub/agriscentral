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

            case "project":
                $this->load->model('projectmodel', '', TRUE);
                
                $projects = $this->projectmodel->getProjects();
                //dump($projects);die;
                $arr = array('PROJECTS' => $projects );
                $data['results'] = $arr;
                $data['param'] = $projects['param'];

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

            case "project":
                $this->load->model('projectmodel', '', TRUE);
                $projectId = $this->input->post('record_id');
                //$project = array();
                $arr = array();
                if(isset($projectId) && $projectId !='' && !empty($projectId) ) {
                    $project = $this->projectmodel->getProjectFromId($projectId);
                    $arr = array('PROJECT' => $project);
                }
                $data['results'] = $arr;
                break;

        }

        return $data;
    }
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */