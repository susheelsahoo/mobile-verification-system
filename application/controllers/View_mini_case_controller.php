<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_mini_case_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('view_mini_case_model');
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

    public function view_mini_case_open()
    {
        $this->load->library('session');
        if ($this->session->userdata('user')) {
            $this->load->view('view_mini_case');
        } else {
            redirect('/');
        }
    }

    public function fetch_all_mini_case()
    {
        try {
            $this->load->model("View_mini_case_model");
            $fetch_mini_case = $this->View_mini_case_model->make_datatables_mini_case();
            $data = array();
            // $i=1;

            foreach ($fetch_mini_case as $row) {
                $sub_array = array();
                $buttons = '';
                if ($row->fi_type == 'BV') {
                    $buttons .= '<button type="button" title="View Case" name="view" id="' . $row->id . '" class="btn btn-primary btn-sm view_quick_case"><i class="fa fa-eye" ></i></button>';
                    $buttons .= '<button type="button" title="BV Remarks" name="view" id="' . $row->id . '" class="btn btn-success btn-sm edit_bv"><i class="fa fa-pencil" ></i></button>';
                } else {
                    $buttons .= '<button type="button" title="View RV Case" name="view" id="' . $row->id . '" class="btn btn-primary btn-sm view_rv_case"><i class="fa fa-eye" ></i></button>';
                    $buttons .= '<button type="button" title="RV Remarks" name="view" id="' . $row->id . '" class="btn btn-warning btn-sm edit_rv"><i class="fa fa-pencil" ></i></button>';
                }


                // $sub_array[] = $i;
                $sub_array[] = $row->id;
                $sub_array[] = $row->bank;
                $sub_array[] = $row->name;
                $sub_array[] = $row->fi_type;
                $sub_array[] = $row->code;
                $sub_array[] = $row->reference_no;
                // $sub_array[] = $row->business_name;
                $sub_array[] = $row->business_add;
                $sub_array[] = $row->status;
                // $sub_array[] = $row->remarks;
                // $i++;
                $sub_array[] = $buttons;
                $data[] = $sub_array;
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->View_mini_case_model->get_all_data_mini_case(),
                "recordsFiltered" => $this->View_mini_case_model->get_filtered_data_mini_case(),
                "data" => $data,
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = true;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }


    function fetch_remarks()
    {
        try {
            $output = array();
            $this->load->model("View_mini_case_model");
            $data = $this->View_mini_case_model->fetch_rv_remarks($_POST["user_id"]);
            foreach ($data as $row) {
                // $output['id'] = $row->id;
                $output['remarks'] = $row->remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            echo '$error';
            // $this->load->view('login', array('error' => $error));
        }
    }

    function fetch_bv_remarks()
    {
        try {
            $output = array();
            $this->load->model("View_mini_case_model");
            $data = $this->View_mini_case_model->fetch_bv_remarks($_POST["user_id"]);
            foreach ($data as $row) {
                // $output['id'] = $row->id;
                $output['bv_remarks'] = $row->bv_remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            echo '$error';
            // $this->load->view('login', array('error' => $error));
        }
    }


    function fetch_single_mini_case()
    {
        // die("hello");
        try {
            $output = array();
            $this->load->model("View_mini_case_model");
            $data = $this->View_mini_case_model->fetch_single_mini_case($_POST["user_id"]);
            // print_r($data);
            // die;
            foreach ($data as $row) {
                $output['bank']             = $row->bank;
                $output['product']          = $row->product;
                $output['fi_type']          = $row->fi_type;
                $output['reference_no']     = $row->reference_no;
                $output['name']             = $row->name;
                $output['code']             = $row->code;
                // $output['address']          = $row->business_add;
                $output['city']          = $row->city;
                $output['business_name']    = $row->business_name;
                $output['business_add']     = $row->business_add;
                $output['bv_lat']           = $row->bv_lat;
                $output['bv_long']          = $row->bv_long;
                // $output['bv_pincode']       = $row->pin_code;
                // $output['bv_location_add']  = $row->city;
                $output['bv_pincode']       = $row->bv_pincode;
                $output['bv_location_add']  = $row->bv_location_add;
                $output['remarks']       = $row->remarks;
                $output['city']       = $row->city;


                $temp_image = $row->bv_image1;
                $temp_image2 = $row->bv_image2;
                $temp_image3 = $row->bv_image3;
                $temp_image4 = $row->bv_image4;
                $temp_image5 = $row->bv_image5;
                $temp_image6 = $row->bv_image6;
                $temp_image7 = $row->bv_image7;
                $temp_image8 = $row->bv_image8;
                $temp_image9 = $row->bv_image9;


                if (!empty($row->bv_image1)) {
                    $replace_space = str_replace(' ', '+', $temp_image);
                    $output['bv_image1'] = '<img class="bv_image1" src="' . $replace_space . '" height="150" width="150">';
                } else {
                    $output['bv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }


                if (!empty($row->bv_image2)) {
                    $replace_space2 = str_replace(' ', '+', $temp_image2);
                    $output['bv_image2'] = ' <img class="bv_image1" src="' . $replace_space2 . '" height="150" width="150">';
                } else {
                    $output['bv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }


                if (!empty($row->bv_image3)) {
                    $replace_space3 = str_replace(' ', '+', $temp_image3);
                    $output['bv_image3'] = ' <img class="bv_image1" src="' . $replace_space3 . '" height="150" width="150">';
                } else {
                    $output['bv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image4)) {
                    $replace_space4 = str_replace(' ', '+', $temp_image4);
                    $output['bv_image4'] = ' <img class="bv_image1" src="' . $replace_space4 . '" height="150" width="150">';
                } else {
                    $output['bv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image5)) {
                    $replace_space5 = str_replace(' ', '+', $temp_image5);
                    $output['bv_image5'] = ' <img class="bv_image1" src="' . $replace_space5 . '" height="150" width="150">';
                } else {
                    $output['bv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image6)) {
                    $replace_space6 = str_replace(' ', '+', $temp_image6);
                    $output['bv_image6'] = ' <img class="bv_image1" src="' . $replace_space6 . '" height="150" width="150">';
                } else {
                    $output['bv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image7)) {
                    $replace_space7 = str_replace(' ', '+', $temp_image7);
                    $output['bv_image7'] = ' <img class="bv_image1" src="' . $replace_space7 . '" height="150" width="150">';
                } else {
                    $output['bv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image8)) {
                    $replace_space8 = str_replace(' ', '+', $temp_image8);
                    $output['bv_image8'] = ' <img class="bv_image1" src="' . $replace_space8 . '" height="150" width="150">';
                } else {
                    $output['bv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image9)) {
                    $replace_space9 = str_replace(' ', '+', $temp_image9);
                    $output['bv_image9'] = ' <img class="bv_image1" src="' . $replace_space9 . '" height="150" width="150">';
                } else {
                    $output['bv_image9'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    private function generateOTP()
    {
        // Generate a random OTP using your preferred method
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        // $otp ='1234';
        return $otp;
    }

    public function sendOTP()
    {
        $response = [];
        $email = 'Jainnupur.88@gmail.com';

        // Generate and store the OTP
        $otp = $this->generateOTP();
        // echo $otp;die;
        $responseArray['otp'] = $otp;
        $responseArray['email'] = $email;

        $this->sendOTPEmail($email, $otp);
        $responseArray['msg'] = "Message";
        $responseArray['success'] = 1;
        echo json_encode($responseArray);
        die();
        // echo 'OTP has been sent to your email address.';
    }

    private function sendOTPEmail($email, $otp)
    {
        $this->load->library('email');
        $this->email->from('Jainnupur.88@gmail.com', 'Yogita Sharma');
        $this->email->to($email);
        $this->email->subject('OTP Verification');
        $this->email->message('Please use the following OTP for verification: ' . $otp);

        if (!$this->email->send()) {
            // Handle email sending error if necessary
            echo $this->email->print_debugger();
        }
    }



    public function reassign_case_validation_mini_case()
    {

        $enteredOtp = $this->input->post('otp');
        $response = [];
        $storedOtp = $this->input->post('store_otp');
        // echo $enteredOtp;
        // echo $storedOtp;die;
        if ($enteredOtp == $storedOtp) {

            $reassign_id = $_POST["r_id"];
            $reassign_multi_id = $_POST["multi_id"];
            $assignfrom = $_POST["assignfrom"];

            $array = array(
                'code' => $this->input->post('code'),
                'reassign_remarks' => $this->input->post('reassign_remarks'),
            );

            $this->load->model('Assign_case_model');
            // $this->Assign_case_model->editData();
            $insert_id = $this->View_mini_case_model->update_assignee_mini_case($reassign_id, $assignfrom, $reassign_multi_id, $array);
            if ($insert_id) {
                $response = array(
                    'success' => 1,
                    'msg' => "Assignee updated successfully"
                );
            } else {
                $response = array(
                    'success' => 0,
                    'msg' => "Error while saving data !!!!"
                );
            }
        } else {
            $response = array(
                'success' => 0,
                'msg' => "please enter valid OTP !!!!"
            );
        }
        echo json_encode($response);
        die;
    }


    public function filterDatewiseMiniCase()
    {

        $from = $_POST['from'];
        $to = $_POST['to'];
        // $code = $_POST['code'];
        //echo $code;die();
        $tbdy = '';
        $fetch_data = $this->View_mini_case_model->filter_CreatedateMiniCase($from, $to);
        $numrows = $fetch_data->num_rows();
        //echo $numrows;die("iii");
        if ($numrows > 0) {
?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>
                <tr>
                    <td><?= $rows->uid; ?></td>
                    <td><?= $rows->bank; ?></td>
                    <td><?= $rows->name; ?></td>
                    <td><?= $rows->fi_type; ?></td>
                    <td><?= $rows->code; ?></td>
                    <td><?= $rows->reference_no; ?></td>
                    <td><?= $rows->business_add; ?></td>
                    <td><?= $rows->status; ?></td>
                    <td><?= $rows->Action; ?></td>

                    <td>
                        <?php

if ($row->fi_type == 'BV') {
    $buttons .= '<button type="button" title="View Case" name="view" id="' . $row->id . '" class="btn btn-primary btn-sm view_quick_case"><i class="fa fa-eye" ></i></button>';
    $buttons .= '<button type="button" title="BV Remarks" name="view" id="' . $row->id . '" class="btn btn-success btn-sm edit_bv"><i class="fa fa-pencil" ></i></button>';
    $buttons .= '<button type="button" title="Reassign Case" name="view" id="' . $row->id . '" class="btn btn-success btn-sm reassign_case"><i class="fa fa-edit" ></i></button>';
} else {
    $buttons .= '<button type="button" title="View RV Case" name="view" id="' . $row->id . '" class="btn btn-primary btn-sm view_rv_case"><i class="fa fa-eye" ></i></button>';
    $buttons .= '<button type="button" title="RV Remarks" name="view" id="' . $row->id . '" class="btn btn-warning btn-sm edit_rv"><i class="fa fa-pencil" ></i></button>';
    $buttons .= '<button type="button" title="Reassign Case" name="view" id="' . $row->id . '" class="btn btn- btn-sm reassign_case"><i class="fa fa-edit" ></i></button>';
}

                        
                        ?>
                        
                    </td>

                </tr>
            <?php endforeach; ?>
            <tr></tr>
        <?php } else { ?>

            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
            <tr></tr>

        <?php }
    }
    

    function fetch_single_rv_mini_case()
    {
        // die("hello");
        try {
            $output = array();
            $this->load->model("View_mini_case_model");
            $data = $this->View_mini_case_model->fetch_single_mini_case($_POST["user_id"]);
            // $temp_image = $data[0]->image;
            foreach ($data as $row) {
                $output['bank'] = $row->bank;
                $output['product'] = $row->product;
                $output['fi_type'] = $row->fi_type;
                $output['reference_no'] = $row->reference_no;
                $output['name'] = $row->name;
                $output['code'] = $row->code;
                $output['address'] = $row->business_add;
                $output['business_name'] = $row->business_name;
                $output['city'] = $row->city;
                $output['business_add'] = $row->business_add;
                $output['rv_lat'] = $row->rv_lat;
                $output['rv_long'] = $row->rv_long;
                $output['rv_pincode'] = $row->rv_pincode;
                $output['rv_location_add'] = $row->rv_location_add;
                $output['remarks'] = $row->remarks;
                $output['city'] = $row->city;


                $temp_image = $row->rv_image1;
                $temp_image2 = $row->rv_image2;
                $temp_image3 = $row->rv_image3;
                $temp_image4 = $row->rv_image4;
                $temp_image5 = $row->rv_image5;
                $temp_image6 = $row->rv_image6;
                $temp_image7 = $row->rv_image7;
                $temp_image8 = $row->rv_image8;
                $temp_image9 = $row->rv_image9;


                if (!empty($row->rv_image1)) {
                    $replace_space = str_replace(' ', '+', $temp_image);
                    $output['rv_image1'] = '<img class="bv_image1" src="' . $replace_space . '" height="150" width="150">';
                } else {
                    $output['rv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image2)) {
                    $replace_space2 = str_replace(' ', '+', $temp_image2);
                    $output['rv_image2'] = '<img class="bv_image1" src="' . $replace_space2 . '" height="150" width="150">';
                } else {
                    $output['rv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                if (!empty($row->rv_image3)) {
                    $replace_space3 = str_replace(' ', '+', $temp_image3);
                    $output['rv_image3'] = '<img class="bv_image1" src="' . $replace_space3 . '" height="150" width="150">';
                } else {
                    $output['rv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image4)) {
                    $replace_space4 = str_replace(' ', '+', $temp_image4);
                    $output['rv_image4'] = '<img class="bv_image1" src="' . $replace_space4 . '" height="150" width="150">';
                } else {
                    $output['rv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image5)) {
                    $replace_space5 = str_replace(' ', '+', $temp_image5);
                    $output['rv_image5'] = '<img class="bv_image1" src="' . $replace_space5 . '" height="150" width="150">';
                } else {
                    $output['rv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image6)) {
                    $replace_space6 = str_replace(' ', '+', $temp_image6);
                    $output['rv_image6'] = '<img class="bv_image1" src="' . $replace_space6 . '" height="150" width="150">';
                } else {
                    $output['rv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image7)) {
                    $replace_space7 = str_replace(' ', '+', $temp_image7);
                    $output['rv_image7'] = '<img class="bv_image1" src="' . $replace_space7 . '" height="150" width="150">';
                } else {
                    $output['rv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image8)) {
                    $replace_space8 = str_replace(' ', '+', $temp_image8);
                    $output['rv_image8'] = '<img class="bv_image1" src="' . $replace_space8 . '" height="150" width="150">';
                } else {
                    $output['rv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image9)) {
                    $replace_space9 = str_replace(' ', '+', $temp_image9);
                    $output['rv_image9'] = '<img class="bv_image1" src="' . $replace_space9 . '" height="150" width="150">';
                } else {
                    $output['rv_image9'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    function get_remark()
    {
        $array = array(
            'remarks' => $this->input->post('value')
        );
        $this->load->model('View_mini_case_model');
        $this->View_mini_case_model->insert_remark($array, $this->input->post('pk'));
        print_r($array);
    }

    public function update_rv_remarks_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('rv_remarks', 'rv_remarks', '');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {
                $pass_id = $_POST["rv_id"];
                $array = array(
                    'rv_remarks' => $this->input->post('rv_remarks')
                );
                $this->load->model('View_mini_case_model');
                $insert_user = $this->View_mini_case_model->update_rv_remarks($pass_id, $array);
                if ($insert_user) {
                    $response = array(
                        'success' => true,
                        'message' => "RV Remarks updated successfully!"
                    );
                } else {
                    $response = array(
                        'error' => true,
                        'message' => "error in data!"
                    );
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $response['message'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }

    public function update_remarks_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('remarks', 'remarks', 'required');
            $response = [];
            if ($this->form_validation->run()) {
                // print_r($this->input->post());die;
                $minicase_id = $_POST["minicase_id"];
                $array = array(
                    'remarks' => $this->input->post('remarks')
                );
                $this->load->model('View_mini_case_model');
                // echo "<prE>";
                // print_r($minicase_id);
                // print_r($array);
                // die;
                $insert_user = $this->View_mini_case_model->update_bv_remarks($minicase_id, $array);
                if ($insert_user) {

                    $response = array('type' => 'success', 'massege' => 'Remarks updated successfully!');
                } else {

                    $response = array('type' => 'danger', 'massege' => 'Somthing went wrong please contact to administrator');
                }
            } else {
                $response = array('type' => 'danger', 'massege' => 'validation error error...');
            }
        } catch (Exception $ex) {
            $response = array('type' => 'danger', 'massege' => 'try error...');
        }
        $this->session->set_flashdata('res_data', $response);
        redirect(base_url("/View_mini_case_controller/view_mini_case_open"));
    }


    //   public function update_rv_remarks_validation()
    // {
    //     try {
    //         $this->load->library('form_validation');
    //         $this->form_validation->set_rules('rv_remarks', 'rv_remarks', '');
    //         $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    //         if ($this->form_validation->run()) {
    //             $pass_id = $_POST["rv_id"];
    //             $array = array(
    //                 'rv_remarks' => $this->input->post('rv_remarks')
    //             );
    //             $this->load->model('View_mini_case_model');
    //             $insert_user = $this->View_mini_case_model->update_rv_remarks($pass_id, $array);
    //             if ($insert_user) {
    //                 $response = array(
    //                     'success' => true,
    //                     'message' => "RV Remarks updated successfully!"
    //                 );
    //             } else {
    //                 $response = array(
    //                     'error' => true,
    //                     'message' => "error in data!"
    //                 );
    //             }
    //         } else {
    //             foreach ($_POST as $key => $value) {
    //                 $response['message'][$key] = form_error($key);
    //             }
    //         }
    //         echo json_encode($response);
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login_page', array('error' => $error));
    //     }
    // }
}
