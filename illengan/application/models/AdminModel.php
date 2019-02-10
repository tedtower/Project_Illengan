<?php
class AdminModel extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

    function validate($username, $password){
        $query = "select * from accounts where account_username = ? and account_type='Admin';";
        $qresult = $this->db->query($query, array($username));
        echo $qresult->num_rows();
        if($qresult->num_rows() === 1){
            echo $qresult->result_array();
            if($qresult->result_array() === $password){
                echo 'yehey';
            }else{
                echo $this->err[1];  
                //return $err[1];
            }
        }else{
            echo $qresult->row->account_username;
            echo $this->err[0];
            //return $err[0];
        }
    }


}
?>