<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Create_user_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Create_user_model');
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

    public function create_user()
    {
        //load session library
        $this->load->library('session');
        //restrict users to go to home if not logged in
        if ($this->session->userdata('user')) {
            $this->load->view('create_user');
        } else {
            redirect('/');
        }
    }


    public function create_user_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name', 'first_name', 'required');
            $this->form_validation->set_rules('last_name', 'last_name', '');
            $this->form_validation->set_rules('username', 'username', '');
            $this->form_validation->set_rules('password', 'password', '');
            $this->form_validation->set_rules('mobile', 'mobile', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('employee_unique_id', 'employee_unique_id', 'required');
            $this->form_validation->set_rules('role_group', 'role_group', 'required');
            $this->form_validation->set_rules('organization', 'organization', 'required');
            $this->form_validation->set_rules('lead_name', 'lead_name', '');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {
                $array = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),
                    'employee_unique_id' => $this->input->post('employee_unique_id'),
                    'role_group' => $this->input->post('role_group'),
                    'organization' => $this->input->post('organization'),
                    'lead_name' => $this->input->post('lead_name')
                );
                $this->load->model('Create_user_model');
                $insert_id = $this->Create_user_model->insert_user($array);
                if ($insert_id) {
                    $response = array(
                        'success' => true,
                        'message' => "user created successfully"
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


    function fetch_all_user()
    {
        try {
            $this->load->model("Create_user_model");
            $fetch_case = $this->Create_user_model->make_datatables_user();
            $data = array();
            foreach ($fetch_case as $row) {
                $sub_array = array();
                $buttons = '';
                $buttons .= '<button type="button" title="Reset Password" name="edit" id="' . $row->id . '" class="btn btn-primary btn-sm edit_password"><i class="fa fa-edit" ></i></button>';
                $buttons .= '<button type="button" title="Edit Mobile Number" name="submit" id="' . $row->id . '" class="btn btn-info btn-sm edit_mobile"><i class="fa fa-edit" ></i></button>';
                $sub_array[] = $row->id;
                $sub_array[] = $row->role_group;
                $sub_array[] = $row->first_name;
                $sub_array[] = $row->employee_unique_id;
                $sub_array[] = $row->username;
                $sub_array[] = $row->password;
                $sub_array[] = $row->mobile;
                $sub_array[] = $row->email;
                $sub_array[] = $row->status;
                $sub_array[] = $buttons;
                $data[] = $sub_array;
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->Create_user_model->get_all_data_user(),
                "recordsFiltered" => $this->Create_user_model->get_filtered_data_user(),
                "data" => $data
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }

    function get_status()
    {
        $array = array(
            'status' => $this->input->post('value')
        );
        $this->load->model('Create_user_model');
        $this->Create_user_model->insert_status_update($array, $this->input->post('pk'));
        print_r($array);
    }


    public function update_mobile()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('mobile', 'mobile', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {
                $mobile_id = $_POST["m_id"];
                $array = array(
                    'mobile' => $this->input->post('mobile'),
                );
                $this->load->model('Create_user_model');
                $insert_mobile = $this->Create_user_model->update_mobile($mobile_id, $array);
                if ($insert_mobile) {
                    $response = array(
                        'success' => true,
                        'message' => "Mobile updated successfully!"
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


    // public function update_user_password_validation()
    // {
    //     try {
    //         $this->load->library('form_validation');
    //         $this->form_validation->set_rules('password', 'password', 'required');
    //         $this->form_validation->set_rules('cnf_password', 'cnf_password', '');
    //         $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    //         if ($this->form_validation->run()) {
    //             $pass_id = $_POST["p_id"];
    //             $array = array(
    //                 'password' => $this->input->post('password'),
    //                 'cnf_password' => $this->input->post('cnf_password')
    //             );
    //             $this->load->model('Create_user_model');
    //             $insert_user = $this->Create_user_model->update_password($pass_id, $array);
    //             if ($insert_user) {
    //                 $response = array(
    //                     'success' => true,
    //                     'message' => "Password updated successfully!"
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


    // public function update_user_password_validation()
    // {
    //     try {
    //         $this->load->library('form_validation');
    //         $this->form_validation->set_rules('password', 'password', 'required');
    //         $this->form_validation->set_rules('cnf_password', 'cnf_password', '');
    //         $this->form_validation->set_rules('mobile', 'mobile', '');
    //         $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    //         if ($this->form_validation->run()) {
    //             $pass_id = $_POST["p_id"];
    //             $mobile_id = $_POST["m_id"];
    //             $array = array(
    //                 'password' => $this->input->post('password'),
    //                 'cnf_password' => $this->input->post('cnf_password'),
    //                 'mobile' => $this->input->post('mobile'),
    //             );
    //             $this->load->model('Create_user_model');
    //             $insert_user = $this->Create_user_model->update_password($pass_id, $mobile_id,$array);
    //             if ($insert_user) {
    //                 $response = array(
    //                     'success' => true,
    //                     'message' => "Password updated successfully!"
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

    public function update_user_password_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('cnf_password', 'cnf_password', '');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {
                $pass_id = $_POST["p_id"];
                $array = array(
                    'password' => $this->input->post('password'),
                    'cnf_password' => $this->input->post('cnf_password'),
                );
                $this->load->model('Create_user_model');
                $insert_user = $this->Create_user_model->update_password($pass_id, $array);
                if ($insert_user) {
                    $response = array(
                        'success' => true,
                        'message' => "Password updated successfully!"
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




    function fetch_single_password()
    {
        try {
            $output = array();
            $this->load->model("Create_user_model");
            $data = $this->Create_user_model->fetch_single_password($_POST["user_id"]);
            foreach ($data as $row) {
                // $output['id'] = $row->id;
                $output['password'] = $row->password;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    function fetch_single_mobile()
    {
        try {
            $output = array();
            $this->load->model("Create_user_model");
            $data = $this->Create_user_model->fetch_single_mobile($_POST["users_id"]);
            foreach ($data as $row) {
                // $output['id'] = $row->id;
                $output['mobile'] = $row->mobile;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }



    // function delete_single_user() {
    //     try {
    //         $this->load->model("Create_user_model");
    //         $data = $this->Create_user_model->delete_single_user($_POST["user_id"]);
    //         if ($data) {
    //             return $data;
    //         } else {
    //             return FALSE;
    //         }
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login_page', array('error' => $error));
    //     }
    // }



}
