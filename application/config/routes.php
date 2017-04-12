<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "user/login";
$route['map/equipments/(:any)'] = "map/index/$1";
$route['map/zones'] = "map/index";
$route['map/zones/(:any)'] = "map/index/$1";

/* Routing  For Equipment Type */
$route['^equipment/type'] = "equipment/equipmenttype";
$route['^type/lists'] = "equipment/lists";


/* Routing  For Equipment  */
$route['^equipment'] = "equipment/equipment";
$route['^equipment/lists'] = "equipment/lists";


/* Routing  For Address Type */
$route['^address/type'] = "address/addresstype";
$route['^type/lists'] = "address/lists";

/* Routing  For Address  */
$route['address'] = "address/address";
$route['^address/lists'] = "address/lists";


/* Routing  For Zone Type */
$route['^zone/type'] = "zone/zonetype";
$route['^type/lists'] = "zone/lists";

/* Routing  For Equipment  */
$route['^zone'] = "zone/zone";
$route['^zone/lists'] = "zone/lists";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */