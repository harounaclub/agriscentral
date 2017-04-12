<?php
class SellerModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addSeller() {
        
        $GLOBALS = array();
        $return = false;
        
        $seller_name= $this->input->post('name');
        $seller_address= $this->input->post('address');
        
        $query = 'SELECT * FROM  seller'
                . ' WHERE seller_name = "'.$seller_name.'"';
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'seller_name' => $seller_name,
                'seller_address'=>$seller_address
            );

            $query = $this->db->insert('seller', $data);
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
    
    function updateSeller() {
        $GLOBALS = array();
        $return = false;
        
        $seller_name= $this->input->post('name');
        $seller_address= $this->input->post('address');
        $sellerId = $this->input->post('sellerId');
        
        $query = 'SELECT * FROM  seller'
                . ' WHERE seller_name = "'.$seller_name.'"'
                . ' AND seller_id <> '.$sellerId;
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'seller_name' => $seller_name,
                'seller_address'=>$seller_address
            );

            $this->db->where('seller_id', $sellerId);
            $response = $this->db->update('seller', $data);

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
    
    function getSellerFromId($sellerId) {
        $query = "SELECT * FROM seller WHERE seller_id = ".$sellerId;
        $result = $this->db->query($query);
        return $result->row();
    }
    
    function getAllSellers() {
        $query = "SELECT * FROM seller ";
        $results = $this->db->query($query);
        
        $data = array();
        foreach ($results->result() as $row) {
            $data[] = $row;
        }
        return $data;
        
    }
    function getSellers($page = null) {

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
                '   FROM seller' ;

        $base_query = ' SELECT seller.*' .
                    ' FROM seller' ;
        
        
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
                        ' seller.seller_name like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( seller.seller_name like "%' . $userInput['q']['first_name'] . '%"' .
                        ' AND seller.seller_name like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( seller.seller_name  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( seller.seller_name  like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
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
            $sort_query = 'ORDER BY seller_name';
            $sort = 'seller_name';
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
        $sellers = array();
        foreach ($result->result() as $row) {
                $sellers[] = $row;
        }
        
        $field = "seller";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $sellers,
            'param'      => $params,
        );

        return $arr;
    }
    
    
    function deleteSeller() {
        $return = false;
        $id= $this->input->post('sellerId');
        if($this->db->delete('seller', array('seller_id' => $id)) ) {
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }
}

?>