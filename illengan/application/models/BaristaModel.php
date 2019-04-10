<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class BaristaModel extends CI_Model{
        
        function orderlist(){
            $this->load->database();
            $query = $this->db->query('SELECT * from orderslip join orderlist using (order_id) join preferences using (pref_id)');
            return $query->result();
        }

        function show_orderslip(){
            $this->load->database();
            $query = $this->db->query('SELECT * from orderslip join orderlist using (order_id) join preferences using (pref_id) GROUP BY table_code');
            return $query->result();
        }

        function edit_tablenumber(){
            $order_id=$this->input->post('order_id');
            $table_code=$this->input->post('table_code');
    
            $this->db->set('order_id', $order_id);
            $this->db->set('table_code', $table_code);
            $this->db->where('order_id', $order_id);
            $result=$this->db->update('orderslip');
            return $result;

        }

        function cancelOrder(){
            $order_id=$this->input->post('order_id');
            $this->db->where('order_id', $order_id);
            $result=$this->db->delete('orderlist');
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
            $query = $this->db->query('SELECT * from orderslip join orderlist using (order_id) join preferences using (pref_id)
             where orderlist.item_status = "pending" ');
            return $query->result_array();
        }

        function served_orders(){
            $query = $this->db->query('SELECT * from orderslip join orderlist using (order_id) join preferences using (pref_id) 
            where orderlist.item_status = "served" ');
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

