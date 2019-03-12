<?php
class BaristaModel extends CI_Model{
    function get_bills(){
        $query = "Select * from orderslip";
        return $this->db->query($query)->result_array();
    }

    function get_billdetails($bill_id){
        $query = "Select * from orderlist where order_id = ?";
        return $this->db->query($query, array($bill_id)); 
    }

}
?>