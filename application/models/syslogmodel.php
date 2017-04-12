<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SyslogModel extends CI_Model {

    function addUpdateEquipmentStatus() {
        $address_id = 1887;
        $query = 'SELECT * FROM address_equipment_status WHERE address_equipment_id = ' . $address_id;
        $results = $this->db->query($query);
        $data = array();
        $updated_at = date('Y-m-d H:i:s');
        
        $syslog_data_1 = array(
            'address_equipment_id' => 1,
            'status'=> 1,
            'updated_at'=> $updated_at,
        );
        
        $syslog_data_2 = array(
            'address_equipment_id' => 2,
            'status'=> 0,
            'updated_at'=> $updated_at,
        );
        
        if (!empty($results) && count($results) > 0) {
            // Update Record
            $this->db->where('address_equipment_id', 1);
            $response = $this->db->update('address_equipment_status', $syslog_data_1);
            
            $this->db->where('address_equipment_id', 2);
            $response = $this->db->update('address_equipment_status', $syslog_data_2);
            
            
        } else {
            // Add Record
            $syslog_data_2['since'] = '2015-09-15 15:48:50';
            $query = $this->db->insert('address_equipment_status', $syslog_data_1);
            
            $syslog_data_2['since'] = '2015-09-15 15:48:50';
            $query = $this->db->insert('address_equipment_status', $syslog_data_2);
            
        }
    }

}
