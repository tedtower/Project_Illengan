<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model("CustomerModel");
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
	}

	//Checks if the user is logged in. *DON'T CHANGE*
	function isLoggedIn(){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'customer'){
			return true;			
		}else{
			return false;
		}
	}

	//Checks if the customer has a table *DON'T CHANGE*
	function isCheckedIn(){
		if($this->session->userdata('table_no')!= NULL){
			return true;
		}else{
			return false;
		}
	}

	//Checking in of customers *CONSULT BEFORE MODIFYING*
	function checkIn(){
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				redirect('customer/menu');
			}else{
				$data['number'] = $this->CustomerModel->get_tables();
				$this->load->view('customer/checkin', $data);
			}
		}else{
			redirect('login');
		}
	}

	//Unsets session variables and redirects to checkin
	function checkout(){
		$this->session->unset_userdata('cust_name');
		$this->session->unset_userdata('table_no');
		$this->session->unset_userdata('orders');
		redirect('customer/checkin');
	}
	
	//Sets the customer's name and table as session variable
	public function processCheckin(){
		if($this->isLoggedIn()){
			$cust_name = $this->input->post('cust_name');
			$table_no['table_code'] = $this->input->post('table_no');
				if ($cust_name != NULL || $table_no != NULL) {
					$data= array(
						'cust_name' => $cust_name,
						'table_no' => $table_no
					);
					$this->session->set_userdata($data);
					redirect('customer/menu');
				} else {
					redirect('customer/checkin');
				}
		}else{
			redirect('login');
		}
	}

	//View Pages *CONSULT BEFORE ADDING THINGS*
	function view($page = 'menu'){
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){
				$data = array ();
				$data['cart'] = $this->cart->contents();
				$data['categories'] = $this->CustomerModel->fetch_category();
				$data['menu'] = $this->CustomerModel->fetch_menu();
				//$data['subcats'] = array_merge($this->CustomerModel->fetch_allsubcats(), 
				//$this->CustomerModel->fetch_catswithmenu());
				$data['subcats'] = $this->CustomerModel->fetch_allsubcats();
				sort($data['subcats']);
				$data['pref_menu'] = $this->CustomerModel->fetch_menupref();
				$data['addons'] = $this->CustomerModel->fetch_addon();
				//$this->output->set_output(json_encode($this->session->userdata('orders')));
				$data['orders'] = json_encode($this->session->userdata('orders'));
				$this->load->view('customer/template/head',$data);
				$this->load->view('customer/menu',$data);
				$this->load->view('customer/template/foot');
				$this->load->view('customer/template/modal_func');
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	//Ano to? haha
	public function set_order(){
		$orders = $this->input->post();
		$this->cart->insert($orders);
	}
	
	//Adds selected menu item in the cart
	function addOrder() {
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				$preference = $this->CustomerModel->get_preference($this->input->post('preference'))[0];
				$rawAddons = json_decode($this->input->post('addons'),true);
				if(empty($rawAddons['addonIds'])){
					$rawAddons = "";
				}else{
					$addonsPrices = $this->CustomerModel->get_addonPrices($rawAddons['addonIds']);					
					for($index = 0 ; $index < count($rawAddons['addonIds']) ; $index++){
						foreach($addonsPrices as $addon){
							if($addon['ao_id'] == $rawAddons['addonIds'][$index]){
								$rawAddons['addonIds'][$index] = intval($rawAddons['addonIds'][$index]);
								$rawAddons['addonQtys'][$index] = intval($rawAddons['addonQtys'][$index]);
								array_push($rawAddons['addonSubtotals'], floatval($addon['ao_price'])*intval($rawAddons['addonQtys'][$index]));
							}
						}
					}
				}
				$data = array(
					'id' => intval($this->input->post('preference')),
					'name' => $preference['order'],
					'qty' => intval($this->input->post('quantity')),
					'orderDesc' => $preference['order'],
					'subtotal' => floatval($this->input->post('subtotal')) ,
					'remarks' => $this->input->post('remarks'),
					'addons' => $rawAddons
				);
				if(!$this->session->has_userdata('orders')){
					$this->session->set_userdata('orders',array());
				}
				$order = $this->session->userdata('orders');
				array_push($order, $data);
				$this->session->set_userdata('orders', $order);
				echo json_encode($this->session->userdata('orders'));
				//term for adding as a temporary order
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	function viewOrders(){
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				$this->load->view('customer/modals/order_modal');
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	function completeOrder(){		
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				$orderDate  = $this->input->post('date');
				$tableCode = $this->input->post('table_no');
				$customer = $this->input->post('cust_name');
				$orderlist = $this->session->userdata('orders');
				$total = $this->input->post('total');
				// foreach()
				$this->CustomerModel->orderInsert($total, $tableCode, $orderlist, $customer, $orderDate);
				echo'<script>alert("Successfully Ordered!")</scipt>';
				$this->load->view('customer/menu');
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}
	
	function clearOrder(){
		$this->session->unset_userdata('orders');
		redirect('customer/menu');
	}
	
	function removeOrder() {	
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	
	function promos() {
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				$data = $this->CustomerModel->fetch_promos();
				echo json_encode($data);
			}else{
				redirect('customer/checkin');
			}	
		}else{
			redirect('login');
		}
	}

	function freebies_discounts() {
			$pref_id = $this->input->post('pref_id');
			$data = array();
			$data['freebies'] = $this->CustomerModel->fetch_freebies($pref_id);
			$data['discounts'] = $this->CustomerModel->fetch_discounts($pref_id);
	
			echo json_encode($data);
	}
 }
?>
