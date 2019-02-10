<?php
class Login extends CI_Controller{

    function index(){
        $this->load->view('landing');
    }

    function load_adminlogin(){
        $this->load->view('admin_module/login');
    }

    function load_baristalogin(){
        $this->load->view('barista_module/login');
    }

    function load_cheflogin(){
        $this->load->view('chef_module/login');
    }

    function check_cred(){
        $uname = $this->input->post('username');
        $pword = $this->input->post('password');
        $this->load->model('adminmodel');
        $loginAttempt = $this->adminmodel->validate($uname,$pword);
        if($loginAttempt === true){
            $this->load->view('admin_module/index');
        }else{
            echo $loginAttempt;
            $data['err'] = $loginAttempt;

            //$this->load->view('admin_module/login',$data);
        }
    }

}
?>