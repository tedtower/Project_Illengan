<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Add_Damages extends CI_Controller{
        
        public function index(){
            
            $this->load->view('Admin_Module/add_damages');
        }
        
        public function form_validation(){
            
             $this->load->helper(array('form'));
             $this->load->library('form_validation');
             $this->form_validation->set_rules('stype', 'Description','required');
             $this->form_validation->set_rules('sqty','Quantity','required|numeric');
             $this->form_validation->set_rules('sdate', 'Date', 'required');
             $this->form_validation->set_rules('remarks', 'Remarks', 'required');

             if($this->form_validation->run()){
                $this->load->model("Admin_Module");
                $data =array(
                    "stype" =>$this->input->post("stype"),
                    "sqty" =>$this->input->post("sqty"),          
                    "sdate" =>$this->input->post("sdate"),           
                    "remarks" =>$this->input->post("remarks"),
                );
                $this->Admin_Module->add_damages($data); 

                redirect(base_url()."Add_Damages/added");

             }else{
                 echo "Error form validation not running";
             }
        }

        public function added(){
            $this->index();
        }
    }
    ?>