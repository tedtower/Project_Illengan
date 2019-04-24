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
    function add_stockspoil($s_type,$stName,$s_qty,$s_date,$date_recorded,$remarks){
        $query1 = "select stID from `stockitems` where stName = ? ";
        $stID = $this->db->query($query1,array($stName));
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
            $query  = "insert into spoilage (s_id, s_type, s_qty, s_date, date_recorded, remarks) values (NULL,?,?,?,?,?)";
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
    function add_stockItem($stockName,$stockType,$stockCategory,$stockStatus,$stockVariance){
        $query = "Insert into stockitems (stID,stName,stType,ctID,stStatus) values (NULL,?,?,?,?)";
        if($this->db->query($query,array($stockName,$stockType,$stockCategory,$stockStatus))){
            $this->add_stockVariances($this->db->insert_id(), $stockVariance);
        }
        return true;
    }
    function add_stockVariances($stockID,$stockVariance){
        $query = "Insert into variance (stID, vUnit, vQty, vMin, vSize, vStatus, bQty) values (?,?,?,?,?,?,?)";
        if(count($stockVariance) > 0){
            for($index = 0; $index < count($stockVariance) ; $index++){
                $this->db->query($query, array($stockID, $stockVariance[$index]['varUnit'],$stockVariance[$index]['varQty'],$stockVariance[$index]['varMin'],$stockVariance[$index]['varSize'],$stockVariance[$index]['varStatus'],0));
            }
        }
    }
    function add_stockVariance($stockID,$stockVariance){
        $query = "Insert into variance (stID, vUnit, vQty, vMin, vSize, vStatus, bQty) values (?,?,?,?,?,?,?)";
        return $this->db->query($query, array($stockID, $stockVariance['varUnit'],$stockVariance['varQty'],$stockVariance['varMin'],$stockVariance['varSize'],$stockVariance['varStatus'],0));
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
    function add_promo($pmName, $pmStartDate, $pmEndDate, $fbName, $isElective, $prID, $pcType, $pcQty, $prIDfb, $fbQty){
        $query = "insert into promos (pmID, pmName, pmStartDate, pmEndDate) values (NULL,?,?,?)";
        if($this->db->query($query,array($pmName, $pmStartDate, $pmEndDate))) {
            $query = "insert into freebies (pmID, fbName, isElective) values (?,?,?)";
            $poID = $this->db->insert_id();
            if($this->db->query($query,array($this->db->insert_id(), $fbName, $isElective))) {
                $query = "insert into promoconstraint (pmID, prID, pcType, pcQty) values (?,?,?,?)";
                if($this->db->query($query,array($poID, $prID, $pcType, $pcQty))) {
                    $query1 = "select pmID from promos where pmName = ? ";
                    $pmID2 = $this->db->query($query1,array($pmName));
                    $query = "insert into menufreebie (pmID, prID, fbQty) values (?,?,?)";
                    return $this->db->query($query,array($pmID2, $prIDfb, $fbQty));
                }
            }
        }
    }
    function add_supplier($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spMerch){
        $query = "insert into supplier (spName, spContactNum, spEmail, spStatus, spAddress) values (?,?,?,?,?);";
        if($this->db->query($query,array($spName, $spContactNum, $spEmail, $spStatus, $spAddress))){
            if(count($spMerch) > 0){
                foreach ($spMerch as $merch) {
                    $this->add_supplierMerchandise($merch);
                }
            }
            return true;            
        }
        return false;
    }
    function add_supplierMerchandise($merch){
        $query = "insert into suppliermerchandise (vID, spID, spmDesc, spmUnit, spmPrice) values (?,?,?,?,?);";
        $this->db->query($query,array($merch['varID'],$merch['suppID'],$merch['merchDesc'],$merch['merchUnit'],$merch['merchPrice']));
    }
    function edit_supplier($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spMerch, $spID){
        $query = "UPDATE supplier 
            SET 
                spName = ?,
                spContactNum = ?,
                spEmail = ?,
                spStatus = ?,
                spAddress = ?
            WHERE
                spID = ?;";
        if($this->db->query($query, array($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spID))){
            foreach($spMerch as $merch){
                if($merch[merchID] == NULL){
                    $this->add_supplierMerchandise($merch);
                }else{
                    $this->edit_supplierMerchandise($merch,$spID);
                }
            }
            return true;
        }
        return false;
    }
    
    function edit_supplierMerchandise($merch, $spID){
        $query = "UPDATE suppliermerchandise 
            SET 
                vID = ?,
                spID = ?,
                spmDesc = ?,
                spmUnit = ?,
                spmPrice = ?
            WHERE
                spmID = ?;";
        $this->db->query($query,array($merch['varID'],$spID,$merch['merchDesc'],$merch['merchUnit'],$merch['merchPrice'], $merch['merchID']));
    }   
    
    function add_purchaseOrder(){
        $query = "insert into purchaseorder (spID, poDate, edDate, poTotal, poDateRecorded, poRemarks, poStatus) values (?,?,?,?,?,?,?)";
        if($this->db->query($query, array())){
            return true;
        }
        return false;
    }

    function add_poItem(){
        $query = "insert into poitems (vID, poID, poiQTY, poiUnit, poiPrice, poiStatus) values (?,?,?,?,?,?);";
        $this->db->query($query, array());
    }

    function edit_purchaseOrder(){
        $query = "UPDATE purchaseorder 
            SET 
                spID = ?,
                poDate = ?,
                edDate = ?,
                poTotal = ?,
                poDateRecorded = ?,
                poRemarks = ?,
                poStatus = ?
            WHERE
                poID = ?;";
        if($this->db->query($query, array())){
            foreach($poItems as $item){

            }
            return true;
        }
        return false;
    }

    function edit_poItem($spmID, $spID, $poItem){
        $query = "";
        $this->db->query($query, array());
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
    function edit_stockItem($stockID,$stockName,$stockType,$stockCategory,$stockStatus,$stockVariance){
        $query = "UPDATE stockitems 
            SET 
                stName = ?,
                stType = ?,
                ctID = ?,
                stStatus = ?
            WHERE
                stID = ?;";
        if($this->db->query($query,array($stockName,$stockType,$stockCategory,$stockStatus,$stockID))){
            if(count($stockVariance) > 0){
                foreach($stockVariance as $variance){
                    if($variance['varID'] == NULL){
                        $this->add_stockVariance($stockID, $variance);
                    }else{
                        $this->edit_stockVariance($variance);
                    }
                }
            }
            return true;
        }
        return false;
    }
    function edit_stockVariance($variance){
        $query = "UPDATE variance 
            SET 
                vUnit = ?,
                vSize = ?,
                vMin = ?,
                vQty = ?,
                vStatus = ?
            WHERE
                vID = ?;";
        return $this->db->query($query, array($variance['varUnit'],$variance['varSize'],$variance['varMin'],$variance['varQty'],$variance['varStatus'],$variance['varID']));
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
        $query = "Select stID, stName, stock_quantity, stock_unit, stock_minimum, stock_status, ctName from stockitems inner join categories using (ctID)";
        return $this->db->query($query)->result_array();
    }
    function get_logs(){
        $query = "Select * from log inner join stockitems using (stID)";
        return $this->db->query($query)->result_array();
    }
    function get_menu(){
        $query = "Select * from menu inner join categories using (ctID) order by ctName asc, menu_name asc";
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

    }
    function get_sales(){
        $query = "Select order_id, order_date_time, order_payable, pay_date_time, date_recorded, mName, order_qty, order_total from orderslip inner join orderlist using (order_id) inner join menu using (mID) where payment_status = 'paid';";
        return $this->db->query($query)->result_array();
    }
    function get_stocks(){
        $query = "SELECT 
            stID,
            stName,
            IF(SUM(vQty) IS NULL, 0, SUM(vQty)) AS 'stQty',
            stStatus,
            stType,
            ctName,
            ctID
        FROM
            stockitems
                LEFT JOIN
            variance USING (stID)
                INNER JOIN
            categories USING (ctID)
        GROUP BY stID;";
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
            vStatus, 
            stID
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
    function get_purchOrders() {
        $query ="Select * FROM purchaseorder INNER JOIN supplier USING (spID)";
        return $this->db->query($query)->result_array();
    }
    function get_poItemVariance() {
        $query ="SELECT *, CONCAT(st.stName,' ',var.vUnit,' ',var.vSize) AS poItem FROM poitems po INNER JOIN variance var USING (vID) INNER JOIN stockitems st USING (stID)";
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
        $query = "SELECT 
            ctID, ctName, ctType, COUNT(stID) AS stockCount
        FROM
            categories
                LEFT JOIN
            stockitems USING (ctID)
        WHERE
            ctType = 'inventory'
                AND supcatID IS NOT NULL
        GROUP BY ctID
        ORDER BY ctName ASC;";
        return $this->db->query($query)->result_array();
    }
    function get_supplier(){
        $query = "Select * from supplier order by spName";
        return $this->db->query($query)->result_array();
    }
    function get_suppliermerch(){
        $query = "Select * from suppliermerchandise";
        return $this->db->query($query)->result_array();
    }
    function get_suppMerchandise(){
        $query = "Select * from suppliermerchandise INNER JOIN supplier USING (spID) INNER JOIN variance USING (vID) INNER JOIN stockitems USING (stID)";
        return $this->db->query($query)->result_array();
    }
    function get_spoilages(){
        $query = "select s_id, s_type, menu_name AS description, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN menuspoil USING (s_id) inner JOIN menu USING (menu_id) UNION select s_id, s_type, stName AS decription, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN stockspoil USING (s_id) inner JOIN stockitems USING (stID) UNION select s_id,s_type, ao_name AS description, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN ao_spoil USING (s_id) inner JOIN addons USING (ao_id) ORDER BY date_recorded";
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
        $query = "Select trans_id, stName, item_qty, item_unit, item_price, subtotal from transitems natural join variance natural join stockitems";
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
    function edit_menu($menu_id, $menu_name, $ctID, $menu_description, $menu_price, $menu_availability){
        $query = "update menu set menu_name = ?, ctID = ?, menu_description = ?, menu_price = ?, menu_availability = ? where menu_id = ?";
        return $this->db->query($query,array($menu_name, $ctID, $menu_description, $menu_price, $menu_availability, $menu_id));
    }
    
    function edit_table($newTableCode, $previousTableCode){
        $query = "Update tables set table_code = ? where table_code = ?;";
        return $this->db->query($query, array($newTableCode, $previousTableCode));
    }
    //Return Function
    function get_returns(){
        $query = "SELECT returns.return_id, returns.trans_id, returns.stID, returns.return_qty, returns.remarks, returns.date_recorded, transactions.receipt_no, transactions.trans_date,
        stockitems.stName, stockitems.stock_unit FROM transactions inner join returns on transactions.trans_id = returns.trans_id inner join stockitems on returns.stID = stockitems.stID";
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
