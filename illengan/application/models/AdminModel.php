<?php
class AdminModel extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

    //INSERT FUNCTIONS----------------------------------------------------------------
    function add_accounts($data){
        $this->db->insert('Accounts',$data);
    }
    function add_menuspoil($menu_id,$s_type,$s_date,$date_recorded,$remarks=null){
        $query = "insert into spoilage (s_id, stype, s_date, date_recorded, remarks) values (Null,?,?,?,?)";
        if($this->db->query($query,array($s_type,$s_date,$date_recorded,$remarks))){ 
            $query = "insert into menuspoil values (?,?)";
            return $this->db->query($query,array($this->db->insert_id(),$menu_id));
        }else{
            return false;
        }
    }
    function add_stockspoil($stock_id,$s_type,$s_date,$date_recorded,$remarks=null){
        $query = "insert into spoilage (s_id, stype, s_date, date_recorded, remarks) values (Null,?,?,?,?)";
        if($this->db->query($query,array($s_type,$s_date,$date_recorded,$remarks))){ 
            $query = "insert into stockspoil values (?,?)";
            return $this->db->query($query,array($this->db->insert_id(),$stock_id));
        }else{
            return false;
        }
    }
    function add_aospoil($ao_id,$s_type,$s_date,$date_recorded,$remarks=null){
        $query = "insert into spoilage (s_id, stype, s_date, date_recorded, remarks) values (Null,?,?,?,?)";
        if($this->db->query($query,array($s_type,$s_date,$date_recorded,$remarks))){ 
            $query = "insert into ao_spoil values (?,?)";
            return $this->db->query($query,array($this->db->insert_id(),$ao_id));
        }else{
            return false;
        }
    }
    function add_damages_menu($stype,$menu_name,$sqty,$sdate,$remarks){
        $menu_id = "(Select m.menu_id from menu AS m INNER JOIN spoilages AS s ON (m.menu_id) where m.menu_name = '$menu_name' GROUP by m.menu_id)";
        $query = "Insert into spoilages (stype, sqty, sdate, remarks, menu_id) values (?,?,?,?,?)";
        return $this->db->query($query, array($stype, $sqty, $sdate, $remarks, $menu_id));   
    }
    function add_damages_stock($stype,$stock_name,$sqty,$sdate,$remarks){
        $stock_id = "(Select st.stock_id from stockitems AS st INNER JOIN spoilages AS sp ON (st.stock_id) where st.stock_name = '$stock_name' GROUP by st.stock_id)";
        $query = "Insert into spoilages (stype, sqty, sdate, remarks, stock_id) values (?,?,?,?,?)";
        return $this->db->query($query, array($stype, $sqty, $sdate, $remarks, $stock_id)); 
    }
    function add_menucategory($category_name){
        $query = "Insert into categories (category_id, category_name, category_type) values (NULL, ? ,'Menu')";
        return $this->db->query($query,array($category_name));
    }
    function add_stockcategory($category_name){
        $query = "Insert into categories (category_id, category_name, category_type) values (NULL, ? ,'Inventory')";
        return $this->db->query($query,array($category_name));
    }
    function add_stockitem($stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id){
        $query = "Insert into stockitems (stock_id,stock_name,stock_quantity,stock_unit,stock_minimum,stock_status,category_id) values (NULL,?,?,?,?,?,?);";
        return $this->db->query($query,array($stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id));
    }
    function add_table($table_no){
        $query = "Insert into tables (table_no) values (?);";
        return $this->db->query($query, array($table_code));
    }
    
    
    // UPDATE FUNCTIONS-------------------------------------------------------------
    function change_account_password($old_password,$new_password, $account_id){
        
        $current_password_query = "select account_password from accounts where account_id = $account_id ";
        $current_password = $this->db->query($current_password_query);
            foreach($current_password->result_array() AS $row) {

            if($old_password == $row['account_password']){
                $query = "update accounts set account_password = ?  where account_id = ? ";
                return $this->db->query($query,array($new_password, $account_id));  
            }else{
                $data['account_id'] = $account_id;
                $this->load->view('admin/changepassword', $data);
            }
        }
    }
    function edit_menuspoilage($s_id,$menu_id,$s_type,$s_date,$date_recorded,$remarks){
        $query = "update spoilage set s_type = ?, s_date = ?, date_recorded = ?, remarks=? where s_id=?";
        if($this->db->query($query,array($stype,$s_date,$date_recorded,$remarks,$s_id))){
            $query = "Update menuspoil set menu_id = ? where s_id = ?";
            return $this->db->query($query,array($menu_id,$s_id));
        }else{
            return false;
        }
    }
    function edit_stockspoilage($s_id,$stock_id,$s_type,$s_date,$date_recorded,$remarks){
        $query = "update spoilage set s_type = ?, s_date = ?, date_recorded = ?, remarks=? where s_id=?";
        if($this->db->query($query,array($stype,$s_date,$date_recorded,$remarks,$s_id))){
            $query = "Update stockspoil set stock_id = ? where s_id = ?";
            return $this->db->query($query,array($stock_id,$s_id));
        }else{
            return false;
        }
    }
    function edit_aospoilage($s_id,$ao_id,$s_type,$s_date,$date_recorded,$remarks){
        $query = "update spoilage set s_type = ?, s_date = ?, date_recorded = ?, remarks=? where s_id=?";
        if($this->db->query($query,array($stype,$s_date,$date_recorded,$remarks,$s_id))){
            $query = "Update ao_spoil set ao_id = ? where s_id = ?";
            return $this->db->query($query,array($ao_id,$s_id));
        }else{
            return false;
        }
    }
    function edit_menucategory($category_id,$category_name){
        $query = "update categories set category_name = ?  where category_id = ? and category_type='menu'";
        return $this->db->query($query,array($category_name,$category_id));
    }
    function edit_stockcategory($category_id,$category_name){
        $query = "update categories set category_name = ?  where category_id = ? and category_type='inventory'";
        return $this->db->query($query,array($category_name,$category_id));
    }
    function edit_stockitem($stock_id,$stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id){
        $query = "Update stockitems set stock_name = ?, stock_quantity = ?, stock_unit = ?, stock_minimum = ?, stock_status = ?, category_id = ? where stock_id=?;";
        return $this->db->query($query,array($stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id,$stock_id));
    }


    //SELECT FUNCTIONS------------------------------------------------------------------
    
    function get_accounts(){
        $query = "Select * from accounts";
        return $this->db->query($query)->result_array();
    }
    function get_inventory(){
        $query = "Select stock_id, stock_name, stock_quantity, stock_unit, stock_minimum, stock_status, category_name from stockitems inner join categories using (category_id)";
        return $this->db->query($query)->result_array();
    }
    function get_logs(){
        $query = "Select log_id, stock_name, quantity, log_date, log_type, date_recorded from log inner join stockitems using (stock_id)";
        return $this->db->query($query)->result_array();
    }
    function get_menu(){
        $query = "Select menu_id, menu_name, menu_description, menu_availability, menu_image, category_name, temp from menu inner join categories using (category_id) order by category_name asc, menu_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_menuprices(){
        $query = "select menu_id, size_name, size_price from sizes";
        return $this->db->query($query)->result_array();
    }
    function get_menucategories(){
        $query = "Select category_id, category_name, category_type, COUNT(menu_id) as menu_no from categories left join menu using (category_id) where category_type = 'menu' group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_menumaincategories(){
        $query = "Select category_id, category_name, category_type, COUNT(menu_id) as menu_no from categories left join menu using (category_id) where category_type = 'menu' and supcat_id is null group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_menusubcategories(){
        $query = "Select category_id, category_name, category_type, COUNT(menu_id) as menu_no from categories left join menu using (category_id) where category_type = 'menu' and supcat_id is not null group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_sales(){
        $query = "Select order_id, order_date_time, order_payable, pay_date_time, date_recorded, menu_name, order_qty, order_total from orderslip inner join orderlist using (order_id) inner join menu using (menu_id) where payment_status = 'paid';";
        return $this->db->query($query)->result_array();
    }
    function get_stockcategories(){
        $query = "Select category_id, category_name, category_type, COUNT(stock_id) as stock_no from categories left join stockitems using (category_id) where category_type = 'Inventory' group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_stockmaincategories(){
        $query = "Select category_id, category_name, category_type, COUNT(stock_id) as stock_no from categories left join stockitems using (category_id) where category_type = 'Inventory' and supcat_id is null group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_stocksubcategories(){
        $query = "Select category_id, category_name, category_type, COUNT(stock_id) as stock_no from categories left join stockitems using (category_id) where category_type = 'Inventory' and supcat_id is not null group by category_id order by category_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_sources(){
        $query = "Select source_id, source_name, contact_num, email, status from sources order by source_name asc";
        return $this->db->query($query)->result_array();
    }
    function get_spoilages_menu(){
        $query = "Select s_id, menu_name , s_qty, sdate, date_recorded, remarks from spoilages inner join menuspoil using (s_id) inner join menu using (menu_id)";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilages_stock(){
        $query = "Select spoilages.s_id, stock_name,s_qty,stock_unit,sdate, date_recorded, remarks from spoilages inner join stockspoil using (s_id) inner join stockitems using (stock_id)";
        return  $this->db->query($query)->result_array();
    }
    function get_tables(){
        $query = "Select * from tables";
        return $this->db->query($query)->result_array();
    }
    function get_transactions(){
        $query = "Select trans_id, receipt_no, source_name, trans_amt, trans_date, date_recorded, remarks from transactions left join sources using (source_id)";
        return $this->db->query($query)->result_array();
    }
    function get_transitems(){
        $query = "Select trans_id, item_name, item_qty, item_unit, item_price, item_qty*item_price as total_price from transitems";
        return $this->db->query($query)->result_array();
    }


//DELETE FUNCTIONS---------------------------------------------------------------------------
    function delete_account($account_id){
        $query = "delete from accounts where account_id = ?";
        return $this->db->query($query,array($account_id));

    }
    function delete_menucategory($category_id){
        $query = "delete from categories where category_id = ? and category_type= 'menu'";
        return $this->db->query($query,array($category_id));
    }
    function delete_spoilages($sid){
        $this->db->where('sid', $sid);
        $this->db->delete('spoilages');
    }
    function delete_stockcategory($category_id){
        $query = "delete from categories where category_id = ? and category_type= 'inventory'";
        return $this->db->query($query,array($category_id));
    }
    function delete_stockitem($stock_id){
        $query = "Delete from stockitems where stock_id=?;";
        return $this->db->query($query, array($stock_id));
    }
    function delete_table($table_no){
        $query = "Delete from tables where table_no= ?";
        return $this->db->query($query, array($table_no));
    }

}
?>
