<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('report_model');
	}

	public function index(){
		$this->load->library('session');
		if($this->session->userdata('user')){
			redirect('home');
		}
		else{
			$this->load->view('login_page');
		}
	}

    public function report_page_open(){
		$this->load->library('session');
		if($this->session->userdata('user')){
			$this->load->view('report');
		}
		else{
			redirect('/');
		}
	}

	

}