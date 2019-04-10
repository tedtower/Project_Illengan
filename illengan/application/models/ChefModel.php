<?php
    class ChefModel extends CI_Model {
        
        
        function return_orderlist() {
            $this->load->database();
            $query = $this->db->query('SELECT * FROM ((((orderlist ol INNER JOIN orderslip os USING (order_id)) 
            INNER JOIN preferences USING (pref_id)) 
            INNER JOIN menu mn USING (menu_id)) 
            LEFT JOIN orderadd oa USING (order_item_id)) 
            LEFT JOIN addons aon USING (ao_id);');
            return $query->result();
        }
    

        function update_status() {
            $this->load->database();
            $item_status = $this->input->post('item_status');
            $order_item_id = $this->input->post('order_item_id');

            $this->db->set('item_status', $item_status);
            $this->db->where('order_item_id', $order_item_id);
            $result = $this->db->update('orderlist');
            return $result;
            /* $query = $this->db->query('UPDATE orderlist SET item_status = ? WHERE order_id = ? AND menu_id = ?');
            $this->db->query($query, array($item_status, $order_id, $menu_id)); */
        }

    
    }
?>