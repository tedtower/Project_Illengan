<?php
class AdminView extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }
//VIEW FUNCTIONS--------------------------------------------------------------------------------
function viewAccountsJs(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        echo json_encode($this->adminmodel->get_accounts());
        
    }else{
        redirect('login');
    }
}
    function viewAccounts(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Admin Stock Items";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $data['inventory'] = array(
                "stocks" => $this->adminmodel->get_stocks(),
                "categories" => $this->adminmodel->get_stockSubCategories(),
                "variances" => $this->adminmodel->get_stockVariance(),
                "expirations" => $this->adminmodel->get_stockExpiration()
            );
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin/adminInventory',$data);
        }else{
            redirect('login');
        }
    }
    function viewLogs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Menu";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Menu - Addons";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/addons');
        }else{
            redirect('login');
        }
    }
    function menuPromos(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Menu - Promos";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminPromo');
        }else{
            redirect('login');
        }
    }
    function viewMenuCategories(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['category'] = $this->adminmodel->get_menucategories();
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Sales";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            // $data['sales'] = $this->adminmodel->get_sales();
            $this->load->view('admin/adminSales',$data);
            $this->load->view('admin/templates/scripts');
            $this->load->view('admin/templates/footer');
        }else{
            redirect('login');
        }
    }
    function viewSupplier(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Sources";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminSources');
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }

    function supplierGetDetails(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data = array(
                'supplier' => $this->adminmodel->get_supplier(),
                'suppliermerch' => $this->adminmodel->get_suppliermerch(),
                'stockvariance' => $this->adminmodel->get_stockVariance()
            );
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }else{
            redirect('login');
        }
    }
    function viewStockJS() {
        $data=$this->adminmodel->get_stockVariance();
        echo json_encode($data);
    }
    function viewSpoilagesJs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data= $this->adminmodel->get_spoilages();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
    function viewSpoilages(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminspoilages');
        }else{
            redirect('login');
        }
    }
 //-----------Stock Spoilage------------------------- 
 function viewSpoilagesStockJs(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $data= $this->adminmodel->get_spoilagesstock();
        echo json_encode($data);
        
    }else{
        redirect('login');
    }
}
function viewSpoilagesStock(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data= $this->adminmodel->get_spoilagesmenu();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data= $this->adminmodel->$this->adminmodel->get_spoilagesaddons();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesAddons(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/inventorycategories',$data);
        }else{
            redirect('login');
        }
    }
    function viewTables(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            echo json_encode($this->adminmodel->get_tables());
        }else{
            redirect('login');
        }
    }
    // function viewTransactions(){
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Transactions - All";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminTransactionsAll');
        }else{
            redirect('login');
        }
    }
    function viewDeliveryTransactions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Transactions - Deliveries";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminTransactionsDeliveries');
        }else{
            redirect('login');
        }
    }
    function viewPurchaseTransactions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
            $this->load->view('admin/adminTransactionsReturns');
        }else{
            redirect('login');
        }
    }

    function viewPurchaseOrders(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Purchase Order";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminPurchaseOrder');

        }else{
            redirect('login');
        }
    }

    function jsonLogStock() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data = $this->adminmodel->get_logs();

            header('Content-Type: application/json');
		    echo json_encode($data, JSON_PRETTY_PRINT);
        }else {
            redirect('login');
        }  

    }
    function jsonStock() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Stock Logs";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/stocklog');
		    
        }else {
            redirect('login');
        }

    }

    function jsonActivityLogs() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data = $this->adminmodel->get_actlogs();
            header('Content-Type: application/json');
		    echo json_encode($data, JSON_PRETTY_PRINT);
        }else {
            redirect('login');
        }  

    }

    function viewActivityLog() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Activity Logs";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/activityLogs');
		    
        }else {
            redirect('login');
        }

    }
    function viewConsumptions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Stock Consumption";
            $data['consumptions'] = array(
                "destockLog" 	=> $this->adminmodel->get_consumption(),
                "stockItems" 	=> $this->adminmodel->get_stocks(),
                "stockVariance" => $this->adminmodel->get_stockVariance()
            );
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/consumption');
        }else{
            redirect('login');
        }
    }
    function viewPromos() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    function jsonSuppMerchandise() {
        $data =  $this->adminmodel->get_suppMerchandise();
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

}

?>
