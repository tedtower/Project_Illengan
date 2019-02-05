<?php
class AdminModule extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

    function check_acct($username, $password){
        $query = "select * from accounts where BINARY account_username = '?' and account_type='admin'";
        $qresult = $this->db->query($query, array($username));
        if($qresult->num_rows() ==1){
            if($qresult->password === $password){
                return true;
            }else{
                return $err[1];
            }
        }else{
            return $err[0];
        }
    }


}
?>