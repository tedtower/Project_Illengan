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
        $this->load->model('ChefModel');
	}
	
	function index()
	{
		$this->load->view('chef/chef'); 
	}
	
	function product_data(){
		$data=$this->ChefModel->return_orderlist();
		echo json_encode($data);
	}


	function change_status() {
		$item_status = $this->input->post('item_status');
		$menu_id = $this->input->post('menu_id');
		$order_id = $this->input->post('order_id');
		
		$this->ChefModel->update_status($order_id, $menu_id, $item_status);
		$this->product_data();
	}

}