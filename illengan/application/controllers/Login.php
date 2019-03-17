<?php
class Login extends CI_Controller{

    function index(){
        $this->load->view('landing');
    }

    function viewlogin(){
        $this->load->view('login');
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
            switch ($this->session->userdata('user_type')){
                case 'Admin':
                    redirect('admin/menu');
                    break;
                case 'Barista':
                    redirect('barista/orders');
                    break;
                case 'Chef':
                    redirect('chef/orders');
                    break;
				case 'Customer':
					redirect('customer/menu');
					break;
            }
        }else{
            $data['err'] = $loginAttempt;
            $this->load->view('login',$data);
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