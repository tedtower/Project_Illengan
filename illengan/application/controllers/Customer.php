<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

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
				$data['promo'] = $this->customermodel->fetch_promo();
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
				$this->load->library('cart');
				$preference = $this->customermodel->get_preference($this->input->post('preference'));
				$data = array(
					'id' => $this->input->post('preference'),
					'name' =>$preference['order'],
					'qty' => $this->input->post('quantity'),
					'order_desc' => $preference['order'],
					'subtotal' => $this->input->post('quantity')*$preference['pref_price'] ,
					'remarks' => $this->input->post('remarks'),
					'addons' => json_decode($this->input->post('addons'))
				);
				$this->cart->insert($data);//term for adding as a temporary order
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	//function to save or contain the menu items selected in a library cart
	function save_order() { //summary orderlist with confirmation
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){
				$data = array(
					'id' => $this->input->post('id'),
					'name' => $this->input->post('name'),
					'qty' => $this->input->post('quantity'),
					'price' => $this->input->post('price'),
					'subtotal' => $this->input->post('subtotal'),
					'total_qty' => $this->input->post('total_qty'),
					'total' => $this->input->post('total')
				);
				$datas = $this->cart->insert($data);
				echo '<script>alert("Saved")</script>'; //with confirmation
				$this->load->view('orderlist', $datas);
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
	function remove($rowid) {	
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){
				if ($rowid ==="all"){
					$this->cart->destroy();
				}else{
					$data = array(
					'rowid' => $rowid,
					'qty' => 0
					);
					$this->cart->update($data);
				}
				redirect('customer/view_menu');
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	function promos() {
		if($this->isLoggedIn()){
			if(isCheckedIn()){
				$data = $this->customermodel->fetch_promos();
				echo json_encode($data);
			}else{
				redirect('customer/checkin');
			}	
		}else{
			redirect('login');
		}
	}
 }
?>