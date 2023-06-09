<?php
class View_mini_case_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public $table1 = "mini_case";
    public $select_column1 = array("id", "bank", "fi_type", "name", "code", "reference_no", "business_name", "business_add", "residence_add", "status", "created_at");
    public $order_column1 = array("id", "bank", "fi_type", "name",  "code", "reference_no", "business_name", "business_add", "residence_add", "status", "created_at");
    public $column_search = array("id", "bank", "fi_type", "name",  "code", "reference_no", "business_name", "business_add", "residence_add", "status", "created_at");

    public function make_query_mini_case()
    {
        try {
            $this->db->select($this->select_column1);
            $this->db->from($this->table1);
            if (isset($_POST["search"]["value"])) {
                $this->db->like("id", $_POST["search"]["value"]);
                $this->db->like("bank", $_POST["search"]["value"]);
                $this->db->or_like("fi_type", $_POST["search"]["value"]);
                $this->db->or_like("code", $_POST["search"]["value"]);
                $this->db->or_like("address", $_POST["search"]["value"]);
                $this->db->or_like("remarks", $_POST["search"]["value"]);
                $this->db->or_like("created_at", $_POST["search"]["value"]);
            }

            if (!empty($this->input->post('from_date')) && !empty($this->input->post('to_date'))) {
                $this->db->where('created_at >= ', $_POST['from_date']);
                $this->db->where('created_at <= ', $_POST['to_date']);
            } else {
            }

            $i = 0;
            foreach ($this->column_search as $item) { // loop column
                if (!empty($_POST['search']['value'])) { // if datatable send POST for search
                    if ($i === 0) { // first loop
                        $this->db->group_start(); // open bracket.  query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if (count($this->column_search) - 1 == $i) //last loop
                    {
                        $this->db->group_end();
                    }
                    //close bracket
                }
                $i++;
            }

            if (isset($_POST["order"])) {
                $this->db->order_by($this->order_column1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'ASC');
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function make_datatables_mini_case()
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

    public function get_all_data_mini_case()
    {
        try {
            $this->db->select("*");
            $this->db->from($this->table1);
            return $this->db->count_all_results();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function get_filtered_data_mini_case()
    {
        try {
            $this->make_query_mini_case();
            $query = $this->db->get();
            return $query->num_rows();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function fetch_single_mini_case($user_id)
    {
        try {
            $this->db->where("id", $user_id);
            $query = $this->db->get('mini_case');
            return $query->result();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    function insert_remark($data, $id)
    {
        try {
            $this->db->where("id", $id);
            $return_data = $this->db->update("mini_case", $data);
            return $return_data;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
