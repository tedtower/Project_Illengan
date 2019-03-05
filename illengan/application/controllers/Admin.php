<?php
class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('adminmodel');
    }
    function viewDashboard(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->view('admin_module/dashboard');
        }else{
            redirect('login');
        }
    }

    function viewAccounts(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['account'] = $this->adminmodel->get_accounts();
            $this->load->view('admin_module/accounts',$data);
        }else{
            redirect('login');
        }
    }
    function viewChangePassword($account_id){
         $this->load->view('admin_module/changePassword',$account_id);
    }
    function changeAccountPassword($account_id){ //dito ka nagstop ikucompare mo yung old pass sa old pass(retrieve)
        $this->load->model("adminmodel");

        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $new_password_confirmation = $this->input->post('new_password_confirmation');



        $data['changepassword'] = $this->adminmodel->get_accounts();
        $this->viewChangePassword($account_id);
    }
    function deleteAccount($account_id){
        $this->load->model("adminmodel");
        $this->adminmodel->delete_spoilages($account_id); 
        echo "Data deleted successfully !";
    }
    function editAccount(){
 
    }
    function viewStockCategories(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin_module/inventorycategories',$data);
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

    function viewMenuCategories(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['category'] = $this->adminmodel->get_menucategories();
            $this->load->view('admin_module/menucategories',$data);
        }else{
            redirect('login');
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

    function viewInventory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['stock'] = $this->adminmodel->get_inventory();
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin_module/inventory',$data);
        }else{
            redirect('login');
        }
    }

    function viewLogs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['log'] = $this->adminmodel->get_logs();
            $this->load->view('admin_module/logs',$data);
        }else{
            redirect('login');
        }
    }
//Menu Operations
    function viewMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['menu'] = $this->adminmodel->get_menu();
            $data['category'] = $this->adminmodel->get_menucategories();
            $this->load->view('admin_module/menuitems',$data);
        }else{
            redirect('login');
        }
    }

    function viewSales(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['sales'] = $this->adminmodel->get_sales();
            $this->load->view('admin_module/sales',$data);
        }else{
            redirect('login');
        }
    }

    function viewSources(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['source'] = $this->adminmodel->get_sources();
            $this->load->view('admin_module/sources',$data);
        }else{
            redirect('login');
        }
    }

    function viewSpoilagesMenu(){
        $this->load->model("adminmodel");
        $data['spoilagesmenu'] = $this->adminmodel->get_spoilages_menu();
        $this->load->view('admin_module/view_spoilages_menu', $data);
    }
    function viewSpoilagesStock(){
        $this->load->model("adminmodel");
        $data['spoilagesstock'] = $this->adminmodel->get_spoilages_stock();
        $this->load->view('admin_module/view_spoilages_stock', $data);
    }

    function viewTables(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['table'] = $this->adminmodel->get_tables();
            $this->load->view('admin_module/tables',$data);
        }else{
            redirect('login');
        }
    }

    function viewTrans(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $data['transaction'] = $this->adminmodel->get_transactions();
            $this->load->view('admin_module/',$data);
        }else{
            redirect('login');
        }
    }
    function deletespoilages($sid){
        $this->load->model("adminmodel");
        $this->adminmodel->delete_spoilages($sid); 
        echo "Data deleted successfully !";
        
    }
    function insertspoilagesmenu(){
        $this->load->model('adminmodel');

        $stype = $this->input->post("stype");
        $menu_name =$this->input->post("menu_name");
        $sqty =$this->input->post("sqty");
        $sdate =$this->input->post("sdate");
        $remarks =$this->input->post("remarks");

        $this->adminmodel->add_damages_menu($stype,$menu_name,$sqty,$sdate,$remarks);
        $this->load->view('admin_module/add_spoilages_menu'); 
    }
    function insertspoilagesstock(){
        $this->load->model('adminmodel');

        $stype = $this->input->post("stype");
        $stock_name =$this->input->post("stock_name");
        $sqty =$this->input->post("sqty");
        $sdate =$this->input->post("sdate");
        $remarks =$this->input->post("remarks");

        $this->adminmodel->add_damages_stock($stype,$stock_name,$sqty,$sdate,$remarks);
        $this->load->view('admin_module/add_spoilages_stock'); 
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