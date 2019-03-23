<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barista extends CI_Controller{
    
    function __construct(){
        parent:: __construct();      
        date_default_timezone_set('Asia/Manila');        
        $this->load->model('baristamodel');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
    }

        function index()
        {
            $this->load->view('barista/baristaView'); 
    }

    function orders(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            $data= $this->baristamodel->view();
            echo json_encode($data);
            //Code Here
        }else{
            redirect('login');
        }
    }

    function getOrders(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            //Code Here
        }else{
            redirect('login');
        }
    }

    function getBills(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
                $data["bills"] = $this->baristamodel->get_bills();
                $this->load->view("barista/baristabillings", $data);
            }else{
                    redirect('login');
            }
        }

        function getBillDetails(){
            if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            $order_id = $this->input->post("order_id"); 
            $orderdetails = array(
            'orderslip' => $this->baristamodel->get_orderslip($order_id)[0],
            'orderlist' => $this->baristamodel->get_orderlist($order_id)
            );
                $this->output->set_output(json_encode($orderdetails));
            }else{
            redirect('login');

            }
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

    function setBillStatus(){        
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            $payment_date_time = date("Y-m-d H:i:s");
            $date_recorded = date("Y-m-d");
            $order_id = $this->input->post("order_id");
            $status = $this->input->post("pay_status");
            
            switch($status){
                case "p": 
                    if($this->baristamodel->update_billstatus($order_id)){
                        $this->output->set_output(json_encode($this->baristamodel->get_bills()));
                    }else{
                        //error
                    }
                    break;
                case "u" : 
                    if($this->baristamodel->update_billstatus($order_id, $payment_date_time, $date_recorded)){
                        $this->output->set_output(json_encode($this->baristamodel->get_bills()));
                    }else{
                        //error
                    }
                    break;
        
                }
            }else{
                redirect('login');
            }
        }
            

    }

        


        /*function change_status() {
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
