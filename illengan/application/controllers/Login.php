<?php
class Login extends CI_Controller{

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
                'user_id' => $loginAttempt[0]['account_id'],
                'user_name' => ucfirst($loginAttempt[0]['account_username']),
                'user_type' => $loginAttempt[0]['account_type']
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
            case 'Admin':
                redirect('admin/menu');
                break;
            case 'Barista':
                redirect('barista/billings');
                break;
            case 'Chef':
                redirect('chef/orders');
                break;
            case 'Customer':
                redirect('customer/checkin');
                break;
        }
    }

    function logout() {
		if($this->session->userdata('user_id') && $this->session->userdata('user_type')){
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('user_name');
			$this->session->unset_userdata('user_type');
		}
		redirect('login');		
    }

}
?>