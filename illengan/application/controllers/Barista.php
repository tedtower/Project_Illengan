<?php
class Barista extends CI_Controller{
    
    function __construct(){
        parent:: __construct();      
        date_default_timezone_set('Asia/Manila');        
        $this->load->model('baristamodel');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
    }

    function index(){
            $this->load->view('barista/baristaView'); 
        }

        function orders(){
            $data= $this->baristaModel->view();
		    echo json_encode($data);
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
?>