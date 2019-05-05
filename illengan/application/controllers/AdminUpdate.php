<?php
class adminUpdate extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }
    function editStockSpoil(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ssID = $this->input->post('ssID');
            $vID = $this->input->post('vID');
            $ssQty = $this->input->post('ssQty');
            $ssDate = $this->input->post('ssDate');
            $ssRemarks = $this->input->post('ssRemarks');
            $date_recorded = date("Y-m-d H:i:s");

            $this->adminmodel->edit_stockspoilage($ssID,$vID,$ssQty,$ssDate,$ssRemarks,$date_recorded);
        }else{
            redirect('login');
        } 
    }
    function editMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctID = $this->input->post('ctID');
            $ctName = $this->input->post('new_name');
            $this->adminmodel->edit_menucategory($ctID, $ctName);
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }
    function editStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctID = $this->input->post('ctID');
            $ctName = $this->input->post('new_name');
            $this->adminmodel->edit_stockcategory($ctID, $ctName);
            redirect('admin/stockcategories');
        }else{
            redirect('login');
        }
    }
    function editTable(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->form_validation->set_rules('prevTableCode', 'Table Code', 'trim|required|alpha_numeric_spaces|max_length[10]');
            $this->form_validation->set_rules('tableCode',   'Table Code', 'trim|required|alpha_numeric_spaces|max_length[10]|is_unique[tables.table_code]');
            if($this->form_validation->run()){
                $prevTableCode = trim($this->input->post('prevTableCode'));
                $tableCode = trim($this->input->post('tableCode'));
                if($this->adminmodel->edit_table($tableCode,$prevTableCode)){
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
    function changeAccountPassword(){  
        $this->load->library('form_validation');

        $aID = $this->input->post('accountId');
        $current_password = $this->adminmodel->get_password($aID);

        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('new_confirm_password', 'Confirm password', 'required|min_length[3]|max_length[50]|matches[new_password]');
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');

        if($this->form_validation->run()){
            $old_password = $this->input->post("old_password");
            $new_password = password_hash($this->input->post("new_password"),PASSWORD_DEFAULT);

            foreach($current_password AS $row) {
                if (password_verify($old_password, $row['aPassword'])){                 
                    $this->adminmodel->change_aPassword($new_password,$aID);
                }else{ 
                echo "Password incorrect";
               }
           }   
        }else{
            
                // echo "Form Validation is not working";
        }
       
        redirect('admin/accounts');   
    }

    function editAccounts(){
        $this->form_validation->set_rules('new_aUsername','Username','trim|required|is_unique[accounts.aUsername]');
        $this->form_validation->set_rules('new_aType','Account Type','trim|required');
        $this->form_validation->set_rules('accountId','Account ID','required');

        if($this->form_validation->run()){
            $aID = $this->input->post('accountId');
            $aType = $this->input->post('new_aType');
            $aUsername = $this->input->post('new_aUsername');
            $this->adminmodel->edit_accounts($aID,$aType,$aUsername);
            }else{
                echo "Form Validation is not Working.";
            }
            redirect('admin/accounts');
    }
    function editStockItem(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){   
            $this->form_validation->set_rules('id','Stock ID','trim|required|numeric');
            $this->form_validation->set_rules('name','Stock Name','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('type','Stock Type','trim|required|alpha');
            $this->form_validation->set_rules('category','Stock Category','trim|required|alpha_numeric');
            $this->form_validation->set_rules('status','Stock Status','trim|required|alpha');
            
            if($this->form_validation->run() == FALSE){
                redirect("admin/inventory");
            }else{
                $stockID = $this->input->post('id');
                $stockName = $this->input->post('name');
                $stockType = $this->input->post('type');
                $stockCategory = $this->input->post('category');
                $stockStatus = $this->input->post('status');
                $stockVariance = json_decode($this->input->post('variances'),true);
                if($this->adminmodel->edit_stockItem($stockID,$stockName,$stockType,$stockCategory,$stockStatus,$stockVariance)){
                    echo json_encode(array(
                        "stocks" => $this->adminmodel->get_stocks(),
                        "categories" => $this->adminmodel->get_stockSubCategories(),
                        "variances" => $this->adminmodel->get_stockVariance(),
                        "expirations" => $this->adminmodel->get_stockExpiration()
                    ));
                }
            }

        }else{
            redirect('login');
        }
    }

    function editSupplierMerchandise(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $spID = $this->input->post('id');
            $spName = $this->input->post('name');
            $spContactNum = $this->input->post('contactNum');
            $spEmail= $this->input->post('email');
            $spStatus = $this->input->post('status');
            $spAddress = $this->input->post('address');
            $spMerch = json_decode($this->input->post('merchandises'),true);
            if($this->adminmodel->edit_supplier($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spMerch, $spID)){
                echo json_encode(array(
                    'sources' => $this->adminmodel->get_supplier(),
                    'merchandises' => $this->adminmodel->get_suppliermerch(),
                    'stockvariances' => $this->adminmodel->get_stockVariance()
                ));
            }
        }else{
            redirect('login');
        }
    }
    function edit_menu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $menu_id = $this->input->post('menu_id');
            $menu_name = $this->input->post('new_name');
            $menu_description = $this->input->post('new_description');
            $category_id = $this->input->post('new_category');
            $string_price = $this->input->post('new_price');
            $menu_price = floatval($string_price);
            $menu_availability = $this->input->post('new_availability');
            $data['menu'] = $this->adminmodel->edit_menu($menu_id, $menu_name, $category_id, $menu_description, $menu_price, $menu_availability);
            redirect('admin/menu');
        }else{
            redirect('login');
        }
    }
    function edit_image(){
        $data['image'] = $this->adminmodel->edit_image();
        $this->load->view('admin_module/edit_menuimage', $data);
        
    }
    function editPurchaseOrder(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){   
                $spID = $this->input->post('spID');
                $poID = $this->input->post('poID');
                $poDate = $this->input->post('poDate');
                $edDate = $this->input->post('edDate');
                $poTotal = $this->input->post('poTotal');
                $poDateRecorded = date('Y-m-d');
                $poStatus = 'pending';
                $poRemarks = $this->input->post('poRemarks');
                $merchandise = json_decode($this->input->post('merchandise'), true);
                echo json_encode($merchandise, true);
                $this->adminmodel->edit_purchaseOrder($poDate, $edDate, $poTotal, $poDateRecorded, $poStatus, 
                $poRemarks, $spID, $poID, $merchandise);
            

        }else{
            redirect('login');
        }
    }
    function editSource(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $source_id = $this->input->get('source_id');
            $source_name = $this->input->get('new_name');
            $contact_num = $this->input->get('new_contact');
            $email = $this->input->get('new_email');
            $status = $this->input->get('new_status');
            $this->adminmodel->edit_source($source_id, $source_name, $contact_num, $email, $status);
            redirect('admin/sources');
        }else{
            redirect('login');
        }
    }
       
    function editTransactions(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $transID = trim($this->input->post('transID'));
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
            if($this->adminmodel->edit_transaction($transID, $receiptNo, $transDate, $source, $remarks, $total, $dateRecorded, $transItems)){
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
    
    function editStockQty() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $stock_id = $this->input->post('stockId');
            $stock_quantity = $this->input->post('stockQty');
            echo $stock_id, $stock_quantity;
            $this->adminmodel->edit_stockqty($stock_id, $stock_quantity);
            redirect('admin/logStock');
        }else{
            redirect('login');
        }
    }
}
?>