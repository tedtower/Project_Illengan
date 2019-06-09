<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Baristamodel extends CI_Model{
        
        function get_orderlist($osID){
            $query = "Select olID, olDesc, olQty, olSubTotal from orderlists inner join preferences using (prID) where osID = ?";
            return $this->db->query($query, array($order_id))->result_array(); 
        }
        function orderlist(){
            $query = "SELECT * from orderslips join orderlists using (osID) join preferences using (prID)";
            return $this->db->query($query)->result_array();
        }
        function get_pendingOrders(){
            $status ="pending";
            $query = "SELECT * FROM orderslips left JOIN orderlists using (osID) where olStatus = ?;";
            return $this->db->query($query,array($status))->result_array();
        }
        function get_servedOrders(){
            $status ="served";
            $query = "SELECT * FROM orderslips left JOIN orderlists using (osID) where olStatus = ?;";
            return $this->db->query($query,array($status))->result_array();
        }
        // function get_orderslip(){
        //     $this->load->database();
        //     $query = $this->db->query('SELECT * from orderslips join orderlists using (osID) join preferences using (prID) GROUP BY tableCode');
        //     return $query->result();
        // }

        function get_orderslip(){
            $query = $this->db->query('SELECT osID, tableCode, custName, osTotal, payStatus, olQty, olDesc, olSubtotal, olStatus from orderslips inner join orderlists using (osID) GROUP BY osID, tableCode' );
            return $query->result();
    }
        function get_orderitems($osID){
            $query = "SELECT olDesc, olSubtotal,olQty,osTotal from orderlists join orderslips USING (osID) WHERE osID = ?";
            return $this->db->query($query,array($osID))->result_array();
        }

        function get_availableTables(){
            $query = "SELECT t.tableCode FROM tables t LEFT JOIN orderslips os on t.tableCode = os.tableCode where os.tableCode IS NULL ";
            return $this->db->query($query)->result_array();
        }

        function edit_tablenumber($tableCode, $osID){
             $query = "Update orderslips set tableCode = ? where osID=?";
             return $this->db->query($query,array($tableCode,$osID));
        }
        function cancelOrder(){
            $osID=$this->input->post('osID');
            $this->db->where('osID', $osID);
            $result=$this->db->delete('orderlists');
            return $result;
        }
        /*function search(){
            $query = $this->db
            ->select('*')
            ->from('orderslip')
            ->join('orderlist', 'orderslip.order_id=orderlist.order_id')
            ->join('menu', 'orderlist.menu_id=menu.menu_id')
            ->where('cust_name', $this->input->post('cust_name'))
            ->get();
         
         return $query->result_array();
      }*/

        function update_status($order_id, $order_desc, $item_status) {
            $data['item_status'] = $item_status;
            $query = $this->db->query('UPDATE orderlists SET olStatus = ? WHERE olID = ? AND osID = ?');
            $this->db->query($query, array($item_status, $order_item_id, $order_id));
        }

        //this function is for orderCards
        function get_slip_data(){
            $query = "select osID, custName, tableCode, payStatus from orderslips";
            return $this->db->query($query)->result_array();
        }


        function get_bills(){
            $query = "select osID, tableCode, custName, osTotal, osDateTime,(CAST(osDateTime AS time)) as time, payStatus , osPayDateTime from orderslips where CAST(osDateTime AS date) = cast((now()) as date) ORDER BY `orderslips`.`osDateTime` DESC ";
            return $this->db->query($query)->result_array();
        }

        function get_orderslips($osID){
            $query = "select osID, tableCode, custName, osTotal, osDate, if(osPayDate is null, 'Unpaid', 'Paid') as payStatus , osPayDate from orderslips where osID = ?";
            return $this->db->query($query, array($order_id))->result_array();
        }

        function get_orderlists($osID){
            $query = "Select olID, olDesc, olQty, olSubtotal from orderlists inner join preferences using (prID) inner join orderslips using (osID) where osID = ?";
            return $this->db->query($query, array($order_id))->result_array(); 
        }

        function update_billstatus($osID, $payment_date_time = null, $date_recorded = null){
            $query = "update orderslips set osPayDate = ?, osDateRecorded = ? where osID=?";
            return $this->db->query($query, array($payment_date_time, $date_recorded, $osID));
        }

        function get_inventory(){
            $query = "Select * from stockitems left join variance using (stID)";
            $query = "Select stID,stName,stStatus,stQty from stockitems";
            return $this->db->query($query)->result_array();
        }
        function restock($stocks,$date_recorded,$account_id){
            $query = "Update stockitems set stQty = ? + ? where stID = ?";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->db->query($query, array($stocks[$in]['curQty'], $stocks[$in]['stQty'], $stocks[$in]['stID'],  )); 
                    $this->add_stockLog($stocks[$in]['stID'], NULL,"restock", $date_recorded, $stocks[$in]['restock_date'], $stocks[$in]['stQty'], NULL);
                    $this->add_actlog($account_id,$date_recorded, "Barista performed a restocking of inventory.", "add", NULL);
                }
            }
        }
        function destock($stocks,$date_recorded,$account_id){
            $query = "Update stockitems set stQty = ? - ? where stID = ?";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->db->query($query, array($stocks[$in]['curQty'], $stocks[$in]['stQty'], $stocks[$in]['stID'])); 
                    $this->add_stockLog($stocks[$in]['stID'], NULL,$stocks[$in]['destock_type'], $date_recorded, $stocks[$in]['destock_date'], $stocks[$in]['stQty'], NULL);
                    $this->add_actlog($account_id,$date_recorded, "Barista performed a destocking  of inventory.", "add", NULL);
                }
            }
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
        function update_payment($status,$osID,$custName,$payDate, $date_recorded){
            $query = "Update orderslips set payStatus = ?, osPayDateTime = ?, osDateRecorded = ? where osID = ? AND custName = ?";
            $this->db->query($query, array($status,$payDate, $date_recorded, $osID, $custName));
        }

    }

?>

