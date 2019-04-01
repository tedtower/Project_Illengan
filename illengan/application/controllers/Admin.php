<?php
class Admin extends CI_Controller{

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
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/view_accounts',$data);
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
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');            
            $this->load->view('admin/adminDashboard');            
            $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function viewInventory($error = null){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['stock'] = $this->adminmodel->get_inventory();
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/inventory',$data);
            $this->load->view('admin/templates/scripts');
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
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/menuitems',$data);
            $this->load->view('admin/templates/scripts');
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
            $data['sales'] = $this->adminmodel->get_sales();
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/sales',$data);
            $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function viewSources(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['source'] = $this->adminmodel->get_sources();
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/sources',$data);
            $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function viewSpoilages(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model("adminmodel");
            $data['spoilages'] = $this->adminmodel->get_spoilages();
            $this->load->view('admin/view_spoilages', $data);
            $this->load->view('admin/templates/scripts');
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
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/view_spoilages_stock', $data);
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesAo(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model("adminmodel");
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
            $data['table'] = $this->adminmodel->get_tables();
            $this->load->view('admin/templates/head');
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/tables',$data);
            $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function viewTransactions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
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

    
//ADD FUNCTIONS---------------------------------------------------------------------------------
    function addaccounts(){

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|min_length[5]|max_length[50]|matches[password]');
        $this->form_validation->set_rules('account_username','Username','trim|required|is_unique[accounts.account_username]');
        $this->form_validation->set_rules('account_type','Account Type','trim|required');

        if($this->form_validation->run()){
            $password = password_hash($this->input->post("password"),PASSWORD_DEFAULT, ['cost' => 12]);
            $username = $this->input->post("account_username");
            $account_type = $this->input->post("account_type");
            $data = array(
                'account_password'=>$password,
                'account_username'=>$username,
                'account_type'=>$account_type
            );
            $this->adminmodel->add_accounts($data);
            $this->viewAccounts();

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
                    redirect('admin/inventory');
                }else{
                    redirect('admin/inventory');             }
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
            $table_no = $this->input->get('table_code');
            if($this->adminmodel->add_table($table_code)){
                $this->viewTables();
            }else{
                echo "There was an error!!!!";
            }
        }else{
            redirect('login');
        }
        
    }
    function addTransactions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            
        }else{
            redirect('login');
        }
    }
    function insertspoilagesaddons(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model('adminmodel');

            $s_type = $this->input->post("s_type");
            $ao_name =$this->input->post("ao_name");
            $s_qty =$this->input->post("s_qty");
            $s_date =$this->input->post("s_date");
            $remarks =$this->input->post("remarks");
            $date_recorded = date("Y-m-d");

            $this->adminmodel->add_aospoil($s_type,$ao_name,$s_type,$s_date,$date_recorded,$remarks);
            $data['spoilages'] = $this->adminmodel->get_spoilages();
            $this->load->view('admin/view_spoilages',$data); 
        }else{
            redirect('login');
        }
    }
    function insertspoilagesmenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){

            $s_type = $this->input->post("s_type");
            $menu_name =$this->input->post("menu_name");
            $s_qty =$this->input->post("s_qty");
            $s_date =$this->input->post("s_date");
            $date_recorded = date("Y-m-d");
            $remarks =$this->input->post("remarks");

            $this->adminmodel->add_menuspoil($s_type,$menu_name,$s_qty,$s_date,$date_recorded,$remarks);
            $data['spoilages'] = $this->adminmodel->get_spoilages();
            $this->load->view('admin/view_spoilages', $data);
        }else{
            redirect('login');
        }
    }
    function insertspoilagesstock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model('adminmodel');

            $s_type = $this->input->post("s_type");
            $stock_name =$this->input->post("stock_name");
            $s_qty =$this->input->post("s_qty");
            $s_date =$this->input->post("s_date");
            $date_recorded = date("Y-m-d");
            $remarks =$this->input->post("remarks");

            $this->adminmodel->add_stockspoil($s_type,$stock_name,$s_qty,$s_date,$date_recorded,$remarks);
            $data['spoilages'] = $this->adminmodel->get_spoilages();
            $this->load->view('admin/view_spoilages', $data);
        }else{
            redirect('login');
        }
    }

//EDIT FUNCTIONS-------------------------------------------------------------------------------------
    function changeAccountPassword(){  
    $this->load->library('form_validation');

    $account_id = $this->input->post('account_id');
    $this->adminmodel->get_password($account_id);
    $current_password = $this->adminmodel->get_password($account_id);

    $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('new_password_confirmation', 'Confirm password', 'required|min_length[3]|max_length[50]|matches[new_password]');
    $this->form_validation->set_rules('old_password', 'Old Password', 'required');

        if($this->form_validation->run()){
            $input_old_password = $this->input->post("old_password");
            $new_password = password_hash($this->input->post("new_password"),PASSWORD_DEFAULT, ['cost' => 12]);

            foreach($current_password AS $row) {
                if (password_verify($input_old_password, $row['account_password'])){                 
                    $this->adminmodel->change_account_password($new_password,$account_id);
                }else{ 
                    $data['account_id'] = $account_id;
                    $this->viewChangePassword2($data);
                }
            }   
        }else{
            $this->viewChangePassword($account_id);
        }
        // $data['account'] = $this->adminmodel->get_accounts();
        // $this->load->view('admin/view_accounts',$data);
    }
    function editAccounts(){
        $this->form_validation->set_rules('account_username','Username','trim|required|is_unique[accounts.account_username]');
        $this->form_validation->set_rules('account_type','Account Type','trim|required');
        $account_id = $this->input->post("account_id");

        if($this->form_validation->run()){
            $account_username = $this->input->post("account_username");
            $account_type = $this->input->post("account_type");

            $data =array(
                'account_type' => $account_type,
                'account_username' =>$account_username
            );
            $data['account_id'] = $account_id;
            
            $this->adminmodel->edit_accounts($data,$account_id);
            $this->viewAccounts();
            }else{
            $this->vieweditAccounts2($account_id);
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
    function editStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $category_id = $this->input->post('category_id');
            $category_name = $this->input->post('new_name');
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
                }
            }

        }else{
            redirect('login');
        }
    }
    // if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
    // }else{
    //     redirect('login');
    // }

//DELETE FUNCTIONS-------------------------------------------------------------------
    function deleteAccount($account_id){
        $this->load->model("adminmodel");
        if($this->adminmodel->delete_account($account_id)){
            $this->viewAccounts();
        }else{
            //error
        }; 
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
            $data['spoilages']=$this->adminmodel->get_spoilages();
            $this->load->view('admin/view_spoilages',$data);
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
    function add_source(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("source_name", "Source Name", 'required');
        $this->form_validation->set_rules("contact_num", "Contact Number", 'required');

        if($this->form_validation->run()){
            $this->load->model("adminmodel");
            $data = array(
                "source_name" =>$this->input->post("source_name"),
                "contact_num" =>$this->input->post("contact_num")
            );
            if($this->input->post("insert")){
                $this->adminmodel->insert_data($data);
                redirect(base_url() . "index.php/admin/viewsources");
            }
        }else{
            $this->viewsources();
        }

    }

    function edit_source(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $source_id = $this->input->get('source_id');
            $source_name = $this->input->get('new_name');
            $contact_num = $this->input->get('new_num');
            $status = $this->input->get('new_status');
            $data['source'] = $this->adminmodel->edit_data($source_id, $source_name, $contact_num, $status);
            $this->viewsources();
        }else{
            redirect('login');
        }
    }
    
    function delete_data(){
        $id = $this->uri->segment(3);
        $this->load->model("adminmodel");
        $this->adminmodel->delete_data($id);
        $this->viewsources();

    }
    function add_menu(){
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            );
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('menu_image')){
            echo 'error';
        }
        else{
        $data = $this->upload->data();
        $picture = $data['file_name'];
        $menu_name = $this->input->post('menu_name');
        $menu_description = $this->input->post('menu_description');
        $category_id = $this->input->post('category_id');
        $menu_price = $this->input->post('menu_price');
        $this->adminmodel->add_menu($menu_name, $menu_description, $category_id, $menu_price, $picture);
        redirect('admin/menu');
        }

    }
    function delete_menu(){
        $id = $this->uri->segment(3);
        $this->load->model("adminmodel");
        $this->adminmodel->delete_menu($id);
        $this->viewMenu();
    }
    function edit_menu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $menu_id = $this->input->post('menu_id');
            $menu_name = $this->input->post('new_name');
            $menu_description = $this->input->post('new_description');
            $category_id = $this->input->post('new_category');
            $string_price = $this->input->post('new_price');
            $menu_price = floatval($string_price);
            $menu_availability = $this->input->post('new_availability');
            $data['menu'] = $this->adminmodel->edit_menu($menu_id, $menu_name, $category_id, $menu_description, $menu_price, $menu_availability);
            redirect('admin/menu');
        }else{
            redirect('login');
        }
    }
    function edit_image(){
        $data['image'] = $this->adminmodel->edit_image();
        $this->load->view('admin_module/edit_menuimage', $data);
        
    }

}

?>