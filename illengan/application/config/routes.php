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

//Viewing Routes -----------------------------------------------
$route['admin/menu'] = "admin/adminview/viewmenu";
$route['admin/spoilages'] = "admin/adminview/viewspoilages";
$route['admin/sales'] = "admin/adminview/viewSales";
$route['admin/dashboard'] = "admin/adminview/viewdashboard";
$route['admin/tables'] = "admin/adminview/viewtables";
$route['admin/menucategories'] = "admin/adminview/viewmenucategories";
$route['admin/stockcategories'] = "admin/adminview/viewstockcategories";
$route['admin/sources'] = "admin/adminview/viewsources";
$route['admin/accounts'] = "admin/adminview/viewaccounts";
$route['admin/inventory'] = "admin/adminview/viewinventory";
$route['admin/transactions'] = "admin/adminview/viewtransactions";
//End Viewing Routes

//Not Sure Routes
$route['admin/menu/datatables'] = "admin/adminview/datatables_menu";
$route['admin/addons/spoilages'] = "admin/adminview/viewspoilagesao";
$route['admin/menu/spoilages'] = "admin/adminview/viewspoilagesmenu";
$route['admin/stock/spoilages'] = "admin/adminview/viewspoilagesstock";
$route['admin/menu/spoilages/add'] ="admin/adminview/viewInsertSpoilageMenu";
$route['admin/stock/spoilages/add'] ="admin/adminview/viewInsertSpoilageStock";
$route['admin/addons/spoilages/add'] ="admin/adminview/viewInsertSpoilageAo";
$route['admin/accounts/edit'] = "admin/vieweditAccounts";
//End Note Sure Routes

//Admin Add Routes ----------------------------------------------
$route['admin/transactions/add'] = "admin/adminadd/addtransactions";
$route['admin/inventory/add'] = "admin/adminadd/addstockitem";
$route['admin/menu/add'] = "admin/adminadd/add_menu";
$route['admin/stockcategories/add'] = "admin/adminadd/addstockcategory";
$route['admin/menucategories/add'] = "admin/adminadd/addmenucategory";
$route['admin/accounts/add'] = "admin/adminadd/addaccounts";
$route['admin/tables/add'] = "admin/adminadd/addtable";
$route['admin/addspoilagesmenu'] = "admin/adminadd/addspoilagesmenu";
$route['admin/insertspoilagesstock'] = "admin/adminadd/insertspoilagesstock";
$route['admin/insertspoilagesmenu'] = "admin/adminadd/insertspoilagesmenu";
//End Admin Add Routes ------------------------------------------

//Admin Update Routes -------------------------------------------
$route['admin/menucategories/edit'] = "admin/adminupdate/editmenucategory/";
$route['admin/stockcategories/edit'] = "admin/adminupdate/editstockcategory/";
$route['admin/menu/edit'] = "admin/adminupdate/edit_menu";
$route['admin/menu/edit_image'] = "admin/adminupdate/edit_image";
$route['admin/inventory/edit'] = "admin/adminupdate/editstockitem";
$route['admin/transactions/edit'] = "admin/adminupdate/edittransactions";
$route['admin/accounts/changepassword'] = "admin/adminupdate/changeAccountPassword";
//End Admin Update Routes ---------------------------------------

//Admin Delete Routes -------------------------------------------
$route['admin/tables/delete/(:num)'] = "admin/admindelete/deletetable/$1";
$route['admin/menucategories/delete/(:num)'] = "admin/admindelete/deletemenucategory/$1";
$route['admin/stockcategories/delete/(:num)'] = "admin/admindelete/deletestockcategory/$1";
$route['admin/inventory/delete/(:num)'] = "admin/admindelete/deletestockitem/$1";
$route['admin/transactions/delete'] = "admin/admindelete/deletetransactions";
//End Admin Delete Routes ---------------------------------------

//CUSTOMER ROUTES
$route['customer/processCheckIn'] = "customer/processCheckIn";
$route['customer/promos'] = "customer/promos";
$route['customer/freebies_discounts'] = "customer/freebies_discounts";
$route['customer/freebies'] = "customer/freebies";
$route['customer/menu/vieworders'] = "customer/viewOrders";
$route['customer/menu/addOrder'] = "customer/addOrder";
$route['customer/checkout'] = "customer/checkout";
$route['customer/checkin'] = 'customer/checkIn';
$route['customer/menu'] = "customer/view";

// BARISTA ROUTES
$route['barista/orders'] = "barista/index";
$route['barista/billings'] = "barista/getbills";
$route['barista/getBillDetails'] = "barista/getBillDetails";
$route['barista/billings/setStatus'] = "barista/setbillstatus";

// CHEF ROUTES
$route['chef/get_orderlist'] = "chef/get_orderlist";
$route['chef/change_status'] = "chef/change_status";