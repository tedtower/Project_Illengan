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

	function get_orderlist() {
		$data = $this->ChefModel->return_orderlist();

        echo json_encode($data);
	}

	function orders_json(){
		$this->load->database();
        $this->load->model('ChefModel');
		$orderlist = $this->ChefModel->return_orderlist();
    	$data['orderlist'] = $orderlist;
		$response = array();
		$posts = array();
		
    foreach($orderlist as $row) 
    { 
        $posts[] = array(
            "order_id"                  =>  $row->order_id,
            "cust_name"             	=>  $row->cust_name,
            "table_code"            	=>  $row->table_code,
            "menu_name" 				=>  $row->menu_name,
            "order_qty"                 =>  $row->order_qty,
            "item_status"               =>  $row->item_status
        );
    } 
    $response = $posts;
    echo json_encode($response,TRUE);
	$fp = fopen('./orders.json', 'w');
    fwrite($fp, json_encode($response));
	}


	function change_status() {
		$order_item_id = $this->input->post('order_item_id');
		$item_status = $this->input->post('item_status');
	
		$this->ChefModel->update_status($order_item_id, $item_status);
		$this->get_orderlist();
	}

}
