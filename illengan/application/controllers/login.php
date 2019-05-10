<?php
class login extends CI_Controller{

    function viewlogin(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type')){
            $this->homeRedirect();
        }else{
            $this->load->view('login');
        }
    }

    function check_cred(){
        $uname = $this->input->post('username');
        $pword = $this->input->post('password');
        $this->load->model('loginmodel');
        $loginAttempt = $this->loginmodel->validate($uname,$pword);
        if(is_array($loginAttempt)){
            $user_data = array(
                'user_id' => $loginAttempt[0]['aID'],
                'user_name' => ucfirst($loginAttempt[0]['aUsername']),
                'user_type' => $loginAttempt[0]['aType']
            );
            $this->session->set_userdata($user_data);
            $this->homeRedirect();
        }else{
            $data['err'] = $loginAttempt;
            $this->load->view('login',$data);
        }
    }

    function homeRedirect(){        
        switch ($this->session->userdata('user_type')){
            case 'admin':
                redirect('admin/dashboard');
                break;
            case 'barista':
                redirect('barista/billings');
                break;
            case 'chef':
                redirect('chef');
                break;
            case 'customer':
                redirect('customer/menu');
                break;
        }
    }

    function logout() {
		if($this->session->userdata('user_id') && $this->session->userdata('user_type')){
			$this->session->sess_destroy();
		}
		redirect('login');		
    }

}
?>
