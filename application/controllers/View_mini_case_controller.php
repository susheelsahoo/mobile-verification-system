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
                $buttons .= '<button type="button" title="View BV Case" name="view" id="' . $row->id . '" class="btn btn-primary btn-sm view_quick_case"><i class="fa fa-eye" ></i></button>';
                // $sub_array[] = $i;
                $sub_array[] = $row->id;
                $sub_array[] = $row->bank;
                $sub_array[] = $row->fi_type;
                $sub_array[] = $row->code;
                $sub_array[] = $row->reference_no;
                $sub_array[] = $row->business_name;
                $sub_array[] = $row->business_add;
                // $sub_array[] = $row->residence_add;
                $sub_array[] = $row->remarks;
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

    function fetch_single_mini_case()
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
                $output['address'] = $row->address;
                $output['business_name'] = $row->business_name;
                $output['business_add'] = $row->business_add;
                $output['bv_lat'] = $row->bv_lat;
                $output['bv_long'] = $row->bv_long;
                $output['bv_pincode'] = $row->bv_pincode;
                $output['bv_location_add'] = $row->bv_location_add;
                $output['bv_remarks'] = $row->bv_remarks;


                $temp_image = $row->bv_image1;
                $temp_image2 = $row->bv_image2;
                $temp_image3 = $row->bv_image3;
                $temp_image4 = $row->bv_image4;
                $temp_image5 = $row->bv_image5;
                $temp_image6 = $row->bv_image6;
                $temp_image7 = $row->bv_image7;
                $temp_image8 = $row->bv_image8;
                $temp_image9 = $row->bv_image9;


                if ($row->bv_image1 != '') {
                    $replace_space = str_replace(' ', '+', $temp_image);
                    $output['bv_image1'] = $replace_space;
                } else {
                    $output['bv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->bv_image2 != '') {
                    $replace_space2 = str_replace(' ', '+', $temp_image2);
                    $output['bv_image2'] = $replace_space2;
                } else {
                    $output['bv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }


                if ($row->bv_image3 != '') {
                    $replace_space3 = str_replace(' ', '+', $temp_image3);
                    $output['bv_image3'] = $replace_space3;
                } else {
                    $output['bv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->bv_image4 != '') {
                    $replace_space4 = str_replace(' ', '+', $temp_image4);
                    $output['bv_image4'] = $replace_space4;
                } else {
                    $output['bv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->bv_image5 != '') {
                    $replace_space5 = str_replace(' ', '+', $temp_image5);
                    $output['bv_image5'] = $replace_space5;
                } else {
                    $output['bv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->bv_image6 != '') {
                    $replace_space6 = str_replace(' ', '+', $temp_image6);
                    $output['bv_image6'] = $replace_space6;
                } else {
                    $output['bv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->bv_image7 != '') {
                    $replace_space7 = str_replace(' ', '+', $temp_image7);
                    $output['bv_image7'] = $replace_space7;
                } else {
                    $output['bv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->bv_image8 != '') {
                    $replace_space8 = str_replace(' ', '+', $temp_image8);
                    $output['bv_image8'] = $replace_space8;
                } else {
                    $output['bv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->bv_image9 != '') {
                    $replace_space9 = str_replace(' ', '+', $temp_image9);
                    $output['bv_image9'] = $replace_space9;
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
                $output['address'] = $row->address;
                $output['business_name'] = $row->business_name;
                $output['business_add'] = $row->business_add;
                $output['rv_lat'] = $row->rv_lat;
                $output['rv_long'] = $row->rv_long;
                $output['rv_pincode'] = $row->rv_pincode;
                $output['rv_location_add'] = $row->rv_location_add;
                $output['rv_remarks'] = $row->rv_remarks;


                $temp_image = $row->rv_image1;
                $temp_image2 = $row->rv_image2;
                $temp_image3 = $row->rv_image3;
                $temp_image4 = $row->rv_image4;
                $temp_image5 = $row->rv_image5;
                $temp_image6 = $row->rv_image6;
                $temp_image7 = $row->rv_image7;
                $temp_image8 = $row->rv_image8;
                $temp_image9 = $row->rv_image9;


                if ($row->rv_image1 != '') {
                    $replace_space = str_replace(' ', '+', $temp_image);
                    $output['rv_image1'] = $replace_space;
                } else {
                    $output['rv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->rv_image2 != '') {
                    $replace_space2 = str_replace(' ', '+', $temp_image2);
                    $output['rv_image2'] = $replace_space2;
                } else {
                    $output['rv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }


                if ($row->rv_image3 != '') {
                    $replace_space3 = str_replace(' ', '+', $temp_image3);
                    $output['rv_image3'] = $replace_space3;
                } else {
                    $output['rv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->rv_image4 != '') {
                    $replace_space4 = str_replace(' ', '+', $temp_image4);
                    $output['rv_image4'] = $replace_space4;
                } else {
                    $output['rv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->rv_image5 != '') {
                    $replace_space5 = str_replace(' ', '+', $temp_image5);
                    $output['rv_image5'] = $replace_space5;
                } else {
                    $output['rv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->rv_image6 != '') {
                    $replace_space6 = str_replace(' ', '+', $temp_image6);
                    $output['rv_image6'] = $replace_space6;
                } else {
                    $output['rv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->rv_image7 != '') {
                    $replace_space7 = str_replace(' ', '+', $temp_image7);
                    $output['rv_image7'] = $replace_space7;
                } else {
                    $output['rv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->rv_image8 != '') {
                    $replace_space8 = str_replace(' ', '+', $temp_image8);
                    $output['rv_image8'] = $replace_space8;
                } else {
                    $output['rv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if ($row->rv_image9 != '') {
                    $replace_space9 = str_replace(' ', '+', $temp_image9);
                    $output['rv_image9'] = $replace_space9;
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
}
