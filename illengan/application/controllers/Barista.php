<?php
class Barista extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('baristamodel');        
        date_default_timezone_set('Asia/Manila');
    }
    function getOrders(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            //Code Here
        }else{
            redirect('login');
        }
    }
    function getBillings(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            //Code Here
        }else{
            redirect('login');
        }
    }
    function getBillDetails(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            $order_id = $this->input->post("order_id");
            $data['orderdetails'] = array(
                'orderslip' => $this->barsitamodel->get_orderslip($order_id),
                'orderlist' => $this->baristamodel->get_orderlist($order_id)
            );
        }else{
            redirect('login');
        }
    }
    function setBillStatus(){        
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            //Code Here
        }else{
            redirect('login');
        }
    }
}
?>