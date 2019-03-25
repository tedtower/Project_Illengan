<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['customer/discounts'] = "customer/discounts";
$route['customer/menu/add_order'] = "customer/addOrder";
$route['customer/checkout'] = "customer/checkout";
$route['customer/destroy'] = "customer/destroy";
$route['customer/welcome'] = "customer/welcome";
$route['customer/checkin'] = 'customer/checkIn';
$route['customer/menu'] = "customer/view";

// BARISTA ROUTES
$route['barista/billings'] = "barista/getbills";
$route['barista/getBillDetails'] = "barista/getBillDetails";
$route['barista/billings/setStatus'] = "barista/setbillstatus";
