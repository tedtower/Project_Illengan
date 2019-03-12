<?php
class BaristaModel extends CI_Model{
    function get_bills(){
        $query = "Select * from orderslip";
        return $this->db->query($query)->result_array();
    }

    function get_orderlist($order_id){
        $query = "Select * from orderlist where order_id = ?";
        return $this->db->query($query, array($order_id))->result_array(); 
    }

    function get_orderslip($order_id){
        $query = "select * from orderslip where order_id = ?";
        return $this->db->query($query, array($order_id))->result_array();
    }

    function update_billstatus($order_id, $payment_date_time, $date_recorded){
        $query = "update orderslip set pay_date_time = ?, date_recorded = ? where order_id=?";
        return $this->db->query($query, array($payment_date_time, $date_recorded, $order_id));
    }

}
?>