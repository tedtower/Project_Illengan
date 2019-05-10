<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Baristamodel extends CI_Model{
        
        function orderlist(){
            $this->load->database();
            $query = $this->db->query('SELECT * from orderslips join orderlists using (osID) join preferences using (prID)');
            return $query->result();
        }

        function show_orderslip(){
            $this->load->database();
            $query = $this->db->query('SELECT * from orderslips join orderlists using (osID) join preferences using (prID) GROUP BY tableCode');
            return $query->result();
        }

        function edit_tablenumber(){
            $osID=$this->input->post('osID');
            $tableCode=$this->input->post('tableCode');
    
            $this->db->set('osID', $osID);
            $this->db->set('tableCode', $tableCode);
            $this->db->where('osID', $osID);
            $result=$this->db->update('orderslips');
            return $result;

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

        function pending_orders(){
            $query = $this->db->query('SELECT * from orderslips join orderlists using (osID) join preferences using (prID)
             where orderlists.olStatus = "pending" ');
            return $query->result_array();
        }

        function served_orders(){
            $query = $this->db->query('SELECT * from orderslips join orderlists using (osID) join preferences using (prID) 
            where orderlists.olStatus = "served" ');
            return $query->result_array();
        }

        function get_bills(){
            $query = "select order_id, table_code, cust_name, total, order_date, if(pay_date_time is null, 'Unpaid', 'Paid') as pay_status , pay_date_time from orderslip";
            return $this->db->query($query)->result_array();
        }

        function get_orderlist($order_id){
            $query = "Select order_item_id, menu_name, order_qty, order_total from orderlist inner join menu using (menu_id) where order_id = ?";
            return $this->db->query($query, array($order_id))->result_array(); 
        }

        function get_orderslip($order_id){
            $query = "select order_id, table_code, cust_name, total, order_date, if(pay_date_time is null, 'Unpaid', 'Paid') as pay_status , pay_date_time from orderslip where order_id = ?";
            return $this->db->query($query, array($order_id))->result_array();
        }

        function update_billstatus($order_id, $payment_date_time = null, $date_recorded = null){
            $query = "update orderslip set pay_date_time = ?, date_recorded = ? where order_id=?";
            return $this->db->query($query, array($payment_date_time, $date_recorded, $order_id));
        }

    }

?>

