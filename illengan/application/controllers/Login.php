<?php
class Login extends CI_Controller{

    function check_cred(){
        $uname = $this->input->post('username');
        $pword = $this->input->post('password');
        $this->load->model('adminmodule');
        $loginAttempt = $this->adminmodule->check_acct($uname,$pword);
        if($loginAttempt === true){
            $this->load->view('admin_module/index');
        }else{
            $data['err'] = $loginAttempt;
            $this->load->view('admin_module/login',$data);
        }
    }

}
?>