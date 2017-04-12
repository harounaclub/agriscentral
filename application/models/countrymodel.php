<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CountryModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCountries() {
        
        $query = "SELECT * FROM country";
        $results = $this->db->query($query);
        $data = array();
        foreach ($results->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }

}
