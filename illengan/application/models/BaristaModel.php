<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class BaristaModel extends CI_Model{
        
        function view(){
            $this->load->database();
            $query = $this->db->query('SELECT * FROM ((orderlist ol INNER JOIN orderslip os ON ol.order_id = os.order_id)
            INNER JOIN menu mn ON mn.menu_id = ol.menu_id) ORDER BY os.order_id;');
            return $query->result();
        }

        function edit_tablenumber(){
            $order_id=$this->input->post('order_id');
            $table_code=$this->input->post('table_code');
    
            $this->db->set('order_id', $order_id);
            $this->db->set('table_code', $table_code);
            $this->db->where('order_id', $order_id);
            $result=$this->db->update('orderslip');
            return $result;
            
            /*$query->$this->db->query("UPDATE orderslip set table_code = ?  where orderslip.order_id = ?");
            return $this->db->query($query,array($table_no)); */
        }

        function remove(){
            $order_id=$this->input->post('order_id');
            $this->db->where('order_id', $order_id);
            $result=$this->db->remove('menu_name');
            return $result;
        }
        

        /*function search(){
            $query = $this->db
            ->select('*')
            ->from('orderslip')
            ->join('orderlist', 'orderslip.order_id=orderlist.order_id')
            ->join('menu', 'orderlist.menu_id=menu.menu_id')
            ->where('cust_name', $this->input->post('cust_name'))
            ->get();
         
         return $query->result_array();
      }*/

        function update_status($order_id, $menu_id, $item_status) {
            $data['item_status'] = $item_status;
            $query = $this->db->query('UPDATE orderlist SET item_status = ? WHERE order_id = ? AND menu_id = ?');
            $this->db->query($query, array($item_status, $order_id, $menu_id));
        }

    }

?>

