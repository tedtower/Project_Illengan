<?php
    class ChefModel extends CI_Model {
        
        
        function return_orderlist() {
            $this->load->database();
            $query = $this->db->query('SELECT * FROM ((orderlist ol INNER JOIN orderslip os ON ol.order_id = os.order_id)
            INNER JOIN menu mn ON mn.menu_id = ol.menu_id) WHERE mn.category_id = 11 OR mn.category_id = 12 ORDER BY os.order_id;');
            return $query->result();
        }

        function update_status($data) {
            $this->load->database();
            $query = $this->db->query('UPDATE orderlist SET item_status = ? WHERE order_id = ? AND menu_id = ?');
            $this->db->query($query, array($data['item_status'], $data['order_id'], $data['menu_id']));
    }
    }
?>