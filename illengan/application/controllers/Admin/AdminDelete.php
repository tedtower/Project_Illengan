<?php
class AdminDelete extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }
    function deleteAccount($account_id){
        $this->load->model("adminmodel"); //Bakit niyo paulit-ulit na linalagay to e meron na siya sa topmost method, Check the __construct method for more info!!
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
            $this->load->model("adminmodel"); //Bakit niyo paulit-ulit na linalagay to e meron na siya sa topmost method, Check the __construct method for more info!!
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
                redirect('admin/inventory');
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
                redirect('admin/tables');
            }else{
                echo "There was an error";
            }
        }else{
            redirect('login');
        }
    }    
    function deleteSource(){
        $id = $this->uri->segment(3);
        $this->adminmodel->delete_source($id);
        $this->viewsources();
    }    
    function delete_menu(){
        $id = $this->uri->segment(3);
        $this->adminmodel->delete_menu($id);
        $this->viewMenu();
    }
}
?>