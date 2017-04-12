<?php
$defines_file = './application/helpers/symfony_helper.php';
if (file_exists($defines_file)) {
    require_once($defines_file);
} 


class ProjectModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addProject() {
        $GLOBALS = array();
        $return = false;
        
        $project= $this->input->post('project');
        $slugProject =  Symfony::urlize($project);
        
        $query = 'SELECT * FROM project WHERE project_name = "'.$project.'" ';
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'project_name' => $project,
                'project_slug'=>$slugProject
            );

            $query = $this->db->insert('project', $data);
            if ($query) {
                $return = true;
            } else {
                $return = false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        //echo $return;die;
        return $return;
    }
    
    function updateProject() {
        $return = false;
        $GLOBALS = array();
        
        $project= $this->input->post('project');
        $projectId = $this->input->post('projectId');
        $slugProject =  Symfony::urlize($project);
        
        $query = "SELECT * FROM project WHERE project_name = \"" .$project . "\" AND project_id <> " . $projectId;
	$result = $this->db->query($query);
        if ($result->num_rows() == 0) {	
                $data = array(
                'project_name' => $project,
                'project_slug'=>$slugProject
            );
                
            $this->db->where('project_id', $projectId);
            $response = $this->db->update('project', $data);

            if ($response) {
                $return = true;
            } else {
                $return = false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        return $return;
        
    }
    
    function getProjectFromId($projectId) {
        $query = "SELECT * FROM project WHERE project_id = ".$projectId;
        $result = $this->db->query($query);
        return $result->row();
    }
    
    function getAllProjects() {
        $query = "SELECT * FROM project";
        $results = $this->db->query($query);
        $projects = array();
        foreach ($results->result() as $row) {
            $projects[] = $row;
        }
        return $projects;
        
    }
    function getProjects($page = null) {

        global $PER_PAGE;

        $q = $this->input->post('q');
        $p = 1;

        if (isset($page) && $page > 0) {
            $p = $page; // Page	
        } else {
            $p = $this->input->post('page'); 
            if (!$p) {
                $p = $this->input->get('page');
            }
        }

        $sort = $order = $where = $pp = '';
        $start = 1;
        
        $base_query = $query_count = '';

        $userInput = processUserInput($q);
        
        //Helpers::dump($userInput);die;

        $query_count = ' SELECT count(*) as num_records' .
                '   FROM project' ;

        $base_query = ' SELECT project.*' .
                    ' FROM project' ;
        
        
        if (!empty($userInput['q'])) {
            
           //print_r($userInput);
            
            if (!empty($where) && $where != '') {
                $where .= ' AND (';
            } else {
                $where .= ' WHERE ( ';
            }

            if ($userInput['type'] == 'string') {
                $where .=
                        ' ( ' .
                        ' project.project_name like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( project.project_name like "%' . $userInput['q']['first_name'] . '%"' .
                        ' AND project.project_name like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( project.project_name  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( project.project_name  like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
                }  else {
                    
                }
               
            }

            $where .= ') ';
        }
         
        $query_count = $query_count . $where;
         if($PER_PAGE ==0){
             $PER_PAGE=3;
         }

        $result = $this->db->query($query_count);
        $row = $result->row();
        $numResults = $row->num_records;
        
        if($numResults > 0) {
            $totalPages = ceil($numResults/$PER_PAGE);
            $firstPage = 1;

            if ($totalPages > 0) {
                    $lastPage = $totalPages;
            } else {
                    $lastPage = 1;
            }
        }
        
        
        $base_query = $base_query . $where;
        $query = $base_query;
        
        $limitQuery = buildLimitQuery($p);
        
        if (empty($sort)) {
            $sort_query = 'ORDER BY project_name';
            $sort = 'project_name';
        } else {
            $sort_query = ' ORDER BY ' . $sort;
        }

        if (empty($order)) {
            $order = 'ASC';
        }
        
        
        $query = $query . ' ' . $sort_query . ' ' . $order;
        
        $query = $query . $limitQuery['query'];
        $start = $limitQuery['start'];
        
        $result = $this->db->query($query);
        $projects = array();
        foreach ($result->result() as $row) {
                $projects[] = $row;
        }
        
        $field = "project";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $projects,
            'param'      => $params,
        );

        return $arr;
    }
    
    
    function deleteProject() {
        $return = false;
        
        $id= $this->input->post('projectId');
        if($this->db->delete('project', array('project_id' => $id)) ) {
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }
    
}

?>