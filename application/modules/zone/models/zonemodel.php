<?php
$defines_file = './application/helpers/symfony_helper.php';
if (file_exists($defines_file)) {
    require_once($defines_file);
} 


class ZoneModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addZone() {
        $GLOBALS = array();
        $return = false;
        
        $zone= $this->input->post('zone');
        $slugZone =  Symfony::urlize($zone);
        
        $query = 'SELECT * FROM  zone'
                . ' WHERE zone_name = "'.$zone.'"';
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'zone_name' => $zone,
                'zone_slug'=>$slugZone,
                'zone_type_id'=> $this->input->post('zone_type_id')
            );

            $query = $this->db->insert('zone', $data);
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
    
    function updateZone() {
        $GLOBALS = array();
        $return = false;
        
        $zone= $this->input->post('zone');
        $slugZone =  Symfony::urlize($zone);
        $zoneId = $this->input->post('zoneId');
        
        $query = 'SELECT * FROM  zone'
                . ' WHERE zone_name = "'.$zone.'"'
                . ' AND zone_id <> '.$zoneId;
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'zone_name' => $zone,
                'zone_slug'=>$slugZone,
                'zone_type_id'=> $this->input->post('zone_type_id')
            );

            $this->db->where('zone_id', $zoneId);
            $response = $this->db->update('zone', $data);

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
    
    function getZoneFromId($zoneId) {
        $query = "SELECT * FROM zone WHERE zone_id = ".$zoneId;
        $result = $this->db->query($query);
        return $result->row();
    }
    
    function getAllZones() {
        $query = "SELECT * FROM zone";
        $results = $this->db->query($query);
        $zones = array();
        foreach ($results->result() as $row) {
            $zones[] = $row;
        }
        return $zones;
        
    }
    
    function getZoneFromZoneSlug($zone_slug) {
        $this->db->select('*');
        $this->db->from('zone');
        $this->db->where('zone_slug', $zone_slug);
        $result = $this->db->get();
        return $result->row();
    }
    
    function getZones($page = null) {

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
                ' FROM zone LEFT JOIN'
                . ' zone_type ON zone.zone_type_id = zone_type.zone_type_id' ;

        $base_query = ' SELECT zone.*, zone_type.zone_type' .
                  ' FROM zone LEFT JOIN'
                . ' zone_type ON zone.zone_type_id = zone_type.zone_type_id' ;
        
        
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
                        ' zone.zone_name like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( zone.zone_name like "%' . $userInput['q']['first_name'] . '%"' .
                        ' AND zone.zone_name like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( zone.zone_name  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( zone.zone_name  like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
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
            $sort_query = 'ORDER BY zone_name';
            $sort = 'zone_name';
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
        $zones = array();
        foreach ($result->result() as $row) {
                $zones[] = $row;
        }
        
        $field = "zone";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $zones,
            'param'      => $params,
        );
        //dump($arr);die;
        return $arr;
    }
    
    function deleteZone() {
        $return = false;
        $id= $this->input->post('zoneId');
        if($this->db->delete('zone', array('zone_id' => $id)) ) {
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }
    
}

?>