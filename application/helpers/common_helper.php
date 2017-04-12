<?php

function dump($ob) {
    echo "<pre style=\"text-align: left;\">";
    print_r($ob);
    echo "</pre>";
}

function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function checkUserAccess($redirect = true) {

    $accessTypeArray = array('1');
    $CI = & get_instance();

    $access_id = $CI->session->userdata('access_id');

    if ($access_id == '1') {

        if ($redirect) {
            redirect('/');
        } else {
            return false;
        }
    } else if (in_array($access_id, $accessTypeArray)) {
        return true;
        // All Good
    } else {
        if ($redirect) {
            redirect('/user/login');
        } else {
            return false;
        }
    }
}

function checkAdminAccess() {

    $accessTypeArray = array('1');
    $CI = & get_instance();
    $return = 0;
    $access_id = $CI->session->userdata('access_id');

    if (isset($access_id) && $access_id != '') {
        if ($access_id == '1') {
            $return = 1;
        } else {
            $return = 'user';
        }
    } else {
        $return = 0;
    }
    return $return;
}

function buildLimitQuery($p) {

    global $PER_PAGE;

    $arr = array();

    $query = '';
    $start = 1;

    if (!empty($p) && $p == 'all') {
        // NO NEED TO LIMIT THE CONTENT
    } else {

        if (!empty($p) || $p != 0) {
            $start = ($p - 1) * $PER_PAGE;
            $query = " LIMIT $start, " . $PER_PAGE;
        } else {
            $query = " LIMIT 0, " . $PER_PAGE;
            $start = 1;
        }
    }

    $arr ['query'] = $query;
    $arr ['start'] = $start;

    return $arr;
}

function processUserInput($q) {

    $response = array();
    if ($q == '0') {
        $q = '';
    }
    $q = str_replace("+", " ", $q);

    $arr_query = explode(' ', $q);

    if (!empty($q)) {
        if (count($arr_query) > 1) {
            $response ['type'] = 'name';

            $arr_name = array();
            $arr_name ['first_name'] = $arr_query [1];
            $arr_name ['last_name'] = $arr_query [0];
            foreach ($arr_query as $key => $value) {
                if ($key > 1) {
                    $arr_name [$key] = $value;
                }
            }

            $response ['q'] = $arr_name;
        } else {

            $arr = explode("/", $arr_query [0]);
            // print_r_pre($arr);

            if (count($arr) == 3) {
                $response ['type'] = 'date';
                if (!empty($arr [2])) {
                    $response ['q'] = date("Y-m-d", strtotime($arr_query [0]));
                } else {
                    $response ['q'] = sprintf("%02d", $arr [0]) . (!empty($arr [1]) ? '-' . sprintf("%02d", $arr [1]) : '');
                }
            } else if (count($arr) == 2) {
                $response ['type'] = 'date';
                $response ['q'] = sprintf("%02d", $arr [0]) . (!empty($arr [1]) ? '-' . sprintf("%02d", $arr [1]) : '');
            } else {
                $response ['type'] = 'string';
                $response ['q'] = $arr_query [0];
            }
        }
    } else {
        $response ['q'] = '';
    }
    return $response;
}

function buildParamForPagination($numResults, $p, $per_page) {

    $arr = array();

    if (!empty($p) && $p == 'all') {
        $per_page = $numResults;
        $arr ['per_page'] = $per_page;
    }

    if ($numResults > 0) {
        $totalPages = ceil($numResults / $per_page);
    } else {
        $totalPages = 0;
    }

    $arr ['totalPages'] = $totalPages;
    $firstPage = 1;
    $arr ['firstPage'] = $firstPage;

    if ($totalPages > 0) {
        $lastPage = $totalPages;
    } else {
        $lastPage = 1;
    }
    $arr ['lastPage'] = $lastPage;

    $currentPage = '';
    if ($p) {
        $currentPage = $p;
    }

    if ($currentPage <= 0) {
        $currentPage = 1;
    } else if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }
    $arr ['currentPage'] = $currentPage;

    return $arr;
}

function requestToParams($numResults, $start, $totalPages, $first, $last, $page, $sort, $order, $q, $field = null, $header = null) {

    global $PER_PAGE;

    $param = array(
        'page' => $page,
        'totalPages' => $totalPages,
        'perPage' => $PER_PAGE,
        'start' => $start,
        'end' => (($start + ($PER_PAGE - 1)) > ($numResults - 1) ? ($numResults - 1) : ($start + ($PER_PAGE - 1))),
        'firstPage' => $first,
        'lastPage' => $last,
        'numResults' => $numResults,
        'sort' => $sort,
        'order' => $order,
        'q' => $q,
        'field' => $field,
        'result_header' => $header,
        'currentPage' => $page
    );
    $CI = & get_instance();

    $tab = $CI->input->post('tab');
    if ($tab) {
        $param ['tab'] = $tab;
    }
    return $param;
}

function buildPagination($param, $uri) {
    $html = '<div class="dt-toolbar-footer">
        <div class="col-xs-12 col-sm-12"> <div>';
    if (!empty($param) && count($param) > 0) {
        $adjacents = 2;
        $page = $param ['currentPage'];
        // $page = $param['page'];

        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = $param ['lastPage'];
        $lpm1 = $lastpage - 1;

        if ($lastpage > 1) {
            $html .= '<ul class="pagination pagination-sm">';

            // previous button
            if ($page > 0) {
                $html .= '<li class="first"><a  href="' . $uri . '/page/' . $param ['firstPage'] . '" id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $param ['firstPage'] . '">First</a></li>';
                $html .= '<li class="prev"><a  href="' . $uri . '/page/' . $page . '" id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $prev . '"> &laquo; </a></li>';
            } else {
                $html .= '<span class="paginate_button previous"> << </span>';
            }
            // pages
            if ($lastpage < 5 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter ++) {
                    if ($counter == $page) {
                        $html .= '<li class="paginate_button active"><a href="' . $uri . '/page/' . $counter . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $counter . '">' . $counter . '</a></li>';
                    } else {
                        $html .= '<li class="paginate_button"><a href="' . $uri . '/page/' . $counter . '" id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $counter . '">' . $counter . '</a></li>';
                    }
                }
            } else if ($lastpage > 3 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter ++) {
                        if ($counter == $page) {
                            $html .= '<li class="paginate_button active"><a href="' . $uri . '/page/' . $counter . '" id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $counter . '">' . $counter . '</a></li>';
                        } else {
                            $html .= '<li class="paginate_button"><a href="' . $uri . '/page/' . $counter . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $counter . '">' . $counter . '</a></li>';
                        }
                    }

                    $html .= '<li class="unavailable"><a href="">&hellip;</a></li>';

                    // $html.= '<li>...</li>';
                    $html .= '<li><a href="' . $uri . '/page/' . $lpm1 . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $html .= '<li><a href="' . $uri . '/page/' . $lastpage . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $lastpage . '">' . $lastpage . '</a></li>';
                } else if ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $html .= '<li><a href="' . $uri . '/page/' . $param ['firstPage'] . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $param ['firstPage'] . '">1</a></li>';
                    $html .= '<li><a href="' . $uri . '/page/' . $next . '"   id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $next . '">2</a></li>';
                    $html .= '<li>...</li>';

                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter ++) {
                        if ($counter == $page) {
                            $html .= '<li class="paginate_button current"><a href="' . $uri . '/page/' . $counter . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $counter . '">' . $counter . '</a></li>';
                        } else {
                            $html .= '<li><a href="' . $uri . '/page/' . $counter . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $counter . '">' . $counter . '</a></li>';
                        }
                    }
                    // $html.= '<li>...</li>';
                    $html .= '<li class="unavailable"><a href="">&hellip;</a></li>';
                    $html .= '<li><a href="' . $uri . '/page/' . $lpm1 . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $html .= '<li><a href="' . $uri . '/page/' . $lastpage . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $lastpage . '">' . $lastpage . '</a></li>';
                } else {
                    $html .= '<li><a href="' . $uri . '/page/' . $param ['firstPage'] . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $param ['firstPage'] . '">1</a></li>';
                    $html .= '<li><a href="' . $uri . '/page/' . $next . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $next . '">2</a></li>';
                    // $html.= '<li>...</li>';
                    $html .= '<li class="unavailable"><a href="">&hellip;</a></li>';

                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter ++) {
                        if ($counter == $page) {
                            $html .= '<li class="paginate_button active"><a href="' . $uri . '/page/' . $counter . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $counter . '">' . ($counter) . '</a></li>';
                        } else {
                            $html .= '<li class="paginate_button"><a href="' . $uri . '/page/' . $counter . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $counter . '">' . $counter . '</a></li>';
                        }
                    }
                }
            }
            // next button
            if ($page < $counter - 1) {
                $html .= '<li class="next"><a  href="' . $uri . '/page/' . $next . '"  id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $next . '"> &raquo; </a></li>';
            } else {
                $html .= '<li class="next disabled"><a > &raquo; </a></li>';
            }
            $html .= '<li class="last"><a   href="' . $uri . '/page/' . $param ['lastPage'] . '" id = "page' . ((isset($param ['field']) && !empty($param ['field'])) ? '__' . $param ['field'] : '') . '__' . $lastpage . '">Last</a></li>';
            $html .= '</ul>';
        }
    }
    $html .= '</div>
        </div>
    </div>';
    echo $html;
}

function getZones() {
    $CI = & get_instance();
    $CI->load->model('zone/zonemodel');

    $zones = $CI->zonemodel->getAllZones();
    return $zones;
}

function getEquipments() {
    $CI = & get_instance();
    $CI->load->model('equipment/equipmentmodel');

    $equipments = $CI->equipmentmodel->getAllEquipments();
    return $equipments;
}



function getAddressTypes() {
    $CI = & get_instance();
    $CI->load->model('address/addresstypemodel');

    $address_types = $CI->addresstypemodel->getAllAddressTypes();
    return $address_types;
}



function getStates() {
    $CI = & get_instance();
    $CI->load->model('address/addressmodel');

    $states = $CI->addressmodel->getStates();
    return $states;
}


function generateReport($filter = NUll, $start_date = NUll, $end_date = NUll, $logout_chk = NUll, $agency = NUll, $type = NULL, $view = NULL, $today = NULL) {

    $CI = & get_instance();
    $data = array();
    
    //load PHPExcel library
    $CI->load->library('Excel');
    $today_date = date("Y-m-d H-i-s");
    // Create new PHPExcel object
    //$objPHPExcel = new PHPExcel();

    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("Orange")
            //->setLastModifiedBy("Anil")
            ->setTitle("Report")
            ->setSubject("Report-" . $today_date . "")
            ->setDescription("Test document for Office 2007 XLSX")
            ->setKeywords("office 2007 ")
            ->setCategory("Excel");

    # get the data for excel data
    $CI->load->model('equipment/equipmentmodel');
    $data = $CI->equipmentmodel->getAllEquipmentsForExcel();

    # column for excel first row 
    $columns = array('equipment', 'status');
    
    // Field names in the first row

    $col = 0;
    foreach ($columns as $column) {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $column);
        $col++;
    }
    // dump($data);die;
    // Fetching the table data
    // create key for array 
    // $data is 2D arary $data['key'] = value

    $key_name = array();

    foreach ($data[0] as $key => $val) {
        $key_name[] = $key;
    }
    
    $row = 2;
    foreach ($data as $row_data) {
        $col = 0;
        foreach ($columns as $column) {
            echo $row_data[$key_name[$col]];die;
            $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $row, $row_data[$key_name[$col]]);
            $col++;
        }

        $row++;
    }

    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Report');


    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);


    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="report-' . $today_date . '.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
}
