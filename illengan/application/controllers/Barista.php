<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Barista extends CI_Controller{
        function __construct() {        
            parent::__construct();
            $this->load->model('baristaModel');
            }

        function index()
        {
            $this->load->view('barista/baristaView'); 
        }

        function orders(){
            $data=$this->baristaModel->view();
		    echo json_encode($data);
        }

        function getDate(){
            $this->load->helper('date');
            date_default_timezone_set('Asia/Manila'); 
            $format = "%Y-%m-%d %h:%i %A";
            echo mdate($format);
        }


        /*function editTableNumber($order_id, $table_no){
            $table_no = $this->input->post('table_no');
            $order_id = $this->input->post('order_id');
            $this->load->model('baristaModel');
            $this->baristaModel->edit_tablenumber($order_id, $table_no);
            $this->load->view('editTable');

            if(isset($table_no)){
                $this->db->update('orderslip');
            }else{
                echo "Error";
            }
           // $this->viewStockCategories();
        }*/

        function editTableNumber(){
            $data=$this->baristaModel->edit_tablenumber();
            echo json_encode($data);


        }

        
        function change_status() {
            $item_status = $this->input->post('item_status');
            $menu_id = $this->input->post('menu_id');
            $order_id = $this->input->post('order_id');
            
            $this->baristaModel->update_status($order_id, $menu_id, $item_status);
            $this->get_orderlist();
        }

        function removeRow(){
            $data=$this->baristaModel->remove();
            echo json_encode($data);
        }

    }
        

           /* $order_id = $this->input->get('order_id');
            $table_code = $this->input->get('table_code');
            $data['orderslip'] = $this->baristaModel->edit_tablenumber($table_code, $order_id);
            $this->load->view('editTable', $data);
            }
            ---------------------------------------------------------------------------

        function searchCustomer(){
            $data['orderArray'] = $this->baristaModel->search();
            $this->load->view('barista/searchView', $data);

        }

        function change_status() {
            $order_id = $this->input->post('order_id');
            $menu_id = $this->input->post('menu_id');
            $item_status = $this->input->post('item_status');
            if($item_status == 'pending') {
                $data = array(
                    'order_id' => $order_id,
                    'menu_id' => $menu_id,
                    'item_status' => 'ongoing'
                );
                $this->db->where('order_id', $order_id);
                $this->db->where('menu_id', $menu_id);
                $this->db->update('orderlist', $data);
            } else if ($item_status == 'on going') {
                $data = array(
                    'order_id' => $order_id,
                    'menu_id' => $menu_id,
                    'item_status' => 'Done'
                );
                $this->db->where('order_id', $order_id);
                $this->db->where('menu_id', $menu_id);
                $this->db->update('orderlist', $data);
            } else if ($item_status == 'done') {
                $data = array(
                    'order_id' => $order_id,
                    'menu_id' => $menu_id,
                    'item_status' => 'Served'
                );
                $this->db->where('order_id', $order_id);
                $this->db->where('menu_id', $menu_id);
                $this->db->update('orderlist', $data);
            } 
            
            redirect('');
        }
            function billings(){
                //codes here
            }*/

?>
