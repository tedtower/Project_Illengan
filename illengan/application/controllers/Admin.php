<?php
class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('adminmodel');
    }
    function viewDashboard(){
        $this->load->view('admin_module/dashboard');
    }

    function viewAccounts(){
        $this->load->model("adminmodel");
        $data['account'] = $this->adminmodel->get_accounts();
        $this->load->view('admin_module/view_accounts',$data);
    }
    function viewChangePassword($account_id){
         $this->load->view('admin_module/changePassword',$account_id);
    }
    function changeAccountPassword(){ //dito ka nagstop set query result sa variable
        $this->load->model("adminmodel");

        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $new_password_confirmation = $this->input->post('new_password_confirmation');
        $account_id = $this->input->post('account_id');
        
        
        $this->db->select('account_password')->from('accounts')->where('account_id',$account_id);
        $current_password = $this->db->get();
        
        if(($old_password == $query) && ($new_password == $new_password_confirmation)){
            $this->adminmodel->change_account_password($new_password, $account_id);
            echo "Password changed successfully !";
        }else{
            echo "Passwords doesn't match";
        }
    }
        
    
    function deleteAccount($account_id){
        $this->load->model("adminmodel");
        $this->adminmodel->delete_spoilages($account_id); 
        echo "Data deleted successfully !";
    }
    function editAccount(){
 
    }
    function viewStockCategories(){
        $data['category'] = $this->adminmodel->get_stockcategories();
        $this->load->view('admin_module/inventorycategories',$data);
    }

    function addStockCategory(){
        $category_name = $this->input->get('category_name');
        $data['category'] = $this->adminmodel->add_stockcategory($category_name);
        $this->viewStockCategories();
    }

    function editStockCategory(){
        $category_id = $this->input->get('category_id');
        $category_name = $this->input->get('new_name');
        $data['category'] = $this->adminmodel->edit_stockcategory($category_id, $category_name);
        $this->viewStockCategories();
    }

    function deleteStockCategory($category_id){
        if($this->adminmodel->delete_stockcategory($category_id)){
            $this->viewStockCategories();
        }else{
            //error
        }
    }

    function viewMenuCategories(){
        $data['category'] = $this->adminmodel->get_menucategories();
        $this->load->view('admin_module/menucategories',$data);
    }

    function addMenuCategory(){
        $category_name = $this->input->get('category_name');
        $this->adminmodel->add_menucategory($category_name);
        $this->viewMenuCategories();
    }

    function editMenuCategory(){
        $category_id = $this->input->get('category_id');
        $category_name = $this->input->get('new_name');
        $data['category'] = $this->adminmodel->edit_menucategory($category_id, $category_name);
        $this->viewMenuCategories();
    }

    function deleteMenuCategory($category_id){
        if($this->adminmodel->delete_menucategory($category_id)){
            $this->viewMenuCategories();
        }else{
            //error
        }
    }

    function viewInventory(){
        $data['stock'] = $this->adminmodel->get_inventory();
        $this->load->view('admin_module/inventory',$data);
    }

    function viewLogs(){
        $data['log'] = $this->adminmodel->get_logs();
        $this->load->view('admin_module/logs',$data);
    }

    function viewMenu(){
        $data['menu'] = $this->adminmodel->get_menu();
        $this->load->view('admin_module/menuitems',$data);
    }

    function viewSales(){
        $data['sales'] = $this->adminmodel->get_sales();
        $this->load->view('admin_module/sales',$data);
    }

    function viewSources(){
        $data['source'] = $this->adminmodel->get_sources();
        $this->load->view('admin_module/sources',$data);
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
        $data['table'] = $this->adminmodel->get_tables();
        $this->load->view('admin_module/tables',$data);
    }

    function viewTrans(){
        $data['transaction'] = $this->adminmodel->get_transactions();
        $this->load->view('admin_module/',$data);
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
        $table_no = $this->input->get('table_no');
        if($this->adminmodel->add_table($table_no)){
            $this->viewTables();
        }else{
            echo "There was an error!!!!";
        }
        
    }

    function deleteTable($table_no){
        if($this->adminmodel->delete_table($table_no)){
            $this->viewTables();
        }else{
            echo "There was an error";
        }
    }

}
?>