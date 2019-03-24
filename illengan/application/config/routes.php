<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'login/viewlogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'login/viewlogin';
$route['verifylogin'] = "login/check_cred";
$route['admin/menu'] = "admin/viewmenu";
$route['admin/viewspoilagesmenu'] = "admin/viewspoilagesmenu";
$route['admin/viewspoilagesstock'] = "admin/viewspoilagesstock";
$route['admin/addspoilagesmenu'] = "admin/addspoilagesmenu";
$route['admin/insertspoilagesstock'] = "admin/insertspoilagesstock";
$route['admin/insertspoilagesmenu'] = "admin/insertspoilagesmenu";

$route['admin/dashboard'] = "admin/viewdashboard";
$route['admin/tables'] = "admin/viewtables";
$route['admin/tables/add'] = "admin/addtable";
$route['admin/tables/delete/(:num)'] = "admin/deletetable/$1";
$route['admin/menucategories'] = "admin/viewmenucategories";
$route['admin/menucategories/add'] = "admin/addmenucategory";
$route['admin/menucategories/delete/(:num)'] = "admin/deletemenucategory/$1";
$route['admin/menucategories/edit'] = "admin/editmenucategory/";
$route['admin/stockcategories'] = "admin/viewstockcategories";
$route['admin/stockcategories/add'] = "admin/addstockcategory";
$route['admin/stockcategories/delete/(:num)'] = "admin/deletestockcategory/$1";
$route['admin/stockcategories/edit'] = "admin/editstockcategory/";
$route['admin/sources'] = "admin/viewsources";
$route['admin/viewaccounts'] = "admin/viewaccounts";
$route['admin/menu/add'] = "admin/add_menu";
$route['admin/menu/edit'] = "admin/edit_menu";
$route['admin/menu/edit_image'] = "admin/edit_image";

$route['admin/accounts/add'] = "admin/addaccount";
$route['admin/accounts/edit'] = "admin/vieweditAccounts";
$route['admin/accounts/changepassword'] = "admin/changepassword";
$route['admin/inventory'] = "admin/viewinventory";
$route['admin/inventory/add'] = "admin/addstockitem";
$route['admin/inventory/edit'] = "admin/editstockitem";
$route['admin/inventory/delete/(:num)'] = "admin/deletestockitem/$1";
$route['admin/transactions'] = "admin/viewtransactions";
$route['admin/transactions/add'] = "admin/addtransactions";
$route['admin/transactions/edit'] = "admin/edittransactions";
$route['admin/transactions/delete'] = "admin/deletetransactions";
$route['admin/sample'] = 'admin/samplemethod';

//CUSTOMER ROUTES
$route['customer/menu/getitemdetails'] = "customer/getdetails";
$route['customer/process_login'] = "customer/process_login";
$route['customer/view_menu'] = "customer/view_menu";
$route['view'] = "customer/view";
$route['add_order'] = "customer/add";
$route['customer/logout'] = "customer/logout";
$route['destroy'] = "customer/destroy";
$route['welcome'] = "customer/welcome";
$route['LogIn'] = 'customer/isLoggedIn';
$route['details'] = "customer/getMenuDetails";
$route['customer/(:any)'] = "customer/view/$1";

// BARISTA ROUTES
$route['barista/billings'] = "barista/getbills";
$route['barista/getBillDetails'] = "barista/getBillDetails";
$route['barista/billings/setStatus'] = "barista/setbillstatus";
