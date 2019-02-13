<?php
class Admin extends CI_Controller{
    function dashboard(){

    }

    function viewAccounts(){
        $this->load->model('adminmodel');
        $data['account'] = $this->adminmodel->get_accounts();
        $this->load->view('',$data);
    }

    function viewCategories(){
        $this->load->model('adminmodel');
        $data['category'] = $this->adminmodel->get_categories();
        $this->load->view('',$data);
    }

    function viewInventory(){
        $this->load->model('adminmodel');
        $data['stock'] = $this->adminmodel->get_inventory();
        $this->load->view('',$data);
    }

    function viewLogs(){
        $this->load->model('adminmodel');
        $data['log'] = $this->adminmodel->get_logs();
        $this->load->view('',$data);
    }

    function viewMenu(){
        $this->load->model('adminmodel');
        $data['menu'] = $this->adminmodel->get_menu();
        $this->load->view('',$data);
    }

    function viewSales(){
        $this->load->model('adminmodel');
        $data['sales'] = $this->adminmodel->get_sales();
        $this->load->view('',$data);
    }

    function viewSources(){
        $this->load->model('adminmodel');
        $data['source'] = $this->adminmodel->get_sources();
        $this->load->view('',$data);
    }

    function viewSpoilages(){
        $this->load->model('adminmodel');
        $data['spoilage'] = $this->adminmodel->get_spoilages();
        $this->load->view('',$data);
    }

    function viewTables(){
        $this->load->model('adminmodel');
        $data['table'] = $this->adminmodel->get_tables();
        $this->load->view('',$data);
    }

    function viewTrans(){
        $this->load->model('adminmodel');
        $data['transaction'] = $this->adminmodel->get_transactions();
        $this->load->view('',$data);
    }

}
?>