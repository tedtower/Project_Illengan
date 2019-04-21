<?php
class AdminModel extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

    //INSERT FUNCTIONS----------------------------------------------------------------
    function add_accounts($data){
        $this->db->insert('accounts',$data);
    }
    function add_menuspoil($s_type,$mName,$s_qty,$s_date,$date_recorded,$remarks){
        $query1 = "select mID from `menu` where mName = ? ";
        $mID = $this->db->query($query1,array($mName));
        foreach($mID->result_array() AS $row) {
            $query = "insert into spoilage (s_id, s_type, s_qty, s_date, date_recorded, remarks) values (NULL,?,?,?,?,?)";
            if($this->db->query($query,array($s_type,$s_qty,$s_date,$date_recorded,$remarks))){ 
                $query = "insert into menuspoil values (?,?)";
                return $this->db->query($query,array($this->db->insert_id(),$row['mID']));
            }else{
                return false;
            }
        }
    }
    function add_stockspoil($s_type,$stock_name,$s_qty,$s_date,$date_recorded,$remarks){
        $query1 = "select stID from `stockitems` where stock_name = ? ";
        $stID = $this->db->query($query1,array($stock_name));
        foreach($stID->result_array() AS $row) {
            $query = "insert into spoilage (s_id, s_type, s_qty, s_date, date_recorded, remarks) values (NULL,?,?,?,?,?)";
            if($this->db->query($query,array($s_type,$s_qty,$s_date,$date_recorded,$remarks))){ 
                $query = "insert into stockspoil values (?,?)";
                return $this->db->query($query,array($this->db->insert_id(),$row['stID']));
            }else{
                return false;
            }
        }
    }
    function add_aospoil($s_type,$ao_name,$s_qty,$s_date,$date_recorded,$remarks){
        $query1 = "select ao_id from `addons` where ao_name = ? ";
        $ao_id = $this->db->query($query1,array($ao_name));
        foreach($ao_id->result_array() AS $row) {
            $query = "insert into spoilage (s_id, s_type, s_qty, s_date, date_recorded, remarks) values (NULL,?,?,?,?,?)";
            if($this->db->query($query,array($s_type,$s_qty,$s_date,$date_recorded,$remarks))){ 
                $query = "insert into ao_spoil values (?,?)";
                return $this->db->query($query,array($this->db->insert_id(),$row['ao_id']));
            }else{
                return false;
            }
        }
        $query = "insert into spoilage (s_id, s_type, s_date, date_recorded, remarks) values (Null,?,?,?,?)";
        if($this->db->query($query,array($s_type,$s_date,$date_recorded,$remarks))){ 
            $query = "insert into ao_spoil values (?,?)";
            return $this->db->query($query,array($this->db->insert_id(),$ao_id));
        }else{
            return false;
        }
    }

    function add_menucategory($ctName, $superCategory){
        $query = "Insert into categories (ctID, ctName, supcatID, ctType) values (NULL, ?, ? ,'Menu')";
        return $this->db->query($query,array($ctName));
    }
    function add_stockcategory($ctName, $superCategory){
        $query = "Insert into categories (ctID, ctName, supcatID, ctType) values (NULL, ? , ? ,'inventory')";
        return $this->db->query($query,array($ctName, $superCategory));
    }
    function add_stockItem($stockName,$stockQty,$stockUnit,$stockMin,$stock_Status,$ctID){
        $query = "Insert into stockitems (stID,stock_name,stock_quantity,stock_unit,stock_minimum,stock_status,ctID) values (NULL,?,?,?,?,?,?);";
        return $this->db->query($query,array($stockName,$stockQty,$stockUnit,$stockMin,$stockStatus,$ctID));
    }
    function add_table($table_code){
        $query = "Insert into tables (table_code) values (?);";
        return $this->db->query($query, array($table_code));
    }
    function add_transaction($receiptNo, $transDate, $source, $remarks, $total, $dateRecorded, $transItems){
        $query = "Insert into transactions (source_id, receipt_no, total, trans_date, date_recorded, remarks) values (?,?,?,?,?,?)";
        $bool = $this->db->query($query, array($source, $receiptNo, $total, $transDate, $dateRecorded, $remarks));
        $trans_id = $this->db->insert_id();
        if($transItems != NULL){
            $query = "Insert into transitems values (?,?,?,?,?,?)";
            foreach($transItems as $transItem){
                $this->db->query($query,array($trans_id, $transItem['itemName'], $transItem['itemQty'], $transItem['itemUnit'], $transItem['imTemprice'], $transItem['subtotal']));
            }
        }
        return true;
    }
    function add_promo($s_type,$mName,$s_qty,$s_date,$date_recorded,$remarks){
        $query1 = "select mID from `menu` where mName = ? ";
        $mID = $this->db->query($query1,array($mName));
        foreach($mID->result_array() AS $row) {
            $query = "insert into spoilage (s_id, s_type, s_qty, s_date, date_recorded, remarks) values (NULL,?,?,?,?,?)";
            if($this->db->query($query,array($s_type,$s_qty,$s_date,$date_recorded,$remarks))){ 
                $query = "insert into menuspoil values (?,?)";
                return $this->db->query($query,array($this->db->insert_id(),$row['mID']));
            }else{
                return false;
            }
        }
    }
    
    
    // UPDATE FUNCTIONS-------------------------------------------------------------
    function get_password($aID){
        $query = "select aPassword from accounts where aID = ? ";
        return $this->db->query($query,array($aID))->result_array();
    }

    function change_aPassword($new_password, $aID){
        $query = "Update accounts set aPassword = ?  where aID = ? ";
        return $this->db->query($query,array($new_password, $aID));  
           
    }

    function edit_accounts($account_id,$account_type,$account_username){
        $query = "update accounts set account_username = ?, account_type = ? where account_id = ?";
        return $this->db->query($query,array($account_username, $account_type, $account_id));
    // function change_aPassword($old_password,$new_password, $aID){

    //     $query2 = "select aPassword from accounts where aID = ? ";
    //     $current_password = $this->db->query($query2,array($aID));
    //         foreach($current_password->result() AS $row) {

    //         if(password_verify($row->aPassword,$old_password)){
    //             $query = "update accounts set aPassword = ?  where aID = ? ";
    //             return $this->db->query($query,array($new_password, $aID));  
    //         }else{
                
    //             echo $old_password;
    //             echo "====";
    //             echo $row->aPassword;
                
    //             echo "there is a problem in model";
    //             // $data['aID'] = $aID;
    //             // $this->load->view('admin/changepassword', $data);
    //         }
    //     }
    // }

    function edit_accounts($aID,$aType,$aUsername){
        $query = "update accounts set aUsername = ?, aType = ? where aID = ?";
        return $this->db->query($query,array($aUsername, $aType, $aID));
    }
    function edit_menuspoilage($s_id,$mID,$s_type,$s_date,$date_recorded,$remarks){
        $query = "update spoilage set s_type = ?, s_date = ?, date_recorded = ?, remarks=? where s_id=?";
        if($this->db->query($query,array($stype,$s_date,$date_recorded,$remarks,$s_id))){
            $query = "Update menuspoil set mID = ? where s_id = ?";
            return $this->db->query($query,array($mID,$s_id));
        }else{
            return false;
        }
    }
    function edit_stockspoilage($s_id,$stID,$s_type,$s_date,$date_recorded,$remarks){
        $query = "update spoilage set s_type = ?, s_date = ?, date_recorded = ?, remarks=? where s_id=?";
        if($this->db->query($query,array($stype,$s_date,$date_recorded,$remarks,$s_id))){
            $query = "Update stockspoil set stID = ? where s_id = ?";
            return $this->db->query($query,array($stID,$s_id));
        }else{
            return false;
        }
    }
    function edit_aospoilage($s_id,$ao_id,$s_type,$s_date,$date_recorded,$remarks){
        $query = "update spoilage set s_type = ?, s_date = ?, date_recorded = ?, remarks=? where s_id=?";
        if($this->db->query($query,array($stype,$s_date,$date_recorded,$remarks,$s_id))){
            $query = "Update ao_spoil set ao_id = ? where s_id = ?";
            return $this->db->query($query,array($ao_id,$s_id));
        }else{
            return false;
        }
    }
    function edit_menucategory($ctID,$ctName){
        $query = "update categories set ctName = ?  where ctID = ? and ctType='menu'";
        return $this->db->query($query,array($ctName,$ctID));
    }
    function edit_stockcategory($ctID,$ctName){
        $query = "update categories set ctName = ?  where ctID = ? and ctType='inventory'";
        return $this->db->query($query,array($ctName,$ctID));
    }
    function edit_stockItem($stockID,$stockName,$stockQty,$stockUnit,$stockMin,$stockStatus,$ctID){
        $query = "Update stockitems set stock_name = ?, stock_quantity = ?, stock_unit = ?, stock_minimum = ?, stock_status = ?, ctID = ? where stID=?;";
        return $this->db->query($query,array($stockName,$stockQty,$stockUnit,$stockMin,$stockStatus,$ctID,$stockID));
    }
    function edit_stockqty($stID, $stock_quantity){
        $query = "Update stockitems set stock_quantity = ? where stID= ?;";
        return $this->db->query($query,array($stock_quantity, $stID));
    }
    function edit_transaction($trans_id, $receiptNo, $transDate, $source, $remarks, $total, $dateRecorded, $transItems){
        $query = "Delete from transitems where trans_id = ?";
        $this->db->query($query, array($trans_id));
        $query = "Update transactions set source_id = ?, receipt_no = ?, total = ?, trans_date = ?, date_recorded = ?, remarks = ? where trans_id = ?";
        $bool = $this->db->query($query, array($source, $receiptNo, $total, $transDate, $dateRecorded, $remarks, $trans_id));
            //transitems array includes previous name and new name
        if($transItems != NULL){
            $query = "Insert into transitems (trans_id, item_name, item_qty, item_unit, item_price, subtotal)  values (?, ?, ?, ?, ?, ?)";
            foreach($transItems as $transItem){
                $this->db->query($query, array($trans_id, $transItem['itemName'], $transItem['itemQty'], $transItem['itemUnit'], $transItem['imTemprice'], $transItem['subtotal']));
            }
        }
        return true;
        // return $bool;
    }


    //SELECT FUNCTIONS------------------------------------------------------------------
    
    function get_accounts(){
        $query = "Select * from accounts";
        return $this->db->query($query)->result_array();
    }
    function get_discounts() {
        $query = "SELECT *, CONCAT(mn.mName,' ',pref.prName) AS menu_item  FROM promoconstraint pc 
        INNER JOIN preferences pref USING (prID) 
        INNER JOIN menu mn USING (mID) 
        INNER JOIN discounts USING (pmID) 
        INNER JOIN menudiscount USING (pmID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_freebies() {
        $query = "SELECT *, CONCAT(mn.mName,' ',pref.prName) AS menu_item, CONCAT(me.mName,' ',pr.prName) AS menu_freebie 
        FROM promoconstraint pc 
        INNER JOIN preferences pref USING (prID) 
        INNER JOIN menu mn USING (mID) 
        INNER JOIN freebies USING (pmID) 
        INNER JOIN menufreebie mf USING (pmID) 
        INNER JOIN preferences pr ON mf.prID = pr.prID 
        INNER JOIN menu me ON pr.mID = me.mID";
        return $this->db->query($query)->result_array(); 
    }
    function get_menu_items() {
        $query = "SELECT CONCAT(mn.mName,' ',pref.prName) 
        AS pref_menu, pref.mTemp, pref.prID 
        FROM menu mn INNER JOIN preferences pref USING (mID)";
        return $this->db->query($query)->result_array();
    }
    function get_menuItems() {
        $query = "SELECT pr.prID, CONCAT(mn.mName,' ',pr.prName) AS menu_item 
        FROM preferences pr INNER JOIN menu mn USING (mID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_promos() {
        $query = "SELECT * FROM promos";
        return $this->db->query($query)->result_array(); 
    }
    function get_promoconst() {
        $query = "SELECT pc.pmID, pc.pc_type, pc.pcQty, pref.prID, mn.mName, pref.prName,
        CONCAT(mn.mName,' ',pref.prName) AS menu_item
        FROM promoconstraint pc INNER JOIN preferences pref USING (prID) INNER JOIN menu mn USING (mID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_inventory(){
        $query = "Select stID, stock_name, stock_quantity, stock_unit, stock_minimum, stock_status, ctName from stockitems inner join categories using (ctID)";
        return $this->db->query($query)->result_array();
    }
    function get_logs(){
        $query = "Select * from log inner join stockitems using (stID)";
        return $this->db->query($query)->result_array();
    }
    function get_menu(){
<<<<<<< HEAD
        $query = "Select * from menu inner join categories using (category_id) order by category_name asc, mName asc";
=======
        $query = "Select * from menu inner join categories using (ctID) order by ctName asc, menu_name asc";
>>>>>>> 4c2b0d935debb08d87d96098e05255d1b791d665
        return $this->db->query($query)->result_array();
    }
    function get_preferences(){
        $query = "SELECT * from preferences";
        return $this->db->query($query)->result_array();
    }
    function get_addons2(){
        $query = "SELECT * from itemadd inner join addons using (ao_id)";
        return $this->db->query($query)->result_array();
    }
    //for spoilage
    function get_menu2(){
        $query = "Select * from menu";
        return $this->db->query($query)->result_array();
    }
    function get_menuprices(){
        $query = "select mID, prName, prPrice from sizes";
        return $this->db->query($query)->result_array();
    }
    function get_menucategories(){
<<<<<<< HEAD
        $query = "Select category_id, category_name, category_type, COUNT(mID) as menu_no from categories left join menu using (category_id) where category_type = 'menu' group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_menumaincategories(){
        $query = "Select category_id, category_name, category_type, COUNT(mID) as menu_no from categories left join menu using (category_id) where category_type = 'menu' and supcat_id is null group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_menusubcategories(){
        $query = "Select category_id, category_name, category_type, COUNT(mID) as menu_no from categories left join menu using (category_id) where category_type = 'menu' and supcat_id is not null group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }

    function add_menu($mName, $menu_description, $category_id, $menu_price, $picture){
        $query = "Insert into menu (mID, mName, menu_description, category_id, menu_price, menu_image, size, menu_availability) values (NULL,?,?,?,?,?, NULL,'Available')";
        return $this->db->query($query,array($mName, $menu_description, $category_id, $menu_price, $picture));
=======
        $query = "Select ctID, ctName, ctType, COUNT(menu_id) as menu_no from categories left join menu using (ctID) where ctType = 'menu' group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_menumaincategories(){
        $query = "Select ctID, ctName, ctType, COUNT(menu_id) as menu_no from categories left join menu using (ctID) where ctType = 'menu' and supcatID is null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_menusubcategories(){
        $query = "Select ctID, ctName, ctType, COUNT(menu_id) as menu_no from categories left join menu using (ctID) where ctType = 'menu' and supcatID is not null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }

    function add_menu($menu_name, $menu_description, $ctID, $menu_price, $picture){
        $query = "Insert into menu (menu_id, menu_name, menu_description, ctID, menu_price, menu_image, size, menu_availability) values (NULL,?,?,?,?,?, NULL,'Available')";
        return $this->db->query($query,array($menu_name, $menu_description, $ctID, $menu_price, $picture));
>>>>>>> 4c2b0d935debb08d87d96098e05255d1b791d665

    }
    function get_sales(){
        $query = "Select order_id, order_date_time, order_payable, pay_date_time, date_recorded, mName, order_qty, order_total from orderslip inner join orderlist using (order_id) inner join menu using (mID) where payment_status = 'paid';";
        return $this->db->query($query)->result_array();
    }
    function get_stocks(){
        $query = "SELECT 
            stID, stName, stStatus, stType, ctName, ctID
        FROM
            stockitems
                INNER JOIN
            categories USING (ctID);";
        return $this->db->query($query)->result_array();
    }
    function get_stockVariance(){
        $query = "SELECT 
            vID,
            CONCAT(stName,
                    ' ',
                    vUnit,
                    IF(vSize = NULL, '', CONCAT(' ', vSize))) AS vName,
            vUnit,
            vSize,
            vMin,
            vQty,
            bQty,
            vStatus
        FROM
            variance
                INNER JOIN
            stockitems USING (stID);";
        return $this->db->query($query)->result_array();
    }
    function get_stockExpiration(){
        $query = "SELECT 
            expID,
            CONCAT(stName,
                    ' ',
                    vUnit,
                    IF(vSize = NULL, '', CONCAT(' ', vSize))) AS vName,
            expDate,
            expQty,
            expMaxTime
        FROM
            expiration
                INNER JOIN
            variance USING (vID)
                INNER JOIN
            stockitems USING (stID);";
        return $this->db->query($query)->result_array();
    }
    function get_addons(){
        $query = "Select * from addons";
        return $this->db->query($query)->result_array();
    }
    function get_stockCategories(){
        $query = "Select ctID, ctName, ctType, COUNT(stID) as stockCount from categories left join stockitems using (ctID) where ctType = 'inventory' group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_stockMainCategories(){
        $query = "Select ctID, ctName, ctType, COUNT(stID) as stockCount from categories left join stockitems using (ctID) where ctType = 'inventory' and supcatID is null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_stockSubcategories(){
        $query = "Select ctID, ctName, ctType, COUNT(stID) as stockCount from categories left join stockitems using (ctID) where ctType = 'inventory' and supcatID is not null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_sources(){
        $query = "Select * from supplier order by spName";
        return $this->db->query($query)->result_array();
    }
    function get_spoilages(){
<<<<<<< HEAD
        $query = "select s_id, s_type, mName AS description, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN menuspoil USING (s_id) inner JOIN menu USING (mID) UNION select s_id, s_type, stock_name AS decription, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN stockspoil USING (s_id) inner JOIN stockitems USING (stock_id) UNION select s_id,s_type, ao_name AS description, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN ao_spoil USING (s_id) inner JOIN addons USING (ao_id) ORDER BY date_recorded";
=======
        $query = "select s_id, s_type, menu_name AS description, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN menuspoil USING (s_id) inner JOIN menu USING (menu_id) UNION select s_id, s_type, stock_name AS decription, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN stockspoil USING (s_id) inner JOIN stockitems USING (stID) UNION select s_id,s_type, ao_name AS description, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN ao_spoil USING (s_id) inner JOIN addons USING (ao_id) ORDER BY date_recorded";
>>>>>>> 4c2b0d935debb08d87d96098e05255d1b791d665
        return $this->db->query($query)->result_array();
    }
    function get_spoilagesmenu(){
        $query = "Select s_id, mName , s_qty, s_date, date_recorded, remarks from spoilage inner join menuspoil using (s_id) inner join menu using (mID)";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilagesstock(){
        $query = "Select ssID,stName,ssQty,vUnit,ssDate,ssDateRecorded,ssRemarks from stockspoil inner join varspoilitems using (ssID) inner join variance using (vID) inner join stockitems using (stID)";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilagesaddons(){
        $query = "Select s_id, ao_name,s_qty, ao_category,s_date, date_recorded, remarks from spoilage INNER JOIN ao_spoil using (s_id)INNER JOIN addons using (ao_id)";
        return  $this->db->query($query)->result_array();
    }
    function get_tables(){
        $query = "Select * from tables";
        return $this->db->query($query)->result_array();
    }
    function get_transactions(){
        $query = "Select trans_id, receipt_no, source_id, source_name, total, trans_date, date_recorded, remarks from transactions left join sources using (source_id) order by trans_id desc";
        return $this->db->query($query)->result_array();
    }
    function get_transitems(){
        $query = "Select trans_id, stock_name, item_qty, item_unit, item_price, subtotal from transitems natural join variance natural join stockitems";
        return $this->db->query($query)->result_array();
    }
    function get_inventorystock() {
        $query = "SELECT * FROM stockitems INNER JOIN categories USING (ctID);";
        return $this->db->query($query)->result_array();
    }

    function get_samplemethod($id){
        $query = "Select trans_id, item_name, item_qty, item_unit, item_price, item_qty*item_price as total_price from transitems where trans_id=?";
        return $this->db->query($query, array($id))->result_array();
    }

    function get_actlogs() {
        $query = "select * FROM activity_logs al INNER JOIN accounts ac USING (aID)";
        return $this->db->query($query)->result_array();
    }

//DELETE FUNCTIONS---------------------------------------------------------------------------
    function delete_account($accountId){
        $query = "Delete from accounts where aID = ?";
        return $this->db->query($query, array($accountId));
    }
    function delete_menucategory($ctID){
        $query = "delete from categories where ctID = ? and ctType= 'menu'";
        return $this->db->query($query,array($ctID));
    }
    function delete_spoilages(){
        $s_id=$this->input->post('s_id');
        $this->db->where('s_id', $s_id);
        $result = $this->db->delete('spoilage');
        return $result;
    }
    function delete_stockcategory($ctID){
        $query = "delete from categories where ctID = ? and ctType= 'inventory'";
        return $this->db->query($query,array($ctID));
    }
    function delete_stockitem($stID){
        $query = "Delete from stockitems where stID=?;";
        return $this->db->query($query, array($stID));
    }
    function delete_table($tableCode){
        $query = "Delete from tables where table_code= ?";
        return $this->db->query($query, array($tableCode));
    }
    function delete_transaction($trans_id){
        $query = "Delete from transactions where trans_id=?";
        return $this->db->query($query, array($trans_id));
    }
    function delete_transitem($trans_id, $item_name){
        $query = "Delete from transitems where trans_id=? and item_name=?";
        return $this->db->query($query, array($trans_id, $item_name));
    }
    function add_source($data){
        $this->db->insert("sources", $data);
    }
    function edit_source($source_id, $source_name, $contact_num, $email,$status){
        $query = "update sources set source_name = ?, contact_num = ?, email = ?, status = ?  where source_id = ?";
        return $this->db->query($query,array($source_name, $contact_num, $email,$status,$source_id));
    }
    function delete_source($source_id){
        $query = "Delete from sources where source_id = ?";
        return $this->db->query($query, array($source_id));
    }

    function delete_menu($id){
        $this->db->where("mID", $id);
        $this->db->delete("menu");
    }
<<<<<<< HEAD
    function edit_menu($mID, $mName, $category_id, $menu_description, $menu_price, $menu_availability){
        $query = "update menu set mName = ?, category_id = ?, menu_description = ?, menu_price = ?, menu_availability = ? where mID = ?";
        return $this->db->query($query,array($mName, $category_id, $menu_description, $menu_price, $menu_availability, $mID));
=======
    function edit_menu($menu_id, $menu_name, $ctID, $menu_description, $menu_price, $menu_availability){
        $query = "update menu set menu_name = ?, ctID = ?, menu_description = ?, menu_price = ?, menu_availability = ? where menu_id = ?";
        return $this->db->query($query,array($menu_name, $ctID, $menu_description, $menu_price, $menu_availability, $menu_id));
>>>>>>> 4c2b0d935debb08d87d96098e05255d1b791d665
    }
    
    function edit_table($newTableCode, $previousTableCode){
        $query = "Update tables set table_code = ? where table_code = ?;";
        return $this->db->query($query, array($newTableCode, $previousTableCode));
    }
    //Return Function
    function get_returns(){
        $query = "SELECT returns.return_id, returns.trans_id, returns.stID, returns.return_qty, returns.remarks, returns.date_recorded, transactions.receipt_no, transactions.trans_date,
        stockitems.stock_name, stockitems.stock_unit FROM transactions inner join returns on transactions.trans_id = returns.trans_id inner join stockitems on returns.stID = stockitems.stID";
        return $this->db->query($query)->result_array();
    }
    function add_returns($trans, $stock, $quantity,  $now){
        $stocks= "Select stock_quantity from stockitems where stID='$stock'";
        $stocks = $this->db->query($stocks)->result_array();
        foreach($stocks as $stck){
            $stck = $stck['stock_quantity'];
        }
        $stck_qty = $stck - $quantity;
        $query2 = "Update stockitems set stock_quantity = ? where stID = ?";
        $this->db->query($query2, array( $stck_qty, $stock));

        $query1 = "Insert into returns(trans_id, stID, return_qty, date_recorded) values (?,?,?,?)";
        return $this->db->query($query1, array( $trans, $stock, $quantity,  $now));
        
    }

}
?>
