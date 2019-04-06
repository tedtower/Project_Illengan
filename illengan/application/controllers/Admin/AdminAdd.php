<?php
class AdminAdd extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }
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
            $this->form_validation->set_rules('tableCode', 'Table Code', 'trim|required|alpha_numeric_spaces|max_length[10]');
            if($this->form_validation->run()){
                $tableCode = trim($this->input->get('tableCode'));
                if($this->adminmodel->add_table($tableCode)){
                    redirect('admin/tables');
                }else{
                    redirect('');
                }
            }else{
                $this->viewTables();
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
    function addSource(){
        $this->form_validation->set_rules("source_name", "Source Name", 'required');
        $this->form_validation->set_rules("contact_num", "Contact Number", 'required');
        if($this->form_validation->run()){
            $data = array(
                "source_name" => trim($this->input->post("source_name")),
                "contact_num" => trim($this->input->post("contact_num"))
            );
            if($this->input->post("insert")){
                $this->adminmodel->insert_data($data);
                redirect('admin/sources');
            }
        }else{
            $this->viewsources();
        }

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

}
?>