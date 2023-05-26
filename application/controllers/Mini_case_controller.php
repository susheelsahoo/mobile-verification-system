<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mini_case_controller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('mini_case_model');
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


	public function mini_case_form()
	{
		$this->load->library('session');
		$this->load->model("Mini_case_model");
		$bank_data = $this->Mini_case_model->getBank();
		$product_data = $this->Mini_case_model->getProduct();
		$agent_code = $this->Mini_case_model->getAgentCode();
		// print_r($agent_code);die;
		$data['bank_names'] = $bank_data;
		$data['product_data'] = $product_data;
		$data['agent_code'] = $agent_code;
		if ($this->session->userdata('user')) {
			$this->load->view('mini_case', $data);
		} else {
			redirect('/');
		}
	}





	function create_Quick_case_form_submit()
	{
		try {
			$this->load->model('Mini_case_model');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('bank', 'bank', 'required');
			$this->form_validation->set_rules('fi_type', 'fi_type', '');
			$this->form_validation->set_rules('product', 'product', 'required');
			$this->form_validation->set_rules('reference_no', 'reference_no', 'required');
			$this->form_validation->set_rules('name', 'name', '');
				// $this->form_validation->set_rules('code', 'code', 'required');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			// $this->form_validation->set_rules('vehicle', 'vehicle', '');
			$this->form_validation->set_rules('mobile', 'mobile', '');
			$this->form_validation->set_rules('geo_limit', 'geo_limit', 'required');
			$this->form_validation->set_rules('source_channel', 'source_channel', '');
			$this->form_validation->set_rules('tat_start', 'tat_start', 'required');
			$this->form_validation->set_rules('tat_end', 'tat_end', 'required');
			$fi_type = $this->input->post('fi_type');
			// print_r($fi_type);die;
			// if (!empty($fi_type[0]) && (isset($fi_type[1]) && !empty($fi_type[1]))) {
			// 	$this->form_validation->set_rules('bv_agent', 'BV Agent', 'required');
			// 	$this->form_validation->set_rules('rv_agent', 'RV Agent', 'required');
			// } else if (isset($fi_type[0]) && !empty($fi_type[0])) {
			// 	$this->form_validation->set_rules('bv_agent', 'BV Agent', 'required');
			// }
			if ($this->form_validation->run()) {
				foreach ($fi_type as $key => $val) {
					$varification = [];
					$address 	= array_values(array_filter($this->input->post('address')));
					$name 		= array_values(array_filter($this->input->post('name')));
					$city 		= array_values(array_filter($this->input->post('city')));
					$pincode 	= array_values(array_filter($this->input->post('pin_code')));
					$varification['code'] = $this->input->post('bv_agent');
					if ($key == 1) {
						$varification['code'] = $this->input->post('rv_agent');
					}

					$varification['product'] 		= $this->input->post('product');
					$varification['reference_no'] 	= $this->input->post('reference_no');
					$varification['name'] 			= $this->input->post('applicant_name');
					$varification['amount'] 		= $this->input->post('amount');
					$varification['vehicle'] 		= $this->input->post('vehicle');
					$varification['mobile'] 			= $this->input->post('mobile');
				// 		$varification['code'] 			= $this->input->post('code');
					$varification['geo_limit'] 			= $this->input->post('geo_limit');
					$varification['source_channel'] 			= $this->input->post('source_channel');
					$varification['tat_start'] 		= $this->input->post('tat_start');
					$varification['tat_end'] 		= $this->input->post('tat_end');
					$varification['fi_type'] 		= $val;
					$varification['business_add'] 	= $address[$key];
					$varification['business_name'] 	= $name[$key];
					$varification['city'] 			= $city[$key];
					$varification['pin_code'] 		= $pincode[$key];
					$varification['bank'] 			= $this->input->post('bank');
					//$varification['status'] 		= '1';
					// print_r($varification);die;

					$res_id = $this->Mini_case_model->insert_mini_case($varification);
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

			// echo json_encode($response);
		} catch (Exception $ex) {
			// $error['error'] = TRUE;
			// $error['message'] = $ex->getMessage();
			$response = array(
				'error' => true,
				'message' => $ex->getMessage(),
			);
			// echo $error;			// $this->load->view('login_page', array('error' => $error));
		}
		echo json_encode($response);
	}


	public function getBank()
	{
		$response = [];
		try {
			$this->load->model("Mini_case_model");
			$fetch_data = $this->Mini_case_model->getBank();
			$response = $fetch_data;
			//            print_r($fetch_data);die;
		} catch (Exception $ex) {
			$response = [
				'status' => "failure",
				'message' => $ex->getMessage(),
			];
		}
		echo json_encode($response);
	}


	public function getProduct()
	{
		$response = [];
		try {
			$this->load->model("Mini_case_model");
			$fetch_product = $this->Mini_case_model->getProduct();
			$response = $fetch_product;
		} catch (Exception $ex) {
			$response = [
				'status' => "failure",
				'message' => $ex->getMessage(),
			];
		}
		echo json_encode($response);
	}

	public function getAgentCode()
	{
		$response = [];
		try {
			$this->load->model("Mini_case_model");
			$fetch_agent_code = $this->Mini_case_model->getAgentCode();
			$response = $fetch_agent_code;
		} catch (Exception $ex) {
			$response = [
				'status' => "failure",
				'message' => $ex->getMessage(),
			];
		}
		echo json_encode($response);
	}
}
