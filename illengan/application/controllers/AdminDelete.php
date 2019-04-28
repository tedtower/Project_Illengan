<?php
class AdminDelete extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }
    function deleteAccount(){
      
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->form_validation->set_rules('accountId', 'Account Id', 'trim|required');
            if($this->form_validation->run()){
                $accountId = trim($this->input->post("accountId"));
                $this->adminmodel->delete_account($accountId);
                // redirect('admin/accounts');
            }else{
                echo $accountID;
               //redirect('admin/accounts');
            } 

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
            redirect('login');
        }
    }
    function deletestockspoilages(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data=$this->adminmodel->delete_spoilages(); 
            echo json_encode($data);
            redirect('admin/stock/spoilages');
        }else{
            redirect('login');
        }
    }
    function deletemenuspoilages($sid){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            
            $this->adminmodel->delete_spoilages($sid); 
            redirect('admin/menu/spoilages');
        }else{
            redirect('login');
        }
    }
    function deleteaddonsspoilages($sid){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            
            $this->adminmodel->delete_spoilages($sid); 
            redirect('admin/addons/spoilages');
        }else{
            redirect('login');
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
            redirect('login');
        }
    }
    function deleteStockItem($stock_id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            if($this->adminmodel->delete_stockitem($stock_id)){
                redirect('admin/inventory');
            }else{           
                $this->viewInventory("");
            }
        }else{
            redirect('login');
        }
    }    
    function deleteTable(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->form_validation->set_rules('tableCode', 'Table Code', 'trim|required|alpha_numeric_spaces');
            if($this->form_validation->run()){
                $tableCode = trim($this->input->post("tableCode"));
                if($this->adminmodel->delete_table($tableCode)){
                    $this->output->set_output(json_encode($this->adminmodel->get_tables()));
                }else{
                    redirect('admin/tables');
                }
            }else{
                redirect('admin/tables');
            }
        }else{
            redirect('login');
        }
    }    
    function deleteSource($source_id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            if($this->adminmodel->delete_supplier($source_id)){
                redirect('admin/sources');
            }else{
                echo "There was an error";
            }
        }else{
            redirect('login');
        }
    }    
    function delete_menu(){
        $id = $this->uri->segment(3);
        $this->adminmodel->delete_menu($id);
        $this->viewMenu();
    }
}
?>