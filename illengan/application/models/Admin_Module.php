<?php
class Admin_Module extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

    function get_inventory(){
        $query = "Select * from stockitems";
        return $this->db->query($query)->result_array();
    }
    function add_damages($data){
        $this->load->database();
        $this->db->insert("spoilages", $data);
    }

    function get_spoilages(){
        $query = "Select * from spoilages";
        return $this->db->query($query)->result_array();
    }
    function get_transactions(){
        $query = "Select * from transactions inner join transitems using (trans_id)";
        return $this->db->query($query)->result_array();
    }
    function get_sources(){
        $query = "Select * from sources";
        return $this->db->query($query)->result_array();
    }
    function get_sales(){
        $query = "Select * from orderslip inner join orderlist using (order_id)";
        return $this->db->query($query)->result_array();
    }
    function get_destock(){
        $query = "Select * from destock";
        return $this->db->query($query)->result_array();
    }
    function get_tables(){
        $query = "Select * from tables";
        return $this->db->query($query)->result_array();
    }
    function get_accounts(){
        $query = "Select * from accounts";
        return $this->db->query($query)->result_array();
    }
    function get_menu(){
        $query = "Select * from menu";
        return $this->db->query($query)->result_array();
    }
    function get_categories(){
        $query = "Select * from categories";
        return $this->db->query($query)->result_array();
    }
}
?>