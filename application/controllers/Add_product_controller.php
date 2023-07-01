<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_product_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Add_product_model');
	}

	public function index()
    {
        $this->load->library('session');
        if ($this->session->userdata('user')) {
            redirect('home');
        } else {
            $this->load->view('login_page');
        }
    }

    public function add_product()
    {
        //load session library
        $this->load->library('session');
        //restrict users to go to home if not logged in
        if ($this->session->userdata('user')) {
            $this->load->view('add_product');
        } else {
            redirect('/');
        }
    }

    public function add_product_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('product', 'product', 'required');
            $this->form_validation->set_rules('description', 'description', '');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {
                $array = array(
                    'product' => $this->input->post('product'),
                    'description' => $this->input->post('description'),
                );
                $this->load->model('Add_product_model');
                $insert_id = $this->Add_product_model->insert_product($array);
                if ($insert_id) {
                    $response = array(
                        'success' => true,
                        'message' => "product add successfully"
                    );
                } else {
                    $response = array(
                        'error' => true,
                        'message' => "Error while saving data .....!!!!"
                    );
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    function fetch_all_product()
    {
        try {
            $this->load->model("Add_product_model");
            $fetch_case = $this->Add_product_model->make_datatables_product();
            $data = array();
            foreach ($fetch_case as $row) {
                $sub_array = array();
                // $buttons = '';
                // $buttons .= '<button type="button" title="Reset Password" name="edit" id="' . $row->id . '" class="btn btn-primary btn-sm edit_password"><i class="fa fa-edit" ></i></button>';
                // $buttons .= '<button type="button" title="Delete User" name="delete" id="' . $row->id . '" class="btn btn-danger btn-sm delete_user"><i class="fa fa-trash" ></i></button>';
                $sub_array[] = $row->id;
                $sub_array[] = $row->product;
                $sub_array[] = $row->description;
                $sub_array[] = $row->status;
                // $sub_array[] = $buttons;
                $data[] = $sub_array;
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->Add_product_model->get_all_data_product(),
                "recordsFiltered" => $this->Add_product_model->get_filtered_data_product(),
                "data" => $data
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }

    function get_status_product()
    {
        $array = array(
            'status' => $this->input->post('value')
        );
        $this->load->model('Add_product_model');
        $this->Add_product_model->insert_status_update_product($array, $this->input->post('pk'));
        print_r($array);
    }
    
      function get_description() {
        $array = array(
              'description'=> $this->input->post('value'));
                $this->load->model('Add_product_model');
                $this->Add_product_model->insert_descriptions($array,$this->input->post('pk'));
            print_r($array);
    }
    
    function get_product() {
        $array = array(
              'product'=> $this->input->post('value'));
                $this->load->model('Add_product_model');
                $this->Add_product_model->insert_products($array,$this->input->post('pk'));
            print_r($array);
    }

}