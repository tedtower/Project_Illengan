<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Add_Damages extends CI_Controller{
        
        public function index(){
            
            $this->load->view('Admin_Module/add_damages');
        }
        
        public function form_validation(){

             $this->load->library('form_validation');
             $this->form_validation->set_rules("description", "Description",'required');
             $this->form_validation->set_rules("quantity","Quantity",'required|numeric');
             $this->form_validation->set_rules("date", "Date", 'required');
             $this->form_validation->set_rules("remarks", "Remarks", 'required');

             if($this->form_validation->run()){
                 $this->load->model("AdminModule");
                 $data =array(
                     "damage_type" =>$this->input->post("Inventory"),
                     "damage_quantity" =>$this->input->post("quantity"),          
                     "date_recorded" =>$this->input->post("date"),           
                     "damage_reason" =>$this->input->post("remarks"),
                 );
                 $this->AdminModule->add_damages($data); 

                 redirect(base_url()."Add_Damages/added");

             }else{
                 $this->index();
             }
        }

        public function added(){
            $this->index();
        }
    }
    ?>