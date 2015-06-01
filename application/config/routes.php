<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = 'error/pagenotfound';
$route['^ch/(.+)$'] = "$1";
$route['^en/(.+)$'] = "$1";
$route['^fr/(.+)$'] = "$1";
$route['^jp/(.+)$'] = "$1";
$route['^kr/(.+)$'] = "$1";
$route['^ru/(.+)$'] = "$1";

$route['^ch$'] = $route['default_controller'];
$route['^en$'] = $route['default_controller'];
$route['^fr$'] = $route['default_controller'];
$route['^jp$'] = $route['default_controller'];
$route['^kr$'] = $route['default_controller'];
$route['^ru$'] = $route['default_controller'];

$route['unauthorized']          = "error/unauthorized";
$route['forbidden']             = "error/forbidden";
$route['pagenotfound']          = "error/pagenotfound";
$route['internalservererror']   = "error/internalservererror";
$route['badgateway']            = "error/badgateway";
$route['serviceunavaliable']    = "error/serviceunavaliable";
$route['servicemaintenance']    = "error/serviceunavaliable";

/* End of file routes.php */
/* Location: ./application/config/routes.php */