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

$route['default_controller'] = "league";
$route['404_override'] = '';
$route['matches/(:any)'] = 'matches/index/$1';
$route['matches/(:any)/(:any)'] = 'matches/index/$1/$2';
$route['matchdetail/(:num)'] = 'matchdetail/index/$1';
$route['matchdetail/(:num)/(:num)'] = 'matchdetail/index/$1/$2';
$route['matchdetail/(:num)/(:num)/(:any)'] = 'matchdetail/index/$1/$2/$3';
$route['teams/(:num)'] = 'teams/index/$1';
$route['teams/(:num)/(:any)'] = 'teams/index/$1/$2';
$route['teams/(:num)/(:any)/(:num)'] = 'teams/index/$1/$2/$3';
$route['teamranking/(:num)'] = 'teamranking/index/$1';
$route['teamranking/(:num)/(:any)/(:num)'] = 'teamranking/edit/$1/$2/$3';
$route['topscorer/(:num)'] = 'topscorer/index/$1';
$route['topscorer/(:num)/(:any)'] = 'topscorer/operation/$1/$2';
$route['topscorer/(:num)/(:any)/(:num)'] = 'topscorer/operation/$1/$2/$3';


/* End of file routes.php */
/* Location: ./application/config/routes.php */