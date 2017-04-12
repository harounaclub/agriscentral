<?php
$defines_file = './application/helpers/symfony_helper.php';
if (file_exists($defines_file)) {
    require_once($defines_file);
} 


class AddressModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addAddress() {
        $GLOBALS = array();
        $return = false;
        
        $country_id = $this->input->post('country_id');
        $state_id = $this->input->post('state_id');
        $city = $this->input->post('city');
        $location = $this->input->post('location');
        $address_type_id = $this->input->post('address_type_id');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $address = $this->input->post('address');
        $zipcode = $this->input->post('zipcode');
        
        $query = 'SELECT * FROM  address'
                . ' WHERE address = "'.$address.'"'
                .' AND zipcode = "'.$zipcode.'"';
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'address' => $address,
                'country_id' => $country_id,
                'state_id' => $state_id,
                'location' => $location,
                'zipcode' => $zipcode ,
                'city' => $city,
                'address_type_id' => $address_type_id ,
                'latitude' => $latitude ,
                'longitude' => $longitude,
                'zone_id'=> $this->input->post('zone_id')
            );

            $query = $this->db->insert('address', $data);
            if ($query) {
                $return =  true;
            } else {
                $return = false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        return $return;
    }
    
    function updateAddress() {
        $GLOBALS = array();
        $return = false;
        
        $addressId = $this->input->post('addressId');
        
        $country_id = $this->input->post('country_id');
        $state_id = $this->input->post('state_id');
        $city = $this->input->post('city');
        $location = $this->input->post('location');
        $address_type_id = $this->input->post('address_type_id');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $address = $this->input->post('address');
        $zipcode = $this->input->post('zipcode');
        
        $query = 'SELECT * FROM  address'
                . ' WHERE address = "'.$address.'" '
                .' AND zipcode =  "'.$zipcode.'"'
                .' AND address_id <>'.$addressId;
        
        $result = $this->db->query($query);
        if ($result->num_rows() == 0) {	
            $data = array(
                'address' => $address,
                'country_id' => $country_id,
                'state_id' => $state_id,
                'location' => $location,
                'zipcode' => $zipcode ,
                'city' => $city,
                'address_type_id' => $address_type_id ,
                'latitude' => $latitude ,
                'longitude' => $longitude ,
                'zone_id'=> $this->input->post('zone_id')
            );

            $this->db->where('address_id', $addressId);
            $response = $this->db->update('address', $data);

            if ($response) {
                $return =  true;
            } else {
                $return = false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        return $return;
    }
    
    function getAddressFromId($addressId) {
        $query = ' SELECT address.*, country.country, state.state, equipment_inventory.serial_number, '
                . ' address_type.address_type'
                . ' FROM address '
                . ' LEFT JOIN address_equipment'
                . '     ON address.address_id = address_equipment.address_id'
                . ' LEFT JOIN equipment_inventory'
                . '     ON address_equipment.equipment_inventory_id = equipment_inventory.equipment_inventory_id'
                . ' LEFT JOIN country'
                . '     ON address.country_id = country.country_id'
                . ' LEFT JOIN state'
                . '     ON address.state_id = state.state_id'
                . ' LEFT JOIN address_type '
                . '     ON address.address_type_id = address_type.address_type_id'
                . ' WHERE address.address_id = '.$addressId;
        
        //echo $query;die;
        $result = $this->db->query($query);
        
        return $result->row(); 
    }
    
    function getAddresses($page = null) {

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
                . ' FROM address '
                . ' LEFT JOIN country'
                . ' ON address.country_id = country.country_id'
                . ' LEFT JOIN state'
                . ' ON address.state_id = state.state_id'
                . ' LEFT JOIN address_type '
                . ' ON address.address_type_id = address_type.address_type_id';
        
        $base_query = ' SELECT address.*, country.country, state.state,'
                . ' address_type.address_type'
                . ' FROM address '
                . ' LEFT JOIN country'
                . ' ON address.country_id = country.country_id'
                . ' LEFT JOIN state'
                . ' ON address.state_id = state.state_id'
                . ' LEFT JOIN address_type '
                . ' ON address.address_type_id = address_type.address_type_id';
        
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
                        ' address.address like "%' . $userInput['q'] . '%"  ' .
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                
                if(!empty($userInput['q']['first_name']) && !empty($userInput['q']['last_name'])){
                    $where .=
                        ' ( address.address like "%' . $userInput['q']['first_name'] . '%"' .
                        ' AND address.address like "%' . $userInput['q']['last_name'] . '%" ' .
                        ' ) ';
                    
                } else if(!empty($userInput['q']['first_name'])) {
                    $where .=
                        ' ( address.address  like "%' . $userInput['q']['first_name'] . '%"' .' ) ';
                    
                } else if(!empty($userInput['q']['last_name'])) {
                    $where .=
                        ' ( address.address like "%' . $userInput['q']['last_name'] . '%" ' .' ) ';
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
            $sort_query = 'ORDER BY address_id';
            $sort = 'address_id';
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
        $addresss = array();
        foreach ($result->result() as $row) {
                $addresss[] = $row;
        }
        
        $field = "address";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $addresss,
            'param'      => $params,
        );
        
        return $arr;
    }
    
    
    function deleteAddress() {
        $return = false;
        $id= $this->input->post('addressId');
        
        if($this->db->delete('address', array('address_id' => $id)) ) {
            $return =  true;
        } else {
            $return = false;
        }
        return $return;
    }
    
    function deleteAddressEquipment() {
        $return = false;
        $id= $this->input->post('address_equipment_id');
        
        if($this->db->delete('address_equipment', array('address_equipment_id' => $id)) ) {
            $return =  true;
        } else {
            $return = false;
        }
        return $return;
    }
    
    
    public function getAddressEquipments($addressId) {
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
                . ' FROM address_equipment LEFT JOIN equipment'
                . ' ON address_equipment.equipment_inventory_id = equipment.equipment_id'
                . ' LEFT JOIN address ON'
                . ' address_equipment.address_id = address.address_id'
                . ' LEFT JOIN brand ON'
                . ' equipment.brand_id = brand.brand_id'
                . ' LEFT JOIN address_equipment_status ON'
                . ' address_equipment.address_equipment_id = address_equipment_status.address_equipment_id'
                . ' WHERE address_equipment.address_id = '.$addressId;
        
        $base_query = ' SELECT address_equipment.*, address.address,'
                . ' equipment.equipment,  brand.brand_name, address_equipment_status.status as address_equipment_status, since'
                . ' FROM address_equipment LEFT JOIN equipment_inventory'
                . ' ON address_equipment.equipment_inventory_id = equipment_inventory.equipment_inventory_id'
                . '     LEFT JOIN equipment '
                . ' ON equipment_inventory.equipment_id = equipment.equipment_id'
                . '     LEFT JOIN address ON'
                . ' address_equipment.address_id = address.address_id'
                . ' LEFT JOIN brand ON'
                . ' equipment.brand_id = brand.brand_id'
                . ' LEFT JOIN address_equipment_status ON'
                . ' address_equipment.address_equipment_id = address_equipment_status.address_equipment_id'
                . ' WHERE address_equipment.address_id = '.$addressId;
        
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
            $sort_query = 'ORDER BY address_id';
            $sort = 'address_id';
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
        $addresss = array();
        foreach ($result->result() as $row) {
                $addresss[] = $row;
        }
        
        $field = "equipment";
        
        $paginationParams = buildParamForPagination($numResults, $p, $PER_PAGE);
        $params = requestToParams($numResults, $start, $paginationParams['totalPages'], $paginationParams['firstPage'], $paginationParams['lastPage'], $paginationParams['currentPage'], $sort, $order, $q, $field);

        $arr = array(
            'results'    => $addresss,
            'param'      => $params,
        );
        
        return $arr;
    }
    
    
    public function getEquipmentsForAutocomplete() {
        
        $q = $this->input->get('term');
        $sort = $order = $where = '';
        $userInput = processUserInput($q);
        
        $where .= ' WHERE equipment_inventory.assigned = 0';
        
        if (!empty($userInput['q'])) {
            if (!empty($where)) {
                $where .= ' AND (';
            } else {
                $where .= ' WHERE ( ';
            }

            if ($userInput['type'] == 'string') {
                $where .=
                        ' ( equipment_type.equipment_type like "%' . $userInput['q'] . '%"' .
                        ' OR brand.brand_name like "%' . $userInput['q'] . '%"  ' .
                        ' OR equipment.equipment like "%' . $userInput['q'] . '%"  ' .
                        ' OR equipment_inventory.serial_number 	like "%' . $userInput['q'] . '%"  ' .
                        
                        ' ) ';
            } else if ($userInput['type'] == 'name') {
                $where .=
                        ' ( equipment_type.equipment_type  like "%' . $userInput['q']['first_name'] . '%" ' .
                        ' AND  equipment_type.equipment_type like "%' . $userInput['q']['last_name'] . '%" ' .
                        
                        ' OR brand.brand_name like "%' . $userInput['q']['first_name'] . '%" ' .
                        ' AND  brand.brand_name like "%' . $userInput['q']['last_name'] . '%" ' .
                        
                        ' OR equipment.equipment like "%' . $userInput['q']['first_name'] . '%" ' .
                        ' AND  equipment.equipment like "%' . $userInput['q']['last_name'] . '%" ' .
                        
                        ' OR equipment_type.equipment_type like "%' . $q . '%"' .
                        ' OR brand.brand_name like "%' . $q . '%" '.
                        ' OR equipment.equipment like "%' . $q . '%" ' .
                        
                        ' OR equipment_inventory.serial_number 	like "%' . $userInput['q'] . '%"  ' .
                        
                        ' ) ';
            }

            $where .= ') ';
        }

        
        $query = 'SELECT  equipment.*, equipment_type.equipment_type, brand.brand_name, equipment_inventory.serial_number, equipment_inventory.equipment_inventory_id'
                . ' FROM equipment LEFT JOIN brand'
                . ' ON equipment.brand_id = brand.brand_id'
                . ' LEFT JOIN equipment_type '
                . ' ON equipment.equipment_type_id = equipment_type.equipment_type_id'
                . ' LEFT JOIN equipment_inventory '
                . ' ON equipment.equipment_id = equipment_inventory.equipment_id';

        $query .= $where;
        
        $sort_query = ' ORDER BY equipment ASC';
        
        $query = $query . $sort_query;
        
        $result = $this->db->query($query);

        $equipmemts = array();
        foreach ($result->result() as $row) {
            $equipmemts[] = $row;
        }
        //Helpers::dump($months);die;
        return $equipmemts;
    }
    
    function addAddressEquipment() {
        //dump($_POST);die;
        
        $GLOBALS = array();
        $return = false;
        $added_by = $this->session->userdata('user_id');
        
        $ip = $this->input->post('ip');
        $addressId = $this->input->post('addressId');
        $equipment_inventory_id = $this->input->post('equipment_inventory_id');
        
        //$project_id = $this->input->post('project_id');
        
        $project_ids = $this->input->post('projectIds');
        
        $date_of_installation = $this->input->post('date_of_installation');
        $date_of_installation = (!empty($date_of_installation ) ? date('Y-m-d', strtotime($date_of_installation)) : NULL);
        
        
        $date_of_uninstallation = $this->input->post('date_of_uninstallation');
        $date_of_uninstallation = (!empty($date_of_uninstallation ) ? date('Y-m-d', strtotime($date_of_uninstallation)) : NULL);
        
        $query = 'SELECT * FROM  address_equipment'
                . ' WHERE address_id = "'.$addressId.'"'
                .' AND equipment_inventory_id = "'.$equipment_inventory_id.'"';
        
        $result = $this->db->query($query);
        $num_of_rows = $result->num_rows();
        
        if($num_of_rows == 0) {
            $data = array(
                'address_id' => $addressId,
                'equipment_inventory_id' => $equipment_inventory_id,
                'date_of_installation' => $date_of_installation,
                //'project_id' => $project_id,
                'date_of_uninstallation' => $date_of_uninstallation ,
                'added_by' => $added_by,
                'ip' => $ip ,
                'status' => $this->input->post('status')
            );
            
            $query = $this->db->insert('address_equipment', $data);
            $address_equipment_id = $this->db->insert_id();
            // Update assigned equipment 
            if(!empty($equipment_inventory_id)) {
                $eqpdata = array(
                    'assigned'=>1
                );

                $this->db->where('equipment_inventory_id', $equipment_inventory_id);
                $this->db->update('equipment_inventory', $eqpdata);
            }
             // Add address_equipment project 
            
            if(isset($project_ids) && $project_ids !='') {
                $projectIds = explode(',', $project_ids);
                
                $address_project_data = array(
                    'address_id'    => $addressId,
                    'address_equipment_id'=> $address_equipment_id
                );
            
                if(!empty($projectIds) && count($projectIds)>0) {
                    foreach($projectIds as $project_id) {
                        $address_project_data['project_id'] = $project_id;
                        $this->db->insert('address_equipment_project', $address_project_data);
                    }
                }
            }
            
            if ($query) {
                $return =  true;
            } else {
                $return = false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        return $return;
    }
    
    function updateAddressEquipment() {
        $GLOBALS = array();
        $return = false;
        
        $ip = $this->input->post('ip');
        $added_by = $this->session->userdata('user_id');
        
        $addressId = $this->input->post('addressId');
        $equipment_inventory_id = $this->input->post('equipment_inventory_id');
        //$project_id = $this->input->post('project_id');
        $project_ids = $this->input->post('projectIds');
        
        $date_of_installation = $this->input->post('date_of_installation');
        $date_of_installation = (!empty($date_of_installation ) ? date('Y-m-d', strtotime($date_of_installation)) : NULL);
        
        $date_of_uninstallation = $this->input->post('date_of_uninstallation');
        $date_of_uninstallation = (!empty($date_of_uninstallation ) ? date('Y-m-d', strtotime($date_of_uninstallation)) : NULL);
        
        $addressEquipmentId = $this->input->post('addressEquipmentId');
        
        $query = 'SELECT * FROM  address_equipment'
                . ' WHERE address_id = "'.$addressId.'"'
                .' AND equipment_inventory_id = "'.$equipment_inventory_id.'"'
                .' AND address_equipment_id <>'.$addressEquipmentId;
        
        $result = $this->db->query($query);
        if ($result->num_rows() == 0) {	
            $data = array(
                'address_id' => $addressId,
                'equipment_inventory_id' => $equipment_inventory_id,
                'date_of_installation' => $date_of_installation,
                //'project_id' => $project_id,
                'date_of_uninstallation' => $date_of_uninstallation ,
                'added_by' => $added_by,
                'ip' => $ip ,
                'status' => $this->input->post('status')
            );
            
            $this->db->where('address_equipment_id', $addressEquipmentId);
            $response = $this->db->update('address_equipment', $data);
            
            // UPdate Equipment as assigned 
            
            if(!empty($equipment_inventory_id)) {
                $eqpdata = array(
                    'assigned'=>1
                );

                $this->db->where('equipment_inventory_id', $equipment_inventory_id);
                $this->db->update('equipment_inventory', $eqpdata);
            }
            
            if(isset($project_ids) && $project_ids !='') {
                $projectIds = explode(',', $project_ids);
                
                $address_project_data = array(
                    'address_id'    => $addressId,
                    'address_equipment_id'=> $addressEquipmentId
                );
                
                
                if(!empty($projectIds) && count($projectIds)>0) {
                    $this->db->where('address_equipment_id' , $addressEquipmentId);
                    $this->db->delete('address_equipment_project'); 
                    
                    foreach($projectIds as $project_id) {
                        $address_project_data['project_id'] = $project_id;
                        $this->db->insert('address_equipment_project', $address_project_data);
                    }
                }
            }
            
            if ($response) {
                $return =  true;
            } else {
                $return = false;
            }
        } else {
            $GLOBALS['error'] = 'duplicate';
            $return = false;
        }
        return $return;
    }
    
    public function getEquipmentAddressFromId($equipment_address_id) {
        
        $query = ' SELECT address_equipment.*, equipment.equipment, brand.brand_name,  equipment_inventory.serial_number'
                . ' FROM address_equipment '
                . ' LEFT JOIN equipment_inventory'
                . '     ON address_equipment.equipment_inventory_id = equipment_inventory.equipment_inventory_id'
                . ' LEFT JOIN equipment '
                . '     ON equipment_inventory.equipment_id = equipment.equipment_id'
                . ' LEFT JOIN brand '
                . '     ON equipment.brand_id = brand.brand_id'
                . ' LEFT JOIN equipment_type'
                . ' ON  equipment.equipment_type_id = equipment_type.equipment_type_id'
                . ' WHERE address_equipment.address_equipment_id= '.$equipment_address_id;
        
        $result = $this->db->query($query);
        
        
        
        return $result->row(); 
    }
    
    public function getAddedProjectForEquipment($equipment_address_id) {
        $query = ' SELECT address_equipment_project.*'
                . ' FROM address_equipment_project '
                . ' WHERE address_equipment_project.address_equipment_id= '.$equipment_address_id;
        
        $results = $this->db->query($query);
        $data = array();
        if(!empty($results) && count($results) > 0 ) {
            foreach ($results->result() as $key => $row) {
                $data[$row->project_id] = $row;
            }
        }
        return $data;
    }
    
    public function getCoordinates() {
        $address = $this->input->post('address');
        $location = $this->input->post('location');
        $city =  $this->input->post('city');
        
        $full_address = $address . ', '.  $location . ', ' . $city;
        $GEOCODE_URL = 'http://maps.google.com/maps/api/geocode/json';
        $url = $GEOCODE_URL . "?address=".  urlencode($full_address)."&sensor=false";
        $geocode = file_get_contents($url);
        $output = array();
        $output= json_decode($geocode);
        
        $data = array();
        if(!empty($output->results)) {
            //dump($output->results);
            $data = $output->results[0]->geometry->location;
        } 
        return $data;
        
        
    }
    
    function getStates() {
        $query = "SELECT * FROM state";
        $results = $this->db->query($query);
        $data = array();
        foreach ($results->result() as $row) {
            $data[] = $row;
        }
        return $data;
        
    }
    
    
}