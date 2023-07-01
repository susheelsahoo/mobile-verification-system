<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
class Upload_case_controller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('upload_case_model');
	}


// 	public function index()
// 	{
// 		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// 			$response = [];
// 			$upload_status =  $this->uploadDoc();
// 			if ($upload_status != false) {
// 				$inputFileName = 'assets/uploads/imports/' . $upload_status;
// 				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
// 				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
// 				$spreadsheet = $reader->load($inputFileName);
// 				$sheet 			= $spreadsheet->getSheet(0)->toArray();
// 				$upload_type 	= $this->input->post('upload_type');
// 				$bank 			= $this->input->post('bank');
// 				$count_Rows = 0;
// 				$data['created_at'] = date('Y-m-d H:i:s');
// 				$session_user = $this->session->userdata('user');
// 				// print_r($data);
// 				// die;
// 				// echo "<pre>";
// 				if ($upload_type == 'create_case') {
// 					foreach ($sheet as $key => $row) {
// 						// print_r($row);
// 						if ($key == 0) {
// 							continue;
// 						}
// 						// die;
// 							$station 	= $row['20'];
// 						$station_array = explode(",", $station);
						
// 						$fi_to_be_conducted 	= $row['2'];
// 						$fi_to_be_conducted_array = explode(",", $fi_to_be_conducted);

// 						if (count($fi_to_be_conducted_array) != 0) {
// 							foreach ($fi_to_be_conducted_array as $fi_type) {
// 								$fi_type = trim($fi_type);
// 								if ($fi_type == 'RV') {
// 									$agent_code 	= $row['25'];
// 									$address 		= $row['4'];
// 									$name 			= NULL;
// 									$city 			= $row['5'];
// 									$pincode 		= $row['6'];
									
// 								} elseif ($fi_type == 'BV') {
// 									$agent_code 	= $row['24'];
// 									$address 		= $row['7'];
// 									$name 			= $row['8'];
// 									$city 			= $row['9'];
// 									$pincode 		= $row['10'];
									
// 								} else {
// 									continue;
// 								}
// 								$data = [];
// 								$data = array(
// 									'application_id' 		=> $row['0'],
// 									'bank_name'				=> $bank,
// 									'customer_name' 		=> $row['1'],
// 									'fi_to_be_conducted' 	=> $fi_type,
// 									'product_name' 			=> $row['3'],
// 									'business_address' 		=> $address,
// 									'business_name' 		=> $name,
// 									'city' 					=> $city,
// 									'pincode' 				=> $pincode,
// 									'mobile' 				=> $row['11'],
// 									'permanent_address' 	=> $row['12'],
// 									'fi_date' 				=> $row['13'],
// 									'fi_time' 				=> $row['14'],
// 									'fi_flag' 				=> $row['15'],
// 									'dob' 					=> $row['16'],
// 									'designation' 			=> $row['17'],
// 									'loan_amount' 			=> $row['18'],
// 									'vehicle' 				=> $row['19'],
// 									'station' 				=> $row['20'],
									
// 									'tat_start' 			=> formatDate($row['21'], 'Y-m-d H:i:s'),
// 									'tat_end' 				=> formatDate($row['22'], 'Y-m-d H:i:s'),
// 									'remarks' 				=> $row['23'],
// 									'code' 					=> $agent_code,
// 									'created_by' 	        => $session_user['id'],
// 									'created_at'            => date('Y-m-d H:i:s'),
// 					                'updated_at'            => date('Y-m-d H:i:s'),
// 								);
// 								// echo "<pre>";
// 								// print_r($data);
// 								// die;
// 								$this->db->insert('upload_file', $data);;
// 							}
// 						}
// 					}
// 				} else {
// 					// echo "<pre>";
// 					foreach ($sheet as $key => $row) {
// 						// print_r($row);
// 						if ($key == 0) {
// 							continue;
// 						}
// 						// die;
// 						$fi_to_be_conducted 	= $row['2'];
// 						$fi_to_be_conducted_array = explode(",", $fi_to_be_conducted);

// 						if (count($fi_to_be_conducted_array) != 0) {
// 							foreach ($fi_to_be_conducted_array as $fi_type) {
// 								$fi_type = trim($fi_type);
// 								if ($fi_type == 'RV') {
// 									$agent_code 	= $row['25'];
// 									$address 		= $row['4'];
// 									$name 			= NULL;
// 									$city 			= $row['5'];
// 									$pincode 		= $row['6'];
// 								} elseif ($fi_type == 'BV') {
// 									$agent_code 	= $row['24'];
// 									$address 		= $row['7'];
// 									$name 			= $row['8'];
// 									$city 			= $row['9'];
// 									$pincode 		= $row['10'];
// 								} else {
// 									continue;
// 								}
// 								$data = [];
// 								$data = array(
// 									'reference_no' 			=> $row['0'],
// 									'bank'					=> $bank,
// 									'name' 					=> $row['1'],
// 									'fi_type' 				=> $fi_type,
// 									'product' 				=> $row['3'],
// 									'business_add' 			=> $address,
// 									'business_name' 		=> $name,
// 									'city' 					=> $city,
// 									'pin_code'				=> $pincode,
// 									'mobile' 				=> $row['11'],
// 									// 'fi_date' 				=> $row['12'],
// 									'fi_date' 				=> $row['13'],
// 									'fi_time' 				=> $row['14'],
// 									'fi_flag' 				=> $row['15'],
// 									'dob' 					=> $row['16'],
// 									// 'designation' 			=> $row['16'],
// 									'amount' 				=> $row['18'],
// 									'vehicle' 				=> $row['19'],
// 									// 'asset_model' 			=> $row['20'],
// 									// 'station' 				=> $row['21'],
// 									'tat_start' 			=> formatDate($row['21'], 'Y-m-d H:i:s'),
// 									'tat_end' 				=> formatDate($row['22'], 'Y-m-d H:i:s'),
// 									'remarks' 				=> $row['23'],
// 									'code' 					=> $agent_code,
// 									'created_by' 	        => $session_user['id'],
// 									'created_at'            => date('Y-m-d H:i:s'),
// 					                'updated_at'            => date('Y-m-d H:i:s'),
// 								);
// 								// echo "<pre>";
// 								// print_r($data);
// 								// die;
// 								$this->db->insert('mini_case', $data);;
// 							}
// 						}
// 					}
// 				}

// 				$response = array('type' => 'success', 'massege' => 'Excel Data Imported Successfully');
// 				$this->session->set_flashdata('res_data', $response);
// 			} else {
// 				$response = array('type' => 'error', 'massege' => 'File is not uploaded');
// 				$this->session->set_flashdata('res_data', $response);
// 			}
// 			redirect(base_url("/Create_cse/create_c"));
// 		} else {
// 			$this->load->view('login_page');
// 		}
// 	}
	
		public function index()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$response = [];
			$upload_status =  $this->uploadDoc();
			if ($upload_status != false) {
				$inputFileName = 'assets/uploads/imports/' . $upload_status;
				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet = $reader->load($inputFileName);
				$sheet 			= $spreadsheet->getSheet(0)->toArray();
				$upload_type 	= $this->input->post('upload_type');
				$bank 			= $this->input->post('bank');
				$count_Rows = 0;
				$data['created_at'] = date('Y-m-d H:i:s');
				$session_user = $this->session->userdata('user');
				// print_r($data);
				// die;
				// echo "<pre>";
				if ($upload_type == 'create_case') {
					foreach ($sheet as $key => $row) {
						// print_r($row);
						if ($key == 0) {
							continue;
						}
						// die;
				// 			$station 	= $row['20'];
				// 		$station_array = explode(",", $station);
						
						$fi_to_be_conducted 	= $row['2'];
						$fi_to_be_conducted_array = explode(",", $fi_to_be_conducted);

						if (count($fi_to_be_conducted_array) != 0) {
							foreach ($fi_to_be_conducted_array as $fi_type) {
								$fi_type = trim($fi_type);
								if ($fi_type == 'RV') {
									$agent_code 	= $row['25'];
									$address 		= $row['4'];
									$name 			= NULL;
									$city 			= $row['5'];
									$pincode 		= $row['6'];
									$geo_limit 		= $row['20'];
									
								} elseif ($fi_type == 'BV') {
									$agent_code 	= $row['25'];
									$address 		= $row['7'];
									$name 			= $row['8'];
									$city 			= $row['9'];
									$pincode 		= $row['10'];
									$geo_limit 		= $row['21'];
									
								} else {
									continue;
								}
								$data = [];
								$data = array(
									'application_id' 		=> $row['0'],
									'bank_name'				=> $bank,
									'customer_name' 		=> $row['1'],
									'fi_to_be_conducted' 	=> $fi_type,
									'product_name' 			=> $row['3'],
									'business_address' 		=> $address,
									'business_name' 		=> $name,
									'city' 					=> $city,
									'pincode' 				=> $pincode,
									'mobile' 				=> $row['11'],
									'permanent_address' 	=> $row['12'],
									'fi_date' 				=> $row['13'],
									'fi_time' 				=> $row['14'],
									'fi_flag' 				=> $row['15'],
									'dob' 					=> $row['16'],
									'designation' 			=> $row['17'],
									'loan_amount' 			=> $row['18'],
									'vehicle' 				=> $row['19'],
							    	'geo_limit' 				=> $geo_limit,
									
									'tat_start' 			=> formatDate($row['22'], 'Y-m-d H:i:s'),
									'tat_end' 				=> formatDate($row['23'], 'Y-m-d H:i:s'),
									'remarks' 				=> $row['24'],
									'code' 					=> $agent_code,
									'created_by' 	        => $session_user['id'],
									'created_at'            => date('Y-m-d H:i:s'),
					                'updated_at'            => date('Y-m-d H:i:s'),
								);
								// echo "<pre>";
								// print_r($data);
								// die;
								$this->db->insert('upload_file', $data);;
							}
						}
					}
				} else {
					// echo "<pre>";
					foreach ($sheet as $key => $row) {
						// print_r($row);
						if ($key == 0) {
							continue;
						}
						// die;
						$fi_to_be_conducted 	= $row['2'];
						$fi_to_be_conducted_array = explode(",", $fi_to_be_conducted);

						if (count($fi_to_be_conducted_array) != 0) {
							foreach ($fi_to_be_conducted_array as $fi_type) {
								$fi_type = trim($fi_type);
								if ($fi_type == 'RV') {
									$agent_code 	= $row['25'];
									$address 		= $row['4'];
									$name 			= NULL;
									$city 			= $row['5'];
									$pincode 		= $row['6'];
								} elseif ($fi_type == 'BV') {
									$agent_code 	= $row['25'];
									$address 		= $row['7'];
									$name 			= $row['8'];
									$city 			= $row['9'];
									$pincode 		= $row['10'];
								} else {
									continue;
								}
								$data = [];
								$data = array(
									'reference_no' 			=> $row['0'],
									'bank'					=> $bank,
									'name' 					=> $row['1'],
									'fi_type' 				=> $fi_type,
									'product' 				=> $row['3'],
									'business_add' 			=> $address,
									'business_name' 		=> $name,
									'city' 					=> $city,
									'pin_code'				=> $pincode,
									'mobile' 				=> $row['11'],
									// 'fi_date' 				=> $row['12'],
									'fi_date' 				=> $row['13'],
									'fi_time' 				=> $row['14'],
									'fi_flag' 				=> $row['15'],
									'dob' 					=> $row['16'],
									// 'designation' 			=> $row['16'],
									'amount' 				=> $row['18'],
									'vehicle' 				=> $row['19'],
									'geo_limit' 				=> $geo_limit,
								// 	'station' 				=> $row['21'],
									
									'tat_start' 			=> formatDate($row['22'], 'Y-m-d H:i:s'),
									'tat_end' 				=> formatDate($row['23'], 'Y-m-d H:i:s'),
									'remarks' 				=> $row['24'],
									'code' 					=> $agent_code,
									'created_by' 	        => $session_user['id'],
									'created_at'            => date('Y-m-d H:i:s'),
					                'updated_at'            => date('Y-m-d H:i:s'),
								);
								// echo "<pre>";
								// print_r($data);
								// die;
								$this->db->insert('mini_case', $data);;
							}
						}
					}
				}

				$response = array('type' => 'success', 'massege' => 'Excel Data Imported Successfully');
				$this->session->set_flashdata('res_data', $response);
			} else {
				$response = array('type' => 'error', 'massege' => 'File is not uploaded');
				$this->session->set_flashdata('res_data', $response);
			}
			redirect(base_url("/Create_cse/create_c"));
		} else {
			$this->load->view('login_page');
		}
	}

// public function index()
//     {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             $response = [];
//             $upload_status =  $this->uploadDoc();
//             if ($upload_status != false) {
//                 $inputFileName = 'assets/uploads/imports/' . $upload_status;
//                 $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
//                 $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
//                 $spreadsheet = $reader->load($inputFileName);
//                 $sheet = $spreadsheet->getSheet(0)->toArray();
//                 $upload_type = $this->input->post('upload_type');
//                 $bank = $this->input->post('bank');
//                 $count_Rows = 0;
//                 $data['created_at'] = date('Y-m-d H:i:s');
//                 $session_user = $this->session->userdata('user');

//                 if ($upload_type == 'create_case') {
//                     foreach ($sheet as $key => $row) {
//                         if ($key == 0) {
//                             continue;
//                         }
                        
//                         $station = $row['20'];
//                         $station_array = explode(",", $station);

//                         foreach ($station_array as $station_value) {
//                             $station_value = trim($station_value);
//                             $fi_to_be_conducted = $row['2'];
//                             $fi_to_be_conducted_array = explode(",", $fi_to_be_conducted);

//                             if (count($fi_to_be_conducted_array) != 0) {
//                                 foreach ($fi_to_be_conducted_array as $fi_type) {
//                                     $fi_type = trim($fi_type);
//                                     if ($fi_type == 'RV') {
//                                         $agent_code = $row['25'];
//                                         $address = $row['4'];
//                                         $name = NULL;
//                                         $city = $row['5'];
//                                         $pincode = $row['6'];
//                                     } elseif ($fi_type == 'BV') {
//                                         $agent_code = $row['24'];
//                                         $address = $row['7'];
//                                         $name = $row['8'];
//                                         $city = $row['9'];
//                                         $pincode = $row['10'];
//                                     } else {
//                                         continue;
//                                     }
//                                     $data = array(
//                                         'application_id' => $row['0'],
//                                         'bank_name' => $bank,
//                                         'customer_name' => $row['1'],
//                                         'fi_to_be_conducted' => $fi_type,
//                                         'product_name' => $row['3'],
//                                         'business_address' => $address,
//                                         'business_name' => $name,
//                                         'city' => $city,
//                                         'pincode' => $pincode,
//                                         'mobile' => $row['11'],
//                                         'permanent_address' => $row['12'],
//                                         'fi_date' => $row['13'],
//                                         'fi_time' => $row['14'],
//                                         'fi_flag' => $row['15'],
//                                         'dob' => $row['16'],
//                                         'designation' => $row['17'],
//                                         'loan_amount' => $row['18'],
//                                         // 'agreement_value' => $row['19'],
//                                         'station' => $station_value,
//                                         'code' => $agent_code,
//                                         'created_at' => $data['created_at'],
//                                         'created_by' => $session_user['id']
//                                     );

//                                     $this->db->insert('upload_file', $data);
//                                     $count_Rows++;
//                                 }
//                             }
//                         }
//                     }
//                 }
//                 $response['status'] = 'success';
//                 $response['message'] = $count_Rows . " rows inserted successfully.";
//             } else {
//                 $response['status'] = 'error';
//                 $response['message'] = 'Error in uploading file.';
//             }
//             echo json_encode($response);
//         } else {
//             $data['banks'] = $this->upload_case_model->get_banks();
//             $this->load->view('upload-case', $data);
//         }
//     }


	public function upload_case_form()
	{
		//load session library
		$this->load->library('session');
		$this->load->model("Mini_case_model");
		$product_data = $this->Mini_case_model->getProduct();
		$bank_data = $this->Mini_case_model->getBank();
		$data['product_data'] 	= $product_data;
		$data['bank_names'] 	= $bank_data;

		//restrict users to go to home if not logged in
		if ($this->session->userdata('user')) {
			$this->load->view('upload_case', $data);
		} else {
			redirect('/');
		}
	}

	function uploadDoc()
	{
		$uploadPath = 'assets/uploads/imports/';
		if (!is_dir($uploadPath)) {
			mkdir($uploadPath, 0777, TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
		}

		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = 'csv|xlsx|xls';
		$config['max_size'] = 10000000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('upload_excel')) {
			$fileData = $this->upload->data();
			return $fileData['file_name'];
		} else {
			return false;
		}
	}
}
