<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

//index page
	function __construct(){
		parent::__construct();
		ob_start();//
		$this->load->model('customermodel');
		date_default_timezone_set('Asia/Manila');
	}
	//Check Session
	function isLoggedIn(){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
			$data['number'] = $this->customermodel->get_tables();
			$this->load->view('customer/login', $data);
			
		}else{
			redirect('default_controller');
		}
	}
	//login
	public function process_login()
    {
		$cust_name = $this->input->post('cust_name');
        $table_no['table_code'] = $this->input->post('table_no');
		if ($cust_name != NULL || $table_no != NULL) {
			$data= array(
				'cust_name' => $cust_name,
				'table_no' => $table_no
			);
			$this->session->set_userdata($data);
			redirect('menu');
        } else {
            $data['error'] = 'Invalid Login';
            $this->load->view('LogIn', $data);
        }
    }
	public function getMenuDetails(){
			$this->load->library('cart');
			$item_id = $this->input->post('item_id');
			redirect('add_order');
	}

	//display the menu
	function menu(){
		if($this->session->userdata('table_no')!= NULL){
			$data= array();
			$data['cart'] = $this->cart->contents();
			$data['menu'] = $this->customermodel->fetch_menu();
			$data['subcats'] = $this->customermodel->fetch_allsubcats();
			$data['cust_name'] = $this->session->userdata('cust_name');
			$data['table_no'] = $this->session->userdata('table_no');
			redirect('view');
			
		}else{
			redirect('LogIn');
		}
	}

	function view($page = 'menu'){
		if($this->session->userdata('table_no')!= NULL){
			$data = array ();
			$data['cart'] = $this->cart->contents();
			$data['categories'] = $this->customermodel->fetch_category();
			$data['menu'] = $this->customermodel->fetch_menu();
			$data['subcats'] = array_merge($this->customermodel->fetch_allsubcats(), $this->customermodel->fetch_catswithmenu());
			sort($data['subcats']);
			$data['pref_menu'] = $this->customermodel->fetch_menupref();
			$data['addons'] = $this->customermodel->fetch_addon();
			$data['orders'] = $this->cart->contents();
			$data['subcats'] = $this->customermodel->fetch_allsubcats();
			$this->load->view('customer/template/head',$data);
			$this->load->view('customer/'.$page,$data);
			$this->load->view('customer/template/foot');
			$this->load->view('customer/template/modal_ajax');
			$this->load->view('customer/home', $data);
		}else{
			redirect('LogIn');
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

	//AJAX Menu Details (including Sizes and Addons)
	function getDetails(){
		if($this->session->userdata('table_no')!= NULL){
			$menu_id = $this->input->post("menu_id");
			$item = array(
				'details' => $this->input->get_menudetails($menu_id),
				'sizes' => $this->input->get_sizes($menu_id),
				'addons' => $this->input->get_addons($menu_id)
			);
			$this->output->set_output(json_encode($item));
		}else{
			redirect('LogIn');
		}

	}
	
//logout
    function logout() {
		$this->session->unset_userdata('cust_name');
		$this->session->unset_userdata('table_no');
		$this->load->driver('cache');//
		$this->session->sess_destroy();//
		$this->cache->clean();//
		ob_clean();//
		$data['number'] = $this->customermodel->get_tables();
		$this->load->view('customer/login', $data);
    }
	//add menu item as an temporary order
	function add() {
		if($this->session->userdata('table_no')!= NULL){
			$data = array(
				'id' => $this->input->post('menu_id')
			);
			$this->cart->insert($data);
			echo '<script>alert("Added to Cart")</script>'; //term for adding as an temporary order		
			redirect('menu');
		}else{
			redirect('LogIn');
		}
	}
	//fucntion to save or contain the menu items selected in a library cart
	function save_order() { //summary orderlist with confirmation
		if($this->session->userdata('table_no')!= NULL){
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
			redirect('LogIn');
		}
	}
	function ordered() { //insert in db table orderslip and orderlist
		if($this->session->userdata('table_no')!= NULL){			
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
			redirect('LogIn');
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
			redirect('LogIn');
		}
	}

	function destroy() {
		if($this->isLoggedIn()){
			$this->cart->destroy();
			redirect('menu');
		}else{
			redirect('LogIn');
		}
	}
 }
?>
