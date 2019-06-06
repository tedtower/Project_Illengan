<?php
class Adminupdate extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }
    function editStockSpoil(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $stID = $this->input->post('stID');
            $ssID=$this->input->post('ssID');
            $ssDate=$this->input->post('ssDate');
            $ssRemarks=$this->input->post('ssRemarks');
            $stQty = $this->input->post('stQty');
            $ssQtyUpdate = $this->input->post('ssQtyUpdate');
            $curSsQty = $this->input->post('curSsQty');
            $updateQtyh = $ssQtyUpdate - $curSsQty; 
            $updateQtyl = $curSsQty - $ssQtyUpdate;
            $date_recorded=date("Y-m-d H:i:s");
            $slType = "spoilage";
            $slDateTime = date('Y-m-d', strtotime($ssDate));

            $this->adminmodel->edit_stockspoilage($ssID,$stID,$ssDate,$ssRemarks,$updateQtyh,$updateQtyl,$curSsQty,$stQty,$ssQtyUpdate,$date_recorded);
            $this->adminmodel->add_stockLog2($stID, $slType, $date_recorded, $slDateTime, $ssQty, $ssRemarks, $updateQtyh, $updateQtyl,$curSsQty,$ssQtyUpdate);
           
        }else{
            redirect('login');
        } 
    }
    function editMenuSpoil(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $msID = $this->input->post('msID');
            $prID = $this->input->post('prID');
            $msQty = $this->input->post('msQty');
            $msDate = $this->input->post('msDate');
            $msRemarks = $this->input->post('msRemarks');
            $date_recorded = date("Y-m-d H:i:s");

            $this->adminmodel->edit_menuspoilage($msID,$prID,$msQty,$msDate,$msRemarks,$date_recorded);
        }else{
            redirect('login');
        } 
    }
    function editAoSpoil(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $aoID = $this->input->post('aoID');
            $aosID = $this->input->post('aosID');
            $aosQty = $this->input->post('aosQty');
            $aosDate = $this->input->post('aosDate');
            $aosRemarks = $this->input->post('aosRemarks');
            $date_recorded = date("Y-m-d H:i:s");

            $this->adminmodel->edit_aospoilage($aoID,$aosID,$aosQty,$aosDate,$aosRemarks,$date_recorded);
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
            $this->form_validation->set_rules('tableCode',   'Table Code', 'trim|required|alpha_numeric_spaces|max_length[10]|is_unique[tables.tableCode]');
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
        // $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[3]|max_length[50]');
        // $this->form_validation->set_rules('new_password_confirmation', 'Confirm password', 'required|min_length[3]|max_length[50]|matches[new_password]');

        // if($this->form_validation->run()){
            $aID = $this->input->post('aID');
            $new_password = password_hash($this->input->post("new_password"),PASSWORD_DEFAULT);
             $this->adminmodel->change_aPassword($new_password,$aID);
              
        // }else{
            // echo "Form Validation is not working";
        // }
       
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
            redirect('admin/accounts');
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
                $stockCategory = $this->input->post('category'); 
                $stockBqty = $this->input->post('bqty');
                $stockLocation = $this->input->post('location');
                $stockMin = $this->input->post('min');
                $stockName = $this->input->post('name');
                $stockQty = $this->input->post('qty');
                $stockStatus = $this->input->post('status');
                $stockType = $this->input->post('type');
                $stockUom = $this->input->post('uom');
                $stockID = $this->input->post('id');
                $stockSize = $this->input->post('size');
                if($this->adminmodel->edit_stockItem($stockCategory, $stockBqty, $stockLocation, $stockMin, $stockName, $stockQty, $stockStatus, $stockType, $stockUom, $stockSize, $stockID)){
                    echo json_encode(array(
                        "stocks" => $this->adminmodel->get_stocks(),
                        "categories" => $this->adminmodel->get_stockSubCategories()
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
    function editMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $mID = $this->input->post('id');
            $mName = $this->input->post('name');
            $mDesc = $this->input->post('description');
            $mCat = $this->input->post('category');
            $mAvailability = $this->input->post('status');
            $preference = json_decode($this->input->post('preferences'),true);
            $addon = json_decode($this->input->post('addons'),true);
            if($this->adminmodel->edit_menu($mName, $mDesc, $mCat, $mAvailability, $preference, $addon, $mID)){
                echo json_encode(array(
                    'menu' => $this->adminmodel->get_menu(),
                    'preferences' => $this->adminmodel->get_preferences(),
                    'addons' => $this->adminmodel->get_addons2(),
                    'categories' => $this->adminmodel->get_menucategories()
                ));
            }
        }else{
            redirect('login');
        }
    }

    function editAddon(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $aoID = $this->input->post('aoID');
            $aoName = $this->input->post('aoName');
            $aoPrice = $this->input->post('aoPrice');
            $aoCategory = $this->input->post('aoCategory');
            $aoStatus= $this->input->post('aoStatus');
            $this->adminmodel->edit_addon($aoName, $aoPrice, $aoCategory, $aoStatus, $aoID);
            redirect('admin/menu/addons');
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
    function editReturnTrans(){
        print_r($_POST);
        $eID = $this->input->post('eID'); 
        $eSpID = $this->input->post('eSpID');
        $eRNum = $this->input->post('eRNum'); 
        $eStat = $this->input->post('eStat'); 
        $eRDate = $this->input->post('eRDate');
        $eDRec = $this->input->post('eDRec');
        $etotal = $this->input->post('eTotal'); 
        $eremarks = $this->input->post('eRemarks');
        $defaultType = $this->input->post('eType'); 
        $eRetIt = json_decode($this->input->post('eRetIt'), true); 
        echo json_encode($eRetIt, true);
        $this->adminmodel->update_returns($eID, $eSpID, $eRNum, 
        $eStat, $eRDate, $eDRec, $etotal, $eremarks, $defaultType, $eRetIt);
    }
}
?>
