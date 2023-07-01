<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require 'vendor/autoload.php'; // Include PHPMailer autoload file
    //     require '/PHPMailer/src/Exception.php';
    // require '/PHPMailer/src/PHPMailer.php';
    // require '/PHPMailer/src/SMTP.php';

   # use "use" after include or require

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;
    // use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
			$source_data = $this->Mini_case_model->getSourceChannel();
		$agent_code = $this->Mini_case_model->getAgentCode();
		$data['bank_names'] = $bank_data;
		$data['product_data'] = $product_data;
			$data['source_data'] = $source_data;
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
        $this->form_validation->set_rules('co_applicant', 'Co-Applicant Name', '');
        $this->form_validation->set_rules('guarantee_name', 'Guarantee Name', '');
        $this->form_validation->set_rules('geo_limit', 'Geo Limit', '');
        $this->form_validation->set_rules('source_channel', 'Source Channel', 'required');
        $this->form_validation->set_rules('tat_start', 'TAT Start', 'required');
        $this->form_validation->set_rules('tat_end', 'TAT End', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', '');
        $fi_type = $this->input->post('fi_to_be_conducted');
        $session_user = $this->session->userdata('user');
        if ($this->form_validation->run()) {

            foreach ($fi_type as $key => $val) {
                $varification = [];
                $address = array_values(array_filter($this->input->post('address')));
                $name = array_values(array_filter($this->input->post('name')));
                $city = array_values(array_filter($this->input->post('city')));
                $pincode = array_values(array_filter($this->input->post('pincode')));
                $agent_code = array_values(array_filter($this->input->post('agent_code')));
                $geo_limit = array_values(array_filter($this->input->post('geo_limit')));

                $varification['product_name'] = $this->input->post('product_name');

                $varification['application_id'] = $this->input->post('application_id');
                // Generate random digit
                $random_digit = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
                $varification['random_no'] = $random_digit;
                $varification['customer_name'] = $this->input->post('customer_name');
                $varification['dob'] = $this->input->post('dob');
                $varification['amount'] = $this->input->post('amount');
                $varification['vehicle'] = $this->input->post('vehicle');
                $varification['mobile'] = $this->input->post('mobile');
                $varification['co_applicant'] = $this->input->post('co_applicant');
                $varification['guarantee_name'] = $this->input->post('guarantee_name');
                // $varification['geo_limit'] = $this->input->post('geo_limit');
                $varification['source_channel'] = $this->input->post('source_channel');
                $varification['tat_start'] = formatDate($this->input->post('tat_start'), 'Y-m-d H:i:s');
                $varification['tat_end'] = formatDate($this->input->post('tat_end'), 'Y-m-d H:i:s');
                $varification['remarks'] = $this->input->post('remarks');
                $varification['fi_to_be_conducted'] = $val;
                $varification['business_address'] = $address[$key];
                $varification['business_name'] = $name[$key];
                $varification['city'] = $city[$key];
                $varification['pincode'] = $pincode[$key];
                $varification['code'] = $agent_code[$key];
                 $varification['geo_limit'] = $geo_limit[$key];
                $varification['bank_name'] = $this->input->post('bank_name');
                $varification['created_by'] = $session_user['username'];
                $varification['created_at'] = date('Y-m-d H:i:s');
                $varification['updated_at'] = date('Y-m-d H:i:s');

                $res_id = $this->Case_form_model->insert_case($varification);

                // Retrieve email based on code from login table
                $this->load->model('Case_form_model');
                $email = $this->Case_form_model->getEmailByCode($varification['code']);

                if (!empty($email)) {
                      
                      
                      $this->load->library('email');
                    $this->email->from('yogitasharma1606@gmail.com', 'Yogita Sharma');
                    $this->email->to($email);
                    // $this->email->subject('NEW CASE CREATED');
                    $this->email->subject('NEW CASE CREATED - Bank Name: ' . $this->input->post('bank_name') . ', Product Name: ' . $this->input->post('product_name') . ', Application ID: ' . $this->input->post('application_id') . ', TAT Start: ' . $this->input->post('tat_start') . ', TAT End: ' . $this->input->post('tat_end'));

               
                    // $this->email->message('We have Assigned a case to you, Case details is given below :Bank Name: ' . $this->input->post('bank_name') . 'Product Name: ' . $this->input->post('product_name') . 'Application ID: ' . $this->input->post('application_id') . 'To check more details login in your Mobile App');
// 
                      $this->email->message('To Check more details, Please login in your Mobile App');


                    if (!$this->email->send()) {
                        // Handle email sending error if necessary
                        echo $this->email->print_debugger();
                    }
//                       require_once APPPATH.'third_party/PHPMailer/src/PHPMailer.php';
//                       require_once APPPATH.'third_party/PHPMailer/src/Exception.php';
//                       require_once APPPATH.'third_party/PHPMailer/src/SMTP.php';
        
        
             
//  $mail = new PHPMailer();
//                     // $mail = new PHPMailer\PHPMailer\PHPMailer();
                    
//                     // Server settings
//                       $mail->isSMTP(); // Set mailer to use SMTP
//                       $mail->Host = 'smtp-relay.gmail.com'; // Specify main and backup SMTP servers
//                       $mail->SMTPAuth = true; // Enable SMTP authentication
//                       $mail->Username = 'admin@realbitscoders.com'; // SMTP username
//                       $mail->Password = 'OU2sje!MTv*6BY$g'; // SMTP password
//                       $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
//                       $mail->Port = 587; // TCP port to connect to


//                       $mail->setFrom('admin@realbitscoders.com', 'RealBits Coders');
//                       $mail->addAddress('yogitasharma1606@gmail.com');
//                     //   $mail->addAddress($email); // Replace $email with the recipient's email address


                    

//                     // Email content
//                     $mail->isHTML(true);
//                     $mail->Subject = 'New Case Created';
//                     $mail->Body = 'A new case has been created.';

//                     // Send the email
//                     $mail->send();
                }
            }

            if ($res_id) {
                // check if data inserted and return inserted id
                $response = array(
                    'success' => true,
                    'message' => "Case Generated successfully!"
                );
            } else {
                $response = array(
                    'error' => true,
                    'message' => "Error while saving data!"
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



// function create_case_form_submit()
// {
//     try {
//         $this->load->model('Case_form_model');
//         $this->load->library('form_validation');
//         $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
//         $this->form_validation->set_rules('product_name', 'Product Name', 'required');
//         $this->form_validation->set_rules('application_id', 'Application ID', 'required');
//         $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
//         $this->form_validation->set_rules('dob', 'dob', '');
//         $this->form_validation->set_rules('amount', 'amount', 'required');
//         $this->form_validation->set_rules('vehicle', 'vehicle', 'required');
//         $this->form_validation->set_rules('co_applicant', 'Co-Applicant Name', '');
//         $this->form_validation->set_rules('guarantee_name', 'Guarantee Name', '');
//         $this->form_validation->set_rules('geo_limit', 'Geo Limit', '');
//         $this->form_validation->set_rules('source_channel', 'Source Channel', 'required');
//         $this->form_validation->set_rules('tat_start', 'TAT Start', 'required');
//         $this->form_validation->set_rules('hours', 'Hours', 'required');
//         $this->form_validation->set_rules('remarks', 'Remarks', '');

//         if ($this->form_validation->run()) {
//              $random_no = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
//             $tat_start = $this->input->post('tat_start');
//             $hours = $this->input->post('hours');

//             // Convert TAT start to timestamp
//             $tat_start_timestamp = strtotime($tat_start);

//             // Add hours to TAT start
//             $tat_end_timestamp = $tat_start_timestamp + ($hours * 3600);

//             // Format TAT end timestamp as datetime string
//             $tat_end = date('Y-m-d H:i:s', $tat_end_timestamp);

//             $varification = array(
                
//                 'bank_name' => $this->input->post('bank_name'),
//                 'product_name' => $this->input->post('product_name'),
//                 'application_id' => $this->input->post('application_id'),
//                 'customer_name' => $this->input->post('customer_name'),
//                 'dob' => $this->input->post('dob'),
//                 'random_no' => $random_no,
//                 'amount' => $this->input->post('amount'),
//                 'vehicle' => $this->input->post('vehicle'),
//                 'co_applicant' => $this->input->post('co_applicant'),
//                 'guarantee_name' => $this->input->post('guarantee_name'),
//                 'geo_limit' => $this->input->post('geo_limit'),
//                 'source_channel' => $this->input->post('source_channel'),
//                 'tat_start' => $tat_start,
//                 'tat_end' => $tat_end,
//                 'remarks' => $this->input->post('remarks')
//             );

//             $fi_type = $this->input->post('fi_to_be_conducted');
//             $session_user = $this->session->userdata('user');

//             if (is_array($fi_type)) {
//                 foreach ($fi_type as $key => $val) {
//                     $varification['fi_to_be_conducted'] = $val;

//                     // Handle verification data for each fi_type
//                     $address = $this->input->post('address')[$key];
//                     $name = $this->input->post('name')[$key];
//                     $city = $this->input->post('city')[$key];
//                     $pincode = $this->input->post('pincode')[$key];
//                     $agent_code = $this->input->post('agent_code')[$key];
//                     $geo_limit = $this->input->post('geo_limit')[$key];

//                     $varification['business_address'] = $address;
//                     $varification['business_name'] = $name;
//                     $varification['city'] = $city;
//                     $varification['pincode'] = $pincode;
//                     $varification['code'] = $agent_code;
//                     $varification['geo_limit'] = $geo_limit;

//                     $res_id = $this->Case_form_model->insert_case($varification);

//                     // Retrieve email based on code from login table
//                     $email = $this->Case_form_model->getEmailByCode($varification['code']);

//                     if (!empty($email)) {
//                         // Send email notification
//                         $this->load->library('email');
//                         $this->email->from('yogitasharma1606@gmail.com', 'Yogita Sharma');
//                         $this->email->to($email);
//                         $this->email->subject('NEW CASE CREATED - Bank Name: ' . $this->input->post('bank_name') . ', Product Name: ' . $this->input->post('product_name') . ', Application ID: ' . $this->input->post('application_id') . ', TAT Start: ' . $this->input->post('tat_start') . ', TAT End: ' . $tat_end);
//                         $this->email->message('To Check more details, Please login to your Mobile App');

//                         if (!$this->email->send()) {
//                             // Handle email sending error if necessary
//                             echo $this->email->print_debugger();
//                         }
//                     }
//                 }

//                 if ($res_id) {
//                     // Data inserted successfully
//                     $response = array(
//                         'success' => true,
//                         'message' => "Case Generated successfully!"
//                     );
//                 } else {
//                     // Error while saving data
//                     $response = array(
//                         'error' => true,
//                         'message' => "Error while saving data!"
//                     );
//                 }
//             } else {
//                 // Invalid fi_type data
//                 $response = array(
//                     'error' => true,
//                     'message' => "Invalid fi_type data!"
//                 );
//             }
//         } else {
//             // Form validation errors
//             $response = array(
//                 'error' => true,
//                 'message' => validation_errors()
//             );
//         }

//         echo json_encode($response);
//     } catch (Exception $ex) {
//         $error['error'] = TRUE;
//         $error['message'] = $ex->getMessage();
//         $this->load->view('login_page', array('error' => $error));
//     }
// }



}
