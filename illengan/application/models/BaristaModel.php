<?php
class BaristaModel extends CI_Model{

    function view(){
        $this->load->database();
        $query = $this->db->query('SELECT * FROM ((orderlist ol INNER JOIN orderslip os ON ol.order_id = os.order_id)
        INNER JOIN menu mn ON mn.menu_id = ol.menu_id) ORDER BY os.order_id;');
        return $query->result();
    }

    /*function update_status($order_id, $menu_id, $item_status) {
        $data['item_status'] = $item_status;
        $query = $this->db->query('UPDATE orderlist SET item_status = ? WHERE order_id = ? AND menu_id = ?');
        $this->db->query($query, array($item_status, $order_id, $menu_id));
    }
*/

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