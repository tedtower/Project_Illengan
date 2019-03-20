<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	// if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
	// }else{
	// 	redirect('login');
	// }
//index page
	function __construct(){
		parent::__construct();
		$this->load->model('customermodel');
		date_default_timezone_set('Asia/Manila');
	}
	//Direct Log-in
	function welcome(){
		$this->load->view('login');
	}
	//Check Session
	function isLoggedIn(){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
			return true;
		}
		return false;
	}

	public function view($page = 'menu'){
		if($this->isLoggedIn()){
			$data['categories'] = $this->customermodel->fetch_category();
			$data['menu'] = $this->customermodel->fetch_menu();
			$data['subcats'] = array_merge($this->customermodel->fetch_allsubcats(), $this->customermodel->fetch_catswithmenu());
			sort($data['subcats']);
			$data['pref_menu'] = $this->customermodel->fetch_menupref();
			$data['addons'] = $this->customermodel->fetch_addon();
			$data['orders'] = $this->cart->contents();
			$this->load->view('customer/template/head',$data);
			$this->load->view('customer/'.$page,$data);
			$this->load->view('customer/template/foot');
		}else{
			redirect('login');
		}
	}

	public function set_order(){
		$orders = $this->input->post();
		$this->cart->insert($orders);
	}

	//login
	public function process_login(){
        $cust_name = $this->input->post('cust_name');
        $table_no = $this->input->post('table_no');
        if ($cust_name != NULL || $table_no != NULL) {
			$data= array(
				'cust_name' => $cust_name,
				'table_no' => $table_no
			);
			$this->session->set_userdata($data);
			redirect('customer/view_menu');
        } else {
            $data['error'] = 'Invalid Account';
            $this->load->view('login', $data);
        }
    }
    
//view_menu --pass data
	function view_menu(){
		if($this->isLoggedIn()){
			$this->load->model('customermodel');
			$data= array();
			$data['cart'] = $this->cart->contents();
			$data['menu'] = $this->customermodel->get_all();
			$data['cust_name'] = $this->session->userdata('cust_name');
			$data['table_no'] = $this->session->userdata('table_no');
			$this->load->view('home', $data);
		}else{
			redirect('login');
		}
	}

	
	//add menu item as an temporary order
	function add() {
		if($this->isLoggedIn()){
			$data = array(
				'id' => $this->input->post('id'),
				'name' => $this->input->post('name'),
				'qty' => $this->input->post('quantity'),
				'price' => $this->input->post('price')
			);
			$this->cart->insert($data);
			echo '<script>alert("Added to Cart")</script>'; //term for adding as an temporary order
			redirect('index.php/customer/view_menu');
		}else{
			redirect('login');
		}
	}
	//fucntion to save or contain the menu items selected in a library cart
	function save_order() { //summary orderlist with confirmation
		if($this->isLoggedIn()){
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
			redirect('login');
		}
	}
	function ordered() { //insert in db table orderslip and orderlist
		if($this->isLoggedIn()){			
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
			redirect('login');
		}
	}
	function remove($rowid) {
		if($this->isLoggedIn()){
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
			redirect('login');
		}
	}

	function destroy() {
		if($this->isLoggedIn()){
			$this->cart->destroy();
			echo "destroy was called";
		}else{
			redirect('login');
		}
	}
   }

