<?php
class Adminmodel extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

    //INSERT FUNCTIONS----------------------------------------------------------------
    function add_accounts($data){
        $this->db->insert('accounts',$data);
    }
    function add_aospoil($date_recorded,$addons){
        $query = "insert into aospoil (aosID,aosDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_spoiledaddon($this->db->insert_id(),$addons);
            return true;
        }
    }
    function add_spoiledaddon($aosID,$addons){
        $query = "insert into addonspoil (aosID,aoID,aosQty,aosDate,aosRemarks) values (?,?,?,?,?)";
        if(count($addons) > 0){
            for($in = 0; $in < count($addons) ; $in++){
                $this->db->query($query, array($aosID, $addons[$in]['aoID'], $addons[$in]['aosQty'],
                $addons[$in]['aosDate'],$addons[$in]['aosRemarks']));
            }    
        }
    }
    function add_menuspoil($date_recorded,$menu){
        $query = "insert into menuspoil (msID,msDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_spoiledmenu($this->db->insert_id(),$menu);
            return true;
        }
    }
    function add_spoiledmenu($msID,$menus){
        $query = "insert into spoiledmenu (msID,prID,msQty,msDate,msRemarks) values (?,?,?,?,?)";
        if(count($menus) > 0){
            for($in = 0; $in < count($menus) ; $in++){
                $this->db->query($query, array($msID, $menus[$in]['prID'], $menus[$in]['msQty'],$menus[$in]['msDate'],$menus[$in]['msRemarks']));
            }    
        }
    }
    function add_stockspoil($date_recorded,$stocks){
        $query = "insert into stockspoil (ssID,ssDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_varspoilitems($this->db->insert_id(),$stocks);
            return true;
        }
    }
    function add_varspoilitems($ssID,$stocks){
        $query = "insert into varspoilitems (ssID,vID,ssQty,ssDate,ssRemarks) values (?,?,?,?,?)";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                   $this->db->query($query, array($ssID, $stocks[$in]['vID'], $stocks[$in]['ssQty'], $stocks[$in]['ssDate'],$stocks[$in]['ssRemarks']));  
                   $this->destockvarItems($stocks[$in]['vID'],$stocks[$in]['curQty'],$stocks[$in]['ssQty']);    
                }    
            }
    }
    function destockvarItems($vID,$curQty,$ssQty){
        $query = "UPDATE variance 
        SET 
            vQty = ? - ?
        WHERE
            vID = ?;";
        return $this->db->query($query,array($curQty,$ssQty,$vID));
    }
    function add_menucategory($ctName){
        $query = "Insert into categories (ctName, ctType) values (?,'menu')";
        return $this->db->query($query,array($ctName));
    }
    function add_submenucategory($ctName, $supcatID){
        $query = "Insert into categories (ctName, supcatID, ctType) values (?,?,'menu')";
        return $this->db->query($query,array($ctName,$supcatID));
    }
    function add_stockcategory($ctName){
        $query = "Insert into categories (ctName,ctType) values (?,'inventory')";
        return $this->db->query($query,array($ctName));
    }
    function add_substockcategory($ctName, $supcatID){
        $query = "Insert into categories (ctName, supcatID, ctType) values (?,?,'inventory')";
        return $this->db->query($query,array($ctName,$supcatID));
    }
    function add_stockItem($stockName,$stockType,$stockCategory,$stockStatus,$stockVariance){
        $query = "Insert into stockitems (stID,stName,stType,ctID,stStatus) values (NULL,?,?,?,?)";
        if($this->db->query($query,array($stockName,$stockType,$stockCategory,$stockStatus))){
            $this->add_stockVariances($this->db->insert_id(), $stockVariance);
            return true;
        }
        return false;
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
            $spID = $this->db->insert_id();
            if(count($spMerch) > 0){
                foreach ($spMerch as $merch) {
                    $this->add_supplierMerchandise($merch, $spID);
                }
            }
            return true;            
        }
        return false;
    }

    function add_supplierMerchandise($merch, $id) {
        $query = "insert into suppliermerchandise (vID, spID, spmDesc, spmUnit, spmPrice) values (?,?,?,?,?);";
        $this->db->query($query,array($merch['varID'],$id,$merch['merchName'],$merch['merchUnit'],$merch['merchPrice']));
    }

    function add_menu($image, $mName, $mDesc, $category, $status, $preference, $addon){
        $query = "INSERT into menu (mImage, mName, mDesc, ctID, mAvailability) values (?,?,?,?,?);";
        if($this->db->query($query,array($image, $mName, $mDesc, $category, $status))){
            $this->add_preference($this->db->insert_id(), $preference);
            $this->add_addon($this->db->insert_id(), $addon);
            return true;
        }
    }

    function add_preference($mID, $preference){
       $query = "INSERT into preferences (mID, prName, mTemp, prPrice, prStatus) values (?,?,?,?,?)";
       if(count($preference) > 0){
           for($n = 0; $n < count(preference) ; $n++){
               $this->db->query($query, array($mID, $preference[$n]['prName'], $preference[$n]['mTemp'], $preference[$n]['prPrice'], $preference[$n]['prStatus']));
           }
       } else{
           return false;
       }
    }
    function add_addon($mID, $addon){
        $query = "INSERT into menuaddons (mID, aoID) values (?,?)";
        if(count($addon) > 0){
            for($n = 0; $n < count(addon) ; $n++){
                $this->db->query($query, array($mID, $addon[$n]['aoID']));
            }
        } else{
            return false;
        }
     }

    function add_PurchaseOrder($poDate,$edDate,$poTotal,$poDateRecorded,$poStatus, $poRemarks, $spID, $merchandise){
        $query = "insert into purchaseorder (poID, poDate, edDate, poTotal, poDateRecorded, poStatus, 
        poRemarks, spID) values (NULL,?,?,?,?,?,?,?);";
        if($this->db->query($query,array($poDate,$edDate,$poTotal,$poDateRecorded,$poStatus, $poRemarks, $spID))) {
            $this->add_poItems($this->db->insert_id(), $merchandise);
            return true;
            }
    }
    function add_poItems($poID, $merchandise) {
        $query = "insert into poitems (poiID, vID, poID, poiName, poiQty, poiUnit, poiPrice, poiStatus) values
        (NULL,?,?,?,?,?,?,?)";
        if(count($merchandise) > 0){
            for($in = 0; $in < count($merchandise) ; $in++){
                $this->db->query($query, array($merchandise[$in]['vID'], $poID, $merchandise[$in]['poiName'], $merchandise[$in]['poiQty'],
                $merchandise[$in]['poiUnit'],$merchandise[$in]['poiPrice'], $merchandise[$in]['poiStatus']));
            }
        } else {
            return false;
        }
   
    }
    
    function add_consumption($id,$cd,$rDate,$cnd){
        $query = "insert into consumption (cnID, cnDate, cnDateRecorded) values (?,?,?)";
        $this->db->query($query,array($id[0]['nextID'],$cd,$rDate));
        $cnID = $this->db->insert_id();
        foreach ($cnd as $ci) {
            $this->add_consumptionItems($id[0]['nextID'],$ci['varConsumed'],$ci['consumedQty'],$ci['remainingQty']);
            $this->destockVariance($ci['varConsumed'],$ci['remainingQty']);
        }
    }
    function add_consumptionItems($cnID,$vID,$cnQty,$rQty){
        $query = "insert into varconsumptionitems (cnID, vID, cnQty, remainingQty) values (?,?,?,?)";
        $this->db->query($query,array($cnID,$vID,$cnQty,$rQty));
    }
    function destockVariance($vID,$vQty){
        $query = "UPDATE variance 
            SET 
                vQty = ?
            WHERE
                vID = ?;";
        return $this->db->query($query,array($vQty,$vID));
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
            if(count($spMerch) > 0){
                foreach($spMerch as $merch){
                    if($merch['spmID'] == NULL){
                        $this->add_supplierMerchandise($merch, $spID);
                    }else{
                        $this->edit_supplierMerchandise($merch);
                    }
                }
            }
            return true;
        }
        return false;
    }
    
    function edit_supplierMerchandise($merch){
        $query = "UPDATE suppliermerchandise 
            SET 
                vID = ?,
                spmDesc = ?,
                spmUnit = ?,
                spmPrice = ?
            WHERE
                spmID = ?;";
        $this->db->query($query,array($merch['varID'],$merch['merchName'],$merch['merchUnit'],$merch['merchPrice'], $merch['spmID']));
    }

    function add_poItem(){
        $query = "insert into poitems (vID, poID, poiQTY, poiUnit, poiPrice, poiStatus) values (?,?,?,?,?,?);";
        $this->db->query($query, array());
    }

    function edit_purchaseOrder($poDate, $edDate, $poTotal, $poDateRecorded, $poStatus, 
    $poRemarks, $spID, $poID, $merchandise){
        $query = "UPDATE purchaseorder po
            SET 
                spID = ?,
                poDate = ?,
                edDate = ?,
                poTotal = ?,
                poDateRecorded = ?,
                poStatus = ?,
                poRemarks = ?
            WHERE
                po.poID = ?;";
       if($this->db->query($query,array($spID,$poDate, $edDate, $poTotal,$poDateRecorded,$poStatus, $poRemarks, $poID))) {
        foreach($merchandise as $merch){
            if($merch['poiID'] == NULL){
                $this->add_poItems($poID, $merchandise);
            }else{
                $this->update_poItems($poID, $merchandise);
            }
        
           }
    }
}
    

    function update_poItems($poID, $merchandise) {
        $query = $query = "UPDATE poitems
        SET 
            vID = ?,
            poID = ?,
            poiName = ?,
            poiQty = ?,
            poiUnit = ?,
            poiPrice = ?,
            poiStatus = ?
        WHERE
            poiID = ?;";
        if(count($merchandise) > 0){
        for($in = 0; $in < count($merchandise) ; $in++){
            $this->db->query($query, array($merchandise[$in]['vID'], $poID, $merchandise[$in]['poiName'], $merchandise[$in]['poiQty'],
            $merchandise[$in]['poiUnit'],$merchandise[$in]['poiPrice'], $merchandise[$in]['poiStatus'],$merchandise[$in]['poiID']));

        }
    } 
   
    }
    function edit_poItem($spmID, $spID, $poItem){
        $query = "";
        $this->db->query($query, array());
    }
    // UPDATE FUNCTIONS-------------------------------------------------------------

    function change_aPassword($new_password, $aID){
        $query = "Update accounts set aPassword = ?  where aID = ? ";
        return $this->db->query($query,array($new_password, $aID));  
           
    }
    function edit_accounts($aID,$aType,$aUsername){
        $query = "update accounts set aUsername = ?, aType = ? where aID = ?";
        return $this->db->query($query,array($aUsername, $aType, $aID));
    }
    function edit_menuspoilage($msID,$prID,$msDate,$msRemarks,$date_recorded){
        $query = "Update menuspoil set msDateRecorded = ? where msID=?";
        if($this->db->query($query,array($date_recorded,$msID))){
            $query = "Update spoiledmenu set msDate = ?,msRemarks = ? where msID = ? AND prID = ?";
            return $this->db->query($query,array($msDate,$msRemarks,$msID,$prID));
        }else{
            return false;
        }
    }
    function edit_stockspoilage($ssID,$vID,$ssDate,$ssRemarks,$date_recorded){
        $query = "Update stockspoil set ssDateRecorded = ? where ssID=?";
        if($this->db->query($query,array($date_recorded,$ssID))){
            $query = "Update varspoilitems set ssDate = ?,ssRemarks = ? where ssID = ? AND vID = ?";
            return $this->db->query($query,array($ssDate,$ssRemarks,$ssID,$vID));
        }else{
            return false;
        }
    }
    function edit_aospoilage($aoID,$aosID,$aosDate,$aosRemarks,$date_recorded){
        $query = "Update aospoil set aosDateRecorded = ? where aosID=?";
        if($this->db->query($query,array($date_recorded,$aosID))){
            $query = "Update addonspoil set aosDate = ?,aosRemarks = ? where aoID = ?";
            return $this->db->query($query,array($aosDate,$aosRemarks,$aoID));
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
    }
    function get_stockDetails($id){
        $query = "SELECT 
            stID, stName, stStatus, stType, ctID
        FROM
            stockitems
        WHERE
            stID = ?;";
        return $this->db->query($query, array($id))->result_array();
    }
    function get_variances($id){
        $query = "SELECT 
            vID,
            vUnit,
            vSize,
            vMin,
            vQty,
            vStatus,
            stID
        FROM
            variance
                INNER JOIN
            stockitems USING (stID)
        WHERE
            stID = ?;";
        return $this->db->query($query, array($id))->result_array();
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
    function get_nextIDConsumption(){
        $query = "SELECT COUNT(cnID)+1 nextID FROM consumption;";
        return $this->db->query($query)->result_array();
    }
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
        $query = "Select * from menu inner join categories using (ctID) order by ctName asc, mName asc";
        return $this->db->query($query)->result_array();
    }
    function get_addons2(){
        $query = "SELECT * from menuaddons inner join addons using (aoID)";
        return $this->db->query($query)->result_array();
    }
    function get_preferences(){
        $query = "SELECT * from preferences";
        return $this->db->query($query)->result_array();
    }
    function get_prefDetails($prID){
        $query = "SELECT * from preferences pr INNER JOIN menu USING (mID) WHERE pr.prID = ?";
        return $this->db->query($query,array($prID))->result_array();
    }
    function get_orderAddon() {
        $query = "SELECT * FROM `orderaddons` INNER JOIN addons USING (aoID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_menuprices(){
        $query = "select mID, prName, prPrice from sizes";
        return $this->db->query($query)->result_array();
    }
    function get_menucategories(){
        $query = "Select ctID, ctName, ctType, COUNT(mID) as menu_no from categories left join menu using (ctID) where ctType = 'menu' group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_menumaincategories(){
        $query = "Select ctID, ctName, ctType, COUNT(mID) as menu_no from categories left join menu using (ctID) where ctType = 'menu' and supcatID is null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_menusubcategories(){
        $query = "Select ctID, ctName, ctType, COUNT(mID) as menu_no from categories left join menu using (ctID) where ctType = 'menu' and supcatID is not null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_maincat(){
        $query = "SELECT * from categories where supcatID is null AND ctType = 'menu' group by ctName order by ctName asc";
        return $this->db->query($query)->result_array();
    }

    function get_osSales(){
        $query = "Select * from orderslips where payStatus = 'paid';";
        return $this->db->query($query)->result_array();
    }
    function get_olSales(){
        $query = "Select * from orderlists inner join preferences using (prID) inner join menu using (mID)";
        return $this->db->query($query)->result_array();
    }
    function get_stocks(){
        $query = "SELECT stID, stName, var.vID, IF(SUM(vQty) IS NULL, 0, SUM(vQty)) AS 'stQty', 
        stStatus, stType, ctName, ctID FROM stockitems 
        LEFT JOIN variance var USING (stID) INNER JOIN categories USING (ctID) GROUP BY stID";
        return $this->db->query($query)->result_array();
    }
    function get_stockVariance(){
        $query = "SELECT 
            vID,
            stID,
            stName,
            CONCAT(stName,
                    ' ',
                    vUnit,
                    IF(vSize IS NULL, '', CONCAT(' ',vSize))) AS vName,
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
    function get_menuPref(){
        $query = "SELECT 
        prID, 
        mName,
        CONCAT(mName,
                   ' ',
                '(',prName,')',
                IF(mTemp IS NULL,' ', CONCAT(' ',mTemp))) as prName,
        prPrice,
        mAvailability 
    FROM 
        preferences 
                INNER JOIN 
        menu USING (mID)";
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
        $query = "Select aoID,aoName from addons";
        return $this->db->query($query)->result_array();
    }
    function get_menuaddons($mID) {
        $query = "SELECT * FROM menu mn INNER JOIN menuaddons ma USING (mid) INNER JOIN addons ao USING (aoID) 
        WHERE mn.mID = ? AND ao.aoStatus = 'available'";
         return $this->db->query($query, array($mID))->result_array();
    }
    function get_purchOrders() {
        $query ="Select * FROM purchaseorder INNER JOIN supplier USING (spID)";
        return $this->db->query($query)->result_array();
    }
    function get_purchaseOrders($id){
        $query = "SELECT 
            poID,
            poDate,
            edDate,
            poTotal,
            poDateRecorded,
            poRemarks,
            poStatus,
            spName,
            spID
        FROM
            purchaseorder
                INNER JOIN
            supplier USING (spID)
        WHERE
            spID = ? AND NOT poStatus = 'delivered';";
        return $this->db->query($query, array($id))->result_array();
    }
    function get_poItems($id){
        $query = "SELECT 
            *
        FROM
            poItems
        WHERE
            poID IN (SELECT 
                    poID
                FROM
                    purchaseorder
                WHERE
                    spID = ? AND NOT poStatus = 'delivered');";
        return $this->db->query($query, array($id))->result_array();
    }
    function get_poItemVariance() {
        $query ="SELECT *, CONCAT(st.stName,' ',var.vUnit,' ',var.vSize) AS poItem, CONCAT(po.poiName,': ',st.stName) AS branditem FROM poitems po 
        INNER JOIN variance var USING (vID) INNER JOIN stockitems st USING (stID)";
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
    function get_maincatStock(){
        $query = "SELECT * from categories where supcatID is null AND ctType = 'inventory' group by ctName order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_supplier(){
        $query = "Select * from supplier order by spName";
        return $this->db->query($query)->result_array();
    }
    function get_suppliermerch(){
        $query = "SELECT *, CONCAT(spmDesc,' ',stName,' ',vUnit,' ','(',vSize,')') as merchandise, CONCAT(stName,' ',vUnit,' ','(',vSize,')') as stockvariance  from supplier natural join suppliermerchandise natural join variance natural join stockitems";
        return $this->db->query($query)->result_array();
    }
    function get_suppMerchandise($spmID){
        $query = "Select *, CONCAT(spm.spmDesc,' :',st.stName) as branditem from suppliermerchandise spm INNER JOIN supplier USING (spID) INNER JOIN variance 
        USING (vID) INNER JOIN stockitems st USING (stID) WHERE spm.spmID = ?";
        return $this->db->query($query, array($spmID))->result_array();
    }
    function get_spoilagesmenu(){
        $query = "Select msID,prID, mName,msQty,msDate,msDateRecorded,msRemarks from menuspoil inner join spoiledmenu using (msID) inner join preferences using (prID) inner join menu using (mID)";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilagesstock(){
        $query = "Select ssID,vID,CONCAT(stName,' ',vUnit, IF(vSize = NULL, '', CONCAT(' ', vSize))) AS vName,ssQty,vUnit,ssDate,ssDateRecorded,ssRemarks from stockspoil inner join varspoilitems using (ssID) inner join variance using (vID) inner join stockitems using (stID)";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilagesaddons(){
        $query = "Select aoID,aosID, aoName,aosQty, aoCategory,aosDate, aosDateRecorded, aosRemarks from addonspoil INNER JOIN aospoil using (aosID)INNER JOIN addons using (aoID)";
        return  $this->db->query($query)->result_array();
    }
    function get_tables(){
        $query = "Select * from tables";
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
    function get_consumption(){
       $query = "SELECT cnID, cnDate, cnDateRecorded, COUNT(stID) countItem FROM varconsumptionitems NATURAL JOIN consumption NATURAL JOIN variance NATURAL JOIN stockitems GROUP BY cnDate ORDER BY cnDate DESC";
       return $this->db->query($query)->result_array();
    }
    function get_consumptionItems(){
        $query = "SELECT stID, cnID, cnQty, remainingQty, stName, vUnit, vSize  FROM varconsumptionitems NATURAL JOIN consumption NATURAL JOIN variance NATURAL JOIN stockitems";
        return $this->db->query($query)->result_array();
    }
    function get_allTransactions(){
        $query = "SELECT 
            iID,
            spID,
            spName,
            iType,
            iNumber,
            iTotal,
            iRemarks,
            iDate,
            iDateRecorded,
            resolvedStatus
        FROM
            invoice
                INNER JOIN
            supplier USING (spID);";
        return $this->db->query($query)->result_array();
    }
    function get_purchaseTransactions(){
        $query = "SELECT 
            iID,
            spID,
            spName,
            iType,
            iNumber,
            iTotal,
            iRemarks,
            iDate,
            iDateRecorded,
            resolvedStatus
        FROM
            invoice
                INNER JOIN
            supplier USING (spID)
        WHERE
            iType = 'purchase';";
        return $this->db->query($query)->result_array();
    } 
    function get_deliveryTransactions(){
        $query = "SELECT 
            iID,
            spID,
            spName,
            iType,
            iNumber,
            iTotal,
            iRemarks,
            iDate,
            iDateRecorded,
            resolvedStatus
        FROM
            invoice
                INNER JOIN
            supplier USING (spID)
        WHERE
            iType = 'delivery';";
        return $this->db->query($query)->result_array();
    }
    function get_allTransactionsItems(){
        $query = "SELECT 
            iID, iName, iQty, iPrice, iUnit, iSubtotal
        FROM
            invoiceitems
                INNER JOIN
            (SELECT 
                iID
            FROM
                invoice) AS aInvoice USING (iID);";
        return $this->db->query($query)->result_array();
    }
    function get_purchaseTransactionsItems(){
        $query = "SELECT 
            iID, iName, iQty, iPrice, iUnit, iSubtotal
        FROM
            invoiceitems
                INNER JOIN
            (SELECT 
                iID
            FROM
                invoice
            WHERE
                iType = 'purchase') AS pInvoice USING (iID);";
        return $this->db->query($query)->result_array();
    }
    function get_deliveryTransactionsItems(){
        $query = "SELECT
            iID, iName, iQty, iPrice, iUnit, iSubtotal
        FROM
            invoiceitems
                INNER JOIN
            (SELECT 
                iID
            FROM
                invoice
            WHERE
                iType = 'delivery') AS dInvoice USING (iID);";
        return $this->db->query($query)->result_array();
    }
    function add_transaction($spID, $transType, $receiptNum, $transDate, $dateRecorded, $resStatus, $remarks, $total, $transitems, $transID=null){
        $query = "";
        $invoiceSuccess = false;
        if($transID == null){
            $query = "INSERT INTO invoice (spID, iDate, iDateRecorded, iNumber, iTotal, iRemarks, iType, resolvedStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
            $invoiceSuccess = $this->db->query($query, array($spID, $transDate, $dateRecorded, $receiptNum, $total, $remarks, $transType, $resStatus));
        }else{
            $query = "UPDATE invoice 
                SET 
                    spID = '',
                    iDate = '',
                    iDateRecorded = '',
                    iNumber = '',
                    iTotal = '',
                    iRemarks = '',
                    iType = '',
                    resolvedStatus = ''
                WHERE
                    transID = '';";
            $invoiceSuccess = $this->db->query($query, array($spID, $transDate, $dateRecorded, $receiptNumber, $total, $remarks, $transType, $resStatus, $transID));
        }
        $id = $this->db->insert_id();
        if($invoiceSuccess){
            $indexes = [];
            $count = 0;
            foreach($transitems as $item){
                if(!$this->addEdit_transactionItems($item, $id)){
                    array_push($indexes,$count);
                }
                $count++;
            }
            echo json_encode(array("erredQ" =>$indexes, "data"=> $transitems));
            return true;
        }
        return false;
    }
    function addEdit_transactionItems($item,$id){
        $query = "";
        if($item['itemID'] == null){
            $query = "INSERT INTO `invoiceitems`(
                `vID`,
                `iID`,
                `iName`,
                `iQty`,
                `iPrice`,
                `iUnit`,
                `iSubTotal`
            )
            VALUES(
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            );";
            $this->db->query($query, array($item['varID'],$id,$item['itemName'],$item['itemQty'],$item['itemPrice'],$item['itemUnit'],$item['subtotal']));
        }else{
            $query = "UPDATE invoiceitems 
            SET 
                vID = ?,
                iID = ?,
                iName = ?,
                iQty = ?,
                iPrice = ?,
                iUnit = ?,
                iSubtotal = ?
            WHERE
                iItemID = ?;";
            $this->db->query($query,array($item['varID'],$id,$item['itemName'],$item['itemQty'],$item['itemPrice'],$item['itemUnit'],$item['subtotal'],$item['itemID']));
        }
        return;
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
    function delete_spoilages($ssID, $delRemarks){
        $query ="Delete from stockspoil where ssID = ?";
        return $this->db->query(query, array($ssID));
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
    function add_salesOrder($tableCode, $custName, $osTotal, $osDate, $osPayDate, $osDateRecorded, $orderlists, $addons) {
        $query = "insert into orderslips (osID, tableCode, custName, osTotal, payStatus, 
        osDate, osPayDate, osDateRecorded) values (NULL,?,?,?,?,?,?,?);";
        if($this->db->query($query,array($tableCode, $custName, $osTotal, 'paid', $osDate, $osPayDate, $osDateRecorded))) {
            $this->add_salesList($this->db->insert_id(), $orderlists, $addons);
            return true;
            }
        }

    function add_salesList($osID, $orderlists, $addons) {
        $query = "insert into orderlists (olID, prID, osID, olDesc, olQty, 
        olSubtotal, olStatus, olRemarks) values (NULL,?,?,?,?,?,?,?);";
        if(count($orderlists) > 0){
             for($in = 0; $in < count($orderlists) ; $in++){
              if($this->db->query($query, array($orderlists[$in]['prID'], $osID, $orderlists[$in]['olDesc'], 
              $orderlists[$in]['olQty'], $orderlists[$in]['olSubtotal'],'served', ' '))) {
                $this->add_salesAddons($this->db->insert_id(), $orderlists[$in]['prID'], $addons);
                return true;
              }
        }
    }   else {
        return false;
    }
    }

    function add_salesAddons($olID, $olprID, $addons) {
        $query = "INSERT INTO orderaddons (aoID, olID, aoQty, aoTotal) VALUES (?, ?, ?, ?);";
        if(count($addons) > 0){
          for($in = 0; $in < count($addons) ; $in++){
            if($olprID === $addons[$in]['prID']) {
            $this->db->query($query, array($addons[$in]['aoID'], $olID, $addons[$in]['aoQty'], 
                  $addons[$in]['aoTotal']));

            }
        }
    }   else {
        return false;
    }

    }
    // function add_poItems($poID, $merchandise) {
    //     $query = "insert into poitems (poiID, vID, poID, poiName, poiQty, poiUnit, poiPrice, poiStatus) values
    //     (NULL,?,?,?,?,?,?,?)";
    //     if(count($merchandise) > 0){
    //     for($in = 0; $in < count($merchandise) ; $in++){
    //         $this->db->query($query, array($merchandise[$in]['vID'], $poID, $merchandise[$in]['poiName'], $merchandise[$in]['poiQty'],
    //         $merchandise[$in]['poiUnit'],$merchandise[$in]['poiPrice'], $merchandise[$in]['poiStatus']));
    //     }
    // } else {
    //     return false;
    // }
   
    // }
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
    function edit_menu($menu_id, $mName, $ctID, $menu_description, $menu_price, $menu_availability){
        $query = "update menu set mName = ?, ctID = ?, menu_description = ?, menu_price = ?, menu_availability = ? where menu_id = ?";
        return $this->db->query($query,array($mName, $ctID, $menu_description, $menu_price, $menu_availability, $menu_id));
    }
    
    function edit_table($newTableCode, $previousTableCode){
        $query = "Update tables set table_code = ? where table_code = ?;";
        return $this->db->query($query, array($newTableCode, $previousTableCode));
    }
    //Return Function
    function get_poD(){
        $query = "SELECT * FROM supplier inner join invoice on supplier.spID=invoice.spID inner join invoiceitems on invoice.iID=invoiceitems.iID
        inner join variance on invoiceitems.vID=variance.vID inner join stockitems on variance.stID=stockitems.stID where invoice.iType !='return'";
        return $this->db->query($query)->result_array();
    }
    function get_returns(){
        $query = "SELECT * FROM supplier inner join invoice on supplier.spID=invoice.spID inner join invoiceitems on invoice.iID=invoiceitems.iID
        inner join variance on invoiceitems.vID=variance.vID inner join stockitems on variance.stID=stockitems.stID ";
        return $this->db->query($query)->result_array();
    }
    function get_invoiceReturns(){
        $query = "SELECT * FROM supplier inner join invoice on supplier.spID=invoice.spID where invoice.iType='return'";
        return $this->db->query($query)->result_array();
    }
    function get_invRetVar(){
        $query = "SELECT * FROM supplier inner join invoice on supplier.spID=invoice.spID inner join invoiceitems on invoice.iID=invoiceitems.iID
        inner join variance on invoiceitems.vID=variance.vID where invoice.iType='return'";
        return $this->db->query($query)->result_array();
    }
    function get_item($item){
        $query = "SELECT * FROM supplier inner join invoice on supplier.spID=invoice.spID inner join invoiceitems on invoice.iID=invoiceitems.iID
        inner join variance on invoiceitems.vID=variance.vID inner join stockitems on variance.stID=stockitems.stID where invoiceitems.iID ='$item'";
        return $this->db->query($query)->result_array();
    }
    function get_allInvoice(){
        $query = "SELECT * FROM supplier inner join invoice on supplier.spID=invoice.spID where invoice.iType !='return' ORDER BY invoice.iDate DESC";
        return $this->db->query($query)->result_array();
    }
    function add_returns($idate, $reQty, $reUnit, $supID, $dateRet, $receipt, $cost, $remarks,$reStat,  $stckName, $subtotal, $variance, $stckID){
        $var= "Select vQty from variance where vID='$variance'";
        $var = $this->db->query($var)->result_array();
        foreach($var as $stck){
            $var = $stck['vQty'];
        }
        $stck_qty = $var - $reQty;
        $query2 = "Update variance set vQty = ? where vID = ?";
        $this->db->query($query2, array($stck_qty, $variance));

            $query1 = "Insert into invoice(iID, spID, iDate, iDateRecorded, iNumber, iTotal, iRemarks, iType, resolvedStatus) values (?,?,?,?,?,?,?,?,?)";
            $this->db->query($query1, array(NULL, $supID, $dateRet, $idate,  $receipt, $subtotal, $remarks, 'return', $reStat));
    
            $invId= $this->db->insert_id();
            $query3 = "Insert into invoiceitems(iItemID, vID, iID, iName, iQty, iPrice, iUnit, iSubTotal) values (?,?,?,?,?,?,?,?)";
            return $this->db->query($query3, array(NULL, $variance, $invId, $stckName,  $reQty, $cost, $reUnit, $subtotal));
        
    }
    function update_returns($eID, $eSpID, $eRNum, $eStat, $eRDate, $eDRec, $etotal, $eremarks, $defaultType, $eRetIt){
        $query1 = "UPDATE invoice 
            SET 
                spID = ?,
                iDate = ?,
                iDateRecorded = ?,
                iNumber = ?,
                iTotal = ?,
                iRemarks = ?,
                iType = ?,
                resolvedStatus = ?
            WHERE
                iID = ?;"
                ;
        $this->db->query($query1,array($eSpID,$eRDate, $eDRec, $eRNum, $etotal, $eremarks, $defaultType, $eStat, $eID));
        $query2 = "UPDATE invoiceitems
        SET 
            vID = ?,
            iID = ?,
            iName = ?,
            iQty = ?,
            iPrice = ?,
            iUnit = ?,
            iSubTotal = ?
        WHERE
            iItemID = ?
    ;";
        if(count($eRetIt) > 0){
            for($i = 0; $i < count($eRetIt) ; $i++){
                $itemID = $eRetIt[$i]['itemID'];
                $varID = $eRetIt[$i]['varId'];
                $itQty = $eRetIt[$i]['itQty'];

                    $retOldQty = "Select iQty from invoiceitems where iItemID = '$itemID'";
                    $variance = $this->db->query($retOldQty)->result_array();
                    foreach($variance as $num){
                        $old = $num['iQty'];
                    }
                        if($old > $itQty){
                            $newVarqty1 = $old - $itQty; 
                            $quant = "Select vQty from variance where vID='$varID'";
                            $iQuant = $this->db->query($quant)->result_array();
                            foreach($iQuant as $num){
                                $var = $num['vQty'];
                            }
                            $newQty =  $newVarqty1 + $var;
                            $addVarQty = "Update variance set vQty = ? where vID = ?";
                            $this->db->query($addVarQty, array($newQty, $varID));
                        }else{
                            $newVarqty2 = $itQty - $old;
                            $quant = "Select vQty from variance where vID='$varID'";
                            $var = $this->db->query($quant)->result_array();
                            foreach($var as $num){
                                $var = $num['vQty'];
                            }
                            $newQty = $var - $newVarqty2;
                            $addVarQty = "Update variance set vQty = ? where vID = ?";
                            $this->db->query($addVarQty, array($newQty, $varID));
                       }
                       return $this->db->query($query2, array($varID, $eID, $eRetIt[$i]['itName'], $itQty,
                       $eRetIt[$i]['itPri'],$eRetIt[$i]['itUnit'], $eRetIt[$i]['itSub'],$itemID));
                    }
            }
    }

}

?>
