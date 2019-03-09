<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	// if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
	// }else{
	// 	redirect('login');
	// }

//index page
	function welcome(){
		$this->load->view('login');
	}
	//display the menu
	function menu(){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
		}else{
			redirect('login');
		}
		$this->load->model('Db_model');
		$data= array();
		$data['menu'] = $this->Db_model->get_all();
		$data['cust_name'] = $this->session->userdata('cust_name');
		$data['table_no'] = $this->session->userdata('table_no');
		$this->load->view('home');
	}
	//AJAX Menu Details (including Sizes and Addons)
	function getDetails(){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
			$item = array(
				'details' => $this->input->get_menudetails("menu_id"),
				'sizes' => $this->input->get_sizes("menu_id"),
				'addons' => $this->input->get_addons("menu_id")
			);
			$this->output->set_output(json_encode($item));
		}else{
			redirect('login');
		}

	}
	//login
	public function process_login()
    {
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
//logout
    
//view_menu --pass data
	function view_menu(){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
			$this->load->model('Db_model');
			$data= array();
			$data['cart'] = $this->cart->contents();
			$data['menu'] = $this->Db_model->get_all();
			$data['cust_name'] = $this->session->userdata('cust_name');
			$data['table_no'] = $this->session->userdata('table_no');
			$this->load->view('home', $data);
		}else{
			redirect('login');
		}
	}

	//categories
	function snacks($type= 'snacks'){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
			$this->load->model('Db_model');
			$data = array();
			$data['snacks'] =$this->Db_model->return_snacks();
			$this->load->view($type, $data);
		}else{
			redirect('login');
		}
	}
	function drinks($type= 'drinks'){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
			$this->load->model('Db_model');
			$data = array();
			$data['drinks'] =$this->Db_model->return_drinks();
			$this->load->view($type, $data);
		}else{
			redirect('login');
		}
	}
	function meals($type= 'meals'){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
			$this->load->model('Db_model');
			$data = array();
			$data['meals'] =$this->Db_model->return_meals();
			$this->load->view($type, $data);
		}else{
			redirect('login');
		}
	}
	//add menu item as an temporary order
	function add() {
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
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
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
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
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){			
			$this->load->model('Db_model');
			$data['cart'] = $this->cart->contents();
			if($cart = $this->cart->contents()):
				foreach($cart as $items):
					$total = $this->cart->total();
					$order_num = 1; //function to count orderslip
				$this->Db_model->insert_order($order_num,$items['id'], $items['subtotal'], $total);
				echo '<script>alert("Inserted")</script>';
				endforeach;
			endif;
			$this->load->view('orderlist', $datas);
		}else{
			redirect('login');
		}
	}
	function remove($rowid) {
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
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
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Customer'){
			$this->cart->destroy();
			echo "destroy was called";
		}else{
			redirect('login');
		}
	}
   }

