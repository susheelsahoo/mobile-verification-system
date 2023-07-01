<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
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

  
    public function dashboard_function()
    {
        //load session library
        $this->load->library('session');
        //restrict users to go to home if not logged in
        if ($this->session->userdata('user')) {
            $this->load->view('dashboard');
        } else {
            redirect('/');
        }
    }

    public function TotalCount() {
        // if ($this->session->userdata('user')) {
            // check user logged in
            $user_data = $this->session->userdata('user');// session data of user store in $user_data variable
            $countTotal = $this->Dashboard_model->countAllTotal();
            $data = [
                'countTotal' => $countTotal,
            ];
            // $this->render_page('assign_case', array('data' => array('active_menu' => 'dashboard', 'countTotal' => $data)));
           $this->load->view('dashboard', array('user' => $user_data, 'data' => array('active_menu' => 'dashboard', 'countTotal' => $data)));
        // } else {
        //     return redirect();
        // }
    }


    function fetch_all_agent()
    {
        try {
            $this->load->model("Dashboard_model");
            $fetch_case = $this->Dashboard_model->make_datatables_agent();
            $data = array();

            foreach ($fetch_case as $row) {
                $count=$this->Dashboard_model->countCase($row->employee_unique_id);
                $totDaywiseCount = $this->Dashboard_model->totDaywiseCount($row->employee_unique_id);
                $inprogressDaywiseCount=$this->Dashboard_model->inprogressDaywiseCount($row->employee_unique_id);
                $visitDaywiseCount=$this->Dashboard_model->visitDaywiseCount($row->employee_unique_id);
                //$outOfTatDaywiseCount=$this->Dashboard_model->outOfTatDaywiseCount($row->employee_unique_id);
                $positiveResolvedDaywiseCount=$this->Dashboard_model->positiveResolvedDaywiseCount($row->employee_unique_id);
                $negativeResolvedDaywiseCount=$this->Dashboard_model->negativeResolvedDaywiseCount($row->employee_unique_id);
                $sub_array = array();
                
                $sub_array[] = '<a href="' .  base_url() . 'index.php/Assign_case_controller/assign_case_function/' . $row->employee_unique_id . '">' . $row->first_name . '</a>';
                // $sub_array[] = $row->first_name;
                $sub_array[] = $totDaywiseCount;//$row->total;
                $sub_array[] = $inprogressDaywiseCount;
                $sub_array[] = $visitDaywiseCount;
                $sub_array[] = $row->out_of_tat;
                $sub_array[] = $positiveResolvedDaywiseCount;
                $sub_array[] = $negativeResolvedDaywiseCount;
                $sub_array[] = $row->positive_verified;
                $sub_array[] = $row->negative_verified;
                $data[] = $sub_array;
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->Dashboard_model->get_all_data_agent(),
                // "recordsFiltered" => $this->Dashboard_model->get_filtered_data_agent(),
                "data" => $data
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }

    


    // function fetch_single_case() {
    //     try {
    //         $output = array();
    //         $this->load->model("Dashboard_model");
    //         $data = $this->Dashboard_model->fetch_single_cases($_POST["user_id"]);
    //         foreach ($data as $row) {

    //             $output['id'] = $row->id;
    //             $output['bank_name'] = $row->bank_name;
    //             $output['product'] = $row->product;
    //             // $output['status'] = $row->status;
    //             // $output['value'] = $row->value;
    //             // $output['course_type'] = $row->course_type;
    //             // $output['course_id'] = $row->course_id;
    //         }
    //         echo json_encode($output);
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login', array('error' => $error));
    //     }
    // }
}
