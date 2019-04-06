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
    function vieweditAccounts(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $account_id = $this->uri->segment('3');
            $data['account_id'] = $account_id;
            $this->load->view('admin/editAccounts',$data);  
        }else{  
            redirect('login'); 
        }
    }
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
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $data['stock'] = $this->adminmodel->get_inventory();
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin/adminInventory',$data);
            $this->load->view('admin/templates/scripts');
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
    function datatables_menu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data = $this->adminmodel->get_menu();
            echo json_encode($data);
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
    function viewInsertSpoilageMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $result = array('menu' => $this->adminmodel->get_menu2());
            json_encode($result);
        }else{
            redirect('login');
        }
    }
    function viewInsertSpoilageStock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['stockitems'] = $this->adminmodel->get_stock();
            $this->load->view('admin/add_spoilagesstock',$data);
        }else{
            redirect('login');
        }
    }
    function viewInsertSpoilageAo(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['addons'] = $this->adminmodel->get_addons();
            $this->load->view('admin/add_spoilagesao', $data);
        }else{
            redirect('login');
        }
    }
    // function viewReturns($method=null){        
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
    //         switch($method){
    //             "add":
    //             break;
    //             "edit":
    //             break;
    //             "delete":
    //             break;
    //         }
    //     }else{
    //         redirect('login');
    //     }
    // }
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
            $this->load->view('admin/templates/scripts');
            $this->load->view('admin/templates/footer');
        }else{
            redirect('login');
        }
    }
    function viewSpoilages(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model("adminmodel"); //Bakit niyo paulit-ulit na linalagay to e meron na siya sa topmost method, Check the __construct method for more info!!
            $data['spoilages'] = $this->adminmodel->get_spoilages();
            $this->load->view('admin/view_spoilages', $data);
            $this->load->view('admin/templates/scripts');
            $this->load->view('admin/templates/footer');
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model("adminmodel"); //Bakit niyo paulit-ulit na linalagay to e meron na siya sa topmost method, Check the __construct method for more info!!
            $data['spoilagesmenu'] = $this->adminmodel->get_spoilages_menu();
            $this->load->view('admin/view_spoilages_menu', $data);
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesStock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model("adminmodel"); //Bakit niyo paulit-ulit na linalagay to e meron na siya sa topmost method, Check the __construct method for more info!!
            $data['spoilagesstock'] = $this->adminmodel->get_spoilages_stock();
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/view_spoilages_stock', $data);
            $this->load->view('admin/templates/footer');
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesAo(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model("adminmodel"); //Bakit niyo paulit-ulit na linalagay to e meron na siya sa topmost method, Check the __construct method for more info!!
            $data['spoilagesao'] = $this->adminmodel->get_spoilages_ao();
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/view_spoilages_ao', $data);
        }else{
            redirect('login');
        }
    }
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
            $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function viewTransactions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['title'] = "Admin Transactions";
            $data['transactions'] = $this->adminmodel->get_transactions();
            $data['transitems'] = $this->adminmodel->get_transitems();
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/transactions',$data);
            $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function samplemethod(){
        
        // $this->output->set_output(json_encode($this->adminmodel->get_samplemethod($this->input->get('id'))));
        $this->output->set_output(json_encode($this->adminmodel->get_transactions()));
    }
}

?>