<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Billing_quick_controller extends CI_Controller
{

    function __construct()
    {
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

    public function fetch_all_transferedMiniCases()
    {
        try {
            $this->load->model("Reassign_mini_case_model");
            $fetch_reassign_case = $this->Reassign_mini_case_model->make_datatables_Transactions_mini();
            $data = array();
            // $i=1;

            foreach ($fetch_reassign_case as $row) {
                $sub_array = array();



                // $sub_array[] = $i;
                $sub_array[] = $row->id;
                $sub_array[] = $row->reference_no;
                // $sub_array[] = $row->id;
                $sub_array[] = $row->bank;
                $sub_array[] = $row->fi_type;
                $sub_array[] = $row->assign_from;
                $sub_array[] = $row->assign_to;
                $sub_array[] = $row->transfer_date;
                $sub_array[] = $row->created_at;
                $sub_array[] = $row->reassign_remarks;
                // $sub_array[] = $row->remarks;
                // $i++;

                $data[] = $sub_array;
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->Reassign_mini_case_model->get_all_data_Transactions(),
                "recordsFiltered" => $this->Reassign_mini_case_model->get_filtered_data_Transactions(),
                "data" => $data,
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = true;
            $error['message'] = $ex->getMessage();
            echo json_encode($error);
            // $this->load->view('login_page', array('error' => $error));
        }
    }


    public function downloadReport()
    {
        $bankname = array();
        $from_date = $_POST['from_date'] . ' 00:00:01';
        $to_date = $_POST['to_date'] . ' 23:59:59';
        //  $bankname="'" . implode ( ",", isset($_POST['bankname'] )) . "'";
        $bankname = isset($_POST['bankname']) ? "'" . implode("', '", $_POST['bankname']) . "'" : '';
        //   echo '<pre>';  print_r ($bankname);die("tets");
        //   $product= "'" . implode ( "', '", isset($_POST['product'] )) . "'";
        // $product12 = isset($_POST['product']) && is_array($_POST['product']) ? $_POST['product'] : [];
        //  $product= "'" . implode ( "', '", isset($product12)) . "'";
        // $vpn1 =implode(',', $vpn_network);

        //   implode( '`, `', $dataColumns)
        // $agent= "'" . implode ( "', '", $_POST['agent'] ) . "'";
        $agent = isset($_POST['agent']) ? "'" . implode("', '", $_POST['agent']) . "'" : '';
        $product = isset($_POST['product']) ? "'" . implode("', '", $_POST['product']) . "'" : '';
        $FItype = isset($_POST['FItype']) ? "'" . implode("', '", $_POST['FItype']) . "'" : '';
        $download = isset($_POST['download']) ? '"' . implode('","', $_POST['download']) . '"' : '';
        $downloadquery = isset($_POST['download']) ? implode(",", $_POST['download']) : '';
        //   echo '<pre>';  print_r ($product);die("tets");


        if (empty($_POST['download'])) {
            $this->session->set_flashdata("msg", "Please Select the Field to be downloaded");
            redirect("Billing_quick_controller/billing_quick", "location");
        }
        if (!empty($_POST['bankname'])) {
            $str = 'and bank_name IN (' . $bankname . ')';
        } else $str = '';

        if (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {
            $strdate = 'created_at between ' . "'" . $from_date . "'" . ' and ' . "'" . $to_date . "'";
        } else {

            $from_date1 = date('2001-m-d H:i:s');
            $to_date1 = date('Y-m-d H:i:s');;
            $strdate = 'created_at between ' . "'" . $from_date1 . "'" . ' and ' . "'" . $to_date1 . "'";
        }

        if (!empty($_POST['product'])) {
            $strproduct = "and product_name IN (" . "$product" . ")";
        } else $strproduct = '';

        if (!empty($_POST['agent'])) {
            $stragent = 'and code IN (' . $agent . ')';
        } else $stragent = '';

        if (!empty($_POST['FItype'])) {
            $strFItype = "and fi_to_be_conducted IN (" . "$FItype" . ")";
        } else $strFItype = '';

        // echo "Select $downloadquery from upload_file where $strdate $str $strproduct $strFItype";die();
        $this->val1 = $this->db->query("Select $downloadquery from upload_file where $strdate $str $stragent $strproduct $strFItype");
        $this->num1 = $this->val1->num_rows();
        $count = count($_POST['download']);
        //echo $count;die();
        $delimiter = chr(9);
        ob_clean();
        $filename1 = "Reports.xls";
        //echo $filename;die();
        $filename = trim($filename1);
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");
        //$colarray=implode($delimiter, array("ID","Application ID","Code","Bank","FI Type","Updated Date","Case Created Date","Remark"));
        for ($i = 0; $i < $count; $i++) {
            echo $_POST['download'][$i] . "\t";
        }
        print("\n");
        if ($this->num1 > 0) {
            foreach ($this->val1->result_array() as $row) {
                //  echo '<pre>';print_r($row);
                $schema_insert = "";
                // for($j=0; $j<$count;$j++)
                foreach ($_POST['download'] as $val) {  //echo $val;die();
                    if (!isset($row[$val]))
                        $schema_insert .= "NULL" . $sep;
                    elseif ($row[$val] != "")
                        $schema_insert .= "$row[$val]" . $sep;
                    else
                        $schema_insert .= "" . $sep;

                    $schema_insert = str_replace($sep . "$", "", $schema_insert);
                    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
                    $schema_insert .= "\t";
                }
                print(trim($schema_insert));
                print "\n";
            }
        } else {
            $this->session->set_flashdata("msg", "No Record Found");
            redirect("Billing_quick_controller/billing_quick", "location");
        }
    }
}
