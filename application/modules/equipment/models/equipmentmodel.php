<?php
$defines_file = './application/helpers/symfony_helper.php';
if (file_exists($defines_file)) {
    require_once($defines_file);
} 


class EquipmentModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addEquipment() {
        $GLOBALS = array();
        $return = false;
        
        $brand_id = $this->input->post('brand_id');
        $equipment_type_id = $this->input->post('equipment_type_id');
        $equipment = $this->input->post('equipment');
        $equipment = $this->input->post('equipment');
        $equipment_slug = Symfony::urlize($equipment);
        
        $query = 'SELECT * FROM  equipment'
                . ' WHERE equipment_slug = "'.$equipment_slug .'" ';
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'equipment'=> $this->input->post('equipment'),
                'equipment_slug'=> $equipment_slug,
                'brand_id' => $brand_id,
                'equipment_type_id' => $equipment_type_id,
                'equipment' => $equipment,
                'status' => $this->input->post('status')
            );

            $response = $this->db->insert('equipment', $data);
            if ($response) {
                $return =  true;
            } else {
                $return =  false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        
        return $return;
    }
    
    
    function addEquipmentInventory() {
        $GLOBALS = array();
        $return = false;
        $seller_id = $this->input->post('seller_id');
        $equipment_id = $this->input->post('equipmentId');
        $dop = $this->input->post('dop');
        $dop = ((!empty($dop) ? date('Y-m-d', strtotime($dop)) : NULL));
        $serial_number = $this->input->post('serial_number');
        
        $query = 'SELECT * FROM  equipment_inventory'
                . ' WHERE serial_number = "'.$serial_number .'"'
                . '  AND equipment_id ='.$equipment_id;
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'seller_id' => $seller_id,
                'equipment_id'=>$equipment_id,
                'serial_number' => $serial_number,
                'date_of_purchase' => $dop ,
                'status' => $this->input->post('status')
            );

            $response = $this->db->insert('equipment_inventory', $data);
            if ($response) {
                $return =  true;
            } else {
                $return =  false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        
        return $return;
    }
    
    function updateEquipment() {
        $GLOBALS = array();
        $return = false;
        
        $equipmentId = $this->input->post('equipmentId');
        
        $brand_id = $this->input->post('brand_id');
        $equipment_type_id = $this->input->post('equipment_type_id');
        $equipment = $this->input->post('equipment');
        $equipment = $this->input->post('equipment');
        $equipment_slug = Symfony::urlize($equipment);
        
        $query = 'SELECT * FROM  equipment'
                . ' WHERE equipment_slug = "'.$equipment_slug .'"'
                . ' AND equipment_id <>'.$equipmentId;
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'equipment'=> $this->input->post('equipment'),
                'equipment_slug'=> $equipment_slug,
                'brand_id' => $brand_id,
                'equipment_type_id' => $equipment_type_id,
                'equipment' => $equipment,
                'status' => $this->input->post('status')
            );

            $this->db->where('equipment_id', $equipmentId);
            $response = $this->db->update('equipment', $data);

            if ($response) {
                $return =  true;
            } else {
                $return =  false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        
        return $return;
    }
    
    function updateEquipmentInventory() {
        $GLOBALS = array();
        $return = false;
        
        $seller_id = $this->input->post('seller_id');
        
        $dop = $this->input->post('dop');
        $dop = ((!empty($dop) ? date('Y-m-d', strtotime($dop)) : NULL));
        $serial_number = $this->input->post('serial_number');
        $equipment_id = $this->input->post('equipmentId');
        
        $equipmentInventoryId = $this->input->post('equipmentInventoryId');
        
        $query = 'SELECT * FROM  equipment_inventory'
                . ' WHERE serial_number = "'.$serial_number .'"'
                . '  AND equipment_id ='.$equipment_id
                . ' AND equipment_inventory_id <>'.$equipmentInventoryId;
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'seller_id' => $seller_id,
                'equipment_id'=>$equipment_id,
                'serial_number' => $serial_number,
                'date_of_purchase' => $dop ,
                'status' => $this->input->post('status')
            );
            
            $this->db->where('equipment_inventory_id', $equipmentInventoryId);
            $response = $this->db->update('equipment_inventory', $data);

            if ($response) {
                $return =  true;
            } else {
                $return =  false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        
        return $return;
    }
    
    function getEquipmentFromId($equipmentId) {
        $query = ' SELECT equipment.*, brand.brand_name, '
                . ' equipment_type.equipment_type'
                . ' FROM equipment '
                . ' LEFT JOIN brand'
                . ' ON equipment.brand_id = brand.brand_id'
                . ' LEFT JOIN equipment_type '
                . ' ON equipment.equipment_type_id = equipment_type.equipment_type_id'
                . ' WHERE equipment.equipment_id = '.$equipmentId;
        
        $result = $this->db->query($query);
        return $result->row();
    }
    
    function getEquipmentInventoryFromId($equipmentInventoryId) {
        $query = ' SELECT equipment_inventory.*, seller.seller_name'
                . ' FROM equipment_inventory LEFT JOIN seller'
                . ' ON equipment_inventory.seller_id = seller.seller_id'
                . ' WHERE equipment_inventory.equipment_inventory_id = '.$equipmentInventoryId;
        
        $result = $this->db->query($query);
        return $result->row();
    }
    
    function getEquipments($page = null) {

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
                . ' FROM equipment '
                . '     LEFT JOIN brand'
                . ' ON equipment.brand_id = brand.brand_id'
                . ' LEFT JOIN equipment_type '
                . ' ON equipment.equipment_type_id = equipment_type.equipment_type_id';
        
        $base_query = ' SELECT equipment.*, brand.brand_name,'
                . ' equipment_type.equipment_type'
                . ' FROM equipment '
                . '     LEFT JOIN brand'
                . ' ON equipment.brand_id = brand.brand_id'
                . ' LEFT JOIN equipment_type '
                . ' ON equipment.equipment_type_id = equipment_type.equipment_type_id';
                    
        
        
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
                        ' equipment.equipment like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( equipment.equipment like "%' . $userInput['q']['first_name'] . '%"' .
                        ' AND equipment.equipment like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( equipment.equipment  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( equipment.equipment like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
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
            $sort_query = 'ORDER BY equipment_id';
            $sort = 'equipment_id';
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
        $equipments = array();
        foreach ($result->result() as $row) {
                $equipments[] = $row;
        }
        
        $field = "equipment";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $equipments,
            'param'      => $params,
        );
        
        return $arr;
    }
    
    
    function getEquipmentInventories($page = null) {
        
        global $PER_PAGE;

        $q = $this->input->post('q');
        
        $equipmentId = $this->input->post('equipmentId');
        
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
                . ' FROM equipment_inventory '
                . '     LEFT JOIN seller'
                . ' ON equipment_inventory.seller_id= seller.seller_id';
        
        $base_query = ' SELECT equipment_inventory.*, seller.seller_name'
                . ' FROM equipment_inventory '
                . '     LEFT JOIN seller'
                . ' ON equipment_inventory.seller_id= seller.seller_id';
        
        
        if (!empty($where) && $where != '') {
                $where .= ' AND (';
        } else {
            $where .= ' WHERE ( ';
        }
        
        
        $where .= 'equipment_inventory.equipment_id = '.$equipmentId;
        $where .= ' )';

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
                        ' OR equipment_inventory.serial_number like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
                
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( seller.seller_name like "%' . $userInput['q']['first_name'] . '%"' .
                        ' OR seller.seller_name like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( seller.seller_name  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( seller.seller_name like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
                }  else {
                    $where .=
                        ' ( seller.seller_name like "%' . $q . '%"' .
                        ' OR equipment_inventory.serial_number like "%' . $q. '%" ' .
                        ' ) ';
                }
               
            }

            $where .= ') ';
        }
         
        $query_count = $query_count . $where;
        //echo $query_count ;die;
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
            $sort_query = 'ORDER BY equipment_inventory_id';
            $sort = 'equipment_inventory_id';
        } else {
            $sort_query = ' ORDER BY ' . $sort;
        }

        if (empty($order)) {
            $order = 'ASC';
        }

        
        $query = $query . ' ' . $sort_query . ' ' . $order;
        
        $query = $query . $limitQuery['query'];
        $start = $limitQuery['start'];
        //echo $query;
        $result = $this->db->query($query);
        $equipments = array();
        foreach ($result->result() as $row) {
                $equipments[] = $row;
        }
        
        $field = "equipment_inventory";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $equipments,
            'param'      => $params,
        );
        
        return $arr;
    }
    
    
    function deleteEquipment() {
        $return = false;
        $id= $this->input->post('equipmentId');
        if($this->db->delete('equipment', array('equipment_id' => $id)) ) {
            $return =  true;
        } else {
            $return =  false;
        }
        return $return;
    }
    function deleteEquipmentInventory() {
        $return = false;
        $id= $this->input->post('equipmentInventoryId');
        if($this->db->delete('equipment_inventory', array('equipment_inventory_id' => $id)) ) {
            $return =  true;
        } else {
            $return =  false;
        }
        return $return;
    }
    
    
    function getAllEquipments() {
        $query = "SELECT * FROM equipment";
        $results = $this->db->query($query);
        $data = array();
        foreach ($results->result() as $row) {
            $data[] = $row;
        }
        return $data;
        
    }
    function getAllEquipmentsForExcel() {
        $query = "SELECT * FROM equipment";
        $results = $this->db->query($query);
        $data = array();
        foreach ($results->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
        
    }
    
    function getCountOfEquipmentInventory() {
        $query = "SELECT count(*) as num_rows FROM equipment_inventory";
        $results = $this->db->query($query);
        $row = $results->row();
        $count  = 0;
        if(!empty($row)) {
            $count = $row->num_rows;
        }
        return $count;
    }
    
    function getInstalledEquipmentInventory() {
        //$query = "SELECT count(*) as count_installed_equipment FROM address_equipment";
        $query = "SELECT count(*) as count_installed_equipment FROM equipment_inventory WHERE assigned = 1";
        $results = $this->db->query($query);
        $row = $results->row();
        $count  = 0;
        if(!empty($row)) {
            $count = $row->count_installed_equipment;
        }
        return $count;
    }
    
    function getEquipmentInveoryDetails() {
        // Get Total Equipment 
        
        $query = "SELECT equipment_inventory.*, equipment.* "
                . " FROM equipment  LEFT JOIN equipment_inventory"
                . " ON equipment.equipment_id = equipment_inventory.equipment_id";
        $results = $this->db->query($query);
        foreach ($results->result() as $key => $value) {
            if($value->assigned == 1) {
                $a[$value->equipment]['installed'][] = $value->equipment_inventory_id;
            } else if($value->assigned == 0) {
                $a[$value->equipment]['uninstalled'][] =  $value->equipment_inventory_id;
            }
        }
        
        $data = array();
        if(!empty($a) && count($a) > 0) {
            foreach($a as $key=>$val) {
                if(!empty($a[$key]['uninstalled'])) {
                    $data[$key]['unassigned'] = count($val['uninstalled']);
                } else {
                    $data[$key]['unassigned'] = 0;
                }

                if(!empty($a[$key]['installed'])) {
                    $data[$key]['assigned'] = count($val['installed']);
                } else {
                    $data[$key]['assigned'] = 0;
                }

            }
        }
        //dump($data);
        return $data;
        
    }
    
    function getEquipmentMonthly() {
        
        $query = "SELECT equipment.equipment, equipment_inventory.* "
                . " FROM equipment Right JOIN equipment_inventory "
                . " ON equipment.equipment_id = equipment_inventory.equipment_id"
                . " WHERE equipment_inventory.date_of_added like '%2015%'"
                . " AND equipment_inventory.assigned = 1";
         
        $results = $this->db->query($query);
        
        foreach ($results->result() as $key => $value) {
            $addedmonth = date('M', strtotime($value->date_of_added));
            $a[$addedmonth]['total'][] = $value->equipment_inventory_id;
            $a[$addedmonth]['added_equipment'][$value->equipment][] = $value->equipment_inventory_id;
        }
        
        $query = "SELECT equipment.equipment, equipment_inventory.date_of_added, equipment_inventory.assigned, "
                . " address_equipment.date_of_installation "
                . " FROM equipment JOIN equipment_inventory"
                . " ON equipment.equipment_id = equipment_inventory.equipment_id"
                . " JOIN address_equipment"
                . " ON address_equipment.equipment_inventory_id = equipment_inventory.equipment_inventory_id"
                . " WHERE address_equipment.date_of_installation like '%2015%'";
        
        $results = $this->db->query($query);
        
        foreach ($results->result() as $key => $value) {
            $date_of_installation = date('M', strtotime($value->date_of_installation));
            $a[$date_of_installation]['installed'][] = $value->equipment;
            $a[$date_of_installation]['installed_equipment'][$value->equipment][] = $value->equipment;
        }
        
        $data = array();
        if(!empty($a) && count($a) > 0) {
            foreach($a as $key=>$val) {
                if(!empty($a[$key]['installed'])) {
                    $data[$key]['installed'] = count($val['installed']);
                } else {
                    $data[$key]['installed'] = 0;
                }

                if(!empty($a[$key]['total'])) {
                    $data[$key]['added'] = count($a[$key]['total']);
                } else {
                    $data[$key]['added'] = 0;
                }

                if(!empty($a[$key]['added_equipment'])) {
                    $data[$key]['added_equipment'] = $a[$key]['added_equipment'];
                } else {
                    $data[$key]['added_equipment'] = 0;
                }

                if(!empty($a[$key]['installed_equipment'])) {
                    $data[$key]['installed_equipment'] = $a[$key]['installed_equipment'];
                } else {
                    $data[$key]['installed_equipment'] = 0;
                }

            }
        }
        //dump($data);
        return $data;
    }
    
    
    
    
    
}

?>