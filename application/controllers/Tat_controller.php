<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tat_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Tat_model');
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

 
//     public function open_tat()
// {
//     // Load session library
//     $this->load->library('session');

//     // Restrict users to go to home if not logged in
//     if ($this->session->userdata('user')) {
//         $this->load->model('Tat_model');

//         // Get the data from the model
//         $data['records'] = $this->Tat_model->getRecords();
       
        

//         // Pass the data to the view
//         $this->load->view('tat_details', $data);
//     } else {
//         redirect('/');
//     }
// }

public function open_tat()
{
// echo 'hjhj';
    // Load session library
    $this->load->library('session');

    // Restrict users to go to home if not logged in
    if ($this->session->userdata('user')) {
        $this->load->model('Tat_model');

        // Check if the form is submitted with date filters
        if ($this->input->post()) {
            $fromDate = $this->input->post('from_date');
            $toDate = $this->input->post('to_date');
// echo $fromDate."<br>";
// echo $toDate;die;
            // Get the filtered records from the model
            $data['records'] = $this->Tat_model->getFilteredRecords($fromDate, $toDate);
            
        } else {
            // Get all records from the model
            $data['records'] = $this->Tat_model->getRecords();
        }

        // Pass the data to the view
        $this->load->view('tat_details', $data);
    } else {
        redirect('/');
    }
}


public function getAllTeachercity() {
    $response = [];
    try {
        $sql = 'SELECT DISTINCT code FROM upload_file';
        $query = $this->db->query($sql);
        $data['data'] = $query->result_array();
        $response = $data;
    } catch (Exception $ex) {
        $response = [
            'status' => "failure",
            'message' => $ex->getMessage(),
        ];
    }
     header('Content-Type: application/json');
    echo json_encode($response);
}






}