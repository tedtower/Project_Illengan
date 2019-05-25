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
        function get_orderslip(){
            $this->load->database();
            $query = $this->db->query('SELECT * from orderslips join orderlists using (osID) join preferences using (prID) GROUP BY tableCode');
            return $query->result();
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
            $query = $this->db->query('UPDATE orderlist SET item_status = ? WHERE order_item_id = ? AND order_id = ?');
            $this->db->query($query, array($item_status, $order_item_id, $order_id));
        }

        function get_bills(){
            $query = "select osID, tableCode, custName, osTotal, osDate, if(pay_date_time is null, 'Unpaid', 'Paid') as pay_status , osPayDate from orderslips";
            return $this->db->query($query)->result_array();
        }

        function update_billstatus($osID, $payment_date_time = null, $date_recorded = null){
            $query = "update orderslips set osPayDate = ?, osDateRecorded = ? where osID=?";
            return $this->db->query($query, array($payment_date_time, $date_recorded, $order_id));
        }

        function get_inventory(){
            $query = "Select * from stockitems left join variance using (stID)";
            return $this->db->query($query)->result_array();
        }

    }

?>

