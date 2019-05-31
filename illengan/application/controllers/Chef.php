<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chef extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		$this->load->database();
        $this->load->model('Chefmodel');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
	}
	
	function index()
	{	
		$data['user_id'] = $this->session->userdata('user_id');
		$this->load->view('chef/chef', $data); 
	}

	function get_orderlist() {
		$data = array();
		$data['data'] = $this->Chefmodel->return_orderlist();

		header('Content-Type: application/json');
		echo json_encode($data, JSON_PRETTY_PRINT);
		
	}


	function change_status() {
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Chef'){
		$order_item_id = $this->input->post('order_item_id');
		$item_status = $this->input->post('item_status');
		$this->Chefmodel->update_status( $item_status, $order_item_id);
		} else {
			redirect('login');
		}
	}

}
