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
			$this->form_validation->set_rules('amount', 'amount', 'required');
			$this->form_validation->set_rules('vehicle', 'vehicle', '');
			if ($this->input->post('single_agent') == 'no') {
				$this->form_validation->set_rules('agent_1', 'First Agent', 'required');
				$this->form_validation->set_rules('agent_2', 'Second Agent', 'required');
			} else {
				$this->form_validation->set_rules('agent_1', 'First Agent', 'required');
			}

			if ($this->form_validation->run()) {
				$fi_type = $this->input->post('fi_type');
				foreach ($fi_type as $key => $val) {

					$varification = [];
					$address 	= array_values(array_filter($this->input->post('address')));
					$name 		= array_values(array_filter($this->input->post('name')));
					$city 		= array_values(array_filter($this->input->post('city')));
					$pincode 	= array_values(array_filter($this->input->post('pin_code')));
					$varification['code'] = $this->input->post('agent_1');
					if ($key == 1) {
						$varification['code'] = $this->input->post('agent_2');
					}

					$varification['product'] 		= $this->input->post('product');
					$varification['reference_no'] 	= $this->input->post('reference_no');
					$varification['name'] 			= $this->input->post('applicant_name');
					$varification['amount'] 			= $this->input->post('amount');
					$varification['vehicle'] 			= $this->input->post('vehicle');
					$varification['fi_type'] = $val;
					$varification['business_add'] 	= $address[$key];
					$varification['business_name'] 		= $name[$key];
					$varification['city'] 				= $city[$key];
					$varification['pin_code'] 			= $pincode[$key];
					$varification['bank'] 			= $this->input->post('bank');
					//$varification['status'] 			= '1';

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

			echo json_encode($response);
		} catch (Exception $ex) {
			$error['error'] = TRUE;
			$error['message'] = $ex->getMessage();
			$this->load->view('login_page', array('error' => $error));
		}
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

	// public function getAgentCode_case()
	// {
	// 	$response = [];
	// 	try {
	// 		$this->load->model("Mini_case_model");
	// 		$fetch_agent_code = $this->Mini_case_model->getAgentCode();
	// 		$response = $fetch_agent_code;
	// 	} catch (Exception $ex) {
	// 		$response = [
	// 			'status' => "failure",
	// 			'message' => $ex->getMessage(),
	// 		];
	// 	}
	// 	echo json_encode($response);
	// }
	// function create_mini_case_form_submit() {
	//     try {
	//         $this->load->library('form_validation');
	//         $this->form_validation->set_rules('bank', 'bank', 'required');
	//         $this->form_validation->set_rules('product', 'product', 'required');
	//         $this->form_validation->set_rules('fi_type', 'fi_type', 'required');
	//         $this->form_validation->set_rules('reference_no', 'reference_no', 'required');
	// 		$this->form_validation->set_rules('name', 'name', 'required');
	// 		// $this->form_validation->set_rules('agent_code', 'agent_code', 'required');
	// 		$this->form_validation->set_rules('address', 'address', '');
	// 		$this->form_validation->set_rules('vehicle', 'vehicle', '');
	//         $this->form_validation->set_rules('business_name', 'business_name', '');
	//         $this->form_validation->set_rules('business_add', 'business_add', '');
	//         $this->form_validation->set_rules('residence_add', 'residence_add', '');
	//         $this->form_validation->set_rules('mobile', 'mobile', 'required');
	//         $this->form_validation->set_rules('amount', 'amount', 'required');
	//         $this->form_validation->set_rules('city', 'city', '');
	//         $this->form_validation->set_rules('pin_code', 'pin_code', '');
	// 		if ($this->input->post('single_agent') == 'no') {
	// 			$this->form_validation->set_rules('agent_1', 'First Agent', 'required');
	// 			$this->form_validation->set_rules('agent_2', 'Second Agent', 'required');
	// 		} else {
	// 			$this->form_validation->set_rules('agent_1', 'First Agent', 'required');
	// 		}



	//         if ($this->form_validation->run()) {

	// 			$fi_type = $this->input->post('fi_type');
	// 			foreach ($fi_type as $key => $val) {
	// 				$varification = [];
	// 				$address 	= array_values(array_filter($this->input->post('business_add')));
	// 				$name 		= array_values(array_filter($this->input->post('business_name')));
	// 				// $city 		= array_values(array_filter($this->input->post('city')));
	// 				$pincode 	= array_values(array_filter($this->input->post('pin_code')));
	// 				$varification['code'] = $this->input->post('agent_1');
	// 				if ($key == 1) {
	// 					$varification['code'] = $this->input->post('agent_2');
	// 				}

	// 				$varification['product'] 		= $this->input->post('product');
	// 				$varification['reference_no'] 	= $this->input->post('reference_no');
	// 				$varification['name'] 		=  $this->input->post('name');
	// 				$varification['vehicle'] 				= $this->input->post('vehicle');
	// 				$varification['mobile'] 			= $this->input->post('mobile');
	// 				$varification['residence_add'] 			= $this->input->post('residence_add');
	// 				$varification['address'] 			= $this->input->post('address');
	// 				$varification['amount'] 			= $this->input->post('amount');

	// 				$varification['fi_type'] = $val;

	// 				$varification['business_add'] 	= $address[$key];
	// 				$varification['business_name'] 		= $name[$key];
	// 				$varification['city'] 				= $city[$key];
	// 				$varification['pin_code'] 			= $pincode[$key];
	// 				$varification['bank'] 			= $this->input->post('bank');
	// 				//$varification['status'] 			= '1';

	// 				// $res = $this->Case_form_model->insert_case($varification);

	//             // $data = array(
	//             //     'bank' => $this->input->post('bank'),
	//             //     'product' => $this->input->post('product'),
	//             //     'fi_type' => $this->input->post('fi_type'),
	//             //     'reference_no' => $this->input->post('reference_no'),
	// 			// 	'name' => $this->input->post('name'),
	// 			// 	// 'agent_code' => $this->input->post('agent_code'),
	// 			// 	'vehicle' => $this->input->post('vehicle'),
	// 			// 	'address' => $this->input->post('address'),
	//             //     'business_name' => $this->input->post('business_name'),
	//             //     'business_add' => $this->input->post('business_add'),
	//             //     'residence_add' => $this->input->post('residence_add'),
	//             //     'mobile' => $this->input->post('mobile'),
	//             //     'amount' => $this->input->post('amount'),
	//             //     'city' => $this->input->post('city'),
	//             //     'pin_code' => $this->input->post('pin_code')

	//             // );
	//                 // print_r($this->input->post());
	//              // if form validation success then load admin model to perform data insert in database


	// 			$this->load->model('Mini_case_model');
	// 			$res_id = $this->Mini_case_model->insert_mini_case($varification);
	// 		}
	// 		if ($res_id) {
	// 			// check if data inserted and return inserted id
	// 			$response = array(
	// 				'success' => true,
	// 				'message' => "Case Generated successfully"
	// 			);
	// 		} else {
	// 			$response = array(
	// 				'error' => true,
	// 				'message' => "Error while saving data !!!!"
	// 			);
	// 		}
	// 	} else {
	// 		// if error in form validation
	// 		foreach ($_POST as $key => $value) {
	// 			$response['messages'][$key] = form_error($key);
	// 		}
	// 	}

	// 	echo json_encode($response);
	//     } catch (Exception $ex) {
	//         $error['error'] = TRUE;
	//         $error['message'] = $ex->getMessage();
	//         $this->load->view('login_page', array('error' => $error));
	//     }
	// }

	// function create_Quick_case_form_submit()
	// {
	// 	try {
	// 		$this->load->model('Mini_case_model');
	// 		$this->load->library('form_validation');
	// 		$this->form_validation->set_rules('bank', 'bank', 'required');
	// 		$this->form_validation->set_rules('product', 'product', 'required');
	// 		$this->form_validation->set_rules('reference_no', 'reference_no', 'required');
	// 		$this->form_validation->set_rules('name', 'name', 'required');

	// 		$this->form_validation->set_rules('amount', 'amount', 'required');
	// 		$this->form_validation->set_rules('mobile', 'mobile', 'required');
	// 		$this->form_validation->set_rules('vehicle', 'vehicle', '');
	// 		// $this->form_validation->set_rules('co_applicant', 'co_applicant', '');

	// 		if ($this->input->post('single_agent') == 'no') {
	// 			$this->form_validation->set_rules('agent_1', 'First Agent', 'required');
	// 			$this->form_validation->set_rules('agent_2', 'Second Agent', 'required');
	// 		} else {
	// 			$this->form_validation->set_rules('agent_1', 'First Agent', 'required');
	// 		}


	// 		if ($this->form_validation->run()) {

	// 			$fi_type = $this->input->post('fi_type');
	// 			foreach ($fi_type as $key => $val) {
	// 				$varification = [];
	// 				$address 	= array_values(array_filter($this->input->post('address')));
	// 				$name 		= array_values(array_filter($this->input->post('name')));
	// 				$city 		= array_values(array_filter($this->input->post('city')));
	// 				$pincode 	= array_values(array_filter($this->input->post('pin_code')));
	// 				$varification['code'] = $this->input->post('agent_1');
	// 				if ($key == 1) {
	// 					$varification['code'] = $this->input->post('agent_2');
	// 				}

	// 				$varification['product'] 		= $this->input->post('product');
	// 				$varification['reference_no'] 	= $this->input->post('reference_no');
	// 				$varification['name'] 		= $this->input->post('name');
	// 				$varification['amount'] 			= $this->input->post('amount');
	// 				$varification['vehicle'] 			= $this->input->post('vehicle');
	// 				$varification['remarks'] 			= $this->input->post('remarks');
	// 				$varification['fi_type'] = $val;
	// 				$varification['business_address'] 	= $address[$key];
	// 				$varification['business_name'] 		= $name[$key];
	// 				$varification['city'] 				= $city[$key];
	// 				$varification['pin_code'] 			= $pincode[$key];
	// 				$varification['bank'] 			= $this->input->post('bank');
	// 				//$varification['status'] 			= '1';

	// 				$res_id = $this->Mini_case_model->insert_mini_case($varification);
	// 			}
	// 			if ($res_id) {
	// 				// check if data inserted and return inserted id
	// 				$response = array(
	// 					'success' => true,
	// 					'message' => "Quick Case Generated successfully"
	// 				);
	// 			} else {
	// 				$response = array(
	// 					'error' => true,
	// 					'message' => "Error while saving data !!!!"
	// 				);
	// 			}
	// 		} else {
	// 			// if error in form validation
	// 			foreach ($_POST as $key => $value) {
	// 				$response['messages'][$key] = form_error($key);
	// 			}
	// 		}

	// 		echo json_encode($response);
	// 	} catch (Exception $ex) {
	// 		$error['error'] = TRUE;
	// 		$error['message'] = $ex->getMessage();
	// 		$this->load->view('login_page', array('error' => $error));
	// 	}
	// }

}
