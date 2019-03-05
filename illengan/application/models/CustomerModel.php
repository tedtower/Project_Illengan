<?php
    class Db_model extends CI_Model {
        
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
    }
?>
