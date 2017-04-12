<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Map_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function getMapData($tableName, $attributeId, $search_string) {
        //echo $table;die;
        $data = array();
        
        if(($tableName != '' )&& ($attributeId != '')) {
            if($tableName== 'equipment') {
                $query = "SELECT equipment.*, address.*, address_type.*"
                    . " FROM equipment "
                    . " JOIN equipment_type"
                    . " ON equipment.equipment_type_id =  equipment_type.equipment_type_id"

                    . "  JOIN equipment_inventory"
                    . " ON equipment.equipment_id =  equipment_inventory.equipment_id"

                    . " JOIN address_equipment"
                    . " ON equipment_inventory.equipment_inventory_id =  address_equipment.equipment_inventory_id "

                    . " JOIN address"
                    . " ON address_equipment.address_id =  address.address_id"

                    . " JOIN address_type"
                    . " ON address.address_type_id = address_type.address_type_id"

                    . " WHERE equipment.equipment_id = ".$attributeId;
                

            } else if($tableName == 'zone') {

                $query = "SELECT zone.*, address.*, address_type.*"
                    . " FROM zone "
                    . " LEFT JOIN address"
                    . " ON zone.zone_id =  address.zone_id"
                    . " LEFT JOIN address_type"
                    . " ON address.address_type_id = address_type.address_type_id"
                    . " WHERE zone.zone_id = ".$attributeId ;
            }  else if($tableName == 'address_type') {

                $query = "SELECT address.*, address_type.*"
                    . " FROM address "
                    . " LEFT JOIN address_type"
                    . " ON address.address_type_id = address_type.address_type_id"
                    . " WHERE address_type.address_type_id = ".$attributeId ;
                
            } else if($tableName == 'state') {
                $query = "SELECT address.*, address_type.*"
                    . " FROM state "
                    . " LEFT JOIN address"
                    . " ON state.state_id =  address.state_id"
                    . " LEFT JOIN address_type"
                    . " ON address.address_type_id = address_type.address_type_id"
                    . " WHERE state.state_id = ".$attributeId ;
            } 
        } else if(isset($search_string) && $search_string !='') {
            $query = "SELECT address.*, address_type.* "
                    . " FROM address LEFT JOIN address_equipment"
                    . " ON address.address_id = address_equipment.address_id"

                    . " LEFT JOIN address_type"
                    . " ON address.address_type_id = address_type.address_type_id"
                        
                    . " LEFT JOIN equipment_inventory"
                    . " ON equipment_inventory.equipment_id = equipment_inventory.equipment_inventory_id"
                    
                    . " LEFT JOIN equipment"
                    . " ON equipment_inventory.equipment_id = equipment.equipment_id"
                        
                    . " LEFT JOIN state"
                    . " ON state.state_id = state.state_id"
                    
                    . " WHERE address_equipment.ip LIKE '%$search_string%'"
                    . " OR equipment.equipment LIKE '%$search_string%' "
                    . " OR address.address LIKE '%$search_string%' "
                    . " OR equipment_inventory.serial_number LIKE '%$search_string%' "
                    . " OR state.state LIKE '%$search_string%' "
                    . " OR address.city LIKE '%$search_string%' "        
                    . " OR address_type.address_type LIKE '$search_string' "        
                    . " OR address.location LIKE '%$search_string%' ";
                    // . "     OR equipment.equipment LIKE '%$search_string%' ";
            //echo $query;die;
        } else {
            $query = "SELECT address.*, address_type.*"
                . " FROM address "
                . " LEFT JOIN address_type"
                . " ON address.address_type_id = address_type.address_type_id";
        }
        //echo $query;die;
        $result = $this->db->query($query);
        foreach ($result->result() as $row){
            $data[]= $row;
        }
        //dump($data);die;
        return $data;
    }
    
    public function getAddressDetailFromId($id) {
        //$addressId = $this->input->post('addressId');
        /*
        $query = "SELECT address.*, address_equipment.date_of_installation, address_equipment.ip"
                . " , equipment_inventory.serial_number, equipment.equipment "
                    . " FROM address LEFT JOIN address_equipment"
                    . " ON address.address_id = address_equipment.address_id"

                    . " LEFT JOIN equipment_inventory"
                    . " ON address_equipment.equipment_inventory_id = equipment_inventory.equipment_inventory_id"
                    
                    . " LEFT JOIN equipment"
                    . " ON equipment_inventory.equipment_id = equipment.equipment_id"
                    
                    . " WHERE address.address_id =".$id;
        */
        
        $query = "SELECT address.*, country.country, state.state, zone.zone_name, address_type.address_type"
                    . " FROM address LEFT JOIN address_type"
                    . " ON address.address_type_id= address_type.address_type_id"
                    . " LEFT JOIN zone"
                    . " ON address.zone_id = zone.zone_id"
                    . " LEFT JOIN country"
                    . " ON address.country_id = country.country_id"
                    . " LEFT JOIN state"
                    . " ON address.state_id= state.state_id"
                    . " WHERE address.address_id =".$id;
        
        $results = $this->db->query($query);
        $data = array();
        
        if(!empty($results) && count($results)> 0) {
            foreach ($results->result() as $row) {
                $data[] = $row;
                
            }
        }
        //dump($data);
        return $data;
                    
    }
    
    public function getCommentStatus() {
        $query = "SELECT * FROM comment_status ";
                
        $result = $this->db->query($query);
        $data = array();
        foreach ($result->result() as $row){
            $data[]= $row;
        }
        
        return $data;
    }
    
    function getCommentsFromAddressId($addressId, $page = null) {

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

        $query_count = ' SELECT count(*) as num_records' 
                . " FROM comment JOIN comment_status "
                . " ON comment.comment_status_id = comment_status.comment_status_id"
                . "  LEFT JOIN user ON"
                . "  comment.user_id = user.user_id"
                . "  WHERE comment.address_id = ".$addressId;
        
        $base_query = "SELECT comment.*, comment_status.comment_status, user.user_name "
                . " FROM comment JOIN comment_status "
                . " ON comment.comment_status_id = comment_status.comment_status_id"
                . "  LEFT JOIN user ON"
                . "  comment.user_id = user.user_id"
                . "  WHERE comment.address_id = ".$addressId;
        
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
            $sort_query = 'ORDER BY comment.added_on';
            $sort = 'comment.added_on';
        } else {
            $sort_query = ' ORDER BY ' . $sort;
        }
        
        if (empty($order)) {
            $order = 'DESC';
        }
        
        $query = $query . ' ' . $sort_query . ' ' . $order;
        
        $query = $query . $limitQuery['query'];
        $start = $limitQuery['start'];
        
        $result = $this->db->query($query);
        $addresss = array();
        foreach ($result->result() as $row) {
                $addresss[] = $row;
        }
        
        $field = "comment";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);
        
        $arr = array(
            'results'    => $addresss,
            'param'      => $params,
        );
        
        return $arr;
    }
    /*
    public function getCommentsFromAddressId($addressId) {
        $query = "SELECT comment.*, comment_status.comment_status, user.user_name "
                . " FROM comment JOIN comment_status "
                . " ON comment.comment_status_id = comment_status.comment_status_id"
                . "  LEFT JOIN user ON"
                . "  comment.user_id = user.user_id"
                . "  WHERE comment.address_id = ".$addressId
                ." ORDER by comment.added_on DESC";
               
        $result = $this->db->query($query);
        $data = array();
        if(!empty($result) && count($result)> 0) {
            foreach ($result->result() as $row){
                $data[]= $row;
            }
        }
        //print_r($data);
        return $data;
    }
     * 
     */
    
    public function getEquipmentFromAddressId($addressId) {
        $query = "SELECT  address_equipment.* "
                . " FROM address LEFT JOIN address_equipment "
                . " ON address.address_id = address_equipment.address_id"
                . "  WHERE address.address_id = ".$addressId;
             
        $result = $this->db->query($query);
        
        $data = array();
        if(!empty($result) && count($result)> 0) {
            foreach ($result->result() as $row){
                $data[]= $row;
            }
        }
        return $data;
    }
    
    public function addComment() {
        
        $user_id = $this->session->userdata('user_id');
        $data = array(
            'comment'=> $this->input->post('comment'),
            'comment_status_id'=> $this->input->post('comment_status'),
            'user_id'=>$user_id,
            'address_id'=>$this->input->post('address_id'),
            'added_on'=> date('Y-m-d H:i:s')
        );
        if($this->db->insert('comment', $data)) {
            return true;
        } else {
            return false;
        }
        
    }
}
