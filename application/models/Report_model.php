<?php
class Report_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	var $table1 = "mini_case";
	var $select_column1 = array("id", "bank", "fi_type", "agent_code", "address", "remarks","created_at");
	var $order_column1 = array("id", "bank", "fi_type", "agent_code", "address", "remarks","created_at");

	function make_query_mini_case()
	{
		try {
			$this->db->select($this->select_column1);
			$this->db->from($this->table1);
			if (isset($_POST["search"]["value"])) {
				$this->db->like("id", $_POST["search"]["value"]);
				$this->db->like("bank", $_POST["search"]["value"]);
				$this->db->or_like("fi_type", $_POST["search"]["value"]);
				$this->db->or_like("agent_code", $_POST["search"]["value"]);
				$this->db->or_like("address", $_POST["search"]["value"]);
				$this->db->or_like("remarks", $_POST["search"]["value"]);
				$this->db->or_like("created_at", $_POST["search"]["value"]);
			}

			if (!empty($this->input->post('from_date')) && !empty($this->input->post('to_date'))) {
                $this->db->where('created_at >= ', $_POST['from_date']);
                $this->db->where('created_at <= ', $_POST['to_date']);

            } else { }

			if (isset($_POST["order"])) {
				$this->db->order_by($this->order_column1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else {
				$this->db->order_by('id', 'ASC');
			}
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function make_datatables_mini_case()
	{
		try {
			$this->make_query_mini_case();
			if ($_POST["length"] != -1) {
				$this->db->limit($_POST['length'], $_POST['start']);
			}
			$query = $this->db->get();
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_all_data_mini_case()
	{
		try {
			$this->db->select("*");
			$this->db->from($this->table1);
			return $this->db->count_all_results();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_filtered_data_mini_case()
	{
		try {
			$this->make_query_mini_case();
			$query = $this->db->get();
			return $query->num_rows();
		} catch (Exception $ex) {
			throw $ex;
		}
	}
}
