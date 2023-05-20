<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Case_form extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('case_form_model');
	}

	public function index()
	{
		//load session library
		$this->load->library('session');
		//restrict users to go back to login if session has been set
		if ($this->session->userdata('user')) {
			redirect('home');
		} else {
			$this->load->view('login_page');
		}
	}


	public function case_details_form()
	{
		//load session library
		$this->load->library('session');
		//restrict users to go to home if not logged in
		$this->load->model("Mini_case_model");
		$bank_data = $this->Mini_case_model->getBank();
		$product_data = $this->Mini_case_model->getProduct();
		$agent_code = $this->Mini_case_model->getAgentCode();
		$data['bank_names'] = $bank_data;
		$data['product_data'] = $product_data;
		$data['agent_code'] = $agent_code;
		if ($this->session->userdata('user')) {
			// $this->load->view('components/header');
			$this->load->view('case_form_view', $data);
			// $this->load->view('components/footer');
		} else {
			redirect('/');
		}
	}

	function create_case_form_submit()
	{
		try {
			$this->load->model('Case_form_model');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('bank_name', 'bank_name', 'required');
			$this->form_validation->set_rules('product_name', 'product_name', 'required');
			$this->form_validation->set_rules('application_id', 'application_id', 'required');
			$this->form_validation->set_rules('customer_name', 'customer_name', 'required');
			$this->form_validation->set_rules('dob', 'dob', '');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			$this->form_validation->set_rules('vehicle', 'vehicle', 'required');
			$this->form_validation->set_rules('co_applicant', 'co_applicant', 'required');
			$this->form_validation->set_rules('guarantee_name', 'guarantee_name', 'required');
			$this->form_validation->set_rules('geo_limit', 'geo_limit', 'required');
			$this->form_validation->set_rules('tat', 'tat', 'required');
			$this->form_validation->set_rules('remarks', 'remarks', 'required');
			if ($this->input->post('single_agent') == 'no') {
				$this->form_validation->set_rules('agent_1', 'First Agent', 'required');
				$this->form_validation->set_rules('agent_2', 'Second Agent', 'required');
			} else {
				$this->form_validation->set_rules('agent_1', 'First Agent', 'required');
			}


			if ($this->form_validation->run()) {

				$fi_to_be_conducted = $this->input->post('fi_to_be_conducted');
				foreach ($fi_to_be_conducted as $key => $val) {
					$varification = [];
					$address 	= array_values(array_filter($this->input->post('business_address')));
					$name 		= array_values(array_filter($this->input->post('business_name')));
					$city 		= array_values(array_filter($this->input->post('city')));
					$pincode 	= array_values(array_filter($this->input->post('pincode')));
					$varification['code'] = $this->input->post('agent_1');
					if ($key == 1) {
						$varification['code'] = $this->input->post('agent_2');
					}

					$varification['product_name'] 		= $this->input->post('product_name');
					$varification['application_id'] 	= $this->input->post('application_id');
					$varification['customer_name'] 		= $this->input->post('customer_name');
					$varification['dob'] 				= $this->input->post('dob');
					$varification['amount'] 			= $this->input->post('amount');
					$varification['vehicle'] 			= $this->input->post('vehicle');
					$varification['co_applicant'] 		= $this->input->post('co_applicant');
					$varification['guarantee_name'] 	= $this->input->post('guarantee_name');
					$varification['geo_limit'] 			= $this->input->post('geo_limit');
					$varification['tat'] 				= $this->input->post('tat');
					$varification['remarks'] 			= $this->input->post('remarks');
					$varification['fi_to_be_conducted'] = $val;
					$varification['business_address'] 	= $address[$key];
					$varification['business_name'] 		= $name[$key];
					$varification['city'] 				= $city[$key];
					$varification['pincode'] 			= $pincode[$key];
					$varification['bank_name'] 			= $this->input->post('bank_name');
					//$varification['status'] 			= '1';

					$res_id = $this->Case_form_model->insert_case($varification);
				}
				if ($res_id) {
					// check if data inserted and return inserted id
					$response = array(
						'success' => true,
						'message' => "Case Generated successfully"
					);
				} else {
					$response = array(
						'error' => true,
						'message' => "Error while saving data !!!!"
					);
				}
			} else {
				// if error in form validation
				foreach ($_POST as $key => $value) {
					$response['messages'][$key] = form_error($key);
				}
			}

			echo json_encode($response);
		} catch (Exception $ex) {
			$error['error'] = TRUE;
			$error['message'] = $ex->getMessage();
			$this->load->view('login_page', array('error' => $error));
		}
	}
}
