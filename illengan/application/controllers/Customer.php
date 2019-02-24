<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function view($page = '') {
		if(!file_exists(APPPATH.'views/customer/'.$page.'.php')) {
			show_404();
		}
		$data['title'] = ucfirst($page);
		$this->load->view('customer/head');
		$this->load->view('customer/'.$page, $data);
		$this->load->view('customer/foot');
	}

	public function view_menu() {
		$this->load->model('Db_model');
		$data = array();
		$data['cart'] = $this->cart->contents();
		$data['meals'] = $this->Db_model->return_meals();
		$data['snacks'] = $this->Db_model->return_snacks();
		$data['drinks'] = $this->Db_model->return_drinks();
		$this->load->view('home', $data); 
	}
	
	function next_page() {
		$this->load->view('link');
	}

	function add() {

		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'qty' => $this->input->post('quantity'),
			'price' => $this->input->post('price')
		);
		$this->cart->insert($data);
		echo '<script>alert("Added to Cart")</script>';
		redirect('');
	}

	function update() {

		$data = array(
			'rowid' => '7235ec482f1df396d1b92081b74e5609',
			'qty' => '1'
		);

		$this->cart->update($data);
		echo "update() called";
	}

	function place_order() {

	}

	function remove($rowid) {
		// Check rowid value.
		if ($rowid==="all"){
		// Destroy data which store in session.
		$this->cart->destroy();
		}else{
		// Destroy selected rowid in session.
		$data = array(
		'rowid' => $rowid,
		'qty' => 0
		);
		// Update cart data, after cancel.
		$this->cart->update($data);
			}
		// This will show cancel data in cart.
		redirect('');
	}

	function destroy() {
		$this->cart->destroy();
		echo "destroy was called";
	}

   }

