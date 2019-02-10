<?php
class AdminModule extends CI_Model{
    
    function add_damages($data){
        $this->load->database();
        $this->db->insert("damages", $data);
    }
    }
?>