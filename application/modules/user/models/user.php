<?php

class UserModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addUser() {
        $firstName = $this->input->post('userName');
        $userEmail = $this->input->post('email');
        $userPassword = $this->input->post('password');
        $parentId = $this->input->post('parentId');
        $studentId = $this->input->post('studentId');
        $employeeId = $this->input->post('employeeId');

        $data = array(
            'user_name' => $firstName,
            'email' => $userEmail,
            'password' => md5($userPassword)
        );

        if ($studentId != '') {
            $data['student_id'] = $studentId;
        }

        if ($employeeId != '') {
            $data['employee_id'] = $employeeId;
        }

        if ($parentId != '') {
            $data['parent_id'] = $parentId;
        }


        $query = $this->db->insert('user', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function getUserBYId($userId) {
        $query = "SELECT * FROM user where user_id = $userId";
        $query = $this->db->query($query);
        $row = $query->row();
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }

    function editUserProfile($userId) {

        $query = "SELECT * FROM user where user_id = $userId";
        $query = $this->db->query($query);

        $data = array();
        foreach ($query->result() as $row) {
            $data[] = $row;
        }

        if (isset($data['0']->employee_id)) {
            $employee_id = $data['0']->employee_id;
            $query = "SELECT photo FROM photo where employee_id = $employee_id";
        } else if (isset($data['0']->parent_id)) {
            $parent_id = $data['0']->parent_id;
            $query = "SELECT photo FROM photo where parent_id = $parent_id";
        } if (isset($data['0']->student_id)) {
            $student_id = $data['0']->student_id;
            $query = "SELECT photo FROM photo where student_id = $student_id AND parent_id IS NULL";
        }

        $query = $this->db->query($query);
        $row = $query->row();
        if (isset($row->photo)) {
            $photo = $row->photo;
            $data['photo'] = $photo;
        }
        //  dump($data);die;
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    function updateUser($userId, $userName, $userEmail) {
        $data = array(
            'user_name' => $userName,
            'email' => $userEmail
        );

        $query = $this->db->where('user_id', $userId);
        $query = $this->db->update('user', $data);
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function searchUserFromKeyword($page = NULL, $field = NULL) {
        global $PER_PAGE;
        $p = 1;
        $q = $this->input->post('q');
        //echo $q;die;
        if (isset($page) && $page > 0) {
            $p = $page; // Page	
        } else {
            $p = $this->input->post('page');
            if (!$p) {
                $p = $this->input->get('page');
            }
        }

        $sort = $order = '';
        $start = 1;

        $num_query = 'SELECT count(*) AS num_records FROM user WHERE user_name LIKE "%' . $q . '%" ' .
                ' OR email LIKE "%' . $q . '%"';


        $result = $this->db->query($num_query);
        $row = $result->row();
        $numResults = $row->num_records;

        $totalPages = ceil($numResults / $PER_PAGE);
        $firstPage = 1;

        if ($totalPages > 0) {
            $lastPage = $totalPages;
        } else {
            $lastPage = 1;
        }

        $query = 'SELECT * FROM user WHERE user_name LIKE "%' . $q . '%" ' .
                ' OR email LIKE "%' . $q . '%"';


        if (!empty($p) && $p == 'all') {
            // NO NEED TO LIMIT THE CONTENT
        } else {
            if (!empty($p) || $p != 0) {
                $start = ($p - 1) * $PER_PAGE;
                $query .= " LIMIT $start, " . $PER_PAGE;
            } else {
                $query .= " LIMIT 0, " . $PER_PAGE;
                $start = 0;
            }
        }

        $currentPage = '';
        if ($p) {
            $currentPage = $p;
        }

        if ($currentPage <= 0) {
            $currentPage = 1;
        } else if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        $result = $this->db->query($query);

        $usersearch = array();

        foreach ($result->result() as $row) {
            $usersearch[] = $row;
        }

        if ($field != '') {
            $field = $field;
        } else {
            $field = 'user';
        }

        $params = requestToParamsForBackEnd($numResults, $totalPages, $firstPage, $lastPage, $currentPage, $start, $sort, $order, $q, $field);

        $arr = array(
            'results' => $usersearch,
            'param' => $params,
            'query' => $query,
        );
        //dump($arr);die;
        return $arr;
    }

    function delete($userId) {
        $query = "DELETE FROM user WHERE user_id = '" . $userId . "' ";
        $result = $this->db->query($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getUserList($page = null) {
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

        $sort = $order = '';
        $start = 1;

        $query_count = 'SELECT count(*) as num_records ' .
                ' FROM user';

        $query = ' SELECT * ' .
                ' FROM user';

        if (empty($sort)) {
            $sort_query = ' ORDER BY email';
            $sort = 'email';
        } else {
            $sort_query = ' ORDER BY ' . $sort;
        }

        if (empty($order)) {
            $order = 'DESC';
        }

        $query = $query . ' ' . $sort_query . ' ' . $order;

        $result = $this->db->query($query_count);
        $row = $result->row();
        $numResults = $row->num_records;

        if (!empty($p) && $p == 'all') {
            // NO NEED TO LIMIT THE CONTENT
        } else {
            if (!empty($p) || $p != 0) {
                $start = ($p - 1) * $PER_PAGE;
                $query .= " LIMIT $start, " . $PER_PAGE;
            } else {
                $query .= " LIMIT 0, " . $PER_PAGE;
                $start = 0;
            }
        }

        $totalPages = ceil($numResults / $PER_PAGE);
        $firstPage = 1;

        if ($totalPages > 0) {
            $lastPage = $totalPages;
        } else {
            $lastPage = 1;
        }

        $currentPage = '';
        if ($p) {
            $currentPage = $p;
        }

        if ($currentPage <= 0) {
            $currentPage = 1;
        } else if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        $result = $this->db->query($query);


        $users = array();
        foreach ($result->result() as $row) {
            $users[] = $row;
        }
        $field = "user";

        $params = requestToParamsForBackEnd($numResults, $totalPages, $firstPage, $lastPage, $currentPage, $start, $sort, $order, $q, $field);

        $arr = array(
            'results' => $users,
            'param' => $params,
            'query' => $query,
        );
        //dump($arr);die;
        return $arr;
    }

    function getParentData($term) {
        $query = " SELECT parent_id, first_name " .
                " FROM parent " .
                " WHERE first_name LIKE '%" . $term . "%'";

        $result = $this->db->query($query)->result();
        $user = $all_user = array();
        foreach ($result as $row) {
            $user["id"] = $row->parent_id;
            $user["text"] = $row->first_name;
            $all_user[] = $user;
//			$user[]["id"] = $row;
        }
//		dump($all_user);die;
        return $all_user;
    }

    function getEmployeeData($term) {
        $query = " SELECT employee_id, GROUP_CONCAT(concat(`first_name`,' ',`middle_name`,' ',`last_name`,'') separator ' ') AS first_name " .
                " FROM employee " .
                " WHERE first_name LIKE '%" . $term . "%'" .
                " OR last_name LIKE '%" . $term . "%'" .
                " OR middle_name LIKE '%" . $term . "%'";

        $result = $this->db->query($query)->result();
        $employee = $all_employee = array();
        foreach ($result as $row) {
            $employee["id"] = $row->employee_id;
            $employee["text"] = $row->first_name;
            $all_employee[] = $employee;
        }

        if ($row->first_name != "") {
            return $all_employee;
        } else {
            return $all_employee = array();
        }
    }

    function getStudentData($term) {
        $query = " SELECT student_id, GROUP_CONCAT(concat(`first_name`,' ',`middle_name`,' ',`last_name`,'') separator ' ') AS first_name " .
                " FROM student " .
                " WHERE first_name LIKE '%" . $term . "%'" .
                " OR last_name LIKE '%" . $term . "%'" .
                " OR middle_name LIKE '%" . $term . "%'";
        $data = $this->db->query($query);
        $result = $data->result();

        $num_rows = $data->num_rows();

        $student = $all_student = array();
        //$all_student = array(0=>array("id"=>"", "text"=>""));


        foreach ($result as $row) {
            $student["id"] = $row->student_id;
            $student["text"] = $row->first_name;
            $all_student[] = $student;
        }

        if ($row->first_name != "") {
            return $all_student;
        } else {
            return $all_student = array();
        }
    }

    function checkUserName($userName, $userId = '') {
        if ($userId != '') {
            $query = "SELECT user_name from user WHERE user_name = '" . $userName . "' AND user_id != '" . $userId . "'";
            $query = $this->db->query($query);
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $query = "SELECT user_name from user WHERE user_name = '" . $userName . "' ";
            $query = $this->db->query($query);
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function checkEmail($email, $userId = '') {
        if ($userId != '') {
            $query = "SELECT email from user WHERE email = '" . $email . "' AND user_id != '" . $userId . "'";
            $query = $this->db->query($query);
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $query = "SELECT email from user WHERE email = '" . $email . "' ";
            $query = $this->db->query($query);
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

}

?>