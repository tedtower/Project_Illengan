<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

//index page
	function welcome(){
		$this->load->view('login');
	}
	//display the menu
	function menu(){
		$this->load->model('Db_model');
		$data= array();
		$data['menu'] = $this->Db_model->get_all();
		$data['cust_name'] = $this->session->userdata('cust_name');
		$data['table_no'] = $this->session->userdata('table_no');
		$this->load->view('home');
	}
	//login
	public function process_login()
    {
        $cust_name = $_POST['cust_name'];
        $table_no = $_POST['table_no'];
        if ($cust_name != NULL && $table_no != NULL) {
			$data= array(
				'cust_name' => $cust_name,
				'table_no' => $table_no
			);
			$this->session->set_userdata($data);
			redirect('index.php/customer/view_menu');
        } else {
            $data['error'] = 'Invalid Account';
            $this->load->view('login', $data);
        }
    }
//logout
    public function logout() {
		$this->session->unset_userdata('cust_name');
		$this->session->unset_userdata('table_no');
        $this->load->view('login');
    }
//view_menu --pass data
	function view_menu(){
		$this->load->model('Db_model');
		$data= array();
		$data['cart'] = $this->cart->contents();
		$data['menu'] = $this->Db_model->get_all();
		$data['cust_name'] = $this->session->userdata('cust_name');
		$data['table_no'] = $this->session->userdata('table_no');
		$this->load->view('home', $data);
	}

	//categories
	function snacks($type= 'snacks'){
		$this->load->model('Db_model');
		$data = array();
		$data['snacks'] =$this->Db_model->return_snacks();
		$this->load->view($type, $data);
	}
	function drinks($type= 'drinks'){
		$this->load->model('Db_model');
		$data = array();
		$data['drinks'] =$this->Db_model->return_drinks();
		$this->load->view($type, $data);
	}
	function meals($type= 'meals'){
		$this->load->model('Db_model');
		$data = array();
		$data['meals'] =$this->Db_model->return_meals();
		$this->load->view($type, $data);
	}
	//add menu item as an temporary order
	function add() {
		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'qty' => $this->input->post('quantity'),
			'price' => $this->input->post('price')
		);
		$this->cart->insert($data);
		echo '<script>alert("Added to Cart")</script>'; //term for adding as an temporary order
		redirect('index.php/customer/view_menu');
	}
	//fucntion to save or contain the menu items selected in a library cart
	function save_order() { //summary orderlist with confirmation
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
	}
	function ordered() { //insert in db table orderslip and orderlist
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
	}
	function remove($rowid) {
		if ($rowid ==="all"){
		$this->cart->destroy();
		}else{
		$data = array(
		'rowid' => $rowid,
		'qty' => 0
		);
		$this->cart->update($data);
		}
		redirect('index.php/customer/view_menu');
		}

	function destroy() {
		$this->cart->destroy();
		echo "destroy was called";
	}
   }

