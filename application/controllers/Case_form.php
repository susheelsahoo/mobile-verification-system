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
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
			$this->form_validation->set_rules('product_name', 'Product Name', 'required');
			$this->form_validation->set_rules('application_id', 'Application ID', 'required');
			$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
			$this->form_validation->set_rules('dob', 'dob', '');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			$this->form_validation->set_rules('vehicle', 'vehicle', 'required');
			$this->form_validation->set_rules('co_applicant', 'Co-Applicant Name', 'required');
			$this->form_validation->set_rules('guarantee_name', 'Guarantee Name', 'required');
			$this->form_validation->set_rules('geo_limit', 'Geo Limit', 'required');
			$this->form_validation->set_rules('tat_start', 'TAT Start', 'required');
			$this->form_validation->set_rules('tat_end', 'TAT End', 'required');
			$this->form_validation->set_rules('remarks', 'Remarks', 'required');
			$fi_type = $this->input->post('fi_to_be_conducted');
			// if (!empty($fi_type[0]) && (isset($fi_type[1]) && !empty($fi_type[1]))) {
			// 	$this->form_validation->set_rules('bv_agent', 'BV Agent', 'required');
			// 	$this->form_validation->set_rules('rv_agent', 'RV Agent', 'required');
			// } else if (isset($fi_type[0]) && !empty($fi_type[0])) {
			// 	$this->form_validation->set_rules('bv_agent', 'BV Agent', 'required');
			// }


			if ($this->form_validation->run()) {
				// print_r($this->input->post());
				// die;
				foreach ($fi_type as $key => $val) {
					$varification = [];
					$address 	= array_values(array_filter($this->input->post('address')));
					$name 		= array_values(array_filter($this->input->post('name')));
					$city 		= array_values(array_filter($this->input->post('city')));
					$pincode 	= array_values(array_filter($this->input->post('pincode')));
					$varification['code'] = $this->input->post('bv_agent');
					if ($key == 1) {
						$varification['code'] = $this->input->post('rv_agent');
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
					$varification['tat_start'] 			= $this->input->post('tat_start');
					$varification['tat_end'] 			= $this->input->post('tat_end');
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
