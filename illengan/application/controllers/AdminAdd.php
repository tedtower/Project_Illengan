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
        $this->form_validation->set_rules('aUsername','Username','trim|required|is_unique[accounts.aUsername]');
        $this->form_validation->set_rules('aType','Account Type','trim|required');

            $password = password_hash($this->input->post("password"),PASSWORD_DEFAULT);
            $username = $this->input->post("aUsername");
            $aType = $this->input->post("aType");

        if($this->form_validation->run()){
            $data = array(
                'aPassword'=>$password,
                'aUsername'=>$username,
                'aType'=>$aType
            );
            $this->adminmodel->add_accounts($data);
            redirect('admin/accounts');

        }else{
            $data = array(
                'aPassword'=>$password,
                'aUsername'=>$username,
                'aType'=>$aType
            );
            echo json_encode($data);
        }
    }
    function addMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $superCategory = trim($this->input->post('super_category'));
            $category_name = trim($this->input->post('category_name'));
            $this->adminmodel->add_menucategory($category_name, $superCategory);
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }
    function addPromo() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $pmName = $this->input->post('pmName');
            $pmStartDate = $this->input->post('pmStartDate');
            $pmEndDate = $this->input->post('pmEndDate');
            $fbName = $this->input->post('fbName');
            $isElective = $this->input->post('isElective');
            $prID = $this->input->post('prID');
            $pcType = $this->input->post('pcType');
            $pcQty = $this->input->post('pcQty');
            $prIDfb = $this->input->post('prIDfb');
            $fbQty = $this->input->post('fbQty');

            $this->adminmodel->add_promo($pmName, $pmStartDate, $pmEndDate, $fbName, $isElective, $prID, $pcType, $pcQty, $prIDfb, $fbQty);
            // var pmName = $('#pmName').val();
            // var pmStartDate = $('#pmStartDate').val();
            // var pmEndDate = $('#pmEndDate').val();
            // var elective = $('#isElective').val();
            // var fbName = $('#fbName').val();
            // var menuName = $('#menu_name').val();
            // var pcQty = $('#pcQty').val();
            // var menuFB = $('#fb_item').val();
            // var fbQty = $('#fbQty').val();
        } else {
            redirect('login');
        }

    }
    function addStockItem(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->form_validation->set_rules('name','Stock Name','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('type','Stock Type','trim|required|alpha');
            $this->form_validation->set_rules('category','Stock Category','trim|required|alpha_numeric');
            $this->form_validation->set_rules('status','Stock Status','trim|required|alpha');
            
            if($this->form_validation->run() == FALSE){
                redirect("admin/dashboard");
            }else{
                $stockName = $this->input->post('name');
                $stockType = $this->input->post('type');
                $stockCategory = $this->input->post('category');
                $stockStatus = $this->input->post('status');
                $stockVariance = json_decode($this->input->post('variances'),true);
                if($this->adminmodel->add_stockItem($stockName,$stockType,$stockCategory,$stockStatus,$stockVariance)){
                    echo json_encode(array(
                        "stocks" => $this->adminmodel->get_stocks(),
                        "categories" => $this->adminmodel->get_stockSubCategories(),
                        "variances" => $this->adminmodel->get_stockVariance(),
                        "expirations" => $this->adminmodel->get_stockExpiration()
                    ));
                }else{
                    redirect("admin/dashboard");
                    // echo json_encode(array("stock" => $stockName, "stock" => $stockCategory, "stock" => $stockStatus, "stock" => $stockType, "stock" => $stockVariance));
                } 
            }
        }else{
            redirect("login");
        }
    }
    function addStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $category_name = $this->input->get('category_name');
            $data['category'] = $this->adminmodel->add_stockcategory($category_name);
            $this->viewStockCategories();
        }else{
            redirect('login');
        }
    }
    function addPurchaseOrder() {
            $spID = $this->input->post('spID');
            $poDate = $this->input->post('poDate');
            $edDate = $this->input->post('edDate');
            $poTotal = 100;
            $poDateRecorded = date('Y-m-d');
            $poStatus = $this->input->post('poStatus');
            $poRemarks = $this->input->post('poRemarks');
            $merchandise = json_decode($this->input->post('merchandise'), true);
            echo json_encode($merchandise, true);
            $this->adminmodel->add_PurchaseOrder($poDate, $edDate, $poTotal, $poDateRecorded, $poStatus, $poRemarks, $spID, $merchandise);
        
    }
    function addTable(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){

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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
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

    function addSupplierMerchandise(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->load->model('adminmodel');
            $spName = $this->input->get("supplierName");
            $spContactNum =$this->input->get("contactNum");
            $spEmail =$this->input->get("email");
            $spStatus =$this->input->get("status");
            $spAddress =$this->input->get("supplierAddress");

            $vID = $this->input->get("variance");
            $spmDesc = $this->input->get("merchName");
            $spmUnit = $this->input->get("merchUnit");
            $spmPrice = $this->input->get("merchPrice");
            $this->adminmodel->add_supplierMerchandise($spName, $spContactNum, $spEmail, $spStatus, $spAddress,$vID, $spmDesc, $spmUnit, $spmPrice);
            redirect('admin/supplier');
        }else{
            redirect('login');
        }
        // redirect("login");
        // echo json_encode(array("stock" => $stockName, "stock" => $stockCategory, "stock" => $stockStatus, "stock" => $stockType, "stock" => $stockVariance));
    }
}
?>
