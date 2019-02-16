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
        $data['account'] = $this->adminmodel->get_accounts();
        $this->load->view('admin_module/accounts',$data);
    }

    function viewCategories(){
        $data['category'] = $this->adminmodel->get_categories();
        $this->load->view('admin_module/categories',$data);
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

    function viewSpoilages(){
        $data['spoilage'] = $this->adminmodel->get_spoilages();
        $this->load->view('admin_module/spoilages',$data);
    }

    function viewTables(){
        $data['table'] = $this->adminmodel->get_tables();
        $this->load->view('admin_module/tables',$data);
    }

    function viewTrans(){
        $data['transaction'] = $this->adminmodel->get_transactions();
        $this->load->view('admin_module/',$data);
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