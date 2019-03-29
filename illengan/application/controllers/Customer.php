<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model("customermodel");
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
	}

	//Checks if the user is logged in. *DON'T CHANGE*
	function isLoggedIn(){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
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
				$data['number'] = $this->customermodel->get_tables();
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
		$this->cart->destroy();
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
				$data['categories'] = $this->customermodel->fetch_category();
				$data['menu'] = $this->customermodel->fetch_menu();
				//$data['subcats'] = array_merge($this->customermodel->fetch_allsubcats(), 
				//$this->customermodel->fetch_catswithmenu());
				$data['subcats'] = $this->customermodel->fetch_allsubcats();
				sort($data['subcats']);
				$data['pref_menu'] = $this->customermodel->fetch_menupref();
				$data['addons'] = $this->customermodel->fetch_addon();
				$data['orders'] = $this->cart->contents();
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
				$preference = $this->customermodel->get_preference($this->input->post('preference'));
				$addons = $this->customermodel->get_addonsPrices();
				// $addonQtys = ;
				$data = array(
					'id' => $this->input->post('preference'),
					'name' => $preference['order'],
					'qty' => $this->input->post('quantity'),
					'orderDesc' => $preference['order'],
					'subtotal' => $this->input->post('quantity')*$preference['pref_price'] ,
					'remarks' => $this->input->post('remarks'),
					'addons' => json_decode($this->input->post('addons')),
					'addonSUbtotals' => 'the subtotals'
				);
				if(!$this->session->has_userdata('orders')){
					$this->session->set_userdata('orders',array());
				}
				$array = $this->session->userdata('orders');
				array_push($array, $data);
				$this->session->set_userdata('orders', $array);
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
				$this->output->set_output(json_encode($this->session->userdata('orders')));				
				$this->output->set_output(json_decode(json_encode($this->session->userdata('orders'))));
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
				$orderDate = date("Y-m-d");
				$tableCode = $this->session->userdata('table_no');
				$customer = $this->session->userdata('cust_name');
				$orderlist = $this->session->userdata('orders');
				// foreach()
				$this->customermodel->add_orderslip($tableCode, $customer, $orderlist, $orderDate);
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	function ordered() { //insert in db table orderslip and orderlist		
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){			
				$this->load->model('customermodel');
				$data['cart'] = $this->cart->contents();
				if($cart = $this->cart->contents()):
					foreach($cart as $items):
						$total = $this->cart->total();
						$order_num = 1; //function to count orderslip
					$this->customermodel->insert_order($order_num,$items['id'], $items['subtotal'], $total);
					echo '<script>alert("Inserted")</script>';
					endforeach;
				endif;
				$this->load->view('orderlist', $datas);
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
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
				$data = $this->customermodel->fetch_promos();
				echo json_encode($data);
			}else{
				redirect('customer/checkin');
			}	
		}else{
			redirect('login');
		}
	}

	function freebies() {

			$pref_id = $this->input->post('pref_id');
			$data = $this->customermodel->fetch_freebies($pref_id);
	
			echo json_encode($data);
	}
 }
?>