<?php
$defines_file = './application/helpers/symfony_helper.php';
if (file_exists($defines_file)) {
    require_once($defines_file);
} 


class EquipmentTypeModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addEquipmentType() {
        
        $equipment_type= $this->input->post('equipment_type');
        $slugEquipmentType =  Symfony::urlize($equipment_type);
        
        $GLOBALS = array();
        $return = false;
        
        $query = 'SELECT * FROM  equipment_type'
                . ' WHERE equipment_type = "'.$equipment_type.'"';
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'equipment_type' => $equipment_type,
                'equipment_slug'=>$slugEquipmentType
            );

            $query = $this->db->insert('equipment_type', $data);
            if ($query) {
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
    
    function updateEquipmentType() {
        
        $GLOBALS = array();
        $return = false;
        
        $equipment_type= $this->input->post('equipment_type');
        $slugEquipmentType =  Symfony::urlize($equipment_type);
        $equipmentTypeId = $this->input->post('equipmentTypeId');
        
        $query = 'SELECT * FROM  equipment_type'
                . ' WHERE equipment_type = "'.$equipment_type.'"'
                . ' AND equipment_type_id <> '.$equipmentTypeId;
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        if($num_of_rows == 0) {
            $data = array(
                'equipment_type' => $equipment_type,
                'equipment_slug'=>$slugEquipmentType
            );


            $this->db->where('equipment_type_id', $equipmentTypeId);
            $response = $this->db->update('equipment_type', $data);

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
    
    function getEquipmentTypeFromId($equipment_typeId) {
        $query = "SELECT * FROM equipment_type WHERE equipment_type_id = ".$equipment_typeId;
        $result = $this->db->query($query);
        return $result->row();
    }
    
    function getAllEquipmenttypes() {
        $query = "SELECT * FROM equipment_type ";
        $results = $this->db->query($query);
        $data = array();
        foreach ($results->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    
    function getEquipmentTypes($page = null) {

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
                '   FROM equipment_type' ;

        $base_query = ' SELECT equipment_type.*' .
                    ' FROM equipment_type' ;
        
        
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
                        ' equipment_type.equipment_type like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( equipment_type.equipment_type like "%' . $userInput['q']['first_name'] . '%"' .
                        ' AND equipment_type.equipment_type like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( equipment_type.equipment_type  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( equipment_type.equipment_type like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
                }  else {
                    
                }
               
            }

            $where .= ') ';
        }
         
        $query_count = $query_count . $where;

        $result = $this->db->query($query_count);
        $row = $result->row();
        $numResults = $row->num_records;

        $totalPages = ceil($numResults/$PER_PAGE);
        $firstPage = 1;

        if ($totalPages > 0) {
                $lastPage = $totalPages;
        } else {
                $lastPage = 1;
        }
        
        
        
        $base_query = $base_query . $where;
        $query = $base_query;
        
        $limitQuery = buildLimitQuery($p);
        
        if (empty($sort)) {
            $sort_query = 'ORDER BY equipment_type';
            $sort = 'equipment_type';
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
        $equipment_types = array();
        foreach ($result->result() as $row) {
                $equipment_types[] = $row;
        }
        
        $field = "type";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $equipment_types,
            'param'      => $params,
        );
        
        return $arr;
    }
    
    
    function deleteEquipmentType() {
        $return = false;
        $id= $this->input->post('equipmentTypeId');
        if($this->db->delete('equipment_type', array('equipment_type_id' => $id)) ) {
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }
    
}

?>