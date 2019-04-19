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
            $password = password_hash($this->input->post("password"),PASSWORD_DEFAULT);
            $username = $this->input->post("account_username");
            $account_type = $this->input->post("account_type");
            $data = array(
                'account_password'=>$password,
                'account_username'=>$username,
                'account_type'=>$account_type
            );
            $this->adminmodel->add_accounts($data);
            redirect('admin/accounts');

        }else{
            echo "There is an error";
            
        }
    }
    function addMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $superCategory = trim($this->input->post('super_category'));
            $category_name = trim($this->input->post('category_name'));
            $this->adminmodel->add_menucategory($category_name, $superCategory);
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }
    function addStockItem(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->form_validation->set_rules('stockName','Stock Name','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('stockQty','Stock Quantity','trim|required|numeric');
            $this->form_validation->set_rules('stockUnit','Stock Unit','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('stockMin','Minimum Quantity','trim|numeric');
            $this->form_validation->set_rules('stockStatus','Stock Status','trim|required|alpha');
            $this->form_validation->set_rules('categoryName','Stock Category','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE){
                redirect("admin/inventory");
            }else{
                $stockName = $this->input->post('stockName');
                $stockQty = $this->input->post('stockQty');
                $stockUnit = $this->input->post('stockUnit');
                $stockMin = $this->input->post('stockMin');
                $stockStatus = $this->input->post('stockStatus');
                $categoryName = $this->input->post('categoryName');
                if($this->adminmodel->add_stockItem($stockName,$stockQty,$stockUnit,$stockMin,$stockStatus,$categoryName)){
                    echo json_encode(array(
                        "stocks" => $this->adminmodel->get_stocks(),
                        "categories" => $this->adminmodel->get_stockCategories()
                    ));
                }else{
                }
            }
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
            $this->form_validation->set_rules('tableCode', 'Table Code', 'trim|required|alpha_numeric_spaces|max_length[10]|is_unique[tables.table_code]');
            if($this->form_validation->run()){
                $tableCode = trim($this->input->post('tableCode'));
                if($this->adminmodel->add_table($tableCode)){
                    $this->output->set_output(json_encode($this->adminmodel->get_tables()));
                }else{
                    redirect('admin/tables');
                }
            }else{
                redirect("admin/tables");
            }
        }else{
            redirect('login');
        }        
    }
    function addTransactions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $receiptNo = trim($this->input->post('receiptNo'));
            $transDate = trim($this->input->post('transDate'));
            $source = trim($this->input->post('sourceName'));
            $remarks = trim($this->input->post('remarks'));
            $transItems = !isset(json_decode($this->input->post('transItems'), true)[0]) ? NULL : json_decode($this->input->post('transItems'), true);
            $dateRecorded = date("Y-m-d");
            $total = 0;
            for ($index=0; $index < count($transItems); $index++) { 
                $transItems[$index]['subtotal'] = (float) $transItems[$index]['itemQty'] * (float) $transItems[$index]['itemPrice']; 
                $total += $transItems[$index]['subtotal'];
            }
            if($this->adminmodel->add_transaction($receiptNo, $transDate, $source, $remarks, $total, $dateRecorded, $transItems)){
                $this->output->set_output(json_encode(array(
                    "transaction" => $this->adminmodel->get_transactions(),
                    "transitem" => $this->adminmodel->get_transitems(),
                    "sources" => $this->adminmodel->get_sources()
                )));
            }else{
                redirect(admin/transactions);
            }
        }else{
            redirect('login');
        }
    }
    function addspoilagesaddons(){
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
    function addspoilagesmenu(){
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
    function addspoilagesstock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $this->load->model('adminmodel');

            $s_type = $this->input->get("s_type");
            $stock_name =$this->input->get("stock_name");
            $s_qty =$this->input->get("s_qty");
            $s_date =$this->input->get("s_date");
            $date_recorded = date("Y-m-d");
            $remarks =$this->input->get("remarks");

            $this->adminmodel->add_stockspoil($s_type,$stock_name,$s_qty,$s_date,$date_recorded,$remarks);
            redirect('admin/stock/spoilages');
        }else{
            redirect('login');
        }
    }
    function addSource(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){

            $data = array(
                'source_name' => $this->input->get('source_name'),
                'contact_num' => $this->input->get('contact_num'),
                'email' => $this->input->get('email')
            );
            $this->adminmodel->add_source($data);
            redirect('admin/sources');

        }else{
            redirect('login');
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
    function addReturns(){
        $now = date('Y-m-d');
        $quantity = $this->input->post('quantity');
        $trans = $this->input->post('trans');
        $stock = $this->input->post('stock');
        $stck_qty = $this->input->post('stck_qty');
        $this->adminmodel->add_returns($trans, $stock, $quantity,  $now, $stck_qty);
        redirect('adminview/viewReturns');
    }

}
?>
