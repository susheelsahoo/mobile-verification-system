<?php
class Reassign_mini_case_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	var $table1 = "mini_case_transfer_history AS ct";
    var $table2 = "mini_case AS uf";
    var $select_column1 = array("ct.id","ct.reference_no","uf.bank", "uf.fi_type", "ct.assign_from", "ct.assign_to", "ct.transfer_date","uf.created_at","uf.reassign_remarks");
    var $column_search = array("ct.id","ct.reference_no", "uf.bank", "uf.fi_type", "ct.assign_from", "ct.assign_to", "ct.transfer_date","uf.created_at","uf.reassign_remarks");

    function make_query_transactions() {
        try {
            $this->db->select($this->select_column1);
            $this->db->from($this->table1);
            $this->db->join('mini_case AS uf', 'ct.reference_no = uf.reference_no', 'left');
			if (isset($_POST["search"]["value"])) {
				$this->db->like("ct.id", $_POST["search"]["value"]);
				$this->db->like("ct.reference_no", $_POST["search"]["value"]);
				// $this->db->like("uf.id", $_POST["search"]["value"]);
				$this->db->like("uf.bank", $_POST["search"]["value"]);
				$this->db->or_like("uf.fi_type", $_POST["search"]["value"]);
				$this->db->or_like("ct.assign_from", $_POST["search"]["value"]);
				$this->db->or_like("ct.assign_to", $_POST["search"]["value"]);
				$this->db->or_like("ct.transfer_date", $_POST["search"]["value"]);
				$this->db->or_like("uf.created_at", $_POST["search"]["value"]);
				$this->db->or_like("uf.reassign_remarks", $_POST["search"]["value"]);
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

    function make_datatables_Transactions_mini() {
        try {
            $this->make_query_transactions();
            if ($_POST["length"] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function get_all_data_Transactions() {
        try {
            $this->db->select("*");
            $this->db->from($this->table1);
            return $this->db->count_all_results();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function get_filtered_data_Transactions() {
        try {
            $this->make_query_transactions();
            $query = $this->db->get();
            return $query->num_rows();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}