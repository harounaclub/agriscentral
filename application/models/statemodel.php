<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class stateModel extends CI_Model {

    function __construct() {
        parent::__construct();
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
