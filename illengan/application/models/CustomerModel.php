<?php
    class CustomerModel extends CI_Model {
        function fetch_category(){
            $query = $this->db->query('SELECT category_name FROM categories WHERE supcat_id IS NULL AND category_type = "menu" GROUP BY category_name ASC');
            return $query->result();
        }
        function fetch_menu(){
            $query = $this->db->query('SELECT menu.menu_id, categories.category_name, menu.menu_name, menu.menu_description, menu.menu_availability, menu.menu_image, categories.category_type, MIN(sizes.size_price) AS size_price
            FROM menu LEFT JOIN categories USING (category_id) NATURAL JOIN sizes WHERE category_type = "menu" GROUP BY menu_name');
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
        // function get_freebiepromo($menu_id){
        //     $query = "Select promo_id, from discounts inner join menu";

        // }        
        // function get_discountpromo($menu_id){
        //     $query = "Select promo_id, dc_name, dc_perc, dc_status from discounts inner join menu";

        // }
    }
?>
