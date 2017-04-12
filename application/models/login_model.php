<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check_login($login, $pass) {
        $this->db->where('login', $login);
        $this->db->where('pass', $pass);
        $q = $this->db->get('admin');
        if ($q->num_rows() > 0) {
            return true;
        }
    }

}
