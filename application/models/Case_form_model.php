<?php
class Case_form_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function insert_case($data)
	{
		try {
			$this->db->insert('upload_file', $data);
			return $this->db->insert_id();
		} catch (Exception $ex) {
			throw $ex;
		}
	}
}
