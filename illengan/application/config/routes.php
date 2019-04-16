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
$route['admin/menu'] = "adminview/viewmenu";
$route['admin/menu/getDetails'] = "adminview/menuGetDetails";
$route['admin/spoilages'] = "adminview/viewspoilages";
$route['admin/sales'] = "adminview/viewSales";
$route['admin/dashboard'] = "adminview/viewdashboard";
$route['admin/tables'] = "adminview/viewtables";
$route['admin/tables/getTables'] = "adminview/getTables";
$route['admin/menucategories'] = "adminview/viewmenucategories";
$route['admin/stockcategories'] = "adminview/viewstockcategories";
$route['admin/sources'] = "adminview/viewsources";
$route['admin/accounts'] = "adminview/viewaccounts";
$route['admin/inventory'] = "adminview/viewinventory";
$route['admin/purchaseorders'] = "adminview/viewpurchaseorders";
$route['admin/transactions'] = "adminview/viewtransactions";
$route['admin/purchaseorder'] = "adminview/viewPurchaseOrder";
$route['admin/spoilages/addons'] = "adminview/viewspoilagesao";
$route['admin/spoilages/menu'] = "adminview/viewspoilagesmenu";
$route['admin/spoilages/stock'] = "adminview/viewspoilagesstock";
$route['admin/spoilages/menu/add'] ="adminview/viewInsertSpoilageMenu";
$route['admin/spoilages/stock/add'] ="adminview/viewInsertSpoilageStock";
$route['admin/spoilages/addons/add'] ="adminview/viewInsertSpoilageAo";
$route['admin/spoilages'] = "adminview/viewspoilages";
$route['admin/spoilagesjson'] = "adminview/viewSpoilagesJs";
$route['admin/menu/spoilages'] = "adminview/viewspoilagesmenu";
$route['admin/spoilagesmenujson'] = "adminview/viewSpoilagesMenuJs";
$route['admin/stock/spoilages'] = "adminview/viewSpoilagesStock";
$route['admin/spoilagesstockjson'] = "adminview/viewSpoilagesStockJs";
$route['admin/addons/spoilages'] = "adminview/viewspoilagesaddons";
$route['admin/spoilagesaddonsjson'] = "adminview/viewSpoilagesAddonsJs";
$route['admin/log/stocks'] = "adminview/viewLogStock";
$route['admin/log/activity'] = "adminview/viewActivityLog";

//End Viewing Routes

//Not Sure Routes
$route['admin/menu/datatables'] = "adminview/datatables_menu";
//End Note Sure Routes

//Admin Add Routes ----------------------------------------------
$route['admin/transactions/add'] = "adminadd/addtransactions";
$route['admin/purchaseorder/add'] = "adminview/addpurchaseorder";
$route['admin/inventory/add'] = "adminadd/addstockitem";
$route['admin/menu/add'] = "adminadd/add_menu";
$route['admin/stockcategories/add'] = "adminadd/addstockcategory";
$route['admin/menucategories/add'] = "adminadd/addmenucategory";
$route['admin/accounts/add'] = "adminadd/addaccounts";
$route['admin/tables/add'] = "adminadd/addtable";
$route['admin/addons/spoilages/add'] = "adminadd/addspoilagesaddons";
$route['admin/stock/spoilages/add'] = "adminadd/addspoilagesstock";
$route['admin/menu/spoilages/add'] = "adminadd/addspoilagesmenu";
$route['admin/sources/add'] = "adminadd/addsource";
//End Admin Add Routes ------------------------------------------

//Admin Update Routes -------------------------------------------
$route['admin/menucategories/edit'] = "adminupdate/editmenucategory/";
$route['admin/stockcategories/edit'] = "adminupdate/editstockcategory/";
$route['admin/menu/edit'] = "adminupdate/edit_menu";
$route['admin/menu/edit_image'] = "adminupdate/edit_image";
$route['admin/inventory/edit'] = "adminupdate/editstockitem";
$route['admin/transactions/edit'] = "adminupdate/edittransactions";
$route['admin/accounts/changepassword'] = "adminupdate/changeAccountPassword";
$route['admin/accounts/edit'] = "adminupdate/editAccounts";
$route['admin/sources/edit'] = "adminupdate/editsource";
$route['admin/tables/edit'] = "adminupdate/edittable";
$route['admin/stockqty/edit'] = "adminupdate/editStockQty";
//End Admin Update Routes ---------------------------------------

//Admin Delete Routes -------------------------------------------
$route['admin/tables/delete'] = "admindelete/deletetable";
$route['admin/menucategories/delete/(:num)'] = "admindelete/deletemenucategory/$1";
$route['admin/stockcategories/delete/(:num)'] = "admindelete/deletestockcategory/$1";
$route['admin/inventory/delete/(:num)'] = "admindelete/deletestockitem/$1";
$route['admin/transactions/delete'] = "admindelete/deletetransactions";
$route['admin/sources/delete/(:num)'] = "admindelete/deletesource/$1";
$route['admin/stock/spoilage/delete/(:num)'] ="admindelete/deletestockspoilages/$1";
$route['admin/menu/spoilage/delete/(:num)'] ="admindelete/deletemenuspoilages/$1";
$route['admin/addons/spoilage/delete/(:num)'] ="admindelete/deleteaddonsspoilages/$1";
//End Admin Delete Routes ---------------------------------------

//Admin Json Routes ------------------------------------------- 
$route['admin/logJson'] = "adminview/jsonLogStock";
$route['admin/jsonStock'] = "adminview/jsonStock";
//End Admin Json Routes ---------------------------------------

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
$route['customer/json'] = "customer/json";

// BARISTA ROUTES
$route['barista/orders'] = "barista/index";
$route['barista/billings'] = "barista/getbills";
$route['barista/getBillDetails'] = "barista/getBillDetails";
$route['barista/billings/setStatus'] = "barista/setbillstatus";

// CHEF ROUTES
$route['chef/get_orderlist'] = "chef/get_orderlist";
$route['chef/change_status'] = "chef/change_status";