<?php
    class ChefModel extends CI_Model {
        
        
        function return_orderlist() {
            $this->load->database();
            $query = $this->db->query('SELECT * FROM ((orderlist ol INNER JOIN orderslip os ON ol.order_id = os.order_id)
            INNER JOIN menu mn ON mn.menu_id = ol.menu_id) ORDER BY os.order_id;');
            return $query->result();
        }
    

        function update_status() {
            $this->load->database();
            $menu_id = $this->input->post('menu_id');
            $order_id = $this->input->post('order_id');
            $item_status = $this->input->post('item_status');

            $this->db->set('item_status', $item_status);
            $this->db->where('order_id', $order_id);
            $this->db->where('menu_id', $menu_id);
            $result = $this->db->update('orderlist');
            return $result;
            /* $query = $this->db->query('UPDATE orderlist SET item_status = ? WHERE order_id = ? AND menu_id = ?');
            $this->db->query($query, array($item_status, $order_id, $menu_id)); */
        }

        function save_product(){
            $data = array(
                    'product_code' 	=> $this->input->post('product_code'), 
                    'product_name' 	=> $this->input->post('product_name'), 
                    'product_price' => $this->input->post('price'), 
                );
            $result=$this->db->insert('product',$data);
            return $result;
        }
    
        function update_product(){
            $product_code=$this->input->post('product_code');
            $product_name=$this->input->post('product_name');
            $product_price=$this->input->post('price');
    
            $this->db->set('product_name', $product_name);
            $this->db->set('product_price', $product_price);
            $this->db->where('product_code', $product_code);
            $result=$this->db->update('product');
            return $result;
        }
    
        function delete_product(){
            $product_code=$this->input->post('product_code');
            $this->db->where('product_code', $product_code);
            $result=$this->db->delete('product');
            return $result;
        }
    }
?>