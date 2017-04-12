<?php
$defines_file = './application/helpers/symfony_helper.php';
if (file_exists($defines_file)) {
    require_once($defines_file);
} 


class ZoneTypeModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addZoneType() {
        
        $zone_type= $this->input->post('zone_type');
        $slugZoneType =  Symfony::urlize($zone_type);
        
        $GLOBALS = array();
        $return = false;
        
        $query = 'SELECT * FROM  zone_type'
                . ' WHERE zone_type = "'.$zone_type.'"';
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'zone_type' => $zone_type,
                'zone_slug'=>$slugZoneType
            );

            $query = $this->db->insert('zone_type', $data);
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
    
    function updateZoneType() {
        
        $GLOBALS = array();
        $return = false;
        
        $zone_type= $this->input->post('zone_type');
        $slugZoneType =  Symfony::urlize($zone_type);
        $zoneTypeId = $this->input->post('zoneTypeId');
        
        $query = 'SELECT * FROM  zone_type'
                . ' WHERE zone_type = "'.$zone_type.'"'
                . ' AND zone_type_id <> '.$zoneTypeId;
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        if($num_of_rows == 0) {
            $data = array(
                'zone_type' => $zone_type,
                'zone_slug'=>$slugZoneType
            );


            $this->db->where('zone_type_id', $zoneTypeId);
            $response = $this->db->update('zone_type', $data);

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
    
    function getZoneTypeFromId($zone_typeId) {
        $query = "SELECT * FROM zone_type WHERE zone_type_id = ".$zone_typeId;
        $result = $this->db->query($query);
        return $result->row();
    }
    
    function getAllZonetypes() {
        $query = "SELECT * FROM zone_type ";
        $results = $this->db->query($query);
        $data = array();
        foreach ($results->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    
    function getZoneTypes($page = null) {

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
                '   FROM zone_type' ;

        $base_query = ' SELECT zone_type.*' .
                    ' FROM zone_type' ;
        
        
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
                        ' zone_type.zone_type like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( zone_type.zone_type like "%' . $userInput['q']['first_name'] . '%"' .
                        ' AND zone_type.zone_type like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( zone_type.zone_type  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( zone_type.zone_type like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
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
            $sort_query = 'ORDER BY zone_type';
            $sort = 'zone_type';
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
        $zone_types = array();
        foreach ($result->result() as $row) {
                $zone_types[] = $row;
        }
        
        $field = "type";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $zone_types,
            'param'      => $params,
        );
        
        return $arr;
    }
    
    
    function deleteZoneType() {
        $return = false;
        $id= $this->input->post('zoneTypeId');
        if($this->db->delete('zone_type', array('zone_type_id' => $id)) ) {
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }
    
}

?>