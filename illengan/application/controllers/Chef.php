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
	public function index()
	{
		$this->load->model('ChefModel');
		$data['orderlist'] = $this->ChefModel->return_orderlist();
		$this->load->view('chef/chef', $data); 
	}
	function notifications() {
		$this->load-
		$this->load->view('chef/notifications');
	}

	public function change_status() {
		$this->load->model('ChefModel');
		$order_id = $this->input->post('order_id');
		$menu_id = $this->input->post('menu_id');
		$item_status = $this->input->post('item_status');

		if($item_status == 'pending') {
			$data = array(
				'order_id' => $order_id,
				'menu_id' => $menu_id,
				'item_status' => 'in preparation'
			);
			$this->db->where('order_id', $order_id);
			$this->db->where('menu_id', $menu_id);
			$this->db->update('orderlist', $data);

		} else if ($item_status == 'in preparation') {
			$data = array(
				'order_id' => $order_id,
				'menu_id' => $menu_id,
				'item_status' => 'finished'
			);
			$this->db->where('order_id', $order_id);
			$this->db->where('menu_id', $menu_id);
			$this->db->update('orderlist', $data);

		} else if ($item_status == 'finished') {
			$data = array(
				'order_id' => $order_id,
				'menu_id' => $menu_id,
				'item_status' => 'pending'
			);

			$this->db->where('order_id', $order_id);
			$this->db->where('menu_id', $menu_id);
			$this->db->update('orderlist', $data);
		} 
		
		redirect('');
	}

	public function send(){
        $arr['msg'] = $this->input->post('message');
        $arr['date'] = date('Y-m-d');
        $arr['status'] = 1;
        $this->db->insert('tbl_msg',$arr);
        $detail = $this->db->select('*')->from('tbl_msg')->where('id',$this->db->insert_id())->get()->row();
        $msgCount = $this->db->select('*')->from('tbl_msg')->get()->num_rows();
        $arr['message'] = $detail->msg;
        $arr['date'] = date('m-d-Y', strtotime($detail->date));
        $arr['msgcount'] = $msgCount;
        $arr['success'] = true;
        echo json_encode($arr);
    }
/*
		public function change_status() {
			$this->load->model('ChefModel');
			$item_status = $this->input->post('item_status');
			$menu_id = $this->input->post('menu_id');
			$order_id = $this->input->post('order_id');

			$this->ChefModel->update_status($order_id, $menu_id, $item_status);
		}
*/
}
