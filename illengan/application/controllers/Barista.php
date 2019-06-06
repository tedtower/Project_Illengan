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

    //BARISTA ORDER FUNCTIONS
    function pendingOrders(){
        $this->load->view('barista/templates/navigation');
        $this->load->view('barista/pendingOrders'); 
    }
    function pendingOrdersJS(){
        echo json_encode($this->baristamodel->get_pendingOrders());
    }
    function servedOrders(){
        $this->load->view('barista/templates/navigation');
        $this->load->view('barista/servedOrders');  
    }
    function servedOrdersJS(){
       $data= $this->baristamodel->get_servedOrders();
       echo json_encode($data);
    }
    function vieworderslip(){
        $this->load->view('barista/templates/navigation');
        $this->load->view('barista/orderslip');
    }
    function viewOrderslipJS(){
        $data =$this->baristamodel->get_orderslip();
        echo json_encode($data);
    }
    function getTables(){
        $data =$this->baristamodel->get_availableTables();
        echo json_encode($data);
    }
    function editTableNumber(){
        $osID = $this->input->post('osID');
        $tableCode =$this->input->post('tableCode');
        $data=$this->baristamodel->edit_tablenumber($tableCode,$osID);
    }
    
    //BARISTA BILLINGS FUNCTIONS
    function getOrders(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            //Code Here
        }else{
            redirect('login');
        }
    }

    function getOrderBills(){
        $this->load->view('barista/templates/navigation');
        $this->load->view('barista/orderBills');
    }
    
    function orderBillsJS(){
        $data= $this->baristamodel->get_bills();
        echo json_encode($data);

    }
    function getOrderItems(){
        $osID = $this->input->post('osID');
        $data = $this->baristamodel->get_orderitems($osID);

        echo json_encode($data);
    }
    function getBillDetails(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            $osID = $this->input->post("osID"); 
            $orderdetails = array(
            'orderslips' => $this->baristamodel->get_orderslips($osID)[0],
            'orderlists' => $this->baristamodel->get_orderlists($osID)
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
    function change_status() {
        $item_status = $this->input->post('olStatus');
        $olID = $this->input->post('olID');
        $osID = $this->input->post('osID');
        
        $this->baristamodel->update_status($osID, $olID, $item_status);
        $this->get_orderlist();
    }
    function cancel(){
        $data=$this->baristamodel->cancelOrder();
        echo json_encode($data);
    }
    function cancelslip(){
        $data=$this->baristamodel->cancel_slip();
        echo json_encode($data);
    }
    function setBillStatus(){        
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'Barista'){
            $payment_date_time = date("Y-m-d H:i:s");
            $date_recorded = date("Y-m-d");
            $osID = $this->input->post("osID");
            $status = $this->input->post("payStatus");
            
            switch($status){
                case "p": 
                    if($this->baristamodel->update_billstatus($osID)){
                        $this->output->set_output(json_encode($this->baristamodel->get_bills()));
                    }else{
                        //error
                    }
                    break;
                case "u" : 
                    if($this->baristamodel->update_billstatus($osID, $payment_date_time, $date_recorded)){
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

        //BARISTA INVENTORY FUNCTIONS
        function viewinventory(){
            $this->load->view('barista/templates/navigation');
            $this->load->view('barista/baristaInventory'); 
        }
        function inventoryJS(){
            echo json_encode($this->baristamodel->get_inventory());
        }
        function restockitem(){
            $stocks = json_decode($this->input->post('stocks'), true);
            echo json_encode($stocks, true);
            $this->baristamodel->restock($stocks);
        }
        function destockitem(){
            $stocks = json_decode($this->input->post('stocks'), true);
            echo json_encode($stocks, true);
            $this->baristamodel->destock($stocks);
        }

        //barista functions for orderslips-cards

        function sample(){
            $this->load->view('barista/orderCards');
        }

        function get_slipData(){
            $slipID = $this->input->post('osID');
            $customerName = $this->input->post('custName');
            $table_code = $this->input->post('tableCode');
            $status = $this->input->post('payStatus');
            $this->load->baristamodel->get_slip_data();
        }
        function updatePayment(){
            $status = "paid";
            $osID = $this->input->post('osID');
            $custName = $this->input->post('custName');
            $payDate = date("Y-m-d H:i:s");
            $date_recorded = date("Y-m-d H:i:s");
            $this->baristamodel->update_payment($status,$osID,$custName,$payDate, $date_recorded);
        }
    }
?>