<?php
class Add_bank_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function insert_bank($data)
	{
		try {
			$this->db->insert('add_bank', $data);
			return $this->db->insert_id();
		} catch (Exception $ex) {
			throw $ex;
		}
	}


	function insert_bank_dropdwon($data)
	{
		try {
			$this->db->insert('dropdown_bank_add', $data);
			return $this->db->insert_id();
		} catch (Exception $ex) {
			throw $ex;
		}
	}
	var $table7 = "add_bank";
	var $select_column7 = array("id","bank_name","source","description", "status");
	var $order_column7 = array("id","bank_name","source","description", "status");

	function make_query_bank()
	{
		try {
			$this->db->select($this->select_column7);
			$this->db->from($this->table7);
			if (isset($_POST["search"]["value"])) {
				$this->db->like("id", $_POST["search"]["value"]);
				$this->db->like("bank_name", $_POST["search"]["value"]);
					$this->db->like("source", $_POST["search"]["value"]);
				$this->db->like("description", $_POST["search"]["value"]);
				$this->db->like("status", $_POST["search"]["value"]);
				
			}
			if (isset($_POST["order"])) {
				$this->db->order_by($this->order_column7[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else {
				$this->db->order_by('id', 'ASC');
			}
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function make_datatables_bank()
	{
		try {
			$this->make_query_bank();
			if ($_POST["length"] != -1) {
				$this->db->limit($_POST['length'], $_POST['start']);
			}
			$query = $this->db->get();
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_all_data_bank()
	{
		try {
			$this->db->select("*");
			$this->db->from($this->table7);
			return $this->db->count_all_results();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_filtered_data_bank()
	{
		try {
			$this->make_query_bank();
			$query = $this->db->get();
			return $query->num_rows();
		} catch (Exception $ex) {
			throw $ex;
		}
	}


 function insert_description($data, $id) {
        try {
            $this->db->where("id", $id);
            $return_data = $this->db->update("add_bank", $data);
            return $return_data;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    function insert_source($data, $id) {
        try {
            $this->db->where("id", $id);
            $return_data = $this->db->update("add_bank", $data);
            return $return_data;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    function insert_bank_name($data, $id) {
        try {
            $this->db->where("id", $id);
            $return_data = $this->db->update("add_bank", $data);
            return $return_data;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
	function insert_status_update_bank($data, $id) {
        try {
            $this->db->where("id", $id);
            $return_data = $this->db->update("add_bank", $data);
            return $return_data;
        } catch (Exception $ex) {
            throw $ex;
        }
    }



	var $table5 = "dropdown_bank_add";
	var $select_column5 = array("id","bank","details", "status");
	var $order_column5 = array("id","bank","details", "status");

	function make_query_bank_dropdown()
	{
		try {
			$this->db->select($this->select_column5);
			$this->db->from($this->table5);
			if (isset($_POST["search"]["value"])) {
				$this->db->like("id", $_POST["search"]["value"]);
				$this->db->like("bank", $_POST["search"]["value"]);
				$this->db->like("details", $_POST["search"]["value"]);
				$this->db->like("status", $_POST["search"]["value"]);
				
			}
			if (isset($_POST["order"])) {
				$this->db->order_by($this->order_column5[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else {
				$this->db->order_by('id', 'ASC');
			}
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function make_datatables_bank_dropdown()
	{
		try {
			$this->make_query_bank_dropdown();
			if ($_POST["length"] != -1) {
				$this->db->limit($_POST['length'], $_POST['start']);
			}
			$query = $this->db->get();
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_all_data_bank_dropdown()
	{
		try {
			$this->db->select("*");
			$this->db->from($this->table5);
			return $this->db->count_all_results();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_filtered_data_bank_dropdown()
	{
		try {
			$this->make_query_bank_dropdown();
			$query = $this->db->get();
			return $query->num_rows();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

}