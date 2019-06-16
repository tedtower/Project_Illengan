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
		$this->load->view('chef/chef'); 
	}

	function get_orderlist() {
		$data = array();
        $data['orders'] = $this->Chefmodel->get_orders();
        $data['addons'] = $this->Chefmodel->get_addons();
        
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
		
	}
	
	  //BARISTA INVENTORY FUNCTIONS
	function viewinventory(){
		$this->load->view('chef/navigation');
		$this->load->view('chef/chefInventory'); 
	}
	function inventoryJS(){
		echo json_encode($this->baristamodel->get_inventory());
	}
	function restockitem(){
		$stocks = json_decode($this->input->post('stocks'), true);
		echo json_encode($stocks, true);
		$this->baristamodel->restock($stocks);
	}
	function destockitem(){
		$stocks = json_decode($this->input->post('stocks'), true);
		echo json_encode($stocks, true);
		$this->baristamodel->destock($stocks);
	}

}
