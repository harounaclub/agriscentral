<?php
$defines_file = './application/helpers/symfony_helper.php';
if (file_exists($defines_file)) {
    require_once($defines_file);
} 


class BrandModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addBrand() {
        $GLOBALS = array();
        $return = false;
        
        $brand= $this->input->post('brand');
        $slugBrand =  Symfony::urlize($brand);
        
        $query = 'SELECT * FROM brand WHERE brand_name = "'.$brand.'" ';
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'brand_name' => $brand,
                'brand_slug'=>$slugBrand
            );

            $query = $this->db->insert('brand', $data);
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
    
    function updateBrand() {
        $return = false;
        $GLOBALS = array();
        
        $brand= $this->input->post('brand');
        $brandId = $this->input->post('brandId');
        $slugBrand =  Symfony::urlize($brand);
        
        $query = "SELECT * FROM brand WHERE brand_name = \"" .$brand . "\" AND brand_id <> " . $brandId;
	$result = $this->db->query($query);
        if ($result->num_rows() == 0) {	
                $data = array(
                'brand_name' => $brand,
                'brand_slug'=>$slugBrand
            );
                
            $this->db->where('brand_id', $brandId);
            $response = $this->db->update('brand', $data);

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
    
    function getBrandFromId($brandId) {
        $query = "SELECT * FROM brand WHERE brand_id = ".$brandId;
        $result = $this->db->query($query);
        return $result->row();
    }
    
    function getAllBrands() {
        $query = "SELECT * FROM brand";
        $results = $this->db->query($query);
        $brands = array();
        foreach ($results->result() as $row) {
            $brands[] = $row;
        }
        return $brands;
        
    }
    function getBrands($page = null) {

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
                '   FROM brand' ;

        $base_query = ' SELECT brand.*' .
                    ' FROM brand' ;
        
        
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
                        ' brand.brand_name like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( brand.brand_name like "%' . $userInput['q']['first_name'] . '%"' .
                        ' AND brand.brand_name like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( brand.brand_name  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( brand.brand_name  like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
                }  else {
                    
                }
               
            }

            $where .= ') ';
        }
         if($PER_PAGE ==0){
             $PER_PAGE=3;
         }
        $query_count = $query_count . $where;

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
            $sort_query = 'ORDER BY brand_name';
            $sort = 'brand_name';
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
        $brands = array();
        foreach ($result->result() as $row) {
                $brands[] = $row;
        }
        
        $field = "brand";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $brands,
            'param'      => $params,
        );

        return $arr;
    }
    
    
    function deleteBrand() {
        $return = false;
        
        $id= $this->input->post('brandId');
        if($this->db->delete('brand', array('brand_id' => $id)) ) {
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }
    
}

?>