<?php
class Mini_case_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function insert_mini_case($data)
	{
		try {
			$this->db->insert('mini_case', $data);
			return $this->db->insert_id();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getBank()
	{
		try {
			$status = 'active';
			$this->db->select('id,bank_name');
			$this->db->where('status', $status);
			$this->db->order_by("id", "ASC");
			$query = $this->db->get('add_bank');
			return $query->result_array();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getProduct()
	{
		try {
			$status = 'active';
			$this->db->select('id,product');
			$this->db->where('status', $status);
			$this->db->order_by("id", "ASC");
			$query = $this->db->get('add_product');
			return $query->result_array();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getAgentCode()
	{
		try {
			$this->db->select('id,first_name,employee_unique_id', 'role_group');
			$this->db->order_by("id", "ASC");
			$this->db->where('status', 'active');
			$this->db->where('role_group', 'FA');
			$query = $this->db->get('login');
			return $query->result_array();
		} catch (Exception $ex) {
			throw $ex;
		}
	}
}
