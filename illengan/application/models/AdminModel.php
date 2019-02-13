<?php
class Admin_Model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    private $err = array('Username does not exist!', 'Incorrect password');

    function get_inventory(){
        $query = "Select * from stockitems";
        return $this->db->query($query)->result_array();
    }
    function add_damages($data){
        $this->db->insert("spoilages", $data);
    }

    function get_spoilages(){
        $query = "Select * from spoilages inner join stockitems using (stock_id) inner join using (menu_id)";
        return $this->db->query($query)->result_array();
    }
    function get_transactions(){
        $query = "Select * from transactions inner join transitems using (trans_id)";
        return $this->db->query($query)->result_array();
    }
    function get_sources(){
        $query = "Select source_name, contact_num, status from sources";
        return $this->db->query($query)->result_array();
    }
    function get_sales(){
        $query = "Select order_id, order_date_time, order_payable, pay_date_time, date_recorded, menu_name, order_qty, order_total from orderslip inner join orderlist using (order_id) inner join menu using (menu_id) where payment_status = 'paid';";
        return $this->db->query($query)->result_array();
    }
    function get_logs(){
        $query = "Select log_id, stock_name, quantity, log_date, log_type from log inner join stockitems using (stock_id)";
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
        $query = "Select menu_name, menu_description, menu_price, menu_availability, menu_image, size, category_name from menu inner join categories using (category_id)";
        return $this->db->query($query)->result_array();
    }
    function get_categories(){
        $query = "Select category_name, category_type from categories order by category_name asc";
        return $this->db->query($query)->result_array();
    }
}
?>
