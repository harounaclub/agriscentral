<?php
$defines_file = './application/helpers/symfony_helper.php';
if (file_exists($defines_file)) {
    require_once($defines_file);
} 


class ImportModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function importCSV() {
        $query = 'SELECT * FROM import_csv WHERE is_import is NULL';
        
        $results = $this->db->query($query);
        
        if(!empty($results) &&count($results) > 0) {
            foreach ($results->result() as $row) {
                // Zone Add/update 
                $zone = $row->Zone;
                $zone_slug = Symfony::urlize($zone);
                
                $this->db->select('*');
                $this->db->from('zone');
                $this->db->where('zone_slug', $zone_slug);
                $query = $this->db->get();
                
                if ($query->num_rows() > 0){
                    // Update Zone
                    
                } else {
                    // Add Zone 
                    $zonedata = array(
                        'zone_name'=>$zone,
                        'zone_slug'=>$zone_slug
                    );
                    $this->db->insert('zone', $zonedata);
                }
                
                
                // AddressType Add/upadte
                
                $address_type = $row->Proprietaire_site;
                $address_type_slug = Symfony::urlize($address_type);
                
                $this->db->select('*');
                $this->db->from('address_type');
                $this->db->where('address_type_slug', $address_type_slug);
                $query = $this->db->get();
                
                if ($query->num_rows() > 0){
                    // Update AddressType
                    
                } else {
                    // Add AddressType 
                    $address_type_data = array(
                        'address_type'=>$address_type,
                        'address_type_slug'=>$address_type_slug
                    );
                    $this->db->insert('address_type', $address_type_data);
                }
                
                // state add/upadte
                
                $state = $row->Region;
                $this->db->select('*');
                $this->db->from('state');
                $this->db->where('state', $state);
                $query = $this->db->get();
                
                if ($query->num_rows() > 0){
                    // Update state
                    
                } else {
                    // Add state 
                    $stateData = array(
                        'state'=>$state,
                        'country_id'=>1
                    );
                    $this->db->insert('state', $stateData);
                }
                
                // Address Add/update
                
                $this->load->model('zone/zonemodel');
                $zones = $this->zonemodel->getZoneFromZoneSlug($zone_slug);
                $zone_id =  $zones->zone_id;
                                
                $this->load->model('address/addresstypemodel');
                $address_types = $this->addresstypemodel->getAddressTypeFromSlug($address_type_slug);
                $address_type_id =  $address_types->address_type_id;
                
                $state = $row->Region;
                $this->db->select('*');
                $this->db->from('state');
                $this->db->where('state', $state);
                $states = $this->db->get();
                $stateRecord = $states->row();
                
                $state_id = $stateRecord->state_id;
                
                $addressData = array(
                    'address'=> $row->Site,
                    'zone_id'=> $zone_id,
                    'country_id'=> 1,
                    'state_id'=> $state_id,
                    'location'=> $row->District,
                    'city'=>    $row->Departement,
                    'address_type_id'=> $address_type_id,
                    'latitude'=> $row->LAT_SITE,
                    'longitude'=> $row->LONG_SITE,
                    'source_address_id'=>$row->ID_Site
                );
                
                // check to adddress add/update
                
                $this->db->select('*');
                $this->db->from('address');
                $this->db->where('source_address_id', $row->ID_Site);
                $address = $this->db->get();
                
                if ($address->num_rows() > 0) {
                    // Update state
                    
                } else {
                    $this->db->insert('address', $addressData);
                    $address_id = $this->db->insert_id();
                }
                
                // Update Csv record to track row is import_
                $data = array('is_import'=>1);
                $this->db->where('import_csv_id', $row->import_csv_id);
                $this->db->update('import_csv', $data);
                
            }
        }
    }
    
    function importAddressFromJighi() {
        $query = 'SELECT * FROM jighi_address WHERE is_import is NULL';
        
        $results = $this->db->query($query);
        
        if(!empty($results) &&count($results) > 0) {
            foreach ($results->result() as $row) {
                // Zone Add/update 
                $zone = $row->zone_name;
                $zone_slug = Symfony::urlize($zone);
                
                $this->db->select('*');
                $this->db->from('zone');
                $this->db->where('zone_slug', $zone_slug);
                $query = $this->db->get();
                
                if ($query->num_rows() > 0) {
                    // Update Zone
                    
                } else {
                    // Add Zone 
                    $zonedata = array(
                        'zone_name'=>$zone,
                        'zone_slug'=>$zone_slug
                    );
                    $this->db->insert('zone', $zonedata);
                }
                
                // Address Add/update
                
                $this->load->model('zone/zonemodel');
                $zones = $this->zonemodel->getZoneFromZoneSlug($zone_slug);
                $zone_id =  $zones->zone_id;
                
                $address_type_slug = 'jighi';
                $this->load->model('address/addresstypemodel');
                $address_types = $this->addresstypemodel->getAddressTypeFromSlug($address_type_slug);
                $address_type_id =  $address_types->address_type_id;
                
                $state_id = 34;
                
                $addressData = array(
                    'address'=> $row->address,
                    'zone_id'=> $zone_id,
                    'country_id'=> 1,
                    'state_id'=> $state_id,
                    'location'=> $row->location,
                    'zipcode'=> $row->zipcode,
                    'city'=>    $row->city,
                    'address_type_id'=> $address_type_id,
                    'latitude'=> $row->latitude,
                    'longitude'=> $row->longitude,
                    'import_jighi_address_id'=>$row->address_id
                );
                
                // check to adddress add/update
                
                $this->db->select('*');
                $this->db->from('address');
                $this->db->where('import_jighi_address_id', $row->address_id);
                $address = $this->db->get();
                
                if ($address->num_rows() > 0) {
                    // Update state
                    
                } else {
                    $this->db->insert('address', $addressData);
                    $address_id = $this->db->insert_id();
                }
                
                // Update Csv record to track row is import
                $data = array('is_import'=>1);
                $this->db->where('address_id', $row->address_id);
                $this->db->update('jighi_address', $data);
                
            }
        }
    }
}