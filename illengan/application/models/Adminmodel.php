<?php
class Adminmodel extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

    function __construct(){
        parent:: __construct();
        $this->infoDB = $this->load->database('information',true);
        date_default_timezone_set('Asia/Manila'); 
    }

    //INSERT FUNCTIONS----------------------------------------------------------------
    function add_accounts($data){
        $this->db->insert('accounts',$data);
    }
    function add_addon($aoName, $aoPrice, $aoCategory, $aoStatus){
        $query = "INSERT into addons (aoName, aoPrice, aoCategory, aoStatus) values (?,?,?,?)";
        return $this->db->query($query,array($aoName, $aoPrice, $aoCategory, $aoStatus));
    }
    function add_aospoil($date_recorded,$addons,$account_id){
        $query = "insert into aospoil (aosID,aosDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_spoiledaddon($this->db->insert_id(),$addons,$date_recorded,$account_id);
            return true;
        }
    }
    function add_spoiledaddon($aosID,$addons,$date_recorded,$account_id){
        $query = "insert into addonspoil (aosID,aoID,aosQty,aosDate,aosRemarks) values (?,?,?,?,?)";
        if(count($addons) > 0){
            for($in = 0; $in < count($addons) ; $in++){
                $this->db->query($query, array($aosID, $addons[$in]['aoID'], $addons[$in]['aosQty'],
                $addons[$in]['aosDate'],$addons[$in]['aosRemarks']));
                $this->add_actlog($account_id,$date_recorded, "Admin added an addon spoilage.", "add", $addons[$in]['aosRemarks']);
            }    
        }
    }
    function add_menuspoil($date_recorded,$menu,$account_id){
        $query = "insert into menuspoil (msID,msDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_spoiledmenu($this->db->insert_id(),$menu,$date_recorded,$account_id);
            return true;
        }
    }
    function add_spoiledmenu($msID,$menus,$date_recorded,$account_id){
        $query = "insert into spoiledmenu (msID,prID,msQty,msDate,msRemarks) values (?,?,?,?,?)";
        if(count($menus) > 0){
            for($in = 0; $in < count($menus) ; $in++){
                $this->db->query($query, array($msID, $menus[$in]['prID'], $menus[$in]['msQty'],$menus[$in]['msDate'],$menus[$in]['msRemarks']));
                $this->add_actlog($account_id,$date_recorded, "Admin added a menu spoilage.", "add", $menus[$in]['msRemarks']);
            }    
        }
    }
    function add_stockspoil($date_recorded,$stocks,$slType){
        $query = "insert into stockspoil (ssID,ssDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_varspoilitems($this->db->insert_id(),$date_recorded,$stocks,$slType);
            return true;
        }
    }
    function add_varspoilitems($ssID,$date_recorded,$stocks,$slType){ 
        $query = "insert into spoiledstock (ssID,stID,ssQty,ssDate,ssRemarks) values (?,?,?,?,?)";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                   $this->db->query($query, array($ssID, $stocks[$in]['stID'], $stocks[$in]['ssQty'], $stocks[$in]['ssDate'],$stocks[$in]['ssRemarks']));  
                   $this->destockvarItems($stocks[$in]['stID'],$stocks[$in]['curstQty'],$stocks[$in]['ssQty']);  
                   $this->add_stockLog($stocks[$in]['stID'], NULL, $slType, $date_recorded, $stocks[$in]['ssDate'], $stocks[$in]['ssQty'], $stocks[$in]['ssRemarks']); 
                   $this->add_actlog(1,$date_recorded, "Admin added a stockitem spoilage.", "add", $stocks[$in]['ssRemarks']);
                }    
            }
    }
    function destockvarItems($stID,$curstQty,$ssQty){
        $query = "UPDATE stockitems 
        SET 
            stQty = ? - ?
        WHERE
            stID = ?;";
        return $this->db->query($query,array($curstQty,$ssQty,$stID));
       
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
    function add_stockItem($stockCategory, $stockUom, $stockName, $stockQty, $stockMin, $stockType, $stockStatus, $stockBqty, $stockLocation,$stockSize){
        $query = "INSERT INTO `stockitems`( `stID`,`ctID`,`uomID`,`stName`,`stQty`,`stMin`,`stType`,`stStatus`,`stBqty`,`stLocation`,`stSize` )
                    VALUES( NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? );";
        if($this->db->query($query,array($stockCategory, $stockUom, $stockName, $stockQty, $stockMin, $stockType, $stockStatus, $stockBqty, $stockLocation,$stockSize))){
            if($this->add_stockLog($this->db->insert_id(), NULL, 'beginning', date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $stockQty, "New item")){
                return true;
            }
        }
        return false;
    }
    function add_table($tableCode){
        $query = "INSERT INTO TABLES(tableCode)
        VALUES(?);";
        return $this->db->query($query, array($tableCode));
    }

    // Adding Promos
    function add_promo($pmName, $pmStartDate, $pmEndDate, $freebie, $discount, $status, $pc, $fb, $dc, $mfb, $mdc){
        $query = "insert into promos (pmID, pmName, pmStartDate, pmEndDate, freebie, discount, status) 
        values (NULL,?,?,?,?,?,?)";
        if($this->db->query($query,array($pmName, $pmStartDate, $pmEndDate, $freebie, $discount, $status))) {
            $pmID = $this->db->insert_id();
            $this->add_freebies($pmID, $fb);
            $this->add_discounts($pmID, $dc);
            $this->add_promoconstraint($pmID, $pc, $mfb, $mdc);
        }
    }
    function add_freebies($pmID, $fb) {
        if(count($fb) > 0) {
            $query = "insert into freebies (pmID, fbName, isElective) values (?,?,?)";
        for($in = 0; $in < count($fb) ; $in++){
            $this->db->query($query, array($pmID, $fb[$in]['fbName'], intval($fb[$in]['isElective'])));
          } 
        }
    }
    function add_discounts($pmID, $dc) {
        if(count($dc) > 0) {
            $query = "insert into discounts (pmID, dcName) values (?,?)";
        for($in = 0; $in < count($dc) ; $in++){
            $this->db->query($query, array($pmID, $dc[$in]['dcName']));
          } 
        }
    }
    function add_promoconstraint($pmID, $pc, $mfb, $mdc) {
        if(count($pc) > 0) {
            $query = "insert into promoconstraint (pmID, prID, pcType, pcQty) values (?,?,?,?)";
            for($in = 0; $in < count($pc) ; $in++){
            if($this->db->query($query, array($pmID, $pc[$in]['prID'], $pc[$in]['pcType'], intval($pc[$in]['pcQty'])))) {
                $this->add_menufreebie($pmID, $mfb);
                $this->add_menudiscount($pmID, $mdc);
             }
          } 
        }
    }

    function add_menufreebie($pmID, $mfb) {
        if(count($mfb) > 0) {
            $query = "insert into menufreebie (pmID, prID, fbQty) values (?,?,?)";
            for($in = 0; $in < count($mfb); $in++){
                $this->db->query($query, array($pmID, $mfb[$in]['prID'], intval($mfb[$in]['fbQty'])));
              } 
        } else {
            return false;
        }
    }

    function add_menudiscount($pmID, $mdc) {
        if(count($mdc) > 0) {
            $query = "insert into menudiscount (pmID, prID, dcAmount) values (?,?,?)";
            for($in = 0; $in < count($mdc); $in++){
                $this->db->query($query, array($pmID, $mdc[$in]['prID'], floatval($mdc[$in]['dcAmount'])));
              } 
        }
        else {
            return false;
        }
    }
    // End of Adding Promos
    function add_supplier($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spMerch){
        $query = "insert into supplier (spName, spContactNum, spEmail, spStatus, spAddress) values (?,?,?,?,?);";
        if($this->db->query($query,array($spName, $spContactNum, $spEmail, $spStatus, $spAddress))){
            $spID = $this->db->insert_id();
            if(count($spMerch) > 0){
                foreach($spMerch as $merch) {
                    $this->add_supplierMerchandise($merch, $spID);
                }
            }
            return true;          
        }
        return false;
    }

    function add_supplierMerchandise($merch, $spID) {
        $query = "insert into suppliermerchandise (stID, spID, uomID, spmName, spmActualQty, spmPrice) values (?,?,?,?,?,?);";
        $this->db->query($query,array($merch['stID'],$spID,$merch['merchUnit'],$merch['merchName'],$merch['merchActualQty'],$merch['merchPrice']));
    }


    function add_menu($mName, $mDesc, $category, $status,$preference,$addon){
        $query = "INSERT into menu (mName, mDesc, ctID, mAvailability) values (?,?,?,?);";
        if($this->db->query($query,array($mName, $mDesc, $category, $status))){
            $mID = $this->db->insert_id();
            $this->add_preference($mID, $preference);
            $this->add_menuaddon($mID, $addon);
            return true;
        }
    }

    function add_image($image, $mID){
        $query = "UPDATE menu set mImage = ? where mID = ?";
        return $this->db->query($query,array($image, $mID));
    }

    function add_preference($mID, $preference){
       $query = "INSERT into preferences (mID, prName, mTemp, prPrice, prStatus) values (?,?,?,?,?)";
       if(count($preference) > 0){
           for($n = 0; $n < count($preference) ; $n++){
               $this->db->query($query, array($mID, $preference[$n]['prName'], $preference[$n]['mTemp'], $preference[$n]['prPrice'], $preference[$n]['prStatus']));
           }
       } else{
           return false;
       }
    }

    function add_menuaddon($mID, $addon){
        $query = "INSERT into menuaddons (mID, aoID) values (?,?)";
        $this->db->query($query, array($mID, $ao['aoID']));
    }

     function add_salesOrder($tableCode, $custName, $osTotal, $osDateTime, $osPayDateTime, $osDateRecorded, $osDiscount, $orderlists, $addons) {
        $query = "insert into orderslips (osID, tableCode, custName, osTotal, payStatus, 
        osDateTime, osPayDateTime, osDateRecorded, osDiscount) values (NULL,?,?,?,?,?,?,?,?);";
        if($this->db->query($query,array($tableCode, $custName, $osTotal, 'paid', $osDateTime, $osPayDateTime, $osDateRecorded, $osDiscount))) {
            $this->add_salesList($this->db->insert_id(), $orderlists, $addons);
            }
        }

    function add_salesList($osID, $orderlists, $addons) {
        $query = "insert into orderlists (olID, prID, osID, olDesc, olQty, 
        olSubtotal, olStatus, olRemarks, olPrice, olDiscount) values (NULL,?,?,?,?,?,?,?,?,?);";
        if(count($orderlists) > 0){
             for($in = 0; $in < count($orderlists) ; $in++){
              if($this->db->query($query, array($orderlists[$in]['prID'], $osID, $orderlists[$in]['olDesc'], 
              $orderlists[$in]['olQty'], $orderlists[$in]['olSubtotal'],'served', ' ', $orderlists[$in]['olPrice'], 
              $orderlists[$in]['olDiscount']))) {
                if(count($addons) > 0) {
                    $this->update_salesaddons($this->db->insert_id(), $orderlists[$in]['prID'], $addons);
                }
              }
        }
    }else {
        return false;
    }
    }
    function add_salesAddons($olID, $olprID, $addons) {
        $query = "INSERT INTO orderaddons (aoID, olID, aoQty, aoTotal) VALUES (?, ?, ?, ?);";
          for($in = 0; $in < count($addons); $in++){
            if($olprID == $addons[$in]['prID']) {
            $this->db->query($query, array($addons[$in]['aoID'], $olID, $addons[$in]['aoQty'], 
            $addons[$in]['aoTotal']));
            }
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
                if($merch['del'] === 0){
                    $this->delete_supplierMerchandise($merch['smpID']);
                }else if($merch['spmID'] == NULL){
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
    function delete_supplier($spmID){
        $query = "DELETE FROM suppliermerchandise WHERE spmID = ?";
        return $this->db->query($query, array($smpID));
    }
    
    function edit_supplierMerchandise($merch){
        $query = "UPDATE suppliermerchandise 
            SET 
                stID = ?,
                uomID = ?,
                spmName = ?,
                spmActualQty = ?,
                spmPrice = ?
            WHERE
                spmID = ?;";
        $this->db->query($query,array($merch['stID'],$merch['merchUnit'],$merch['merchName'],$merch['merchActualQty'],$merch['merchPrice'], $merch['spmID']));
    }
    // UPDATE FUNCTIONS-------------------------------------------------------------

    
    function edit_sales($osID, $tableCodes, $custName, $osTotal, $payStatus, $osDateTime, $osPayDateTime, 
    $osDateRecorded, $osDiscount, $orderlists, $addons) {
        $query = "UPDATE orderslips SET tableCode = ?, custName = ?, osTotal = ?, 
        osDateTime = ?, osPayDateTime = ?, osDiscount = ? WHERE orderslips.osID = ?;";
        if($this->db->query($query, array($tableCodes, $custName, $osTotal, $osDateTime, $osPayDateTime, $osDiscount, $osID))) {
            for($i = 0; $i < count($orderlists); $i++) {
                $orlist = array(
                    'olID' => $orderlists[$i]['olID'],
                    'prID' => $orderlists[$i]['prID'],
                    'osID' => $orderlists[$i]['osID'],
                    'olDesc' => $orderlists[$i]['olDesc'],
                    'olQty' => $orderlists[$i]['olQty'],
                    'olSubtotal' => $orderlists[$i]['olSubtotal'],
                    'olStatus' => $orderlists[$i]['olStatus'],
                    'olRemarks' => $orderlists[$i]['olRemarks'],
                    'olPrice' => $orderlists[$i]['olPrice'],
                    'olDiscount' => $orderlists[$i]['olDiscount']
                );

                if($orderlists[$i]['del'] === 0) {
                    $this->delete_salesOrderitem($orderlists[$i]['olID']);
                }
                else if($orderlists[$i]['olID'] != null) {
                    $this->edit_salesorders($orlist, $addons);
                } else{
                    $orderlist = array();
                    array_push($orderlist, $orlist);
                    $this->add_salesList($osID, $orderlist, $addons);
                } 
            }   
        }
    }

    function edit_salesorders($orlist, $addons) {
        $query = "UPDATE orderlists SET prID = ?, osID = ?, olDesc = ?, 
        olQty = ?, olSubtotal = ?, olPrice = ?, olDiscount = ? WHERE orderlists.olID = ?;";
        if($this->db->query($query, array($orlist['prID'], $orlist['osID'], $orlist['olDesc'], 
        $orlist['olQty'], $orlist['olSubtotal'],  $orlist['olPrice'],  $orlist['olDiscount'],  
        $orlist['olID'])))  {
            if(count($addons) > 0) {
              $this->update_salesaddons($orlist['olID'], $orlist['prID'], $addons);
            }
        }
        
    }

    function update_salesaddons($olID, $prID, $addons) {
        for($i = 0; $i < count($addons); $i++) {
            if($addons[$i]['del'] === 0 ) {
                $this->delete_salesAddons($addons[$i]['aoID'], $addons[$i]['olID']);
            } else if($addons[$i]['olID'] === null){
                $addonsArr = array();
                $aolist = array(
                    'prID' => $addons[$i]['prID'],
                    'aoID' => $addons[$i]['aoID'],
                    'aoQty' => $addons[$i]['aoQty'],
                    'aoTotal' => $addons[$i]['aoTotal']
                );
                array_push($addonsArr, $aolist);
                $this->add_salesAddons($olID, $prID, $addonsArr);
            } else if(intval($addons[$i]['oldaoID']) != intval($addons[$i]['aoID'])) {
                $this->update_changedAddon($addons[$i]['aoID'], $addons[$i]['oldaoID'], $addons[$i]['olID']);
            } else if($addons[$i]['prID'] == $prID && $addons[$i]['olID'] != null) {
                $aolist = array(
                    'aoID' => $addons[$i]['aoID'],
                    'olID' => $addons[$i]['olID'],
                    'aoQty' => $addons[$i]['aoQty'],
                    'aoTotal' => $addons[$i]['aoTotal']
                );
                $this->edit_salesaddons($aolist);
            } 
        }
}

    function edit_salesaddons($addon) {
        $query = "UPDATE orderaddons SET aoQty = ?, aoTotal = ? WHERE orderaddons.aoID = ?
        AND orderaddons.olID = ?;";
        $this->db->query($query, array($addon['aoQty'], $addon['aoTotal'], $addon['aoID'], $addon['olID']));
    }

    function update_changedAddon($aoID, $oldaoID, $olID) {
        $query = "UPDATE orderaddons SET aoID = ? WHERE orderaddons.aoID = ? AND orderaddons.olID = ?;";
        $this->db->query($query, array($aoID, $oldaoID, $olID));

    }

    function change_aPassword($new_password, $aID){
        $query = "Update accounts set aPassword = ?  where aID = ? ";
        return $this->db->query($query,array($new_password, $aID));  
           
    }
    function edit_addon($aoName, $aoPrice, $aoCategory, $aoStatus, $aoID){
        $query = "UPDATE addons set aoName = ?, aoPrice = ?, aoCategory = ?, aoStatus = ? where aoID = ?";
        return $this->db->query($query,array($aoName, $aoPrice, $aoCategory, $aoStatus, $aoID));
    }
    function edit_accounts($aID,$aType,$aUsername){
        $query = "update accounts set aUsername = ?, aType = ? where aID = ?";
        return $this->db->query($query,array($aUsername, $aType, $aID));
    }
    function edit_menuspoilage($msID,$prID,$msQty,$msDate,$msRemarks,$date_recorded){
        $query = "Update menuspoil set msDateRecorded = ? where msID=?";
        if($this->db->query($query,array($date_recorded,$msID))){
            $query = "Update spoiledmenu set msQty = ?, msDate = ?,msRemarks = ? where msID = ? AND prID = ?";
            return $this->db->query($query,array($msQty,$msDate,$msRemarks,$msID,$prID));
        }else{
            return false;
        }
    }
    function edit_stockspoilage($ssID,$stID,$ssDate,$ssRemarks,$updateQtyh,$updateQtyl,$curSsQty,$stQty,$ssQtyUpdate,$date_recorded){
        $query = "Update stockspoil set ssDateRecorded = ? where ssID=?";
        
        if($this->db->query($query,array($date_recorded,$ssID))){
                $query = "Update spoiledstock set ssQty = ?,ssDate = ?, ssRemarks = ? where ssID = ? AND stID = ?";
                $this->db->query($query,array($ssQtyUpdate ,$ssDate, $ssRemarks, $ssID, $stID));
                $this->stockitemQty($updateQtyh,$updateQtyl,$stQty, $ssQtyUpdate, $curSsQty, $stID);  
        }else{
            return false;
        }
    }
    function stockitemQty($updateQtyh,$updateQtyl, $stQty, $ssQtyUpdate, $curSsQty, $stID){
            if ($curSsQty > $ssQtyUpdate){
                $query = "UPDATE stockitems SET stQty = ? + ? WHERE stID = ?;";
                return $this->db->query($query,array($stQty,$updateQtyl,$stID));
            }
            if ($curSsQty < $ssQtyUpdate){
                $query = "UPDATE stockitems SET stQty = ? - ? WHERE stID = ?;";
                return $this->db->query($query,array($stQty,$updateQtyh,$stID));
            }
            else{
                $query = "UPDATE stockitems SET stQty = ? WHERE stID = ?;";
                return $this->db->query($query,array($stQty, $stID));
            }
    }
    function edit_aospoilage($aoID,$aosID,$aosQty,$aosDate,$aosRemarks,$date_recorded){
        $query = "Update aospoil set aosDateRecorded = ? where aosID=?";
        if($this->db->query($query,array($date_recorded,$aosID))){
            $query = "Update addonspoil set aosQty = ?,aosDate = ?,aosRemarks = ? where aoID = ?";
            return $this->db->query($query,array($aosQty,$aosDate,$aosRemarks,$aoID));
        }else{
            return false;
        }
    }

    function edit_category($ctName, $ctStatus, $ctID){
        $query = "UPDATE categories SET ctName = ?, ctStatus = ? where ctID = ?";
        return $this->db->query($query,array($ctName, $ctStatus, $ctID));
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
    function edit_stockItem($stockCategory, $stockLocation, $stockMin, $stockName, $stockQty, $stockStatus, $stockType, $stockUom, $stockSize, $stockID){
        $query = "UPDATE
            stockitems
        SET
            ctID = ?,
            stLocation = ?,
            stMin = ?,
            stName = ?,
            stStatus = ?,
            stType = ?,
            uomID = ?,
            stSize = ?
        WHERE
            stID = ?;";
        if($this->db->query($query,array($stockCategory, $stockLocation, $stockMin, $stockName, $stockStatus, $stockType, $stockUom, $stockSize, $stockID))){
            return true;
        }
        return false;
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
    function get_promoconstraint() {
        $query = "SELECT pmID, pc.prID, pc.pcQty, 
        CONCAT(mn.mName,' ',pref.prName) AS menu_item
        FROM promoconstraint pc 
        INNER JOIN preferences pref USING (prID) 
        INNER JOIN menu mn USING (mID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_fb() {
        $query = "SELECT * FROM freebies";
        return $this->db->query($query)->result_array(); 
    }
    function get_menudc() {
        $query = "SELECT pmID, CONCAT(mn.mName,' ',pref.prName) AS menu_item, md.dcAmount FROM 
        menudiscount md INNER JOIN preferences pref 
        USING (prID) INNER JOIN menu mn USING (mID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_dc() {
        $query = "SELECT * FROM discounts";
        return $this->db->query($query)->result_array(); 
    }
    function get_freebies() {
        $query = "SELECT pmID, pc.prID, pc.pcQty, freebies.fbName, 
        CONCAT(mn.mName,' ',pref.prName) AS menu_item
        FROM promoconstraint pc 
        INNER JOIN preferences pref USING (prID) 
        INNER JOIN menu mn USING (mID) 
        INNER JOIN freebies USING (pmID) ";
        return $this->db->query($query)->result_array(); 
    }
    function get_menufreebies() {
        $query = "SELECT pmID, CONCAT(mn.mName,' ',pr.prName) as menu_freebie, fb.fbQty FROM 
        menufreebie fb INNER JOIN preferences pr USING (prID) INNER JOIN menu mn USING (mID); ";
        return $this->db->query($query)->result_array(); 
    }
    function get_menu_items() {
        $query = "SELECT CONCAT(mn.mName,' ',pref.prName) 
        AS pref_menu, pref.mTemp, pref.prID 
        FROM menu mn INNER JOIN preferences pref USING (mID)";
        return $this->db->query($query)->result_array();
    }
    function get_menuItems() {
        $query = "SELECT pr.prID, CONCAT(mn.mName,' ',pr.prName) AS menu_item, pr.prPrice
        FROM preferences pr INNER JOIN menu mn USING (mID) ORDER BY 2";
        return $this->db->query($query)->result_array(); 
    }
    
    function get_promos() {
        $query = "SELECT * FROM promos";
        return $this->db->query($query)->result_array(); 
    }
    function get_promoconst() {
        $query = "SELECT pc.pmID, pc.pcType, pc.pcQty, pref.prID, mn.mName, pref.prName,
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
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(mID) as menu_no from categories left join menu using (ctID) where ctType = 'menu' group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }

    function get_menumaincategories(){
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(mID) as menu_no from categories left join menu using (ctID) where ctType = 'menu' and supcatID is null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }

    function get_menusubcategories(){
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(mID) as menu_no from categories left join menu using (ctID) where ctType = 'menu' and supcatID is not null group by ctID order by ctName asc";
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
        $query = "SELECT
            stID,
            CONCAT(stName, if(stSize IS Null,'', concat(' ',stSize))) as stName,
            stMin,
            stQty,
            uomID,
            uomAbbreviation,
            stBqty,
            UPPER(stStatus) as stStatus,
            stType,
            UPPER(stLocation) as stLocation,
            ctName,
            ctID
        FROM
            (
                stockitems
            LEFT JOIN uom USING(uomID)
            )
        LEFT JOIN categories USING(ctID)
        GROUP BY
            stID;";
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
    function get_addons(){
        $query = "Select * from addons";
        return $this->db->query($query)->result_array();
    }
    function get_mnAddons() {
        $query = "SELECT * FROM addons INNER JOIN menuaddons USING (aoID);";
        return $this->db->query($query)->result_array();
    }
    function get_menuaddons($mID) {
        $query = "SELECT * FROM menu mn INNER JOIN menuaddons ma USING (mid) INNER JOIN addons ao USING (aoID) 
        WHERE mn.mID = ?";
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
            UPPER(poStatus) as poStatus,
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
    function get_stockCategories(){
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(stID) as stockCount from categories left join stockitems using (ctID) where ctType = 'inventory' group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_stockMainCategories(){
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(stID) as stockCount from categories left join stockitems using (ctID) where ctType = 'inventory' and supcatID is null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_stockSubcategories(){
        $query = "SELECT 
            ctID, ctName, ctType, ctStatus, COUNT(stID) AS stockCount
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
    function get_supplierNames(){
        $query = "Select spID, spName from supplier order by spName";
        return $this->db->query($query)->result_array();
    }
    function get_suppliermerch(){
        $query = "SELECT stID, CONCAT( stName, IF( stSize IS NULL, '', CONCAT(' ', stSize) ) ) AS stName, suppliermerchandise.uomID, uomAbbreviation,uomName, spmID, spmName, spmPrice, spmActualQty, spID, spName FROM ( stockitems RIGHT JOIN( suppliermerchandise LEFT JOIN supplier USING(spID) ) USING(stID) ) LEFT JOIN uom on (suppliermerchandise.uomID = uom.uomID)
        ";
        return $this->db->query($query)->result_array();
    }
    function get_suppMerchandise($spmID){
        $query = "Select *, CONCAT(spm.spmDesc,' :',st.stName) as branditem from suppliermerchandise spm INNER JOIN supplier USING (spID) INNER JOIN variance 
        USING (vID) INNER JOIN stockitems st USING (stID) WHERE spm.spmID = ?";
        return $this->db->query($query, array($spmID))->result_array();
    }
    function get_spoilagesmenu(){
        $query = "Select msID,prID, mName,msQty,DATE_FORMAT(msDate, '%b %d, %Y') AS msDate,DATE_FORMAT(msDateRecorded, '%b %d, %Y %r') AS msDateRecorded,msRemarks from menuspoil inner join spoiledmenu using (msID) inner join preferences using (prID) inner join menu using (mID) order by msDateRecorded DESC";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilagesstock(){
        $query = "Select ssID,stID,ssDate,stName,stLocation,ssQty,stQty,DATE_FORMAT(ssDate, '%b %d, %Y') AS ssDate,DATE_FORMAT(ssDateRecorded, '%b %d, %Y %r') AS ssDateRecorded,ssRemarks from stockspoil inner join spoiledstock using (ssID) inner join stockitems using (stID) order by ssDateRecorded DESC";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilagesaddons(){
        $query = "Select aoID,aosID, aoName,aosQty, aoCategory,DATE_FORMAT(aosDate, '%b %d, %Y') AS aosDate, DATE_FORMAT(aosDateRecorded, '%b %d, %Y %r') AS aosDateRecorded, aosRemarks from addonspoil INNER JOIN aospoil using (aosID)INNER JOIN addons using (aoID) order by aosDateRecorded DESC";
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
    function get_consumptions() {
        $query = "SELECT slID, stID, CONCAT(stName,' (',stSize,')') as stDesc ,slDateTime, stocklog.dateRecorded, slQty, uomAbbreviation, slBalance, slRemarks FROM uom NATURAL JOIN stockitems NATURAL JOIN stocklog WHERE slType = 'consumed'";
        return $this->db->query($query)->result_array();
    }

//DELETE FUNCTIONS---------------------------------------------------------------------------
    function delete_account($accountId){
        $query = "Delete from accounts where aID = ?";
        return $this->db->query($query, array($accountId));
    }
    function delete_category($id){
        $query = "UPDATE categories set ctStatus = 'archived' where ctID = ?";
        return $this->db->query($query, array($id));
    }
    function delete_addon($id){
        $query = "UPDATE addons set aoStatus = 'archived' where aoID = ?"; 
        return $this->db->query($query, array($id));
    }
    function delete_spoilages($ssID, $delRemarks){
        $query ="Delete from stockspoil where ssID = ?";
        return $this->db->query(query, array($ssID));
    }
    function delete_stockitem($stID){
        $query = "Delete from stockitems where stID=?;";
        return $this->db->query($query, array($stID));
    }
    function delete_table($tableCode){
        $query = "Delete from tables where tableCode= ?";
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
    function delete_salesOrderitem($olID) {
        $query = "DELETE FROM orderlists WHERE orderlists.olID = ?";
        return $this->db->query($query, array($olID));
    }
    function delete_salesAddons($aoID, $olID) {
        $query = "DELETE FROM orderaddons WHERE orderaddons.aoID = ? AND orderaddons.olID = ?";
        return $this->db->query($query, array($aoID, $olID));
    }

    function add_source($data){
        $this->db->insert("sources", $data);
    }
    
    function edit_table($newTableCode, $previousTableCode){
        $query = "Update tables set tableCode = ? where tableCode = ?;";
        return $this->db->query($query, array($newTableCode, $previousTableCode));
    }
    function get_uom(){
        $query = "SELECT * from uom";
        return $this->db->query($query)->result_array();
    }
    function get_enumVals($table,$column){
        $query = "SELECT 
            column_type
        FROM
            COLUMNS
        WHERE
            TABLE_NAME = ?
                AND COLUMN_NAME = ?;";
        return $this->infoDB->query($query,array($table,$column))->result_array();
    }
    function get_uomForSizes(){
        $query = "SELECT
            uomName,
            uomAbbreviation,
            UPPER(uomVariant) as uomVariant
        FROM
            uom
        WHERE
            uomVariant IS NOT NULL;";
        return $this->db->query($query)->result_array();
    }
    function get_uomForStoring(){
        $query = "SELECT
            uomID,
            uomName,
            uomAbbreviation
        FROM
            uom
        WHERE
            uomStore IS NOT NULL;";
        return $this->db->query($query)->result_array();
    }
    function get_stockItem($id){
        $query = "SELECT
            ctID,
            ctName,
            stID,
            UPPER(stLocation) AS stLocation,
            stMin,
            stName,
            stQty,
            stSize,
            UPPER(stStatus) AS stStatus,
            UPPER(stType) AS stType,
            uomID,
            uomAbbreviation,
            stBqty
        FROM
            (
                stockitems
            LEFT JOIN categories USING(ctID)
            )
        LEFT JOIN uom USING(uomID)
        WHERE
            stID = ?;";
        return $this->db->query($query, array($id))->result_array();
    }
    function get_stockItemNames(){
        $query = "SELECT
            stID,
            CONCAT(stName, ' ', stSize) as stName,
            uomID,
            uomAbbreviation
        FROM
            stockitems
        LEFT JOIN uom USING(uomID);";
        return $this->db->query($query)->result_array();
    }

    function get_transactions(){
        $query = "SELECT
            tID,
            tNum,
            tType,
            DATE_FORMAT(tDate, '%b %d, %Y %r') AS tDate,
            DATE_FORMAT(dateRecorded, '%b %d, %Y %r') AS dateRecorded,
            spID,
            spName,
            SUM(tiSubtotal) AS tTotal,
            tRemarks
        FROM
            (
                transactions
            LEFT JOIN trans_items USING(tID)
            )
        LEFT JOIN supplier USING(spID)
        GROUP BY
            tID
        ORDER BY transactions.tDate DESC;";
        return $this->db->query($query)->result_array();
    }
    function get_transaction($id){
        $query = "SELECT
            tID,
            tNum,
            tType,
            tDate,
            spID,
            spName,
            tRemarks
        FROM
            transactions
        LEFT JOIN supplier USING(spID)
        WHERE 
            tID = ?;";
        return $this->db->query($query, array($id))->result_array();
    }
    function get_transitems($id=null){
        if($id == null){
            $query = "SELECT
                tID,
                tiID,
                tiName,
                tiQty,
                tiActualQty,
                transitems.uomID,
                uomAbbreviation,
                tiPrice,
                tiDiscount,
                tiSubtotal,
                tiStatus,
                stID,
                stName
            FROM
                (
                    (
                        (transitems left join stockitems using(stID))
                    LEFT JOIN uom on (transitems.uomID = uom.uomID)
                    )
                LEFT JOIN trans_items USING(tiID)
                )
            LEFT JOIN transactions USING(tID);";
            return $this->db->query($query)->result_array();
        }else{
            $query = "SELECT
                tID,
                tiID,
                tiName,
                tiQty,
                tiActualQty,
                transitems.uomID,
                uomAbbreviation,
                tiPrice,
                tiDiscount,
                tiSubtotal,
                tiStatus,
                stID,
                stName
            FROM
                    ((
                        (transitems left join stockitems using(stID))
                    LEFT JOIN uom on (transitems.uomID = uom.uomID)
                    )left join trans_items using (tiID))
                LEFT JOIN transactions USING(tID)
                WHERE
                    tID = ?;";
            return $this->db->query($query,array($id))->result_array();
        }
    }

    function add_transaction($id, $supplier, $receipt, $date, $type, $dateRecorded, $remarks, $transitems){
        $insertSuccess = false;
        if($id == null){
            $query = "INSERT INTO `transactions`(`tID`, `spID`, `tNum`, `tDate`, `tType`, `dateRecorded`, `tRemarks`)
                VALUES(NULL, ?, ?, ?, ?, ?, ?);";
            $insertSuccess = $this->db->query($query, array($supplier, $receipt, $date, $type, $dateRecorded, $remarks));
            $id = $this->db->insert_id();
        }else{
            $query = "UPDATE transactions 
                SET spID = ?, tNum = ?, tDate = ?, dateRecorded = ?, tRemarks = ?
                WHERE tID = ?;";
            $insertSuccess = $this->db->query($query, array($supplier, $receipt, $date, $dateRecorded, $remarks, $id));
        }
        if($insertSuccess){
            foreach($transitems as $item){
                if(!isset($item['tiID'])){
                    $tiID = $this->addEdit_transactionItem($item, $id, $type);
                    $this->addEdit_trans_item($tiID, $id, $item['tiQty'], $item['tiSubtotal'], $item['stQty']);
                    if($type != "purchase order"){
                        $actualQty = (int) $item['tiQty'] * (int) $item['stQty'];
                        if($this->add_stockLog($item['stID'], $id, "restock", $date, $dateRecorded, $actualQty, NULL)){
                            $this->update_stockQty($item['stID'], $actualQty);
                        }
                    }
                }else{
                    $poItem = $this->db->query("SELECT tID, tiID, tiQty
                        FROM (transitems LEFT JOIN trans_items USING(tiID))
                        LEFT JOIN transactions USING(tID)
                        WHERE tiID = ? AND tType = 'purchase order' AND tiStatus = 'pending';",
                        array($item['tiID']))->result_array();
                    $orItem = $this->db->query("SELECT tID, tiID, tiQty
                        FROM (transitems LEFT JOIN trans_items USING(tiID))
                        LEFT JOIN transactions USING(tID)
                        WHERE tiID = ? AND tType = 'official receipt';",
                        array($item['tiID']))->result_array();
                    $prevItem = $this->db->query("SELECT tID, tiID, tType, tiQty, tiActualQty, tiStatus, stID FROM
                        ((transactions LEFT JOIN trans_items USING(tID)) LEFT JOIN transitems USING(tiID)) LEFT JOIN stockitems USING(stID)
                        WHERE tiID = ? AND tID = ?;", array($item['tiID'], $id))->result_array();
                    $this->addEdit_transactionItem($item, $id, $type);
                    if($this->addEdit_trans_item($item['tiID'], $id, $item['tiQty'], $item['tiSubtotal'], $item['stQty'])){
                        $newQty = 0;
                        $actualQty = 0; 
                        $logType = "";
                        $sign = 1;
                        switch($type){
                            case "purchase order":
                                break;
                            case "delivery receipt":
                                $newQty = (int) $item['tiQty'] - (int) $prevItem[0]['tiQty'];
                                if($newQty !== 0){
                                    $actualQty = $newQty * $item['stQty'];
                                    if($newQty > 0){
                                        $logType = "restock";
                                    }else{
                                        $sign = -1;
                                        $logType = "other";
                                    }
                                    $this->add_stockLog($item['stID'], $id, $logType, $date, $dateRecorded, $actualQty*$sign, NULL);
                                    $this->update_stockQty($item['stID'], $actualQty);
                                }
                                break;
                            case "official receipt":
                                $drQty = 0;
                                $drItems = $this->db->query("SELECT tiID, tID, tiQty
                                    FROM (transitems LEFT JOIN trans_items USING(tiID)) LEFT JOIN transactions USING(tID)
                                    WHERE tiID = ? AND tType = 'delivery receipt';", array($tiID));
                                if($drItems->num_rows() > 0){
                                    $drItems  = $drItems->result_array();
                                    foreach($drItems as $item){
                                        $drQty += $item['tiQty'];
                                    }
                                    if($prevItem[0]['tiQty'] > $drQty){
                                        $newQty = $item['tiQty'] - $prevItem[0]['tiQty'];
                                    }else{
                                        $newQty = $item['tiQty'] - $drQty;
                                    }
                                    if($newQty !== 0 && $drQty < $item['tiQty']){
                                        $actualQty = $newQty * $item['stQty'];
                                        if($newQty > 0){
                                            $logType = "restock";
                                        }else{
                                            $sign = -1;
                                            $logType = "other";
                                        }
                                        $this->add_stockLog($item['stID'], $id, $logType, $date, $dateRecorded, $actualQty*$sign, NULL);
                                        $this->update_stockQty($item['stID'], $actualQty);
                                    }
                                }
                                break;
                            case "return receipt":
                                $newQty = (int)$item['tiQty'] - (int) $prevItem[0]['tiQty'];
                                if($newQty !== 0){
                                    $actualQty = $newQty * $item['stQty'];
                                    if($newQty > 0){
                                        $sign = -1;
                                        $logType = "return";
                                    }else{
                                        $logType = "restock";
                                    }
                                    $this->add_stockLog($item['stID'], $id, $logType, $date, $dateRecorded, $actualQty*$sign, NULL);
                                    $this->update_stockQty($item['stID'], $actualQty);
                                }
                                break;
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }
//     SELECT tID, tiID, tiQty
// FROM (transitems LEFT JOIN trans_items USING(tiID))
// LEFT JOIN transactions USING(tID)
// WHERE tiID = 1 AND tID = 1 AND tType = 'purchase order' AND tiStatus = 'pending';
    /*
     * if(epmty($prevItem)){
     *      switch($tType){
     *          case "delivery receipt":
     *              
     *              if()
     *          break;
     *          case "official receipt":
     *          break;
     *          case "return receipt":
     *          break;
     *      }
     * }else{
     * }
     * 
     *
     */
    function addEdit_transactionItem($item, $id, $type){
        if(!isset($item['tiID'])){
            $query = "INSERT INTO `transitems`(
                    tiID,
                    uomID,
                    stID,
                    tiName,
                    tiPrice,
                    tiDiscount,
                    tiStatus
                )
                VALUES(NULL, ?, ?, ?, ?, ?, ?);";
            $this->db->query($query, 
                array($item['tiUnit'],$item['stID'],$item['tiName'],$item['tiPrice'], 0, $item['tiStatus']));
            return $this->db->insert_id();
        }else{
            $query = "UPDATE transitems 
                SET 
                    uomID = ?,
                    stID = ?,
                    tiName = ?,
                    tiPrice = ?,
                    tiDiscount = ?,
                    tiStatus = ?
                WHERE
                    tiID = ?;";
            return $this->db->query($query,
                array($item['tiUnit'],$item['stID'],$item['tiName'],$item['tiPrice'], 0,$item['tiStatus'],$item['tiID']));
        }
    }

    function addEdit_trans_item($tiID, $tID, $tiQty, $tiSubtotal, $tiActualQty){
        $result = $this->db->query('SELECT
                    tiID,
                    tID,
                    tiQty,
                    tiActualQty,
                    stID
                FROM
                    trans_items
                LEFT JOIN transitems USING(tiID)
                WHERE
                    tiID = ? AND tID = ?;', array($tiID, $tID));
        echo json_encode($result->result_array());
        if($result->num_rows() === 1){
            $result = $result->result_array();
            return $this->db->query('UPDATE trans_items
                SET tiQty = ?, tiSubtotal = ?, tiActualQty = ?
                WHERE tiID = ? and tID = ?', array($tiQty, $tiSubtotal, $tiActualQty, $tiID, $tID));
        }else{
            return $this->db->query("INSERT INTO trans_items (
                tiID,
                tID,
                tiQty,
                tiSubtotal,
                tiActualQty
            )
            VALUES(?, ?, ?, ?, ?);", array($tiID, $tID, $tiQty, $tiSubtotal, $tiActualQty));
        }
    }
    function add_actlog($aID, $alDate, $alDesc, $defaultType, $additinalRemarks){
        $query = "INSERT INTO `activitylog`(
            `alID`,
            `aID`,
            `alDate`, 
            `alDesc`, 
            `alType`, 
            `additionalRemarks`
            ) 
            VALUES (NULL, ?, ?, ?, ?, ?)";
            return $this->db->query($query, array($aID, $alDate, $alDesc, $defaultType, $additinalRemarks));
    }
    function add_stockLog($stID, $tID, $slType, $slDateTime, $dateRecorded, $slQty, $slRemarks){
        $query = "INSERT INTO `stocklog`(
                `slID`,
                `stID`,
                `tID`,
                `slType`,
                `slDateTime`,
                `dateRecorded`,
                `slQty`,
                `slRemarks`
            )
            VALUES(NULL, ?, ?, ?, ?, ?, ?, ?);";
        return $this->db->query($query, array($stID, $tID, $slType, $slDateTime, $dateRecorded, $slQty, $slRemarks));
    }
    function update_stockQty($stID, $stQty){
        $query = "UPDATE stockitems
        SET
            stQty = stQty + ?
        WHERE
            stID = ?";
        return $this->db->query($query, array($stQty, $stID));
    }

    function get_stockLog($stID){
        $query = "SELECT
                slID,
                stID,
                uomAbbreviation,
                slType,
                DATE_FORMAT(slDateTime, '%b %d, %Y %r') AS slDateTime,
                stocklog.dateRecorded,
                slQty,
                slRemarks,
                tNum
            FROM
                (
                    stocklog
                LEFT JOIN stockitems USING(stID)
                )
            LEFT JOIN transactions USING(tID)
            LEFT JOIN uom USING(uomID)
            WHERE
                stID = ? AND slID >= (
                SELECT
                    MAX(slID)
                FROM
                    stocklog
                WHERE
                    slType = 'beginning' AND stID = ?
            )
            group by slDateTime, slType;";
        return $this->db->query($query,array($stID,$stID))->result_array();
    }
    
    function get_invPeriodStart($stID){
        return $this->db->query("SELECT
                    DATE_FORMAT(MAX(slDateTime), '%b %d, %Y %r') AS maxDate, slQty
                FROM
                    stocklog
                WHERE
                    slType = 'beginning' AND stID = ?
            ;",array($stID))->result_array();
    }
    function get_menudiscounts() {
        $query = "SELECT * FROM menudiscount INNER JOIN discounts USING (pmID)";
        return $this->db->query($query)->result_array();
    }

    function get_SPMs($spID){
        $query = "SELECT
            stID,
            CONCAT(
                stName,
                IF(stSize IS NULL, '', CONCAT(' ', stSize))
            ) AS stName,
            suppliermerchandise.uomID,
            uomAbbreviation,
            spmID,
            spmName,
            spmPrice,
            spmActualQty,
            spID,
            spName
        FROM
            (
                stockitems
            RIGHT JOIN(
                    suppliermerchandise
                LEFT JOIN supplier USING(spID)
                ) USING(stID)
            )
        LEFT JOIN uom on (suppliermerchandise.uomID = uom.uomID) 
        WHERE spID = ?";
        return $this->db->query($query, array($spID))->result_array();
    }
    function get_transactionsBySupplier($spID, $tTypes){
        $query = "SELECT
                spID,
                tID,
                tNum,
                DATE_FORMAT(tDate, '%b %d, %Y %r') AS tDate,
                DATE_FORMAT(dateRecorded, '%b %d, %Y %r') AS dateRecorded,
                tType,
                COUNT(tiID) as tCount
            FROM
                (transactions
            LEFT JOIN supplier USING(spID)) LEFT JOIN trans_items using(tID)
            WHERE
                spID = ? AND tType IN ?
            GROUP BY tID
            HAVING 
                COUNT(tiID) > 0
            ORDER BY transaction.tDate ASC;";
        return $this->db->query($query, array($spID, $tTypes))->result_array();
    }
    function get_transitemsBySupplier($spID, $tTypes){
        $query = "SELECT
            spID, tID, tiID, tiName, tiPrice, tiDiscount, tiStatus, tNum, tType,
            stID, CONCAT(stName, IF(stSize IS NULL,'',CONCAT(' ',stSize))) as stName, 
            ti.uomID AS uomID, uomAbbreviation, tiQty, tiActualQty, tiSubtotal
        FROM
            (
                (
                    (
                        (
                            transitems AS ti
                        LEFT JOIN uom ON
                            (ti.uomID = uom.uomID)
                        )
                    LEFT JOIN trans_items USING(tiID)
                    )
                LEFT JOIN transactions USING(tID)
                )
            LEFT JOIN supplier USING(spID)
            )
        LEFT JOIN stockitems AS st USING(stID)
        WHERE
            spID = ? AND tType IN ?;";
        return $this->db->query($query, array($spID, $tTypes))->result_array();
    }
    
}
?>
