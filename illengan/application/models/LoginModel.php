<?php
class LoginModel extends CI_Model{

    private $err = array('Username does not exist!', 'Incorrect password!');

    function validate($username, $password){
        $query = "select * from accounts where BINARY account_username = ?";
        $qresult = $this->db->query($query, array($username));
        if($qresult->num_rows() === 1){
            $query = "select * from accounts where BINARY account_username = ? and account_password = ?;";
            $qresult = $this->db->query($query, array($username,$password));
            if($qresult->num_rows() === 1){
                return $qresult->result_array();
            }else{
                echo $this->err[1];
            }
        }else{
            echo $this->err[0];
        }
    }
}    
?>