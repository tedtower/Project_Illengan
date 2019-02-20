<?php
class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('adminmodel');
    }
    function viewDashboard(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->load->view('admin_module/dashboard');
        }else{

        }
    }

    function viewAccounts(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['account'] = $this->adminmodel->get_accounts();
            $this->load->view('admin_module/accounts',$data);
        }else{

        }
    }

    function viewStockCategories(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['category'] = $this->adminmodel->get_stockcategories();
            $this->load->view('admin_module/inventorycategories',$data);
        }else{

        }
    }

    function addStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $category_name = $this->input->get('category_name');
            $data['category'] = $this->adminmodel->add_stockcategory($category_name);
            $this->viewStockCategories();
        }else{

        }
    }

    function editStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $category_id = $this->input->get('category_id');
            $category_name = $this->input->get('new_name');
            $data['category'] = $this->adminmodel->edit_stockcategory($category_id, $category_name);
            $this->viewStockCategories();
        }else{

        }
    }

    function deleteStockCategory($category_id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            if($this->adminmodel->delete_stockcategory($category_id)){
                $this->viewStockCategories();
            }else{
                //error
            }
        }else{

        }
    }

    function viewMenuCategories(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['category'] = $this->adminmodel->get_menucategories();
            $this->load->view('admin_module/menucategories',$data);
        }else{

        }
    }

    function addMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $category_name = $this->input->get('category_name');
            $this->adminmodel->add_menucategory($category_name);
            $this->viewMenuCategories();
        }else{

        }
    }

    function editMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $category_id = $this->input->get('category_id');
            $category_name = $this->input->get('new_name');
            $data['category'] = $this->adminmodel->edit_menucategory($category_id, $category_name);
            $this->viewMenuCategories();
        }else{
            redirect('login');
        }
    }

    function deleteMenuCategory($category_id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            if($this->adminmodel->delete_menucategory($category_id)){
                $this->viewMenuCategories();
            }else{
                //error
            }
        }else{

        }
    }

    function viewInventory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['stock'] = $this->adminmodel->get_inventory();
            $this->load->view('admin_module/inventory',$data);
        }else{

        }
    }

    function viewLogs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['log'] = $this->adminmodel->get_logs();
            $this->load->view('admin_module/logs',$data);
        }else{

        }
    }

    function viewMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['menu'] = $this->adminmodel->get_menu();
            $data['category'] = $this->adminmodel->get_categories();
            $this->load->view('admin_module/menuitems',$data);
        }else{

        }
    }

    function viewSales(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['sales'] = $this->adminmodel->get_sales();
            $this->load->view('admin_module/sales',$data);
        }else{

        }
    }

    function viewSources(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['source'] = $this->adminmodel->get_sources();
            $this->load->view('admin_module/sources',$data);
        }else{

        }
    }

    function viewSpoilages(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['spoilage'] = $this->adminmodel->get_spoilages();
            $this->load->view('admin_module/spoilages',$data);
        }else{

        }
    }

    function viewTables(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['table'] = $this->adminmodel->get_tables();
            $this->load->view('admin_module/tables',$data);
        }else{

        }
    }

    function viewTrans(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['transaction'] = $this->adminmodel->get_transactions();
            $this->load->view('admin_module/',$data);
        }else{

        }
    }

    function addTable(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $table_no = $this->input->get('table_no');
            if($this->adminmodel->add_table($table_no)){
                $this->viewTables();
            }else{
                echo "There was an error!!!!";
            }
        }else{

        }
        
    }

    function deleteTable($table_no){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            if($this->adminmodel->delete_table($table_no)){
                $this->viewTables();
            }else{
                echo "There was an error";
            }
        }else{

        }
    }

}
?>