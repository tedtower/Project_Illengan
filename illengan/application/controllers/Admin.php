<?php
class Admin extends CI_Controller{
    function dashboard(){

    }

    function viewinventory(){
        $this->load->model('adminmodel');
        $data['stock'] = $this->adminmodel->get_inventory();
        $this->load->view('',$data);
    }

    funtion viewmenu(){
        $this->load->model('adminmodel');
        $data['menu'] = $this->adminmodel->get_menu();
        $this->load->view('',$data);
    }

    funtion viewtrans(){
        $this->load->model('adminmodel');
        $data['transaction'] = $this->adminmodel->get_transactions();
        $this->load->view('',$data);
    }

    funtion viewsales(){
        $this->load->model('adminmodel');
        $data['sales'] = $this->adminmodel->get_sales();
        $this->load->view('',$data);
    }

    funtion viewspoilages(){
        $this->load->model('adminmodel');
        $data['spoilage'] = $this->adminmodel->get_spoilages();
        $this->load->view('',$data);
    }

    funtion viewtables(){
        $this->load->model('adminmodel');
        $data['table'] = $this->adminmodel->get_tables();
        $this->load->view('',$data);
    }

    funtion viewaccounts(){
        $this->load->model('adminmodel');
        $data['account'] = $this->adminmodel->get_accounts();
        $this->load->view('',$data);
    }

    funtion viewcategories(){
        $this->load->model('adminmodel');
        $data['category'] = $this->adminmodel->get_categories();
        $this->load->view('',$data);
    }

    funtion viewlogs(){
        $this->load->model('adminmodel');
        $data['log'] = $this->adminmodel->get_logs();
        $this->load->view('',$data);
    }
}
?>