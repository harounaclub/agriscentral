<?php
$defines_file = './application/helpers/symfony_helper.php';
if (file_exists($defines_file)) {
    require_once($defines_file);
} 


class AddressTypeModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addAddressType() {
        $GLOBALS = array();
        $return = false;
        
        $address_type= $this->input->post('address_type');
        $address_type_slug =  Symfony::urlize($address_type);
        
        $query = 'SELECT * FROM  address_type'
                . ' WHERE address_type = "'.$address_type.'"';
                
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'address_type' => $address_type,
                'address_type_slug'=>$address_type_slug
            );

            $query = $this->db->insert('address_type', $data);
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
    
    function updateAddressType() {
        $GLOBALS = array();
        $return = false;
        
        $addressTypeId = $this->input->post('addressTypeId');
        $address_type= $this->input->post('address_type');
        $address_type_slug =  Symfony::urlize($address_type);
        
        $query = 'SELECT * FROM  address_type'
                . ' WHERE address_type = "'.$address_type.'"'
                . ' AND address_type_id <>' .$addressTypeId;
                
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'address_type' => $address_type,
                'address_type_slug'=>$address_type_slug
            );

            $this->db->where('address_type_id', $addressTypeId);
            $response = $this->db->update('address_type', $data);

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
    
    function getAddressTypeFromId($address_type_id) {
        $query = "SELECT * FROM address_type WHERE address_type_id = ".$address_type_id;
        $result = $this->db->query($query);
        return $result->row();
    }
    
    
    
    function getAllAddressTypes() {
        $query = "SELECT * FROM address_type ";
        $results = $this->db->query($query);
        $data = array();
        foreach ($results->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    
    function getAddressTypeFromSlug($address_type_slug) {
        $this->db->select('*');
        $this->db->from('address_type');
        $this->db->where('address_type_slug', $address_type_slug);
        $result = $this->db->get();
        return $result->row();
    }
    
    
    function getAddressTypes($page = null) {

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
                '   FROM address_type' ;

        $base_query = ' SELECT address_type.*' .
                    ' FROM address_type' ;
        
        
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
                        ' address_type.address_type like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( address_type.address_type like "%' . $userInput['q']['first_name'] . '%"' .
                        ' AND address_type.address_type like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( address_type.address_type  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( address_type.address_type like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
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
            $sort_query = 'ORDER BY address_type';
            $sort = 'address_type';
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
        $address_types = array();
        foreach ($result->result() as $row) {
                $address_types[] = $row;
        }
        
        $field = "type";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $address_types,
            'param'      => $params,
        );
        
        return $arr;
    }
    
    
    function deleteAddressType() {
        $return = false;
        $id= $this->input->post('addressTypeId');
        if($this->db->delete('address_type', array('address_type_id' => $id)) ) {
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }
    
}

?>