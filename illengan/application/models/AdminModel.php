<?php
class AdminModel extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

        function add_damages($data){
        $this->db->insert("spoilages", $data);
    }
    function get_accounts(){
        $query = "Select * from accounts";
        return $this->db->query($query)->result_array();
    }
    //i'M CURRENTLY WORKING ON THIS
    function change_account_password($account_id){
        $query = "Update `accounts` set `account_password`= '$account_password' WHERE account_id = '$account_id'";
        return $this->db->query($query)->wresult_array();
    }
    function get_menucategories(){
        $query = "Select category_id, category_name, category_type, COUNT(menu_id) as menu_no from categories left join menu using (category_id) where category_type = 'menu' group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function add_menucategory($category_name){
        $query = "Insert into categories (category_id, category_name, category_type) values (NULL, ? ,'Menu')";
        return $this->db->query($query,array($category_name));
    }
    function edit_menucategory($category_id,$category_name){
        $query = "update categories set category_name = ?  where category_id = ? and category_type='menu'";
        return $this->db->query($query,array($category_name,$category_id));
    }
    function delete_menucategory($category_id){
        $query = "delete from categories where category_id = ? and category_type= 'menu'";
        return $this->db->query($query,array($category_id));
    }
    function get_stockcategories(){
        $query = "Select category_id, category_name, category_type, COUNT(stock_id) as stock_no from categories left join stockitems using (category_id) where category_type = 'Inventory' group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function add_stockcategory($category_name){
        $query = "Insert into categories (category_id, category_name, category_type) values (NULL, ? ,'Inventory')";
        return $this->db->query($query,array($category_name));
    }
    function edit_stockcategory($category_id,$category_name){
        $query = "update categories set category_name = ?  where category_id = ? and category_type='inventory'";
        return $this->db->query($query,array($category_name,$category_id));
    }
    function delete_stockcategory($category_id){
        $query = "delete from categories where category_id = ? and category_type= 'inventory'";
        return $this->db->query($query,array($category_id));
    }
    function get_inventory(){
        $query = "Select stock_id, stock_name, stock_quantity, stock_unit, stock_minimum, stock_status, category_name from stockitems inner join categories using (category_id)";
        return $this->db->query($query)->result_array();
    }
    function add_stockitem($stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id){
        $query = "Insert into stockitems (stock_id,stock_name,stock_quantity,stock_unit,stock_minimum,stock_status,category_id) values (NULL,?,?,?,?,?,?);";
        return $this->db->query($query,array($stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id));
    }
    function edit_stockitem($stock_id,$stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id){
        $query = "Update stockitems set stock_name = ?, stock_quantity = ?, stock_unit = ?, stock_minimum = ?, stock_status = ?, category_id = ? where stock_id=?;";
        return $this->db->query($query,array($stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id,$stock_id));
    }
    function get_logs(){
        $query = "Select log_id, stock_name, quantity, log_date, log_type, date_recorded from log inner join stockitems using (stock_id)";
        return $this->db->query($query)->result_array();
    }
    function get_menu(){
        $query = "Select menu_id, menu_name, menu_description, menu_price, menu_availability, menu_image, size, category_name from menu inner join categories using (category_id) order by category_name asc, menu_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_sales(){
        $query = "Select order_id, order_date_time, order_payable, pay_date_time, date_recorded, menu_name, order_qty, order_total from orderslip inner join orderlist using (order_id) inner join menu using (menu_id) where payment_status = 'paid';";
        return $this->db->query($query)->result_array();
    }
    function get_sources(){
        $query = "Select source_id, source_name, contact_num, status from sources order by source_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_spoilages_menu(){
        $query = "Select spoilages.sid, menu.menu_name,categories.category_type,spoilages.sqty,menu.size,spoilages.sdate, spoilages.date_recorded, spoilages.remarks from spoilages inner join menu using (menu_id) inner join categories using (category_id) where spoilages.stype = 'menu'";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilages_stock(){
        $query = "Select spoilages.sid, stockitems.stock_name,categories.category_type,spoilages.sqty,stockitems.stock_unit,spoilages.sdate, spoilages.date_recorded, spoilages.remarks from spoilages inner join stockitems using (stock_id) inner join categories using (category_id)";
        return  $this->db->query($query)->result_array();
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
    function get_tables(){
        $query = "Select * from tables";
        return $this->db->query($query)->result_array();
    }
    function get_transactions(){
        $query = "Select * from transactions inner join transitems using (trans_id)";
        return $this->db->query($query)->result_array();
    }
    function add_table($table_no){
        $query = "Insert into tables (table_no) values (?);";
        return $this->db->query($query, array($table_no));
    }

//DELETE FUNCTIONS---------------------------------------------------------------------------
    function delete_table($table_no){
        $query = "Delete from tables where table_no= ?";
        return $this->db->query($query, array($table_no));
    }
    function delete_stockitem($stock_id){
        $query = "Delete from stockitems where stock_id=?;";
        return $this->db->query($query, array($stock_id));
    }
}
?>
