<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_mini_case_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('view_mini_case_model');
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

    public function view_mini_case_open()
    {
        $this->load->library('session');
        if ($this->session->userdata('user')) {
            $this->load->view('view_mini_case');
        } else {
            redirect('/');
        }
    }

// public function download_images_quick()
// {
//     // Retrieve the imageList data from the POST request
//     $imageList = $this->input->post('imageList');

//     // Create a temporary directory to store the images
//     $tempDir = 'temp_images';
//     if (!is_dir($tempDir)) {
//         mkdir($tempDir, 0777, true);
//     }

//     // Loop through the imageList and save the images
//     foreach ($imageList as $image) {
//         $base64Data = $image['base64Data'];
//         $filename = $image['filename'];
//         $filepath = $tempDir . '/' . $filename;

//         // Decode the base64 data and save it to the file
//         $fileData = base64_decode($base64Data);
//         file_put_contents($filepath, $fileData);
//     }

//     // Generate the ZIP file
//     $zipFile = 'images.zip';
//     $zip = new ZipArchive();
//     if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
//         // Add all the files from the temporary directory to the ZIP archive
//         $files = glob($tempDir . '/*');
//         foreach ($files as $file) {
//             $zip->addFile($file, basename($file));
//         }
//         $zip->close();

//         // Remove the temporary directory and its files
//         array_map('unlink', glob($tempDir . '/*'));
//         rmdir($tempDir);

//         // Set the proper headers for file download
//         header('Content-Type: application/zip');
//         header('Content-Disposition: attachment; filename="' . $zipFile . '"');
//         header('Content-Length: ' . filesize($zipFile));

//         // Read the ZIP file and output it to the response
//         readfile($zipFile);

//         // Delete the ZIP file after it has been downloaded
//         unlink($zipFile);
//     } else {
//         // Handle the case when the ZIP file could not be created
//         echo 'Failed to create ZIP file.';
//     }
// }


public function download_images_quick()
{
    // Retrieve the imageList data from the POST request
    $imageList = $this->input->post('imageList');

    // Create a temporary directory to store the images
    $tempDir = 'temp_images';
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true);
    }

    // Loop through the imageList and save the images
    foreach ($imageList as $image) {
        $base64Data = $image['base64Data'];
        $filename = $image['filename'];
        $filepath = $tempDir . '/' . $filename;

        // Decode the base64 data and save it to the file
        $fileData = base64_decode($base64Data);
        file_put_contents($filepath, $fileData);
    }

    // Generate the ZIP file
    $zipFile = 'images.zip';
    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        // Add all the files from the temporary directory to the ZIP archive
        $files = glob($tempDir . '/*');
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }
        $zip->close();

        // Remove the temporary directory and its files
        array_map('unlink', glob($tempDir . '/*'));
        rmdir($tempDir);

        // Return the download link
        $downloadLink = base_url($zipFile);
        echo json_encode(['downloadLink' => $downloadLink]);
    } else {
        // Handle the case when the ZIP file could not be created
        echo json_encode(['error' => 'Failed to create ZIP file.']);
    }
}



//   public function download_images_quick()
//     {
//         // Retrieve the imageList data from the POST request
//         $imageList = $this->input->post('imageList');

//         // Create a temporary directory to store the images
//         $tempDir = 'temp_images';
//         if (!is_dir($tempDir)) {
//             mkdir($tempDir, 0777, true);
//         }

//         // Loop through the imageList and save the images
//         foreach ($imageList as $image) {
//             $base64Data = $image['base64Data'];
//             $filename = $image['filename'];
//             $filepath = $tempDir . '/' . $filename;

//             // Decode the base64 data and save it to the file
//             $fileData = base64_decode($base64Data);
//             file_put_contents($filepath, $fileData);
//         }

//         // Generate the ZIP file
//         $zipFile = 'images.zip';
//         $zip = new ZipArchive();
//         if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
//             // Add all the files from the temporary directory to the ZIP archive
//             $files = glob($tempDir . '/*');
//             foreach ($files as $file) {
//                 $zip->addFile($file, basename($file));
//             }
//             $zip->close();

//             // Remove the temporary directory and its files
//             array_map('unlink', glob($tempDir . '/*'));
//             rmdir($tempDir);

//             // Set the proper headers for file download
//             header('Content-Type: application/zip');
//             header('Content-Disposition: attachment; filename="' . $zipFile . '"');
//             header('Content-Length: ' . filesize($zipFile));

//             // Read the ZIP file and output it to the response
//             readfile($zipFile);

//             // Delete the ZIP file after it has been downloaded
//             unlink($zipFile);
//         } else {
//             // Handle the case when the ZIP file could not be created
//             echo 'Failed to create ZIP file.';
//         }
//     }

//     public function createZipArchive($files, $zipFilename)
//     {
//         // Create a new ZipArchive instance
//         $zip = new ZipArchive();

//         // Open the ZIP file for writing
//         if ($zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
//             // Add each file to the ZIP archive
//             foreach ($files as $file) {
//                 // Specify the path of the file to add to the ZIP archive
//                 $filePath = $file['path'];

//                 // Specify the name under which the file will be stored in the ZIP archive
//                 $zipFilename = $file['zipFilename'];

//                 // Add the file to the ZIP archive
//                 $zip->addFile($filePath, $zipFilename);
//             }

//             // Close the ZIP archive
//             $zip->close();

//             // Return the ZIP filename
//             return $zipFilename;
//         } else {
//             // Failed to create the ZIP archive
//             return false;
//         }
//     }


    public function fetch_all_mini_case()
    {
        try {
            $this->load->model("View_mini_case_model");
            $fetch_mini_case = $this->View_mini_case_model->make_datatables_mini_case();
            $data = array();
            // $i=1;

            foreach ($fetch_mini_case as $row) {
                $sub_array = array();
                $buttons = '';
                
                if ($row->fi_type == 'BV') {
                    $buttons .= '<button type="button" title="View Case" name="view" id="' . $row->id . '" class="btn btn-primary btn-sm view_quick_case"><i class="fa fa-eye" ></i></button>';
                    $buttons .= '<button type="button" title="BV Remarks" name="view" id="' . $row->id . '" class="btn btn-success btn-sm edit_bv"><i class="fa fa-pencil" ></i></button>';
                    
                } else {
                    $buttons .= '<button type="button" title="View RV Case" name="view" id="' . $row->id . '" class="btn btn-primary btn-sm view_rv_case"><i class="fa fa-eye" ></i></button>';
                    $buttons .= '<button type="button" title="RV Remarks" name="view" id="' . $row->id . '" class="btn btn-warning btn-sm edit_rv"><i class="fa fa-pencil" ></i></button>';
                        //  $buttons .= '<button type="button" title="Download Images" name="download" id="' . $row->id . '" class="btn btn-success btn-sm download_image_quick"><i class="fa fa-download" ></i></button>';
                    
                }


                // $sub_array[] = $i;
                $sub_array[] = $row->id;
                $sub_array[] = $row->bank;
                $sub_array[] = $row->name;
                $sub_array[] = $row->fi_type;
                $sub_array[] = $row->code;
                $sub_array[] = $row->reference_no;
                // $sub_array[] = $row->business_name;
                $sub_array[] = $row->business_add;
                $sub_array[] = formatdate($row->tat_start,'d-m-Y h:i A');
                $sub_array[] = formatdate($row->tat_end,'d-m-Y h:i A');
                //  $sub_array[] = $row->remarks;
                $sub_array[] = $row->status;

                // $i++;
                $sub_array[] = $buttons;
                $data[] = $sub_array;
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->View_mini_case_model->get_all_data_mini_case(),
                "recordsFiltered" => $this->View_mini_case_model->get_filtered_data_mini_case(),
                "data" => $data,
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = true;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }
   

    
    public function downloadExcel()
{
    $this->load->database();
    $this->load->helper('myexceldownload_helper');

    // Define the columns you want to export
    $columns = array('id', 'name','bank', 'product', 'reference_no','fi_type','tat_start','tat_end','status','remarks','created_at');

    $this->db->select($columns);
    $query = $this->db->get('mini_case');
    $data = $query->result_array();

    // Generate the CSV content
    $csvData = implode(",", $columns) . "\r\n"; // Column headers

    foreach ($data as $row) {
        $rowData = array();
        foreach ($columns as $column) {
            $rowData[] = $row[$column];
        }
        $csvData .= implode(",", $rowData) . "\r\n"; // Data rows
    }

    // Set output filename
    $filename = 'report.csv';

    // Set headers for file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Output the CSV content
    echo "\xEF\xBB\xBF"; // UTF-8 BOM for proper encoding
    echo $csvData;
    exit();
}

    
//     public function downloadExcel()
// {
//     $this->load->database();
//     $this->load->helper('myexceldownload_helper');

//     // Define the columns you want to export
//     $columns = array('id', 'bank', 'product','remarks');

//     $this->db->select($columns);
//     $query = $this->db->get('mini_case');
//     $data = $query->result_array();

//     // Generate the tab-separated values (TSV) content
//     $tsvData = implode("\t", $columns) . "\r\n"; // Column headers

//     foreach ($data as $row) {
//         $rowData = array();
//         foreach ($columns as $column) {
//             $rowData[] = $row[$column];
//         }
//         $tsvData .= implode("\t", $rowData) . "\r\n"; // Data rows
//     }

//     // Set output filename
//     $filename = 'report.xls'; // Use .xls extension for TSV

//     // Set headers for file download
//     header('Content-Type: application/vnd.ms-excel');
//     header('Content-Disposition: attachment;filename="' . $filename . '"');
//     header('Cache-Control: max-age=0');

//     // Output the TSV content
//     echo "\xEF\xBB\xBF"; // UTF-8 BOM for proper encoding
//     echo $tsvData;
//     exit();
// }


//   public function downloadExcel()
//     {
//         $this->load->database();
//         $this->load->helper('myexceldownload_helper');
//         // Define the columns you want to export
//         $columns = array('id', 'bank', 'product','remarks');

//         $this->db->select($columns);
//         $query = $this->db->get('mini_case');
//         $data = $query->result_array();

//         $csvData = fopen('php://temp', 'w');
//         fputcsv($csvData, $columns); // Write the column headers

//         foreach ($data as $row) {
//             $rowData = array();
//             foreach ($columns as $column) {
//                 $rowData[] = $row[$column];
//             }
//             fputcsv($csvData, $rowData);
//         }

//         header('Content-Type: application/vnd.ms-excel');
//         header('Content-Disposition: attachment;filename="report.csv"');
//         header('Cache-Control: max-age=0');

//         rewind($csvData);
//         $csvContent = stream_get_contents($csvData);
//         fclose($csvData);

//         // $filename = 'database.xlsx';
//         // force_download($filename, $csvContent);
//         // myexceldownload_helper.php
//         force_download('report.csv', $csvContent);
//     }


    function fetch_remarks()
    {
        try {
            $output = array();
            $this->load->model("View_mini_case_model");
            $data = $this->View_mini_case_model->fetch_rv_remarks($_POST["user_id"]);
            foreach ($data as $row) {
                // $output['id'] = $row->id;
                $output['remarks'] = $row->remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            echo '$error';
            // $this->load->view('login', array('error' => $error));
        }
    }

    function fetch_bv_remarks()
    {
        try {
            $output = array();
            $this->load->model("View_mini_case_model");
            $data = $this->View_mini_case_model->fetch_bv_remarks($_POST["user_id"]);
            foreach ($data as $row) {
                // $output['id'] = $row->id;
                $output['bv_remarks'] = $row->bv_remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            echo '$error';
            // $this->load->view('login', array('error' => $error));
        }
    }


    function fetch_single_mini_case()
    {
        // die("hello");
        try {
            $output = array();
            $this->load->model("View_mini_case_model");
            $data = $this->View_mini_case_model->fetch_single_mini_case($_POST["user_id"]);
            // echo "<pre>";
            // print_r($data);
            // die;
            foreach ($data as $row) {
                $output['bank']             = $row->bank;
                $output['product']          = $row->product;
                $output['fi_type']          = $row->fi_type;
                $output['reference_no']     = $row->reference_no;
                $output['name']             = $row->name;
                $output['code']             = $row->code;
                $output['agent_name']       = $row->agent_name;
                $output['city']             = $row->city;
                $output['created_at']       = formatdate($row->created_at,'d-m-Y h:i A');
                $output['tat_start']        = formatdate($row->tat_start,'d-m-Y h:i A');
                $output['tat_end']          = formatdate($row->tat_end,'d-m-Y h:i A');
                $output['business_name']    = $row->business_name;
                $output['business_add']     = $row->business_add;
                $output['bv_lat']           = $row->bv_lat;
                $output['bv_long']          = $row->bv_long;
                // $output['bv_pincode']       = $row->pin_code;
                // $output['bv_location_add']  = $row->city;
                $output['pin_code']       = $row->pin_code;
                $output['bv_location_add']  = $row->bv_location_add;
                $output['remarks']       = $row->remarks;
                $output['city']       = $row->city;


                $temp_image = $row->bv_image1;
                $temp_image2 = $row->bv_image2;
                $temp_image3 = $row->bv_image3;
                $temp_image4 = $row->bv_image4;
                $temp_image5 = $row->bv_image5;
                $temp_image6 = $row->bv_image6;
                $temp_image7 = $row->bv_image7;
                $temp_image8 = $row->bv_image8;
                $temp_image9 = $row->bv_image9;


                if (!empty($row->bv_image1)) {
                    $replace_space = str_replace(' ', '+', $temp_image);
                    $output['bv_image1'] = '<img class="bv_image1" src="' . $replace_space . '" height="150" width="150">';
                } else {
                    $output['bv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }


                if (!empty($row->bv_image2)) {
                    $replace_space2 = str_replace(' ', '+', $temp_image2);
                    $output['bv_image2'] = ' <img class="bv_image1" src="' . $replace_space2 . '" height="150" width="150">';
                } else {
                    $output['bv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }


                if (!empty($row->bv_image3)) {
                    $replace_space3 = str_replace(' ', '+', $temp_image3);
                    $output['bv_image3'] = ' <img class="bv_image1" src="' . $replace_space3 . '" height="150" width="150">';
                } else {
                    $output['bv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image4)) {
                    $replace_space4 = str_replace(' ', '+', $temp_image4);
                    $output['bv_image4'] = ' <img class="bv_image1" src="' . $replace_space4 . '" height="150" width="150">';
                } else {
                    $output['bv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image5)) {
                    $replace_space5 = str_replace(' ', '+', $temp_image5);
                    $output['bv_image5'] = ' <img class="bv_image1" src="' . $replace_space5 . '" height="150" width="150">';
                } else {
                    $output['bv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image6)) {
                    $replace_space6 = str_replace(' ', '+', $temp_image6);
                    $output['bv_image6'] = ' <img class="bv_image1" src="' . $replace_space6 . '" height="150" width="150">';
                } else {
                    $output['bv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image7)) {
                    $replace_space7 = str_replace(' ', '+', $temp_image7);
                    $output['bv_image7'] = ' <img class="bv_image1" src="' . $replace_space7 . '" height="150" width="150">';
                } else {
                    $output['bv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image8)) {
                    $replace_space8 = str_replace(' ', '+', $temp_image8);
                    $output['bv_image8'] = ' <img class="bv_image1" src="' . $replace_space8 . '" height="150" width="150">';
                } else {
                    $output['bv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image9)) {
                    $replace_space9 = str_replace(' ', '+', $temp_image9);
                    $output['bv_image9'] = ' <img class="bv_image1" src="' . $replace_space9 . '" height="150" width="150">';
                } else {
                    $output['bv_image9'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    function fetch_single_rv_mini_case()
    {
        // die("hello");
        try {
            $output = array();
            $this->load->model("View_mini_case_model");
            $data = $this->View_mini_case_model->fetch_single_mini_case($_POST["user_id"]);
            // $temp_image = $data[0]->image;
            foreach ($data as $row) {
                $output['bank'] = $row->bank;
                $output['product'] = $row->product;
                $output['fi_type'] = $row->fi_type;
                $output['reference_no'] = $row->reference_no;
                $output['name'] = $row->name;
                $output['code'] = $row->code;
                $output['address'] = $row->business_add;
                $output['business_name'] = $row->business_name;
                $output['created_at'] = $row->created_at;
                $output['tat_start'] = $row->tat_start;
                $output['tat_end'] = $row->tat_end;
                $output['city'] = $row->city;
                $output['business_add'] = $row->business_add;
                $output['rv_lat'] = $row->rv_lat;
                $output['rv_long'] = $row->rv_long;
                $output['rv_pincode'] = $row->rv_pincode;
                $output['rv_location_add'] = $row->rv_location_add;
                $output['remarks'] = $row->remarks;
                $output['city'] = $row->city;


                $temp_image = $row->rv_image1;
                $temp_image2 = $row->rv_image2;
                $temp_image3 = $row->rv_image3;
                $temp_image4 = $row->rv_image4;
                $temp_image5 = $row->rv_image5;
                $temp_image6 = $row->rv_image6;
                $temp_image7 = $row->rv_image7;
                $temp_image8 = $row->rv_image8;
                $temp_image9 = $row->rv_image9;


                if (!empty($row->rv_image1)) {
                    $replace_space = str_replace(' ', '+', $temp_image);
                    $output['rv_image1'] = '<img class="bv_image1" src="' . $replace_space . '" height="150" width="150">';
                } else {
                    $output['rv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image2)) {
                    $replace_space2 = str_replace(' ', '+', $temp_image2);
                    $output['rv_image2'] = '<img class="bv_image1" src="' . $replace_space2 . '" height="150" width="150">';
                } else {
                    $output['rv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                if (!empty($row->rv_image3)) {
                    $replace_space3 = str_replace(' ', '+', $temp_image3);
                    $output['rv_image3'] = '<img class="bv_image1" src="' . $replace_space3 . '" height="150" width="150">';
                } else {
                    $output['rv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image4)) {
                    $replace_space4 = str_replace(' ', '+', $temp_image4);
                    $output['rv_image4'] = '<img class="bv_image1" src="' . $replace_space4 . '" height="150" width="150">';
                } else {
                    $output['rv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image5)) {
                    $replace_space5 = str_replace(' ', '+', $temp_image5);
                    $output['rv_image5'] = '<img class="bv_image1" src="' . $replace_space5 . '" height="150" width="150">';
                } else {
                    $output['rv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image6)) {
                    $replace_space6 = str_replace(' ', '+', $temp_image6);
                    $output['rv_image6'] = '<img class="bv_image1" src="' . $replace_space6 . '" height="150" width="150">';
                } else {
                    $output['rv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image7)) {
                    $replace_space7 = str_replace(' ', '+', $temp_image7);
                    $output['rv_image7'] = '<img class="bv_image1" src="' . $replace_space7 . '" height="150" width="150">';
                } else {
                    $output['rv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image8)) {
                    $replace_space8 = str_replace(' ', '+', $temp_image8);
                    $output['rv_image8'] = '<img class="bv_image1" src="' . $replace_space8 . '" height="150" width="150">';
                } else {
                    $output['rv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image9)) {
                    $replace_space9 = str_replace(' ', '+', $temp_image9);
                    $output['rv_image9'] = '<img class="bv_image1" src="' . $replace_space9 . '" height="150" width="150">';
                } else {
                    $output['rv_image9'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    function get_remark()
    {
        $array = array(
            'remarks' => $this->input->post('value')
        );
        $this->load->model('View_mini_case_model');
        $this->View_mini_case_model->insert_remark($array, $this->input->post('pk'));
        print_r($array);
    }

    public function update_rv_remarks_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('rv_remarks', 'rv_remarks', '');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {
                $pass_id = $_POST["rv_id"];
                $array = array(
                    'rv_remarks' => $this->input->post('rv_remarks')
                );
                $this->load->model('View_mini_case_model');
                $insert_user = $this->View_mini_case_model->update_rv_remarks($pass_id, $array);
                if ($insert_user) {
                    $response = array(
                        'success' => true,
                        'message' => "RV Remarks updated successfully!"
                    );
                } else {
                    $response = array(
                        'error' => true,
                        'message' => "error in data!"
                    );
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $response['message'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }

    public function update_remarks_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('remarks', 'remarks', 'required');
            $response = [];
            if ($this->form_validation->run()) {
                // print_r($this->input->post());die;
                $minicase_id = $_POST["minicase_id"];
                $array = array(
                    'remarks' => $this->input->post('remarks')
                );
                $this->load->model('View_mini_case_model');
                // echo "<prE>";
                // print_r($minicase_id);
                // print_r($array);
                // die;
                $insert_user = $this->View_mini_case_model->update_bv_remarks($minicase_id, $array);
                if ($insert_user) {

                    $response = array('type' => 'success', 'massege' => 'Remarks updated successfully!');
                } else {

                    $response = array('type' => 'danger', 'massege' => 'Somthing went wrong please contact to administrator');
                }
            } else {
                $response = array('type' => 'danger', 'massege' => 'validation error error...');
            }
        } catch (Exception $ex) {
            $response = array('type' => 'danger', 'massege' => 'try error...');
        }
        $this->session->set_flashdata('res_data', $response);
        redirect(base_url("/View_mini_case_controller/view_mini_case_open"));
    }
    
     public function getAllAgentCode()
	{
		$response = [];
		try {
            // $sql = "SELECT employee_unique_id FROM `login`";
            $sql = "SELECT employee_unique_id FROM `login` WHERE role_group = 'FA'";
				$query = $this->db->query($sql);
				$data['data'] = $query->result_array();
			$response = $data;
		} catch (Exception $ex) {
			$response = [
				'status' => "failure",
				'message' => $ex->getMessage(),
			];
		}
		echo json_encode($response);
	}


    //   public function update_rv_remarks_validation()
    // {
    //     try {
    //         $this->load->library('form_validation');
    //         $this->form_validation->set_rules('rv_remarks', 'rv_remarks', '');
    //         $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    //         if ($this->form_validation->run()) {
    //             $pass_id = $_POST["rv_id"];
    //             $array = array(
    //                 'rv_remarks' => $this->input->post('rv_remarks')
    //             );
    //             $this->load->model('View_mini_case_model');
    //             $insert_user = $this->View_mini_case_model->update_rv_remarks($pass_id, $array);
    //             if ($insert_user) {
    //                 $response = array(
    //                     'success' => true,
    //                     'message' => "RV Remarks updated successfully!"
    //                 );
    //             } else {
    //                 $response = array(
    //                     'error' => true,
    //                     'message' => "error in data!"
    //                 );
    //             }
    //         } else {
    //             foreach ($_POST as $key => $value) {
    //                 $response['message'][$key] = form_error($key);
    //             }
    //         }
    //         echo json_encode($response);
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login_page', array('error' => $error));
    //     }
    // }
}
