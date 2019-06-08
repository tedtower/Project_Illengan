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
        $query = "insert into spoiledstock (ssID,stID,ssQty,ssDate,ssRemarks) values (?,?,?,?,?)";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                   $this->db->query($query, array($ssID, $stocks[$in]['stID'], $stocks[$in]['ssQty'], $stocks[$in]['ssDate'],$stocks[$in]['ssRemarks']));  
                   $this->destockvarItems($stocks[$in]['stID'],$stocks[$in]['curQty'],$stocks[$in]['ssQty']);    
                }    
            }
    }
    function destockvarItems($stID,$curQty,$ssQty){
        $query = "UPDATE stockitems 
        SET 
            stQty = ? - ?
        WHERE
            stID = ?;";
        return $this->db->query($query,array($curQty,$ssQty,$stID));
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
        $query = "INSERT INTO `stockitems`(
                `stID`,
                `ctID`,
                `uomID`,
                `stName`,
                `stQty`,
                `stMin`,
                `stType`,
                `stStatus`,
                `stBqty`,
                `stLocation`,
                `stSize`
            )
            VALUES(
                NULL,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            );";
        if($this->db->query($query,array($stockCategory, $stockUom, $stockName, $stockQty, $stockMin, $stockType, $stockStatus, $stockBqty, $stockLocation,$stockSize))){
            return true;
        }
        return false;
    }
    function add_table($tableCode){
        $query = "INSERT INTO TABLES(tableCode)
        VALUES(?);";
        return $this->db->query($query, array($tableCode));
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
        if(count($addon) > 0){
            for($n = 0; $n < count($addon) ; $n++){
                $this->db->query($query, array($mID, $addon[$n]['aoID']));
            }
        } else{
            return false;
        }
     }
     function add_salesOrder($tableCode, $custName, $osTotal, $osDateTime, $osPayDateTime, $osDateRecorded, $orderlists, $addons) {
        $query = "insert into orderslips (osID, tableCode, custName, osTotal, payStatus, 
        osDateTime, osPayDateTime, osDateRecorded) values (NULL,?,?,?,?,?,?,?);";
        if($this->db->query($query,array($tableCode, $custName, $osTotal, 'paid', $osDateTime, $osPayDateTime, $osDateRecorded))) {
            $this->add_salesList($this->db->insert_id(), $orderlists, $addons);
            }
        }

    function add_salesList($osID, $orderlists, $addons) {
        $query = "insert into orderlists (olID, prID, osID, olDesc, olQty, 
        olSubtotal, olStatus, olRemarks) values (NULL,?,?,?,?,?,?,?);";
        if(count($orderlists) > 0){
             for($in = 0; $in < count($orderlists) ; $in++){
              if($this->db->query($query, array($orderlists[$in]['prID'], $osID, $orderlists[$in]['olDesc'], 
              $orderlists[$in]['olQty'], $orderlists[$in]['olSubtotal'],'served', ' '))) {
                if(count($addons) > 0) {
                    $this->update_salesaddons($this->db->insert_id(), $orderlists[$in]['prID'], $addons);
                }
              }
        }
    }   else {
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

    
    function edit_sales($osID, $tableCodes, $custName, $osTotal, $payStatus, 
    $osDateTime, $osPayDateTime, $osDateRecorded, $orderlists, $addons) {
        $query = "UPDATE orderslips SET tableCode = ?, custName = ?, osTotal = ?, 
        osDateTime = ?, osPayDateTime = ? WHERE orderslips.osID = ?;";
        if($this->db->query($query, array($tableCodes, $custName, $osTotal, $osDateTime, $osPayDateTime, $osID))) {
            for($i = 0; $i < count($orderlists); $i++) {
                if($orderlists[$i]['del'] === 0) {
                    $this->delete_salesOrderitem($orderlists[$i]['olID']);
                }
                else if($orderlists[$i]['olID'] != null) {
                    $orlist = array(
                        'olID' => $orderlists[$i]['olID'],
                        'prID' => $orderlists[$i]['prID'],
                        'osID' => $orderlists[$i]['osID'],
                        'olDesc' => $orderlists[$i]['olDesc'],
                        'olQty' => $orderlists[$i]['olQty'],
                        'olSubtotal' => $orderlists[$i]['olSubtotal'],
                        'olStatus' => $orderlists[$i]['olStatus'],
                        'olRemarks' => $orderlists[$i]['olRemarks']
                    );
                    $this->edit_salesorders($orlist, $addons);
                } else {
                    $orderlist = array();
                    $olist = array(
                        'prID' => $orderlists[$i]['prID'],
                        'osID' => $orderlists[$i]['osID'],
                        'olDesc' => $orderlists[$i]['olDesc'],
                        'olQty' => $orderlists[$i]['olQty'],
                        'olSubtotal' => $orderlists[$i]['olSubtotal'],
                        'olStatus' => $orderlists[$i]['olStatus'],
                        'olRemarks' => $orderlists[$i]['olRemarks']
                    );
                    array_push($orderlist, $olist);
                    $this->add_salesList($osID, $orderlist, $addons);
                } }   
        }
    }

    function edit_salesorders($orlist, $addons) {
        $query = "UPDATE orderlists SET prID = ?, osID = ?, olDesc = ?, 
        olQty = ?, olSubtotal = ? WHERE orderlists.olID = ?;";
        if($this->db->query($query, array($orlist['prID'], $orlist['osID'], $orlist['olDesc'], 
        $orlist['olQty'], $orlist['olSubtotal'], $orlist['olID'])))  {
            if(count($addons) > 0) {
              $this->update_salesaddons($orlist['olID'], $orlist['prID'], $addons);
            }
        }
        
    }

    function update_salesaddons($olID, $prID, $addons) {
            for($i = 0; $i < count($addons); $i++) {
                if($addons[$i]['olID'] == null){
                    $addonsArr = array();
                    $aolist = array(
                        'prID' => $addons[$i]['prID'],
                        'aoID' => $addons[$i]['aoID'],
                        'aoQty' => $addons[$i]['aoQty'],
                        'aoTotal' => $addons[$i]['aoTotal']
                    );
                    array_push($addonsArr, $aolist);
                    $this->add_salesAddons($olID, $prID, $addonsArr);
                } 
                else if($addons[$i]['del'] === 0 ) {
                    $this->delete_salesAddons($addons[$i]['aoID'], $addons[$i]['olID']);
                } else if(intval($addons[$i]['oldaoID']) !== intval($addons[$i]['aoID'])) {
                    $this->update_changedAddon($addons[$i]['oldaoID'], $addons[$i]['aoID'], $addons[$i]['olID']);
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
        $this->db->query($query, array(intval($aoID, $oldaoID, $olID));

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
    function edit_stockItem($stockCategory, $stockLocation, $stockMin, $stockName, $stockQty, $stockStatus, $stockType, $stockUom, $stockSize, $stockID){
        $query = "UPDATE
            stockitems
        SET
            ctID = ?,
            stLocation = ?,
            stMin = ?,
            stName = ?,
            stQty = ?,
            stStatus = ?,
            stType = ?,
            uomID = ?,
            stSize = ?
        WHERE
            stID = ?;";
        if($this->db->query($query,array($stockCategory, $stockLocation, $stockMin, $stockName, $stockQty, $stockStatus, $stockType, $stockUom, $stockSize, $stockID))){
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
    function get_supplierNames(){
        $query = "Select spID, spName from supplier order by spName";
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
        $query = "Select ssID,stID,stName,stLocation,ssQty,stQty,ssDate,ssDateRecorded,ssRemarks from stockspoil inner join spoiledstock using (ssID) inner join stockitems using (stID)";
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
                LEFT JOIN
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
    

//DELETE FUNCTIONS---------------------------------------------------------------------------
    function delete_account($accountId){
        $query = "Delete from accounts where aID = ?";
        return $this->db->query($query, array($accountId));
    }
    function delete_addon($id){
        $query = "UPDATE addons set aoStatus = 'archived' where aoID = ?"; 
        return $this->db->query($query, array($id));
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
            uomAbbreviation
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
            stName,
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
            tDate,
            dateRecorded,
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
            tID;";
        return $this->db->query($query)->result_array();
    }
    function get_transaction($id){
        $query = "SELECT
            tID,
            tNum,
            tType,
            tDate,
            dateRecorded,
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
        WHERE 
            tID = ?;";
        return $this->db->query($query, arrray($id))->result_array();
    }
    function get_transitems($id=null){
        if($id == null){
            $query = "SELECT
                tID,
                tiID,
                tiName,
                tiQty,
                tiActualQty,
                uomID,
                uomAbbreviation,
                tiPrice,
                tiDiscount,
                tiSubtotal,
                tiStatus
            FROM
                (
                    (
                        transitems
                    LEFT JOIN uom USING(uomID)
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
                uomID,
                uomAbbreviation,
                tiPrice,
                tiDiscount,
                tiSubtotal,
                tiStatus
            FROM
                (
                    (
                        transitems
                    LEFT JOIN uom USING(uomID)
                    )
                LEFT JOIN trans_items USING(tiID)
                )
            LEFT JOIN transactions USING(tID)
            WHERE
                tID = ?;";
            return $this->db->query($query,array($id))->result_array();
        }
    } 


    /*
     * 1] Add a transaction record (add_transaction function)
     * 2] Add the items under the transaction receipt (addEdit_transitem function)
     * 3] Add a log for stocks
     * 4] Make changes to stock quantity 
     */
    function add_transaction($id, $supplier, $receipt, $date, $type, $dateRecorded, $remarks, $transitems){
        $query = "";
        $insertSuccess = false;
        if($id == null){
            $query = "INSERT INTO `transactions`(
                `tID`,
                `spID`,
                `tNum`,
                `tDate`,
                `tType`,
                `dateRecorded`,
                `tRemarks`
            )
            VALUES(NULL, ?, ?, ?, ?, ?, ?);";
            $insertSuccess = $this->db->query($query, 
            array($supplier, $receipt, $date, $type, $dateRecorded, $remarks));
            $id = $this->db->insert_id();
        }else{
            $query = "UPDATE transactions 
                SET 
                    spID = ?,
                    tNum = ?,
                    tDate = ?,
                    tType = ?,
                    dateRecorded = ?,
                    tRemarks = ?
                WHERE
                    tID = '?;";
            $insertSuccess = $this->db->query($query, array($supplier, $receipt, $date, $type, $dateRecorded, $remarks, $id));
        }
        if($insertSuccess){
            $indexes = [];
            $count = 0;
            foreach($transitems as $item){
                if(!$this->addEdit_transactionItem($item, $id, $type)){
                    array_push($indexes,$count);
                }
                $count++;
            }
            // echo json_encode(array("erredQ" =>$indexes, "data"=> $transitems));
            return true;
        }
        return false;
    }
    function addEdit_transactionItem($item,$id, $type){
        $query = "";
        if($item['tiID'] == null){
            //add tiDiscount after tiPrice
            $query = "INSERT INTO `transitems`(
                    tiID,
                    uomID,
                    stID,
                    tiName,
                    tiPrice,
                    tiStatus
                )
                VALUES(NULL, ?, ?, ?, ?
                , ?);";
            $this->db->query($query, 
                array($item['tiUnit'],$item['stID'],$item['tiName'],$item['tiPrice']
                // ,$item['tiDiscount']
                ,$item['tiStatus']));
            $itemID = $this->db->insert_id();
            $this->add_trans_item($itemID, $id, $item['tiQty'], $item['tiSubtotal'], $item['stQty']);
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
            $this->db->query($query,
                array($item['tiUnit'],$item['stID'],$item['tiName'],$item['tiPrice'],$item['tiDiscount'],$item['tiStatus'],$item['tiID']));
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
                    tiID = ? AND tID = ?;', array($item['tiID'], $id));
            //insert codes to add adjusting entry for previous stock item
            //then add entry for new item
            if($result->num_rows() === 1){
                $result = $result->result_array();
                $qty = $result[0]['tiQty'] < $item['tiQty'] ? $item['tiQty'] - $result[0]['tiQty'] : $result[0]['tiQty'] - $item['tiQty'];
                $this->db->query('UPDATE trans_items
                    SET
                        tiQty = ?,
                        tiSubtotal = ?,
                        tiActualQty = ?
                    WHERE
                        tiID = ? and tID = ?',array($item['tiID'], $id));
            }else{
                if($this->add_trans_item($item['tiID'], $id, $item['tiQty'], $item['tiSubtotal'], $item['stQty'])){
                    $qty = (int) $item['tiQty'] * (int) $item['stQty'];
                    switch($type){
                        case "delivery receipt" : 
                            if($this->add_stockLog($item['stID'],$id,'restock', date("Y-m-d H:i:s"), $qty)){
                                $this->add_stockQty($item['stID'], $qty);
                            }
                            break;
                        case "official receipt" :
                            $result = $this->db->query("SELECT
                                    tiID,
                                    tID,
                                    tType
                                FROM
                                    (
                                        transitems
                                    LEFT JOIN trans_items USING(tiID)
                                    )
                                LEFT JOIN transactions USING(tID)
                                WHERE
                                    tType = 'delivery receipt' and tiID = ?;", array($item['tiID']));
                            if($result->num_rows() == 0){
                                if($this->add_stockLog($item['stID'],$id,'restock', date("Y-m-d H:i:s"), $qty)){
                                    $this->add_stockQty($item['stID'], $qty);
                                }
                            }
                    }
                }
            }
        }
        return;
    }
    //
    // $this->db->query("UPDATE transitems
    // SET
    //     tiStatus = 'paid'
    // WHERE
    //     tiID = ?",array($item['tiID']));

    function add_trans_item($tiID, $tID, $tiQty, $tiSubtotal, $tiActualQty){
        $query = "INSERT INTO trans_items (
                tiID,
                tID,
                tiQty,
                tiSubtotal,
                tiActualQty
            )
            VALUES(?, ?, ?, ?, ?);";
        return $this->db->query($query, array($tiID, $tID, $tiQty, $tiSubtotal, $tiActualQty));
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

    function add_stockQty($stID, $stQty){
        $query = "UPDATE stockitems
        SET
            stQty = stQty + ?
        WHERE
            stID = ?";
        return $this->db->query($query, array($stQty, $stID));
    }

}

?>
