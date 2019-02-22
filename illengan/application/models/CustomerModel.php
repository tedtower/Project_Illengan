<?php
    class Db_model extends CI_Model {
        
        
        function return_drinks() {
            $this->load->database();
            $query = $this->db->get_where('menu', array('category_id' => '10'));
            return $query->result();
        }

        function return_meals() {
            $this->load->database();
            $query = $this->db->get_where('menu', array('category_id' => '11'));
            return $query->result();
        }

        function return_snacks() {
            $this->load->database();
            $query = $this->db->get_where('menu', array('category_id' => '12'));
            return $query->result();
        }

        /*function get($menu_id) {
            $results = $this->db->get_where('menu', array('id' => $menu_id))->result();
            $result = $results[0];

            if($result->option_values) {
                $result->options_values = explode(',',$result->option_values);
            }

            return $result;
        }*/
    }
?>