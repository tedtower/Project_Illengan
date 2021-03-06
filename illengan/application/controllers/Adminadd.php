<?php
class Adminadd extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
    }
    function addaccounts(){
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[50]');
        // $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|min_length[5]|max_length[50]|matches[password]');
        $this->form_validation->set_rules('aUsername','Username','trim|required|is_unique[accounts.aUsername]');
        $this->form_validation->set_rules('aType','Account Type','trim|required');

            $password = password_hash($this->input->post("password"),PASSWORD_DEFAULT);
            $username = $this->input->post("aUsername");
            $aType = $this->input->post("aType");

        // if($this->form_validation->run()){
        //     $data = array(
        //         'aPassword'=>$password,
        //         'aUsername'=>$username,
        //         'aType'=>$aType
        //     );
        //     $this->adminmodel->add_accounts($data);
        //     redirect('admin/accounts');

        // }else{
            $data = array(
                'aPassword'=>$password,
                'aUsername'=>$username,
                'aType'=>$aType
            );
            $this->adminmodel->add_accounts($data);
            redirect('admin/accounts');
        // }
    }
    function addMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = trim($this->input->post('ctName'));
            $this->adminmodel->add_menucategory($ctName);
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }
    
    function addSales() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $tableCode = trim($this->input->post('tableCode'));
            $custName = trim($this->input->post('custName'));
            $osTotal = trim($this->input->post('osTotal'));
            $osDateTime = trim($this->input->post('osDateTime'));
            $osPayDateTime = trim($this->input->post('osPayDateTime'));
            $osDate = trim($this->input->post('osDate'));
            $osPayDate = trim($this->input->post('osPayDate'));
            $orderlists = json_decode($this->input->post('orderlists'), true);
            $osDateRecorded = date("Y-m-d H:i:s");
            $addons = json_decode($this->input->post('addons'), true);
           
            $this->adminmodel->add_salesOrder($tableCode, $custName, $osTotal, $osDateTime,
            $osPayDateTime, $osDateRecorded, $orderlists, $addons);

        }else{
            redirect('login');
        }
    }
    function addSubMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = trim($this->input->post('ctName'));
            $supcatID = trim($this->input->post('subcatID'));
            $this->adminmodel->add_submenucategory($ctName, $supcatID);
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }
    function addStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = $this->input->post('ctName');
            $this->adminmodel->add_stockcategory($ctName);
            redirect('admin/stockcategories');
        }else{
            redirect('login');
        }
    }
    function addSubStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = trim($this->input->post('ctName'));
            $supcatID = trim($this->input->post('subcatID'));
            $this->adminmodel->add_SubStockCategory($ctName, $supcatID);
            redirect('admin/stockcategories');
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

    function addAddon(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $aoName = $this->input->post('aoName');
            $aoPrice = $this->input->post('aoPrice');
            $aoCategory = $this->input->post('aoCategory');
            $aoStatus = $this->input->post('aoStatus');
            $this->adminmodel->add_addon($aoName, $aoPrice, $aoCategory, $aoStatus);
            redirect('admin/menu/addons');
        }else{
            redirect('login');
        }
    }
    
    function addSupplierMerchandise(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $spName = $this->input->post('name');
            $spContactNum = $this->input->post('contactNum');
            $spEmail= $this->input->post('email');
            $spStatus = $this->input->post('status');
            $spAddress = $this->input->post('address');
            $spMerch = json_decode($this->input->post('merchandises'),true);
            if($this->adminmodel->add_supplier($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spMerch)){
                echo json_encode(array(
                    'sources' => $this->adminmodel->get_supplier(),
                    'merchandises' => $this->adminmodel->get_suppliermerch(),
                    'stocks' => $this->adminmodel->get_stocks(),
                    'uom' => $this->adminmodel->get_uom()
                ));
            }else{
                redirect("admin/dashboard");
                // echo json_encode(array("stock" => $stockName, "stock" => $stockCategory, "stock" => $stockStatus, "stock" => $stockType, "stock" => $stockVariance));
            }
        }else{
            redirect('login');
        }
        // redirect("login");
        // echo json_encode(array("stock" => $stockName, "stock" => $stockCategory, "stock" => $stockStatus, "stock" => $stockType, "stock" => $stockVariance));
    }
    function addMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
                $mName = $this->input->post('name');
                $mDesc = $this->input->post('description');
                $category = $this->input->post('category');
                $status = $this->input->post('status');
                $preference = json_decode($this->input->post('preferences'),true);
                $addon = json_decode($this->input->post('addons'),true);
                if($this->adminmodel->add_menu($mName, $mDesc, $category, $status, $preference, $addon)){
                    echo json_encode(array(
                            'menu' => $this->adminmodel->get_menu(),
                            'preferences' => $this->adminmodel->get_preferences(),
                            'addons' => $this->adminmodel->get_addons2()
                        ));
                }else{
                    redirect("admin/menu");
                    // echo json_encode(array("stock" => $stockName, "stock" => $stockCategory, "stock" => $stockStatus, "stock" => $stockType, "stock" => $stockVariance));
                }
        }else{
            redirect("login");
        }
    }

    function addImage(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $config = array(
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                );
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('mImage')){
                echo 'error';
            }
            else{
                $data = $this->upload->data();
                $image = $data['file_name'];
                $mID = $this->input->post('menuId');
                $this->adminmodel->add_image($image, $mID);
                redirect("admin/menu");
            }
        }else{
            redirect("login");
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
                $stockCategory = $this->input->post('category');
                $stockLocation = $this->input->post('storage');
                $stockMin = $this->input->post('min');
                $stockName = $this->input->post('name');
                $stockQty = $this->input->post('qty');
                $stockStatus = $this->input->post('status');
                $stockType = $this->input->post('type');
                $stockUom = $this->input->post('uom');
                $stockSize = $this->input->post('size');
                $stockID = $this->input->post('id');
                $dbErr = false;
                if($stockID == null){
                    if(!$this->adminmodel->add_stockItem($stockCategory, $stockUom, $stockName, $stockQty, $stockMin, $stockType, $stockStatus, 0, $stockLocation, $stockSize)){
                        $dbErr = true;
                    }
                }else{                 
                    if(!$this->adminmodel->edit_stockItem($stockCategory, $stockLocation, $stockMin, $stockName, $stockQty, $stockStatus, $stockType, $stockUom, $stockSize, $stockID)){
                        $dbErr = true;
                    }
                }
                if($dbErr){
                    echo json_encode(array(
                        "dbErr" => true 
                    ));
                }else{
                    echo json_encode(array(
                        "stocks" => $this->adminmodel->get_stocks(),
                        "categories" => $this->adminmodel->get_stockSubCategories()
                    ));
                }
            }
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }

    function addPurchaseOrder() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $spID = $this->input->post('spID');
            $poDate = $this->input->post('poDate');
            $edDate = $this->input->post('edDate');
            $poTotal = $this->input->post('poTotal');
            $poDateRecorded = date('Y-m-d');
            $poStatus = 'pending';
            $poRemarks = $this->input->post('poRemarks');
            $merchandise = json_decode($this->input->post('merchandise'), true);
            echo json_encode($merchandise, true);
            $this->adminmodel->add_PurchaseOrder($poDate, $edDate, $poTotal, $poDateRecorded, $poStatus, $poRemarks, $spID, $merchandise);
            
        }else{
            redirect('login');
        }    
    }
    function addTable(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->form_validation->set_rules('tableCode', 'Table Code', 'trim|required|alpha_numeric_spaces|max_length[10]|is_unique[tables.tableCode]');
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
    function addspoilagesaddons(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->load->model('adminmodel');
            $date_recorded = date("Y-m-d H:i:s");
            $addons = json_decode($this->input->post('addons'), true);
            echo json_encode($addons, true);
            $this->adminmodel->add_aospoil($date_recorded,$addons);
           
        }else{
            redirect('login');
        }
    }
    function addspoilagesmenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->load->model('adminmodel');
            $date_recorded = date("Y-m-d H:i:s");
            $menus = json_decode($this->input->post('menus'), true);
            echo json_encode($menus, true);
            $this->adminmodel->add_menuspoil($date_recorded,$menus);
           
        }else{
            redirect('login');
        }
    }
    function addspoilagesstock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->load->model('adminmodel');
            $date_recorded = date("Y-m-d H:i:s");
            $slType = "spoilage";
            $stocks = json_decode($this->input->post('stocks'), true);
            echo json_encode($stocks, true);
            $this->adminmodel->add_stockspoil($date_recorded,$stocks,$slType);
            
        }else{
            redirect('login');
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
    function addTransaction(){
        $id = $this->input->post('id');
        $supplier = $this->input->post('supplier');
        $type = $this->input->post('type');
        $receipt = $this->input->post('receipt');
        $date = $this->input->post('date');
        $remarks = $this->input->post('remarks');
        $transitems = json_decode($this->input->post('transitems'),true);
        $dateRecorded = date("Y-m-d");
        $total = 0.00;
        for($i = 0 ; $i < count($transitems) ; $i++){
            $transitems[$i]['tiSubtotal'] = (float) $transitems[$i]['tiPrice'] * (float) $transitems[$i]['tiQty'];
            $total += $transitems[$i]['tiSubtotal'];
        }
        if($this->adminmodel->add_transaction($id, $supplier, $receipt, $date, $type, $dateRecorded, $remarks, $transitems)){
            echo json_encode(array(
                "dataSuccess" => true
            ));
        }else{
            echo json_encode(array(
                "dbErr" => true
            ));
        }
    }

    function addConsumption(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $nID = $this->adminmodel->get_nextIDConsumption();
            $cnDate = $this->input->post('consumedDate');
            $cnDestock = json_decode($this->input->post('consumptions'),true);
            echo json_encode($this->adminmodel->add_consumption($nID,$cnDate,date("Y-m-d H:i:s"),$cnDestock));
        }else{
            redirect('login');
        }
    }
    function addReturnTransactions(){
        $idate = date('Y-m-d');
        $reQty = $this->input->post('reQty');
        $reUnit = $this->input->post('reUnit');
        $cost = $this->input->post('cost');
        $supID= $this->input->post('supID');
        $dateRet= $this->input->post('dateRet');
        $receipt= $this->input->post('receipt');
        $remarks= $this->input->post('remarks');
        $reStat= $this->input->post('reStat');
        $stckName= $this->input->post('stckName');
        $subtotal= $this->input->post('subtotal');
        $variance= $this->input->post('variance');
        $stckID= $this->input->post('stckID');
        $this->adminmodel->add_returns($idate, $reQty, $reUnit, $supID, $dateRet, $receipt, $cost, $remarks,$reStat,  $stckName, $subtotal, $variance, $stckID);
        redirect('adminview/viewReturnTransactions');
    }

    function addRestockLog(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $restockQtys = json_decode($this->input->post('rsQtys'),true);
            foreach($restockQtys as $item){
                if($this->adminmodel->add_stockLog($item['id'], NULL, "restock", date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $item['qty'], NULL)){
                    if(!$this->adminmodel->add_stockQty($item['id'], $item['qty'])){
                        echo json_encode(array(
                            "crudErr" => true
                        ));
                    }
                }else{
                    echo json_encode(array(
                        "crudErr" => true
                    ));
                }
            }
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }


}
?>
