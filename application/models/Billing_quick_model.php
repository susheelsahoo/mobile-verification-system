<?php
class Billing_quick_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
}