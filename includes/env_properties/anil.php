<?php

/*
 * ======================================================
 * Database Setup
 * ======================================================
 */

$serverName = $_SERVER['SERVER_NAME'];

if($serverName == 'jmap.local') {
    $DB_HOST  		= "localhost";
    $DB_USER  		= "root";
    $DB_PASSWORD            = "";
    $DATABASE  		= "jighi_map";

    $BASE_URL               = "http://jmap.local";
    $PER_PAGE               = 10;
    
} else {
    $DB_HOST  		= "localhost";
    $DB_USER  		= "root";
    $DB_PASSWORD        = "";
    $DATABASE  		= "orange_map";

    $BASE_URL           = "http://orange_map.local";
    $PER_PAGE               = 10;

}

//pie chart
// Donut chart
?>