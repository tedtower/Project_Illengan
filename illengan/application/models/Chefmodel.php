<?php
    class Chefmodel extends CI_Model {
        
        
        function get_orders() {
            $this->load->database();
            $query = "SELECT os.osID, os.tableCode, os.custName, os.osDateTime, ol.olID, ol.olDesc, ol.olQty, ol.olRemarks
            FROM orderlists ol INNER JOIN orderslips os USING (osID) INNER JOIN preferences USING (prID) 
            INNER JOIN menu USING (mID) INNER JOIN categories cat USING (ctID) 
            WHERE cat.supcatID = '1' AND ol.olStatus='pending'";
            return $this->db->query($query)->result_array();
        }
    
        function get_addons() {
            $query = "SELECT * FROM orderaddons INNER JOIN addons USING (aoID)";
            return $this->db->query($query)->result_array();

        }
        function update_status($item_status, $order_item_id) {
            $this->load->database();
            $query = "UPDATE orderlists SET
            olStatus = ? 
            WHERE olID = ?";

            $this->db->query($query, array($item_status, $order_item_id));
            // $this->db->set('olStatus', $item_status);
            // $this->db->where('olID', $order_item_id);
            // $this->db->update('orderlists');
            /* $query = $this->db->query('UPDATE orderlist SET item_status = ? WHERE order_id = ? AND menu_id = ?');
            $this->db->query($query, array($item_status, $order_id, $menu_id)); */
        }

    
    }
?>
