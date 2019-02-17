<?php
class Admin extends CI_Controller{
    function dashboard(){

    }

    function viewAccounts(){
        $this->load->model('adminmodel');
        $data['account'] = $this->adminmodel->get_accounts();
        $this->load->view('admin_module/',$data);
    }

    function viewCategories(){
        $this->load->model('adminmodel');
        $data['category'] = $this->adminmodel->get_categories();
        $this->load->view('admin_module/',$data);
    }

    function viewInventory(){
        $this->load->model('adminmodel');
        $data['stock'] = $this->adminmodel->get_inventory();
        $this->load->view('admin_module/',$data);
    }

    function viewLogs(){
        $this->load->model('adminmodel');
        $data['log'] = $this->adminmodel->get_logs();
        $this->load->view('admin_module/',$data);
    }

    function viewMenu(){
        $this->load->model('adminmodel');
        $data['menu'] = $this->adminmodel->get_menu();
        $this->load->view('admin_module/menuitems',$data);
    }

    function viewSales(){
        $this->load->model('adminmodel');
        $data['sales'] = $this->adminmodel->get_sales();
        $this->load->view('admin_module/',$data);
    }

    function viewSources(){
        $this->load->model('adminmodel');
        $data['source'] = $this->adminmodel->get_sources();
        $this->load->view('admin_module/',$data);
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
        $this->load->model('adminmodel');
        $data['table'] = $this->adminmodel->get_tables();
        $this->load->view('admin_module/',$data);
    }

    function viewTrans(){
        $this->load->model('adminmodel');
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
}
?>