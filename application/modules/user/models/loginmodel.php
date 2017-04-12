<?php

class LoginModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function validateUser(){
		
        $query = 'SELECT user.*, user_access.access_id' .
                ' FROM user, user_access' .
                ' WHERE email = "' . trim($this->input->post('email')) . '"' .
                ' AND password = "' . md5(trim($this->input->post('password'))) . '"' .
                ' AND user.user_id = user_access.user_id ';

        log_message('debug', $query);
        
        $result = $this->db->query($query);

        $return = false;
        if ($result->num_rows() > 0) {
           
            $row = $result->row();

            if ($row) {
                if ($row->is_active == 1) {

                    $this->session->set_userdata($row);
                    $return = true;
                } else {

                    $GLOBALS['error'] = 'blocked';
                    $return = false;
                }
            }
        } else {
            $return = false;
        }

        return $return;
    }

}

?>