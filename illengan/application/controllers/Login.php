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
        $this->load->model('loginmodel');
        $loginAttempt = $this->loginmodel->validate($uname,$pword);
        if(is_array($loginAttempt)){
            $user_data = array(
                'userid' => $loginAttempt[0]['account_id'],
                'user_name' => ucfirst($loginAttempt[0]['account_username']),
                'user_type' => $loginAttempt[0]['account_type']
            );
            $this->session->set_userdata($user_data);
            switch ($this->session->userdata('user_type')){
                case 'Admin':
                    redirect('admin/menu');
                    break;
                case 'Barista':
                    redirect('');
                    break;
                case 'Chef':
                    redirect('');
                    break;
            }
        }else{
            $data['err'] = $loginAttempt;
            $this->load->view('admin_module/login',$data);
        }
    }

}
?>