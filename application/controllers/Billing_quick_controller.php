<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing_quick_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Billing_quick_model');
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

    public function billing_quick()
    {
        //load session library
        $this->load->library('session');
        //restrict users to go to home if not logged in
        if ($this->session->userdata('user')) {
            $this->load->view('billing_quick_case');
        } else {
            redirect('/');
        }
    }

    // public function getAllBank()
    // {
    //     try {
	// 		$sql = 'SELECT bank_name FROM `add_bank` ';

	// 		//here use left join of table cnb_course and cnb_class and fetch result according to above set $owner_id and $owned_by
	// 		$query = $this->db->query($sql); //here above query run
	// 		$data = $query->result_array(); // here result of query gives in array format
	// 		return $data; //here return all data in array 
	// 	} catch (Exception $ex) {
	// 		return false;
	// 	}
	// 	return false;
    // }

    public function getAllBank()
	{
		try {
			$this->db->select('bank_name');
			$query = $this->db->get('add_bank')->result();
			//        print_r($query);die;
			echo json_encode($query);
		} catch (Exception $ex) {
			throw $ex;
		}
	}
}