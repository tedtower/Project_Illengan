<?php
class AdminUpdate extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }
    function editTable(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
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

        $account_id = $this->input->post('accountId');
        $current_password = $this->adminmodel->get_password($account_id);

        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('new_password_confirmation', 'Confirm password', 'required|min_length[3]|max_length[50]|matches[new_password]');
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');

        if($this->form_validation->run()){
            $old_password = $this->input->post("old_password");
            $new_password = password_hash($this->input->post("new_password"),PASSWORD_DEFAULT);

            foreach($current_password AS $row) {
                if (password_verify($old_password, $row['account_password'])){                 
                    $this->adminmodel->change_account_password($new_password,$account_id);
                }else{ 
                echo "Password incorrect";
               }
           }   
        }else{
                echo "Form Validation is not working";
        }
       
        redirect('admin/accounts');   
    }

    // function changeAccountPassword(){  
    //     $this->load->library('form_validation');

    //     $account_id = $this->input->post('accountId');
    //     $current_password = $this->adminmodel->get_password($accountId);

    //     $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[3]|max_length[50]');
    //     $this->form_validation->set_rules('new_password_confirmation', 'Confirm password', 'required|min_length[3]|max_length[50]|matches[new_password]');
    //     $this->form_validation->set_rules('old_password', 'Old Password', 'required');

    //     if($this->form_validation->run()){
    //         $old_password = $this->input->post("old_password");
    //         $new_password = $this->input->post("new_password");

    //         foreach($current_password AS $row) {
    //             if ($old_password == $row['account_password']){                 
    //                  $this->adminmodel->change_account_password($new_password,$account_id);
    //             }else{ 
    //                echo "Old password does not match with old password input";
    //             }
    //         }   
    //     }else{
    //                 echo "Form Validation is not working";
    //     }
    //                redirect('admin/accounts');
    // }
    function editAccounts(){
        $this->form_validation->set_rules('new_account_username','Username','trim|required|is_unique[accounts.account_username]');
        $this->form_validation->set_rules('new_account_type','Account Type','trim|required');
        $this->form_validation->set_rules('accountId','Account ID','required');

        if($this->form_validation->run()){
            $account_id = $this->input->post('accountId');
            $account_type = $this->input->post('new_account_type');
            $account_username = $this->input->post('new_account_username');
            $this->adminmodel->edit_accounts($account_id,$account_type,$account_username);
            }else{
                echo "Form Validation is not Working.";
            }
            redirect('admin/accounts');
    }
    function editMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $category_id = $this->input->get('category_id');
            $category_name = $this->input->get('new_name');
            $data['category'] = $this->adminmodel->edit_menucategory($category_id, $category_name);
            $this->viewMenuCategories();
        }else{
            redirect('login');
        }
    }
    function editStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
            $category_id = $this->input->post('category_id');
            $category_name = $this->input->post('new_name');
            $data['category'] = $this->adminmodel->edit_stockcategory($category_id, $category_name);
            $this->viewStockCategories();
        }else{
            redirect('login');
        }
    }
    function editStockItem(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){            
            $this->form_validation->set_rules('stockID','Stock ID','trim|required|numeric');
            $this->form_validation->set_rules('stockName','Stock Name','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('stockQty','Stock Quantity','trim|required|numeric');
            $this->form_validation->set_rules('stockUnit','Stock Unit','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('stockMin','Minimum Quantity','trim|numeric');
            $this->form_validation->set_rules('stockStatus','Stock Status','trim|required|alpha');
            $this->form_validation->set_rules('categoryName','Stock Category','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE){
                redirect("admin/inventory");
            }else{
                $stockID = $this->input->post('stockID');
                $stockName = $this->input->post('stockName');
                $stockQty = $this->input->post('stockQty');
                $stockUnit = $this->input->post('stockUnit');
                $stockMin = $this->input->post('stockMin');
                $stockStatus = $this->input->post('stockStatus');
                $categoryName = $this->input->post('categoryName');
                if($this->adminmodel->edit_stockItem($stockID,$stockName,$stockQty,$stockUnit,$stockMin,$stockStatus,$categoryName)){
                    echo json_encode(array(
                        "stocks" => $this->adminmodel->get_stocks(),
                        "categories" => $this->adminmodel->get_stockCategories()
                    ));
                }
            }

        }else{
            redirect('login');
        }
    }
    function edit_menu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
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
    function editSource(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
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
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Admin'){
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