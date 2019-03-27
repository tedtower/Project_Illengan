<?php
    class CustomerModel extends CI_Model {
	function get_tables(){ 
	    $query = $this->db->query('SELECT table_code FROM tables');
	    return $query->result();
    }
        function fetch_promos(){
            $query = $this->db->query('SELECT * FROM menu left join preferences using (menu_id)
            left join promo_cons using (pref_id)
            left join promo using (promo_id)
            left join discounts AS d using (promo_id) 
            left join freebie AS f using (promo_id) 
            left join menu_discount AS md USING (promo_id)
            left join menu_freebie AS mf USING (promo_id)');
            return $query->result();
        }

        function fetch_freebies($pref_id){
            $query = $this->db->query('SELECT * FROM (((menu INNER JOIN preferences USING (menu_id)) 
            INNER JOIN promo_cons USING (pref_id)) 
            INNER JOIN promo USING (promo_id)) 
            INNER JOIN freebie USING (promo_id) WHERE pref_id = ?;');
            return $this->db->query($query, array($pref_id))->result();
        }


        function fetch_category(){
            $query = $this->db->query('SELECT category_name FROM categories WHERE supcat_id IS NULL AND category_type = "menu" GROUP BY category_name ASC');
            return $query->result();
        }
        function fetch_menu(){
            $query = $this->db->query('SELECT menu.menu_id, categories.category_name, menu.menu_name, menu.menu_description, menu.menu_availability,
            menu.menu_image, categories.category_type, MIN(preferences.pref_price) AS pref_price, preferences.temp FROM menu LEFT JOIN categories USING (category_id) NATURAL JOIN preferences WHERE category_type = "menu" AND menu_availability != "unavailable" GROUP BY menu_name');
            return $query->result();
        }
        function fetch_allsubcats(){
            $query = $this->db->query('SELECT * FROM categories WHERE supcat_id IS NOT NULL ORDER BY category_id, supcat_id ASC');
            return $query->result();
        }
        function fetch_catswithmenu(){
            $query = $this->db->query('SELECT category_name FROM categories NATURAL JOIN menu GROUP BY category_id ORDER BY category_id ASC');
            return $query->result();
        }
        function fetch_menupref(){
            $query = $this->db->query('SELECT pref_id,size_name,menu_id,pref_price,temp,IF(temp IS NOT NULL, CONCAT(size_name," (",IF(temp="h","Hot",IF(temp="c","Cold",NULL)),") - ",pref_price), CONCAT(size_name," - ",pref_price)) AS preference FROM preferences ORDER BY pref_price ASC');
            return $query->result();
        }
        function fetch_addon(){
            $query = $this->db->query('SELECT * FROM itemadd NATURAL JOIN addons WHERE ao_status = "enabled" ORDER BY ao_price ASC');
            return $query->result();
        }
        function fetch_promo(){
            $query = $this->db->query('SELECT md.promo_id AS dis_promo_id,md.pref_id AS dis_pref_id, dc_name, dc_amt,mf.promo_id AS fb_promo_id, mf.pref_id AS fb_pref_id, freebie_name,status FROM promo left join discounts AS d using (promo_id) left join freebie AS f using (promo_id) 
            left join menu_discount AS md USING (promo_id) left join menu_freebie AS mf USING (promo_id) ');
            return $query->result();
        }

        function get_all(){
            $query =$this->db->get('menu');
            return $query->result();
        }
        function return_drinks() {
            $query = $this->db->get_where('menu', array('category_id' => '10'));
            return $query->result();
        }
        function return_meals() {
            $query = $this->db->get_where('menu', array('category_id' => '11'));
            return $query->result();
        }
        function return_menu($menu_id){
            $query =$this->db->get_where('menu', array('menu_id'=>$menu_id));
            return $query->result();
        }
        function return_snacks() {
            $query = $this->db->get_where('menu', array('category_id' => '12'));
            return $query->result();
        }
        function insert_order($order_num, $id, $qty, $subtotal){ //insert in table orderlist
            $data=array(
                'order_id' => $order_num,
				'menu_id' => $id,
				'order_total' => $subtotal,
				'order_qty' =>$qty,
            );
            $this->db->insert('orderlist', $data);
        }
		function insert(){ //insert in table orderslip
            $data=array(
                'order_id' => $order_num, //unknown function
				'table_code' => $table_no,
				'cust_name' => $cust_name,
				'order_payable' => $order_payable,
				'order_date' => $date, //format unknown
				'pay_date_time' => $pay_time, //format unknown
				'date_record' => $record //unknown format
			);
            $this->db->insert('orderslip', $data);
        }

        function get_menudetails($menu_id){
            $query = "select * from menu where menu_id = ?";
            return $this->db->query($query, array($menu_id))->result_array();
        }
        function get_sizes($menu_id){
            $query = "Select menu_id, size_name, size_price from sizes where menu_id = ?";
            return $this->db->query($query, array($menu_id))->result_array();
        }
        function get_addons($menu_id){
            $query = "Select ao_id, ao_name, ao_price, ao_status from itemadd inner join addons using where menu_id = ?";
            return $this->db->query($query, array($menu_id))->result_array();
        }
        function get_preference($prefID){
            $query = "SELECT 
                        pref_id,
                        menu_id,
                        pref_price,
                        CONCAT(menu_name,
                                IF(size_name = 'Normal',
                                    '',
                                    CONCAT(' - ', size_name)),
                                IF(temp IS NULL,
                                    '',
                                    IF(temp = 'h', ' Hot', ' Cold'))) AS 'order'
                    FROM
                        preferences
                            INNER JOIN
                        menu USING (menu_id)
                    WHERE
                        pref_id = ?;";
            return $this->db->query($query, array($prefID))->result_array()[0];
        }
        
        // function get_freebiepromo($menu_id){
        //     $query = "Select promo_id, from discounts inner join menu";

        // }        
        // function get_discountpromo($menu_id){
        //     $query = "Select promo_id, dc_name, dc_perc, dc_status from discounts inner join menu";

        // }
    }
?>
