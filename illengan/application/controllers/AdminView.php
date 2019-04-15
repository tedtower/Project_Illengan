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
    function viewAccounts(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['account'] = $this->adminmodel->get_accounts();
            $data['title'] = "Admin Accounts";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/view_accounts', $data);
            $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }   
    }

//Modal na ito
    function viewaddaccounts(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->view('admin/add_accounts');  
        }else{  
            redirect('login'); 
        }
    }
    // function vieweditAccounts(){
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
    //         $account_id = $this->uri->segment('3');
    //         $data['account_id'] = $account_id;
    //         $this->load->view('admin/view_accounts',$data);  
    //     }else{  
    //         redirect('login'); 
    //     }
    // }
    function vieweditAccounts2($account_id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['account_id'] = $account_id;
            $this->load->view('admin/editAccounts',$data);  
        }else{  
            redirect('login'); 
        }
    }

    function viewChangePassword(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $account_id = $this->uri->segment('3');
            $data['account_id'] = $account_id;
            $this->load->view('admin/changepassword', $data);
        }else{  
            redirect('login'); 
        }
   }
   function viewChangePassword2($account_id){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
        echo "Incorrect Current Password.";
        $data['account_id'] = $account_id;
        $this->load->view('admin/changepassword', $data);
    }else{  
        redirect('login'); 
    }
}
    function viewDashboard(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Dashboard";
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Inventory";
            // $this->load->view('admin/templates/head', $data);
            // $this->load->view('admin/templates/sideNav');
            $data['inventory'] = array(
                "stocks" => $this->adminmodel->get_inventory(),
                "categories" => $this->adminmodel->get_stockCategories()
            );
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin/adminInventory',$data);
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function viewLogs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Menu";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/menuitems');
        }else{
            redirect('login');
        }
    }

    function menuGetDetails(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data = array(
                'menu' => $this->adminmodel->get_menu(),
                'preferences' => $this->adminmodel->get_preferences(),
                'addons' => $this->adminmodel->get_addons2()
            );
            echo json_encode($data);
        }else{
            redirect('login');
        }
    }

    function menuAddons(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Menu/Addons";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/addons');
        }else{
            redirect('login');
        }
    }
    function viewMenuCategories(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['category'] = $this->adminmodel->get_menucategories();
            $this->load->view('admin/menucategories',$data);
        }else{
            redirect('login');
        }
    }
    // function viewInsertSpoilageMenu(){
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
    //         $result = array('menu' => $this->adminmodel->get_menu2());
    //         json_encode($result);
    //     }else{
    //         redirect('login');
    //     }
    // }
    // function viewInsertSpoilageStock(){
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
    //         $data['stockitems'] = $this->adminmodel->get_stock();
    //         $this->load->view('admin/add_spoilagesstock',$data);
    //     }else{
    //         redirect('login');
    //     }
    // }
    // function viewInsertSpoilageAo(){
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
    //         $data['addons'] = $this->adminmodel->get_addons();
    //         $this->load->view('admin/add_spoilagesao', $data);
    //     }else{
    //         redirect('login');
    //     }
    // }
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Sales";
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
    function viewSources(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Sources";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['source'] = $this->adminmodel->get_sources();
            $this->load->view('admin/adminSources', $data);
            // $this->load->view('admin/templates/scripts');
            $this->load->view('admin/templates/footer');
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesJs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data= $this->adminmodel->get_spoilages();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
    function viewSpoilages(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->view('admin/viewspoilages');
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/templates/footer');
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
 //-----------Stock Spoilage------------------------- 
 function viewSpoilagesStockJs(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
        $data= $this->adminmodel->get_spoilagesstock();
        echo json_encode($data);
        
    }else{
        redirect('login');
    }
}
function viewSpoilagesStock(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
        $this->load->view('admin/viewspoilagesstock');
        $this->load->view('admin/templates/head');
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/templates/footer');
        // $this->load->view('admin/templates/scripts');
    }else{
        redirect('login');
    }
}
   //-----------Menu Spoilage------------------------- 
    function viewSpoilagesMenuJs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data= $this->adminmodel->get_spoilagesmenu();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->view('admin/viewspoilagesmenu');
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/templates/footer');
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
 
    //-----------Addons Spoilage------------------------- 
    function viewSpoilagesAddonsJs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data= $this->adminmodel->$this->adminmodel->get_spoilagesaddons();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesAddons(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->view('admin/viewspoilagesaddons');
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/templates/footer');
            $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    //---------------------------------------------------
    function viewStockCategories(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/inventorycategories',$data);
        }else{
            redirect('login');
        }
    }
    function viewTables(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Tables";
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            echo json_encode($this->adminmodel->get_tables());
        }else{
            redirect('login');
        }
    }
    function viewTransactions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Transactions";
            // $this->load->view('admin/templates/head');
            // $this->load->view('admin/templates/sideNav');
            $data['transactions'] = array(
                "transaction" => $this->adminmodel->get_transactions(),
                "transitem" => $this->adminmodel->get_transitems(),
                "sources" => $this->adminmodel->get_sources()
            );
            $this->load->view('admin/adminAllTransactions',$data);
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }

    function viewPurchaseOrders(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Purchase Order";
            $this->load->view('admin/adminPurchaseOrder',$data);

        }else{
            redirect('login');
        }
    }

    function jsonLogStock() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data = $this->adminmodel->get_logs();

            header('Content-Type: application/json');
		    echo json_encode($data, JSON_PRETTY_PRINT);
        }else {
            redirect('login');
        }  

    }
    function jsonStock() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data = array();
            $data['stocks'] = $this->adminmodel->get_stock();
            $data['transactions'] = $this->adminmodel->get_transactions();
            header('Content-Type: application/json');
		    echo json_encode($data, JSON_PRETTY_PRINT);
        }else {
            redirect('login');
        }  


    }

    function viewLogStock() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Stock Logs";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/stocklog');
		    
        }else {
            redirect('login');
        }

    }


}

?>
