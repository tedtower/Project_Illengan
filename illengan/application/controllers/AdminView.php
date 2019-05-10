<?php
class Adminview extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }
    function checkIfLoggedIn(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            return true;
        }
        return false;
    }
//VIEW FUNCTIONS--------------------------------------------------------------------------------
    function viewAccountsJs(){
        if($this->checkIfLoggedIn()){
            echo json_encode($this->adminmodel->get_accounts());
        }else{
            redirect('login');
        }
    }
    function viewAccounts(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Admin Accounts";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/viewaccounts', $data);
            $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }   
    }
    function viewDashboard(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Dashboard";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');            
            $this->load->view('admin/adminDashboard');            
            $this->load->view('admin/templates/scripts');
            $this->load->view('admin/templates/footer');
        }else{
            redirect('login');
        }
    }
    function viewInventory($error = null){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Admin Stock Items";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $data['inventory'] = array(
                "stocks" => $this->adminmodel->get_stocks(),
                "categories" => $this->adminmodel->get_stockSubCategories(),
                "variances" => $this->adminmodel->get_stockVariance()
            );
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin/adminInventory',$data);
        }else{
            redirect('login');
        }
    }
    function viewSupplier(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Sources";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');

            $data['supplier'] = array(
                'sources' => $this->adminmodel->get_supplier(),
                'merchandises' => $this->adminmodel->get_suppliermerch(),
                'stockvariances' => $this->adminmodel->get_stockVariance()
            );
            $this->load->view('admin/adminSources', $data);
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function viewLogs(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Admin Logs";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['log'] = $this->adminmodel->get_logs();
            $this->load->view('admin/adminLogs',$data);
            $this->load->view('admin/templates/scripts');            
            $this->load->view('admin/templates/footer');
        }else{
            redirect('login');
        }
    }
    function viewMenu(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Menu";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            // $data['menuitem'] = array(
            //     'menus' => $this->adminmodel->get_menu(),
            //     'preferences' => $this->adminmodel->get_preferences(),
            //     'addons' => $this->adminmodel->get_addons2()
            // );
            $this->load->view('admin/menuitems');
        }else{
            redirect('login');
        }
    }

    function menuGetDetails(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data = array(
                'menu' => $this->adminmodel->get_menu(),
                'preferences' => $this->adminmodel->get_preferences(),
                'addons' => $this->adminmodel->get_addons2()
            );
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }else{
            redirect('login');
        }
    }
    function menuAddons(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Menu - Addons";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/addons');
        }else{
            redirect('login');
        }
    }
    function menuPromos(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Menu - Promos";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminPromo');
        }else{
            redirect('login');
        }
    }
    function viewMenuCategories(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Menu - Categories";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['category'] = $this->adminmodel->get_menucategories();
            $data['maincategory'] = $this->adminmodel->get_maincat();
            $this->load->view('admin/menucategories',$data);
        }else{
            redirect('login');
        }
    }
    function viewReturns(){
        $data['title'] = "Returns";
        $data['returns'] = $this->adminmodel->get_returns();
        $data['transactions'] = $this->adminmodel->get_transactions();
        $data['stock'] = $this->adminmodel->get_stocks();
        $this->load->view('admin/templates/head',$data);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/returns', $data);
        $this->load->view('admin/templates/scripts');
    }
    function viewSales(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Sales";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            // $data['sales'] = $this->adminmodel->get_sales();
            $this->load->view('admin/adminSales');
        }else{
            redirect('login');
        }
    }
    function viewStockJS() {
        $data=$this->adminmodel->get_stockVariance();
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    function viewMenuJS() {
        $data=$this->adminmodel->get_menuPref();
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    function viewAddonJS(){
        $data=$this->adminmodel->get_addons();
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
 //-----------Stock Spoilage------------------------- 
 function viewSpoilagesStockJs(){
    if($this->checkIfLoggedIn()){
        $data= $this->adminmodel->get_spoilagesstock();
        echo json_encode($data);
        
    }else{
        redirect('login');
    }
}
function viewSpoilagesStock(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Spoilages - Stock";
        $this->load->view('admin/templates/head', $data);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/adminspoilagesstock');
    }else{
        redirect('login');
    }
}
   //-----------Menu Spoilage------------------------- 
    function viewSpoilagesMenuJs(){
        if($this->checkIfLoggedIn()){
            $data= $this->adminmodel->get_spoilagesmenu();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesMenu(){
        if($this->checkIfLoggedIn()){
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminspoilagesmenu');
            $this->load->view('admin/templates/footer');
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
 
    //-----------Addons Spoilage------------------------- 
    function viewSpoilagesAddonsJs(){
        if($this->checkIfLoggedIn()){
            $data= $this->adminmodel->get_spoilagesaddons();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesAddons(){
        if($this->checkIfLoggedIn()){
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminspoilagesaddons');
            $this->load->view('admin/templates/footer');
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    //---------------------------------------------------
    function viewStockCategories(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Inventory - Categories";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['category'] = $this->adminmodel->get_stockcategories();
            $data['maincategory'] = $this->adminmodel->get_maincatStock();
            $this->load->view('admin/inventorycategories',$data);
        }else{
            redirect('login');
        }
    }
    function viewTables(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Tables";
            // $data['table'] = $this->adminmodel->get_tables();
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminTables');
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function getTables(){
        if($this->checkIfLoggedIn()){
            echo json_encode($this->adminmodel->get_tables());
        }else{
            redirect('login');
        }
    }
    // function viewTransactions(){
    //     if($this->checkIfLoggedIn()){
    //         $data['title'] = "Transactions";
    //         // $this->load->view('admin/templates/head');
    //         // $this->load->view('admin/templates/sideNav');
    //         $data['transactions'] = array(
    //             "transaction" => $this->adminmodel->get_transactions(),
    //             "transitem" => $this->adminmodel->get_transitems(),
    //             "sources" => $this->adminmodel->get_sources()
    //         );
    //         $this->load->view('admin/adminAllTransactions',$data);
    //         // $this->load->view('admin/templates/scripts');
    //     }else{
    //         redirect('login');
    //     }
    // }

    function viewAllTransactions(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Transactions - All";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminTransactionsAll');
        }else{
            redirect('login');
        }
    }
    function viewDeliveryTransactions(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Admin Deliveries";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $data['deliveries'] = $this->adminmodel->get_deliveryTransactions();
            $data['items'] = $this->adminmodel->get_deliveryTransactionsDeliveriesItems();
            $this->load->view('admin/adminTransactionsDeliveries',$data);
        }else{
            redirect('login');
        }
    }
    function viewPurchaseTransactions(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Transactions - Purchases";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminTransactionsPurchases');
            
        }else{
            redirect('login');
        }
    }
    function viewReturnTransactions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Transactions - Returns";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $data = array(
                'invRet' => $this->adminmodel->get_invRetVar(),
                'retItems' => $this->adminmodel->get_returns(),

            );
            $this->load->view('admin/adminTransactionsReturns',$data);
        }else{
            redirect('login');
        }
    }
    function getReturns(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $item = $this->input->post('id');
            $data = array(
                'invoice' => $this->adminmodel->get_invoiceReturns(),
                'returns' => $this->adminmodel->get_returns(),
                'invoiceitems' => $this->adminmodel->get_poD(),
                'invoSup' => $this->adminmodel->get_allInvoice(),
                'selected' => $this->adminmodel->get_item($item)
            );
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);

        }else{
            redirect('login');
        }
    }

    function viewPurchaseOrders(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Purchase Order";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $data['purchaseOrders'] = array(
                "purchorders" => $this->adminmodel->get_purchOrders(),
                "poitems" => $this->adminmodel->get_poItemVariance()
            );
            $this->load->view('admin/adminPurchaseOrder',$data);
        }else{
            redirect('login');
        }
    }

    function jsonLogStock() {
        if($this->checkIfLoggedIn()){
            $data = $this->adminmodel->get_logs();

            header('Content-Type: application/json');
		    echo json_encode($data, JSON_PRETTY_PRINT);
        }else {
            redirect('login');
        }  

    }
    function jsonStock() {
        if($this->checkIfLoggedIn()){
            $data = array();
            $data['restock'] = $this->adminmodel->get_restock();
            $data['destock'] = $this->adminmodel->get_transactions();
            header('Content-Type: application/json');
		    echo json_encode($data, JSON_PRETTY_PRINT);
        }else {
            redirect('login');
        }  


    }

    function viewLogStock() {
        if($this->checkIfLoggedIn()){
            $data['title'] = "Stock Logs";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/stocklog');
		    
        }else {
            redirect('login');
        }

    }

    function jsonActivityLogs() {
        if($this->checkIfLoggedIn()){
            $data = $this->adminmodel->get_actlogs();
            header('Content-Type: application/json');
		    echo json_encode($data, JSON_PRETTY_PRINT);
        }else {
            redirect('login');
        }  

    }

    function viewActivityLog() {
        if($this->checkIfLoggedIn()){
            $data['title'] = "Activity Logs";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/activityLogs');
		    
        }else {
            redirect('login');
        }

    }
    function viewConsumptions(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Stock Consumption";
            $data['consumptions'] = $this->adminmodel->get_consumption();
            $data['conitems'] = $this->adminmodel->get_consumptionItems();
            $data['variance'] = $this->adminmodel->get_poItemVariance();
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminDestock');
        }else{
            redirect('login');
        }
    }
    function viewPromos() {
        if($this->checkIfLoggedIn()){
            $data['title'] = "Promos";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/templates/scripts');
            $this->load->view('admin/templates/footer');
            $this->load->view('admin/adminPromo');
        }else{
            redirect('login');
        }
    }

    function jsonPromos() {
        $promo = array(
            "promos" => $this->adminmodel->get_promos(),
            "discounts" => $this->adminmodel->get_discounts(),
            "freebies" => $this->adminmodel->get_freebies()
        );

        header('Content-Type: application/json');
        echo json_encode($promo, JSON_PRETTY_PRINT);
        
    }

    function jsonMenu() {
        $data = $this->adminmodel->get_menu_items();
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function jsonPurchaseOrders() {
        $data = array();
        $data['purOrders'] = $this->adminmodel->get_purchOrders();
        $data['poItems'] = $this->adminmodel->get_poItemVariance();
        $data['suppliers'] = $this->adminmodel->get_supplier();
        $data['supplierMerch'] = $this->adminmodel->get_suppliermerch();

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    
    function jsonSuppliers() {
        $data =  $this->adminmodel->get_supplier();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function getPurchaseOrders(){
        if($this->checkIfLoggedIn()){
            $id = $this->input->post('id');
            $data = array(
                "po" => $this->adminmodel->get_purchaseOrders($id),
                "poItems" => $this->adminmodel->get_poItems($id)
            );
            echo json_encode($data);
        }else{
            redirect('login');
        }
    }

    function jsonSuppMerchandise() {
        $spmID = $this->input->post('spmID');
        $data = $this->adminmodel->get_suppMerchandise($spmID);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

}

?>
