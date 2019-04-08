<?php
class AdminModel extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

    //INSERT FUNCTIONS----------------------------------------------------------------
    function add_accounts($data){
        $this->db->insert('Accounts',$data);
    }
    function add_menuspoil($s_type,$menu_name,$s_qty,$s_date,$date_recorded,$remarks){
        $query1 = "select menu_id from `menu` where menu_name = ? ";
        $menu_id = $this->db->query($query1,array($menu_name));
        foreach($menu_id->result_array() AS $row) {
            $query = "insert into spoilage (s_id, s_type, s_qty, s_date, date_recorded, remarks) values (NULL,?,?,?,?,?)";
            if($this->db->query($query,array($s_type,$s_qty,$s_date,$date_recorded,$remarks))){ 
                $query = "insert into menuspoil values (?,?)";
                return $this->db->query($query,array($this->db->insert_id(),$row['menu_id']));
            }else{
                return false;
            }
        }
    }
    function add_stockspoil($s_type,$stock_name,$s_qty,$s_date,$date_recorded,$remarks){
        $query1 = "select stock_id from `stockitems` where stock_name = ? ";
        $stock_id = $this->db->query($query1,array($stock_name));
        foreach($stock_id->result_array() AS $row) {
            $query = "insert into spoilage (s_id, s_type, s_qty, s_date, date_recorded, remarks) values (NULL,?,?,?,?,?)";
            if($this->db->query($query,array($s_type,$s_qty,$s_date,$date_recorded,$remarks))){ 
                $query = "insert into stockspoil values (?,?)";
                return $this->db->query($query,array($this->db->insert_id(),$row['stock_id']));
            }else{
                return false;
            }
        }
    }
    function add_aospoil($s_type,$ao_name,$s_qty,$s_date,$date_recorded,$remarks){
        $query1 = "select ao_id from `addons` where ao_name = ? ";
        $ao_id = $this->db->query($query1,array($ao_name));
        foreach($ao_id->result_array() AS $row) {
            $query = "insert into spoilage (s_id, s_type, s_qty, s_date, date_recorded, remarks) values (NULL,?,?,?,?,?)";
            if($this->db->query($query,array($s_type,$s_qty,$s_date,$date_recorded,$remarks))){ 
                $query = "insert into ao_spoil values (?,?)";
                return $this->db->query($query,array($this->db->insert_id(),$row['ao_id']));
            }else{
                return false;
            }
        }
        $query = "insert into spoilage (s_id, s_type, s_date, date_recorded, remarks) values (Null,?,?,?,?)";
        if($this->db->query($query,array($s_type,$s_date,$date_recorded,$remarks))){ 
            $query = "insert into ao_spoil values (?,?)";
            return $this->db->query($query,array($this->db->insert_id(),$ao_id));
        }else{
            return false;
        }
    }

    function add_menucategory($category_name, $superCategory){
        $query = "Insert into categories (category_id, category_name, supcat_id, category_type) values (NULL, ?, ? ,'Menu')";
        return $this->db->query($query,array($category_name));
    }
    function add_stockcategory($category_name, $superCategory){
        $query = "Insert into categories (category_id, category_name, supcat_id, category_type) values (NULL, ? , ? ,'Inventory')";
        return $this->db->query($query,array($category_name, $superCategory));
    }
    function add_stockitem($stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id){
        $query = "Insert into stockitems (stock_id,stock_name,stock_quantity,stock_unit,stock_minimum,stock_status,category_id) values (NULL,?,?,?,?,?,?);";
        return $this->db->query($query,array($stock_name,$stock_quantity,$stock_unit,$stock_minimum,$stock_status,$category_id));
    }
    function add_table($table_code){
        $query = "Insert into tables (table_code) values (?);";
        return $this->db->query($query, array($table_code));
    }
    function add_transaction($source_id, $receipt_no, $trans_amt, $trans_date, $date_recorded, $remarks, $transitems){
        $query = "Insert into transactions (source_id, receipt_no, trans_amt, trans_date, date_recorded, remarks) values (?,?,?,?,?,?)";
        $bool = $this->db->query($query, array($source_id, $receipt_no, $trans_amt, $trans_date, $date_recorded, $remarks));
        if(!$bool){
            $trans_id = $this->db->insert_id();
            $query = "Insert into transitems values (?,?,?,?,?)";
            foreach($transitems as $transitem){
                $bool = $this->db->query($query,array($trans_id, $transitem['item_name'], $transitem['item_qty'], $transitem['item_unit'], $transitem['item_price']));
            }
        }
        return $bool;
    }
    
    
    // UPDATE FUNCTIONS-------------------------------------------------------------
    function get_password($account_id){
        $query = "select account_password from accounts where account_id = ? ";
        return $this->db->query($query,array($account_id))->result_array();
    }

    function change_account_password($new_password, $account_id){
        $query = "update accounts set account_password = ?  where account_id = ? ";
        return $this->db->query($query,array($new_password, $account_id));  
           
    }

    // function change_account_password($old_password,$new_password, $account_id){

    //     $query2 = "select account_password from accounts where account_id = ? ";
    //     $current_password = $this->db->query($query2,array($account_id));
    //         foreach($current_password->result() AS $row) {

    //         if(password_verify($row->account_password,$old_password)){
    //             $query = "update accounts set account_password = ?  where account_id = ? ";
    //             return $this->db->query($query,array($new_password, $account_id));  
    //         }else{
                
    //             echo $old_password;
    //             echo "====";
    //             echo $row->account_password;
                
    //             echo "there is a problem in model";
    //             // $data['account_id'] = $account_id;
    //             // $this->load->view('admin/changepassword', $data);
    //         }
    //     }
    // }

    function edit_accounts($data,$account_id){
        $this->db->where('account_id', $account_id);
        $this->db->update('accounts', $data);
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
    function edit_transaction($trans_id, $source_id, $receipt_no, $trans_amt, $trans_date, $date_recorded, $remarks, $transitems){
        $query = "Update transactions set source_id = ?, receipt_no = ?, trans_amt = ?, trans_date = ?, date_recorded = ?, remarks = ? where trans_id = ?";
        $bool = $this->db->query($query, array($source_id, $receipt_no, $trans_amt, $trans_date, $date_recorded, $remarks, $trans_id));
        if(!$bool){
            //transitems array includes previous name and new name
            $query = "Update transitems set item_name = ?, item_qty = ?, item_unit = ?, item_price = ? where trans_id = ? and item_name = ?";
            foreach($transitems as $transitem){
                $bool = $this->db->query($query, array($transitem['new_item_name'], $transitem['new_item_qty'], $transitem['new_item_unit'], $transitem['new_item_price'], $trans_id, $transitem['old_item_name']));
            }
        }else{
            return false;
        }
        return $bool;
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
    //Menu management
    function get_menu(){
        $query = "Select * from menu inner join categories using (category_id) order by category_name asc, menu_name asc";
        return $this->db->query($query)->result_array();
    }
    //for spoilage
    function get_menu2(){
        $query = "Select * from menu";
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

    function add_menu($menu_name, $menu_description, $category_id, $menu_price, $picture){
        $query = "Insert into menu (menu_id, menu_name, menu_description, category_id, menu_price, menu_image, size, menu_availability) values (NULL,?,?,?,?,?, NULL,'Available')";
        return $this->db->query($query,array($menu_name, $menu_description, $category_id, $menu_price, $picture));

    }
    function get_sales(){
        $query = "Select order_id, order_date_time, order_payable, pay_date_time, date_recorded, menu_name, order_qty, order_total from orderslip inner join orderlist using (order_id) inner join menu using (menu_id) where payment_status = 'paid';";
        return $this->db->query($query)->result_array();
    }
    function get_stock(){
        $query = "Select * from stockitems";
        return $this->db->query($query)->result_array();
    }
    function get_addons(){
        $query = "Select * from addons";
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
    function get_spoilages(){
        $query = "select s_id, menu_name AS description, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN menuspoil USING (s_id) inner JOIN menu USING (menu_id) UNION select s_id, stock_name AS decription, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN stockspoil USING (s_id) inner JOIN stockitems USING (stock_id) UNION select s_id, ao_name AS description, s_qty, s_date, date_recorded,remarks FROM spoilage left JOIN ao_spoil USING (s_id) inner JOIN addons USING (ao_id) ORDER BY date_recorded";
        return $this->db->query($query)->result_array();
    }
    function get_spoilages_menu(){
        $query = "Select s_id, menu_name , s_qty, s_date, date_recorded, remarks from spoilage inner join menuspoil using (s_id) inner join menu using (menu_id)";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilages_stock(){
        $query = "Select s_id, stock_name,s_qty,stock_unit,s_date, date_recorded, remarks from spoilage inner join stockspoil using (s_id) inner join stockitems using (stock_id)";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilages_ao(){
        $query = "Select s_id, ao_name,s_qty, ao_category,s_date, date_recorded, remarks from spoilage INNER JOIN ao_spoil using (s_id)INNER JOIN addons using (ao_id)";
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

    function get_samplemethod($id){
        $query = "Select trans_id, item_name, item_qty, item_unit, item_price, item_qty*item_price as total_price from transitems where trans_id=?";
        return $this->db->query($query, array($id))->result_array();
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
    function delete_spoilages($s_id){
        $this->db->where('s_id', $s_id);
        $this->db->delete('spoilage');
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
    function delete_transaction($trans_id){
        $query = "Delete from transactions where trans_id=?";
        return $this->db->query($query, array($trans_id));
    }    
    function delete_transitem($trans_id, $item_name){
        $query = "Delete from transitems where trans_id=? and item_name=?";
        return $this->db->query($query, array($trans_id, $item_name));
    }
    function insert_data($data){
        $this->db->insert("sources", $data);
    }
    function edit_source($source_id, $source_name, $contact_num, $status){
        $query = "update sources set source_name = ?, contact_num = ?, status = ?  where source_id = ?";
        return $this->db->query($query,array($source_name,$contact_num,$status,$source_id));
    }
    function delete_source($id){
        $this->db->where("source_id", $id);
        return $this->db->delete("sources");
    }

    function delete_menu($id){
        $this->db->where("menu_id", $id);
        $this->db->delete("menu");
    }
    function edit_menu($menu_id, $menu_name, $category_id, $menu_description, $menu_price, $menu_availability){
        $query = "update menu set menu_name = ?, category_id = ?, menu_description = ?, menu_price = ?, menu_availability = ? where menu_id = ?";
        return $this->db->query($query,array($menu_name, $category_id, $menu_description, $menu_price, $menu_availability, $menu_id));
    }
    
    function edit_table($newTableCode, $previousTableCode){
        $query = "Update tables set table_code = ? where table_code = ?;";
        return $this->db->query($query, array($newTableCode, $previousTableCode));
    }

}
?>