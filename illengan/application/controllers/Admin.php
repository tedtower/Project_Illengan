<?php
class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('adminmodel');
    }
//VIEW FUNCTIONS--------------------------------------------------------------------------------
    function viewAccounts(){
        $data['account'] = $this->adminmodel->get_accounts();
        $this->load->view('admin/view_accounts',$data);

    }
    function viewaddaccounts(){
        $this->load->view('admin/add_accounts');   
    }
    function viewChangePassword(){ //PROBLEM: ACCOUNT_ID MAGSEND KA SA VIEW TAPOS ISEND MO ULIT SA CHANGEACCOUNTPASSWORD FUNCTION
        $account_id = $this->uri->segment('3');
        $this->db->select('account_password')->from('accounts')->where('account_id',$account_id);
        $query = $this->db->get();
        $data = $query->result();
        ob_start(); //to set echo output to a variable
        echo ($data[0]['account_password']);
        $account_password = ob_get_contents();
        ob_end_clean(); 

        $data['account_password'] = $account_password;
        $this->load->view('admin/changePassword', $data);
   }
    function viewDashboard(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->view('admin/dashboard');
        }else{
            redirect('login');
        }
    }
    function viewInventory($error = null){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['stock'] = $this->adminmodel->get_inventory();
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin/inventory',$data);
        }else{
            redirect('login');
        }
    }
    function viewLogs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['log'] = $this->adminmodel->get_logs();
            $this->load->view('admin/logs',$data);
        }else{
            redirect('login');
        }
    }

    function viewMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['menu'] = $this->adminmodel->get_menu();
            $data['category'] = $this->adminmodel->get_menucategories();
            $this->load->view('admin/admingeneralheader',$data);
            $this->load->view('admin/menuitems',$data);
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
    function viewSales(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['sales'] = $this->adminmodel->get_sales();
            $this->load->view('admin/sales',$data);
        }else{
            redirect('login');
        }
    }
    function viewSources(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['source'] = $this->adminmodel->get_sources();
            $this->load->view('admin/sources',$data);
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model("adminmodel");
            $data['spoilagesmenu'] = $this->adminmodel->get_spoilages_menu();
            $this->load->view('admin/view_spoilages_menu', $data);
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesStock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model("adminmodel");
            $data['spoilagesstock'] = $this->adminmodel->get_spoilages_stock();
            $this->load->view('admin/view_spoilages_stock', $data);
        }else{
            redirect('login');
        }
    }
    function viewStockCategories(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin/inventorycategories',$data);
        }else{
            redirect('login');
        }
    }
    function viewTables(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['table'] = $this->adminmodel->get_tables();
            $this->load->view('admin/tables',$data);
        }else{
            redirect('login');
        }
    }
    function viewTrans(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['transaction'] = $this->adminmodel->get_transactions();
            $this->load->view('admin/',$data);
        }else{
            redirect('login');
        }
    }

    
//CHANGE FUNCTIONS-------------------------------------------------------------------
    function changeAccountPassword(){  
            $this->load->library('form_validation');

            $account_id= $this->input->post("account_id");
            $this->form_validation->set_rules('new_password', 'Password', 'required|min_length[8]|max_length[50]');
            $this->form_validation->set_rules('new_password_confirmation', 'Confirm password', 'required|min_length[8]|max_length[50]|matches[new_password]');
            $this->form_validation->set_rules('account_password', 'Current Password', 'required');
            $this->form_validation->set_rules('old_password', 'Old Password', 'required|matches[account_password]');

            if($this->form_validation->run()){
                $this->load->model("adminmodel");
                $new_password = $this->input->post("new_password");
                $this->adminmodel->change_account_password($new_password, $account_id);
       
            }else{
                $this->viewChangePassword();
            }
    }
    function editMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $category_id = $this->input->get('category_id');
            $category_name = $this->input->get('new_name');
            $data['category'] = $this->adminmodel->edit_menucategory($category_id, $category_name);
            $this->viewMenuCategories();
        }else{
            redirect('login');
        }
    }

    
//ADD FUNCTIONS---------------------------------------------------------------------------------
    function addaccounts(){ //is_unique username not yet applied

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[50]');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|min_length[8]|max_length[50]|matches[password]');
        $this->form_validation->set_rules('account_username','Username','required');
        $this->form_validation->set_rules('account_type','Account Type','required');

        if($this->form_validation->run()){

            $password = $this->input->post("password");
            $username = $this->input->post("username");
            $account_type = $this->input->post("account_type");
            
            $data = array(
                'account_password'=>$password,
                'account_username'=>$username,
                'account_type'=>$account_type
            );

            $this->adminmodel->add_accounts($data);
    
        }else{
            $this->viewaddaccounts();
        }
    }
    function addMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $category_name = $this->input->get('category_name');
            $this->adminmodel->add_menucategory($category_name);
            $this->viewMenuCategories();
        }else{
            redirect('login');
        }
    }
    function addStockItem(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->form_validation->set_rules('stock_name','Stock Name','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('stock_quantity','Stock Quantity','trim|required|numeric');
            $this->form_validation->set_rules('stock_minqty','Minimum Quantity','trim|numeric');
            $this->form_validation->set_rules('stock_status','Stock Status','trim|required|alpha');
            $this->form_validation->set_rules('stock_category','Stock Status','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE){
                $this->viewInventory();
            }else{
                $stock_name = $this->input->post('stock_name');
                $stock_quantity = $this->input->post('stock_quantity');
                $stock_unit = $this->input->post('stock_unit');
                $stock_minimum = $this->input->post('stock_minqty');
                $stock_status = $this->input->post('stock_status');
                $category_id = $this->input->post('stock_category');
                if($this->adminmodel->add_stockitem($stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id)){
                    $this->viewInventory();
                }else{
                    $this->viewInventory("");                }
            }

        }else{
            redirect('login');
        }
    }
    function addStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $category_name = $this->input->get('category_name');
            $data['category'] = $this->adminmodel->add_stockcategory($category_name);
            $this->viewStockCategories();
        }else{
            redirect('login');
        }
    }
    function addTable(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $table_no = $this->input->get('table_no');
            if($this->adminmodel->add_table($table_no)){
                $this->viewTables();
            }else{
                echo "There was an error!!!!";
            }
        }else{
            redirect('login');
        }
        
    }
    function insertspoilagesmenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model('adminmodel');

            $stype = $this->input->post("stype");
            $menu_name =$this->input->post("menu_name");
            $sqty =$this->input->post("sqty");
            $sdate =$this->input->post("sdate");
            $remarks =$this->input->post("remarks");

            $this->adminmodel->add_damages_menu($stype,$menu_name,$sqty,$sdate,$remarks);
            $this->load->view('admin/add_spoilages_menu'); 
        }else{
        redirect('login');
        }
    }
    function insertspoilagesstock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model('adminmodel');

            $stype = $this->input->post("stype");
            $stock_name =$this->input->post("stock_name");
            $sqty =$this->input->post("sqty");
            $sdate =$this->input->post("sdate");
            $remarks =$this->input->post("remarks");

            $this->adminmodel->add_damages_stock($stype,$stock_name,$sqty,$sdate,$remarks);
            $this->load->view('admin/add_spoilages_stock'); 
        }else{
            redirect('login');
        }
    }

   
//EDIT FUNCTIONS-------------------------------------------------------------------------------------
    function editStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $category_id = $this->input->get('category_id');
            $category_name = $this->input->get('new_name');
            $data['category'] = $this->adminmodel->edit_stockcategory($category_id, $category_name);
            $this->viewStockCategories();
        }else{
            redirect('login');
        }
    }
    function editStockItem(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            
            $this->form_validation->set_rules('new_stock_id','Stock ID','trim|required|numeric');
            $this->form_validation->set_rules('new_stock_name','Stock Name','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('new_stock_quantity','Stock Quantity','trim|required|numeric');
            $this->form_validation->set_rules('new_stock_unit','Stock Unit','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('new_stock_minqty','Minimum Quantity','trim|numeric');
            $this->form_validation->set_rules('new_stock_status','Stock Status','trim|required|alpha');
            $this->form_validation->set_rules('new_stock_category','Stock Category','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE){
                $this->viewInventory();
            }else{
                $stock_id = $this->input->post('new_stock_id');
                $stock_name = $this->input->post('new_stock_name');
                $stock_quantity = $this->input->post('new_stock_quantity');
                $stock_unit = $this->input->post('new_stock_unit');
                $stock_minimum = $this->input->post('new_stock_minqty');
                $stock_status = $this->input->post('new_stock_status');
                $category_id = $this->input->post('new_stock_category');
                if($this->adminmodel->edit_stockitem($stock_id,$stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id)){
                    $this->viewInventory();
                }else{
                    $this->viewInventory("");
                }
            }

        }else{
            redirect('login');
        }
    }
        

//DELETE FUNCTIONS-------------------------------------------------------------------
    function deleteAccount($account_id){
        $this->load->model("adminmodel");
        $this->adminmodel->delete_spoilages($account_id); 
        echo "Data deleted successfully !";
    }
    function deleteMenuCategory($category_id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            if($this->adminmodel->delete_menucategory($category_id)){
                $this->viewMenuCategories();
            }else{
                //error
            }
        }else{
            redirect('login');
        }
    }
    function deletespoilages($sid){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model("adminmodel");
            $this->adminmodel->delete_spoilages($sid); 
            echo "Data deleted successfully !";
        }else{
            redirect('login');
        }
    }
    function deleteStockCategory($category_id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            if($this->adminmodel->delete_stockcategory($category_id)){
                $this->viewStockCategories();
            }else{
                //error
            }
        }else{
            redirect('login');
        }
    }
    function deleteStockItem($stock_id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            if($this->adminmodel->delete_stockitem($stock_id)){
                $this->viewInventory();
            }else{                
                $this->viewInventory("");
            }
        }else{
            redirect('login');
        }
    }
    function deleteTable($table_no){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            if($this->adminmodel->delete_table($table_no)){
                $this->viewTables();
            }else{
                echo "There was an error";
            }
        }else{
            redirect('login');
        }
    }
}
?>