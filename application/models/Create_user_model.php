<?php
class Create_user_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//add new user
	function insert_user($data)
	{
		try {
			$this->db->insert('login', $data);
			return $this->db->insert_id();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	var $table7 = "login";
	var $select_column7 = array("id","role_group","first_name", "username", "password","mobile", "organization", "status");
	var $order_column7 = array("id","role_group","first_name", "username", "password", "mobile","organization", "status");

	function make_query_user()
	{
		try {
			$this->db->select($this->select_column7);
			$this->db->from($this->table7);
			if (isset($_POST["search"]["value"])) {
				$this->db->like("id", $_POST["search"]["value"]);
				$this->db->like("role_group", $_POST["search"]["value"]);
				$this->db->like("first_name", $_POST["search"]["value"]);
				$this->db->like("username", $_POST["search"]["value"]);
				$this->db->or_like("password", $_POST["search"]["value"]);
				$this->db->or_like("mobile", $_POST["search"]["value"]);
				$this->db->or_like("organization", $_POST["search"]["value"]);
				$this->db->or_like("status", $_POST["search"]["value"]);
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

	function make_datatables_user()
	{
		try {
			$this->make_query_user();
			if ($_POST["length"] != -1) {
				$this->db->limit($_POST['length'], $_POST['start']);
			}
			$query = $this->db->get();
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_all_data_user()
	{
		try {
			$this->db->select("*");
			$this->db->from($this->table7);
			return $this->db->count_all_results();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_filtered_data_user()
	{
		try {
			$this->make_query_user();
			$query = $this->db->get();
			return $query->num_rows();
		} catch (Exception $ex) {
			throw $ex;
		}
	}


	function insert_status_update($data, $id) {
        try {
            $this->db->where("id", $id);
            $return_data = $this->db->update("login", $data);
            return $return_data;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

	function update_password($pass_id, $data)
	{
		try {
			$this->db->where("id", $pass_id);
			// print_r($data);die;
			$return_data = $this->db->update("login", $data);
			return $return_data;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function update_mobile($mobile_id, $data)
	{
		try {
			$this->db->where("id", $mobile_id);
			$return_data = $this->db->update("login", $data);
			return $return_data;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	
	function fetch_single_mobile($users_id)
	{
		try {
			$this->db->where("id", $users_id);
			$query = $this->db->get('login');
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function fetch_single_password($user_id)
	{
		try {
			$this->db->where("id", $user_id);
			$query = $this->db->get('login');
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function delete_single_user($user_id)
	{
		try {
			$this->db->where("id", $user_id);
			$return = $this->db->delete("login");
			return $return;
			//DELETE FROM users WHERE id = '$user_id' 
		} catch (Exception $ex) {
			throw $ex;
		}
	}

}