<?php
class AdminModel extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    private $err = array('Username does not exist!', 'Incorrect password');
    
    function get_accounts(){
        $query = "Select * from accounts";
        return $this->db->query($query)->result_array();
    }
    function get_categories(){
        $query = "Select category_name, category_type from categories order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_inventory(){
        $query = "Select * from stockitems";
        return $this->db->query($query)->result_array();
    }
    function get_logs(){
        $query = "Select log_id, stock_name, quantity, log_date, log_type from log inner join stockitems using (stock_id)";
        return $this->db->query($query)->result_array();
    }
    function get_menu(){
        $query = "Select menu_name, menu_description, menu_price, menu_availability, menu_image, size, category_name from menu inner join categories using (category_id) order by category_name asc, menu_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_sales(){
        $query = "Select order_id, order_date_time, order_payable, pay_date_time, date_recorded, menu_name, order_qty, order_total from orderslip inner join orderlist using (order_id) inner join menu using (menu_id) where payment_status = 'paid';";
        return $this->db->query($query)->result_array();
    }
    function get_sources(){
        $query = "Select source_name, contact_num, status from sources order by source_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_spoilages_menu(){
        $query = "Select spoilages.sid, menu.menu_name,categories.category_type,spoilages.sqty,menu.size,spoilages.sdate, spoilages.date_recorded, spoilages.remarks from spoilages inner join menu using (menu_id) inner join categories using (category_id) where spoilages.stype = 'menu'";
        return  $this->db->query($query)->result_array();;
    }
    function get_spoilages_stock(){
        $query = "Select spoilages.sid, stockitems.stock_name,categories.category_type,spoilages.sqty,stockitems.stock_unit,spoilages.sdate, spoilages.date_recorded, spoilages.remarks from spoilages inner join stockitems using (stock_id) inner join categories using (category_id)";
        return  $this->db->query($query)->result_array();;
    }
    function get_tables(){
        $query = "Select * from tables";
        return $this->db->query($query)->result_array();
    }
    function get_transactions(){
        $query = "Select * from transactions inner join transitems using (trans_id)";
        return $this->db->query($query)->result_array();
    }
    function add_damages_menu($stype,$menu_name,$sqty,$sdate,$remarks){
        $menu_id = "(Select m.menu_id from menu AS m INNER JOIN spoilages AS s ON (m.menu_id) where m.menu_name = '$menu_name' GROUP by m.menu_id)";
        $query = "Insert into spoilages (stype, sqty, sdate, remarks, menu_id) values ('$stype', '$sqty', '$sdate', '$remarks', $menu_id)";
        $this->db->query($query);    
    }
    function add_damages_stock($stype,$stock_name,$sqty,$sdate,$remarks){
        $stock_id = "(Select st.stock_id from stockitems AS st INNER JOIN spoilages AS sp ON (st.stock_id) where st.stock_name = '$stock_name' GROUP by st.stock_id)";
        $query = "Insert into spoilages (stype, sqty, sdate, remarks, stock_id) values ('$stype', '$sqty', '$sdate', '$remarks', $stock_id)";
        $this->db->query($query);
    }
    function delete_spoilages($sid){
        $this->db->where('sid', $sid);
        $this->db->delete('spoilages');

	}
}
?>
