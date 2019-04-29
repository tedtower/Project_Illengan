<?php
    class ChefModel extends CI_Model {
        
        
        function return_orderlist() {
            $this->load->database();
            $query = $this->db->query('SELECT * FROM ((((orderlists ol INNER JOIN orderslips os USING (osID)) 
            INNER JOIN preferences USING (prID)) 
            INNER JOIN menu mn USING (mID)) 
            LEFT JOIN orderaddons oa USING (olID)) 
            LEFT JOIN addons aon USING (aoID);');
            return $query->result();
        }
    

        function update_status($item_status, $order_item_id) {
            $this->load->database();
            $this->db->set('olStatus', $item_status);
            $this->db->where('olID', $order_item_id);
            $this->db->update('orderlists');
            /* $query = $this->db->query('UPDATE orderlist SET item_status = ? WHERE order_id = ? AND menu_id = ?');
            $this->db->query($query, array($item_status, $order_id, $menu_id)); */
        }

    
    }
?>