<?php
defined('BASEPATH') or exit('No direct script access allowed');
// use Intervention\Image\ImageManager;
// use Intervention\Image\Exception\NotReadableException;
// use Intervention\Image\Exception\NotWritableException;
class Assign_case_controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Assign_case_model');
    }

    public function index()
    {
        //load session library
        $this->load->library('session');
        //restrict users to go back to login if session has been set
        if ($this->session->userdata('user')) {
            redirect('home');
        } else {
            $this->load->view('login_page');
        }
    }



    public function assign_case_function($data)
    {

        $this->load->library('session');
        if ($this->session->userdata('user')) {
            $this->load->model("Assign_case_model");
            $agent_name = $this->Assign_case_model->getAgentName($data);

            $fetch_data['allAgent'] = $this->Assign_case_model->filter_assignee($data);
            $fetch_data['data'] = $data;
     $fetch_data['agent_name'] = $agent_name;

            $this->load->view('assign_case', $fetch_data);
        } else {
            redirect('/');
        }
    }
    
//     public function assign_case_function($employee_unique_id)
// {
//     $this->load->library('session');
//     if ($this->session->userdata('user')) {
//         $this->load->model("Assign_case_model");

//         // Fetch the agent's name based on the employee_unique_id
//         $agent_name = $this->Assign_case_model->getAgentName($employee_unique_id);

//         $fetch_data['allAgent'] = $this->Assign_case_model->filter_assignee($data);
//         $fetch_data['data'] = $data;
//         $fetch_data['agent_name'] = $agent_name;

//         $this->load->view('assign_case', $fetch_data);
//     } else {
//         redirect('/');
//     }
// }



  public function show($id) {
        // Fetch the row details from your database
        $this->load->model('Assign_case_model');
        $details = $this->Assign_case_model->getDetails($id);
        $imageData = $details['rv_image1'];

        // Pass the details to the view
        $data['details'] = $details;
        $this->load->view('details_view', $data);
    }
    
    
    
    function delete_single_case() {
        try {
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->delete_single_case($_POST["user_id"]);
//           echo 'Data Deleted';  
            if ($data) {
                return $data;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }
    
     public function show_bv($id) {
        // Fetch the row details from your database
        $this->load->model('Assign_case_model');
        $bvdetails = $this->Assign_case_model->getbvDetails($id);

        // Pass the details to the view
        $data['bvdetails'] = $bvdetails;
        $this->load->view('bv_details_view', $data);
    }
    
    //  public function show_bv() {
    //     $id = $this->input->get('$id'); // Get the reference number from the URL

    //     $this->load->model('Assign_case_model');
    //     $data['bvdetails'] = $this->Assign_case_model->getbvDetails($id);

    //     // Load the view passing the fetched data
    //     $this->load->view('bv_details_view', $data);
    // }
    
    
    //  public function send_email_supervisor()
    // {
    //     // Get the selected row ID
    //     $id = $this->input->post('id');
     

    //     // Send email to admin
    //     // $adminEmail = 'Jainnupur.88@gmail.com'; // Replace with the actual admin's email
       
        
    //     $link = base_url('Assign_case_controller/show/'.$id);
    //      $emailContent = 'Link: ' . $link;


    //     $this->load->library('email');
    //     $this->email->from('Jainnupur.88@gmail.com', 'Nupur Jain');
    //     $this->email->to($adminEmail);
    //     $this->email->subject('New Link');
    //     $this->email->message($emailContent);

    //     if ($this->email->send()) {
    //         echo 'Email sent successfully!';
    //     } else {
    //         echo 'Email not sent successfully!';
    //         // echo 'An error occurred while sending the email: ' . $this->email->print_debugger();
    //     }
    // }


 public function send_email_supervisor() {
        // Get the row ID and link from the POST data
          $id = $this->input->post('id');

        // Get the email addresses from the POST data
        $emails = $this->input->post('emails');

        // Send email to each address
        $emailAddresses = explode(',', $emails);
        foreach ($emailAddresses as $emailAddress) {
            // Prepare the email content
             $link = base_url('Assign_case_controller/show/'.$id);
            $emailContent = 'Link: ' . $link;

            // Send the email
            $this->load->library('email');
            $this->email->from('yogitasharma1606@gmail.com', 'Yogita sharma');
            $this->email->to(trim($emailAddress));
            $this->email->subject('Confirmation Email for Residence Verification Cases');
            $this->email->message($emailContent);

            if ($this->email->send()) {
                // Email sent successfully
                echo 'Email sent to: ' . $emailAddress . '<br>';
            } else {
                // Error sending email
                echo 'Error sending email to: ' . $emailAddress . '<br>';
                // echo $this->email->print_debugger();
            }
        }
    }
    
     public function send_email_supervisor_bv() {
        // Get the row ID and link from the POST data
          $id = $this->input->post('id');

        // Get the email addresses from the POST data
        $emailsbv = $this->input->post('emails');

        // Send email to each address
        $emailAddressess = explode(',', $emailsbv);
        foreach ($emailAddressess as $emailAddressbv) {
            // Prepare the email content
             $link = base_url('Assign_case_controller/show_bv/'.$id);
            $emailContentbv = 'Link: ' . $link;

            // Send the email
            $this->load->library('email');
            $this->email->from('yogitasharma1606@gmail.com', 'Yogita sharma');
            $this->email->to(trim($emailAddressbv));
            $this->email->subject('Confirmation Email For Business Verification Cases');
            $this->email->message($emailContentbv);

            if ($this->email->send()) {
                // Email sent successfully
                echo 'Email sent to: ' . $emailAddressbv . '<br>';
            } else {
                // Error sending email
                echo 'Error sending email to: ' . $emailAddressbv . '<br>';
                // echo $this->email->print_debugger();
            }
        }
    }

    
//     public function download_images()
// {
//     try {
//         $id = $this->input->post('id');
//         if (!$id) {
//             throw new Exception('ID not found in POST request.');
//         }
//         ini_set('display_errors', 1);
//         error_reporting(E_ALL);
//         $tempDir = 'temp_images';
//         if (!is_dir($tempDir)) {
//             mkdir($tempDir, 0777, true);
//         }
        
//         $this->load->model("Assign_case_model");
//         $data = $this->Assign_case_model->getImageDataById($id);
//         $zipFile = $tempDir . '/images.zip';
        
//         $zip = new ZipArchive();
//         if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
//             foreach ($data as $row) {
//                 $base64Data1 = str_replace(' ', '+', $row->rv_image1);
//                 $base64Data2 = str_replace(' ', '+', $row->rv_image2);
//                 $base64Data3 = str_replace(' ', '+', $row->rv_image3);
//                  $base64Data4 = str_replace(' ', '+', $row->rv_image4);
//                   $base64Data5 = str_replace(' ', '+', $row->rv_image5);
//                   $base64Data6 = str_replace(' ', '+', $row->rv_image6);
//                     $base64Data7 = str_replace(' ', '+', $row->rv_image7);
//                      $base64Data8 = str_replace(' ', '+', $row->rv_image8);
//                       $base64Data9 = str_replace(' ', '+', $row->rv_image9);
//                 // ... repeat for other image columns
                
//                 // Extract the base64 image data
//                 $base64Data1 = substr($base64Data1, strpos($base64Data1, ',') + 1);
//                 $base64Data2 = substr($base64Data2, strpos($base64Data2, ',') + 1);
//                 $base64Data3 = substr($base64Data3, strpos($base64Data3, ',') + 1);
//                  $base64Data4 = substr($base64Data4, strpos($base64Data4, ',') + 1);
//                   $base64Data5 = substr($base64Data5, strpos($base64Data5, ',') + 1);
//                   $base64Data6 = substr($base64Data6, strpos($base64Data6, ',') + 1);
//                     $base64Data7 = substr($base64Data7, strpos($base64Data7, ',') + 1);
//                      $base64Data8 = substr($base64Data8, strpos($base64Data8, ',') + 1);
//                       $base64Data9 = substr($base64Data9, strpos($base64Data9, ',') + 1);
//                 // ... repeat for other image columns
                
//                 // Save and add images to the ZIP archive for non-empty columns
//                 // if (!empty($base64Data1)) {
//                 //     $filename1 = 'rv_image1_' . $id . '.jpeg';
//                 //     $imagePath1 = $tempDir . '/' . $filename1;
                    
                    
//                 //     if (file_put_contents($imagePath1, base64_decode($base64Data1)) === false) {
//                 //         throw new Exception('Error saving image 1');
//                 //     }
//                 //     if ($zip->addFile($imagePath1, $filename1) === false) {
//                 //         throw new Exception('Error adding image 1 to ZIP archive');
//                 //     }
//                 // }
                
//                  if (!empty($base64Data1)) {
//                     $filename1 = 'rv_image1_' . $id . '.jpeg';
//                     $imagePath1 = $tempDir . '/' . $filename1;
                    
//                     // Save image with increased dimensions
//                     $imageData1 = base64_decode($base64Data1);
//                     $image1 = imagecreatefromstring($imageData1);
//                     // Specify the desired width and height for the resized image
// $newWidth = 500;
// $newHeight = 500;

//                     $resizedImage1 = imagescale($image1, $newWidth, $newHeight);
//                     imagejpeg($resizedImage1, $imagePath1);
//                     imagedestroy($image1);
//                     imagedestroy($resizedImage1);
                    
//                     if ($zip->addFile($imagePath1, $filename1) === false) {
//                         throw new Exception('Error adding image 1 to ZIP archive');
//                     }
//                 }
                
                
//                  if (!empty($base64Data2)) {
//                     $filename2 = 'rv_image2_' . $id . '.jpeg';
//                     $imagePath2 = $tempDir . '/' . $filename2;
                    
//                   // Save image with increased dimensions
// $imageData2 = base64_decode($base64Data2);
// $image2 = imagecreatefromstring($imageData2);

// // Specify the desired width and height for the resized image
// $newWidth = 500;
// $newHeight = 500;

// // Resize the image
// $resizedImage2 = imagescale($image2, $newWidth, $newHeight);
// imagejpeg($resizedImage2, $imagePath2);

// // Destroy the original and resized images
// imagedestroy($image2);
// imagedestroy($resizedImage2);

// // Add the resized image to the ZIP archive
// if ($zip->addFile($imagePath2, $filename2) === false) {
//     throw new Exception('Error adding image 2 to ZIP archive');
// }
//                 }
                
                
                

                
       
                
//                 if (!empty($base64Data2)) {
//                     $filename2 = 'rv_image2_' . $id . '.jpeg';
//                     $imagePath2 = $tempDir . '/' . $filename2;
//                     if (file_put_contents($imagePath2, base64_decode($base64Data2)) === false) {
//                         throw new Exception('Error saving image 2');
//                     }
//                     if ($zip->addFile($imagePath2, $filename2) === false) {
//                         throw new Exception('Error adding image 2 to ZIP archive');
//                     }
//                 }
                
               
                
//                  if (!empty($base64Data3)) {
//                     $filename3 = 'rv_image3_' . $id . '.jpeg';
//                     $imagePath3 = $tempDir . '/' . $filename3;
//                     if (file_put_contents($imagePath3, base64_decode($base64Data3)) === false) {
//                         throw new Exception('Error saving image 3');
//                     }
//                     if ($zip->addFile($imagePath3, $filename3) === false) {
//                         throw new Exception('Error adding image 3 to ZIP archive');
//                     }
//                 }
                
//                  if (!empty($base64Data4)) {
//                     $filename4 = 'rv_image4_' . $id . '.jpeg';
//                     $imagePath4 = $tempDir . '/' . $filename4;
//                     if (file_put_contents($imagePath4, base64_decode($base64Data4)) === false) {
//                         throw new Exception('Error saving image 4');
//                     }
//                     if ($zip->addFile($imagePath4, $filename4) === false) {
//                         throw new Exception('Error adding image 4 to ZIP archive');
//                     }
//                 }
                
                
                
//                  if (!empty($base64Data5)) {
//                     $filename5 = 'rv_image5_' . $id . '.jpeg';
//                     $imagePath5 = $tempDir . '/' . $filename5;
//                     if (file_put_contents($imagePath5, base64_decode($base64Data5)) === false) {
//                         throw new Exception('Error saving image 5');
//                     }
//                     if ($zip->addFile($imagePath5, $filename5) === false) {
//                         throw new Exception('Error adding image 5 to ZIP archive');
//                     }
//                 }
                
//                  if (!empty($base64Data6)) {
//                     $filename6 = 'rv_image6_' . $id . '.jpeg';
//                     $imagePath6 = $tempDir . '/' . $filename6;
//                     if (file_put_contents($imagePath6, base64_decode($base64Data6)) === false) {
//                         throw new Exception('Error saving image 6');
//                     }
//                     if ($zip->addFile($imagePath6, $filename6) === false) {
//                         throw new Exception('Error adding image 6 to ZIP archive');
//                     }
//                 }
                
//                  if (!empty($base64Data7)) {
//                     $filename7 = 'rv_image7_' . $id . '.jpeg';
//                     $imagePath7 = $tempDir . '/' . $filename7;
//                     if (file_put_contents($imagePath7, base64_decode($base64Data7)) === false) {
//                         throw new Exception('Error saving image 7');
//                     }
//                     if ($zip->addFile($imagePath7, $filename7) === false) {
//                         throw new Exception('Error adding image 7 to ZIP archive');
//                     }
//                 }
                
//                  if (!empty($base64Data8)) {
//                     $filename8 = 'rv_image8_' . $id . '.jpeg';
//                     $imagePath8 = $tempDir . '/' . $filename8;
//                     if (file_put_contents($imagePath8, base64_decode($base64Data8)) === false) {
//                         throw new Exception('Error saving image 8');
//                     }
//                     if ($zip->addFile($imagePath8, $filename8) === false) {
//                         throw new Exception('Error adding image 8 to ZIP archive');
//                     }
//                 }
                
//                  if (!empty($base64Data9)) {
//                     $filename9 = 'rv_image9_' . $id . '.jpeg';
//                     $imagePath9 = $tempDir . '/' . $filename9;
//                     if (file_put_contents($imagePath9, base64_decode($base64Data9)) === false) {
//                         throw new Exception('Error saving image 9');
//                     }
//                     if ($zip->addFile($imagePath9, $filename9) === false) {
//                         throw new Exception('Error adding image 9 to ZIP archive');
//                     }
//                 }
//                 // ... repeat for other image columns
//             }
            
//             $zip->close();
            
//             // Send the ZIP file to the browser for download
//             header('Content-Type: application/zip');
//             header('Content-Disposition: attachment; filename="images.zip"');
//             header('Content-Length: ' . filesize($zipFile));
//             readfile($zipFile);
            
//             // Delete the temporary directory and ZIP file
//             $this->delete_directory($tempDir);
//         } else {
//             throw new Exception('Failed to create ZIP archive.');
//         }
//     } catch (Exception $e) {
//         echo 'Error: ' . $e->getMessage();
//     }
// }

public function download_images()
{
    try {
        $id = $this->input->post('id');
        if (!$id) {
            throw new Exception('ID not found in POST request.');
        }
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $tempDir = 'temp_images';
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        
        $this->load->model("Assign_case_model");
        $data = $this->Assign_case_model->getImageDataById($id);
        $zipFile = $tempDir . '/images.zip';
        
        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($data as $row) {
                for ($i = 1; $i <= 9; $i++) {
                    $columnName = "rv_image" . $i;
                    $base64Data = str_replace(' ', '+', $row->$columnName);
                    
                    // Extract the base64 image data
                    $base64Data = substr($base64Data, strpos($base64Data, ',') + 1);
                    
                    // Save and add images to the ZIP archive for non-empty columns
                    if (!empty($base64Data)) {
                        $filename = "rv_image{$i}_" . $id . '.jpeg';
                        $imagePath = $tempDir . '/' . $filename;
                        
                        // Save image with increased dimensions
                        $imageData = base64_decode($base64Data);
                        $image = imagecreatefromstring($imageData);
                        
                        // Specify the desired width and height for the resized image
                        $newWidth = 480;
                        $newHeight = 640;
                        
                        // Resize the image
                        $resizedImage = imagescale($image, $newWidth, $newHeight);
                        imagejpeg($resizedImage, $imagePath);
                        
                        imagedestroy($image);
                        imagedestroy($resizedImage);
                        
                        if ($zip->addFile($imagePath, $filename) === false) {
                            throw new Exception("Error adding image $i to ZIP archive");
                        }
                    }
                }
            }
            
            $zip->close();
            
            // Send the ZIP file to the browser for download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="images.zip"');
            header('Content-Length: ' . filesize($zipFile));
            readfile($zipFile);
            
            // Delete the temporary directory and ZIP file
            $this->delete_directory($tempDir);
        } else {
            throw new Exception('Failed to create ZIP archive.');
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



// public function download_images()
// {
//     try {
//         $id = $this->input->post('id');
//         if (!$id) {
//             throw new Exception('ID not found in POST request.');
//         }
//         ini_set('display_errors', 1);
//         error_reporting(E_ALL);
//         $tempDir = 'temp_images';
//         if (!is_dir($tempDir)) {
//             mkdir($tempDir, 0777, true);
//         }
        
//         $this->load->model("Assign_case_model");
//         $data = $this->Assign_case_model->getImageDataById($id);
//         $zipFile = $tempDir . '/images.zip';
        
//         $zip = new ZipArchive();
//         if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
//             foreach ($data as $row) {
//                 $base64Data1 = str_replace(' ', '+', $row->rv_image1);
//                 $base64Data2 = str_replace(' ', '+', $row->rv_image2);
//                 $base64Data3 = str_replace(' ', '+', $row->rv_image3);
//                 $base64Data4 = str_replace(' ', '+', $row->rv_image4);
//                 $base64Data5 = str_replace(' ', '+', $row->rv_image5);
//                 $base64Data6 = str_replace(' ', '+', $row->rv_image6);
//                 $base64Data7 = str_replace(' ', '+', $row->rv_image7);
//                 $base64Data8 = str_replace(' ', '+', $row->rv_image8);
//                 $base64Data9 = str_replace(' ', '+', $row->rv_image9);
                
//                 // Extract the base64 image data
//                 $base64Data1 = substr($base64Data1, strpos($base64Data1, ',') + 1);
//                 $base64Data2 = substr($base64Data2, strpos($base64Data2, ',') + 1);
//                 $base64Data3 = substr($base64Data3, strpos($base64Data3, ',') + 1);
//                 $base64Data4 = substr($base64Data4, strpos($base64Data4, ',') + 1);
//                 $base64Data5 = substr($base64Data5, strpos($base64Data5, ',') + 1);
//                 $base64Data6 = substr($base64Data6, strpos($base64Data6, ',') + 1);
//                 $base64Data7 = substr($base64Data7, strpos($base64Data7, ',') + 1);
//                 $base64Data8 = substr($base64Data8, strpos($base64Data8, ',') + 1);
//                 $base64Data9 = substr($base64Data9, strpos($base64Data9, ',') + 1);
                
//                 // Save and add images to the ZIP archive for non-empty columns
//                 if (!empty($base64Data1)) {
//                     $filename1 = 'rv_image1_' . $id . '.jpeg';
//                     $imagePath1 = $tempDir . '/' . $filename1;
//                     if (file_put_contents($imagePath1, base64_decode($base64Data1)) === false) {
//                         throw new Exception('Error saving image 1');
//                     }
                    
//                     // Load the image using GD library
//                     $image1 = imagecreatefromjpeg($imagePath1);
                    
//                     // Get the current dimensions of the image
//                     $width1 = imagesx($image1);
//                     $height1 = imagesy($image1);
                    
//                     // Calculate the new dimensions
//                     $newWidth1 = $width1 * 2.5;
//                     $newHeight1 = $height1 * 2.5;
                    
//                     // Create a new image with the updated dimensions
//                     $resizedImage1 = imagecreatetruecolor($newWidth1, $newHeight1);
                    
//                     // Resize the image
//                     imagecopyresized($resizedImage1, $image1, 0, 0, 0, 0, $newWidth1, $newHeight1, $width1, $height1);
                    
//                     // Save the resized image to a new file
//                     $resizedImagePath1 = $tempDir . '/resized_' . $filename1;
//                     if (imagejpeg($resizedImage1, $resizedImagePath1) === false) {
//                         throw new Exception('Error resizing image 1');
//                     }
                    
//                     // Add the resized image to the ZIP archive
//                     $zip->addFile($resizedImagePath1, $filename1);
                    
//                     // Clean up
//                     imagedestroy($image1);
//                     imagedestroy($resizedImage1);
                    
//                     // Delete temporary files
//                     unlink($imagePath1);
//                     unlink($resizedImagePath1);
//                 }
                
//                  if (!empty($base64Data2)) {
//                     $filename2 = 'rv_image2_' . $id . '.jpeg';
//                     $imagePath2 = $tempDir . '/' . $filename2;
//                     if (file_put_contents($imagePath2, base64_decode($base64Data2)) === false) {
//                         throw new Exception('Error saving image 2');
//                     }
//                     if ($zip->addFile($imagePath2, $filename2) === false) {
//                         throw new Exception('Error adding image 2 to ZIP archive');
//                     }
//                 }
                
               
                
//                  if (!empty($base64Data3)) {
//                     $filename3 = 'rv_image3_' . $id . '.jpeg';
//                     $imagePath3 = $tempDir . '/' . $filename3;
//                     if (file_put_contents($imagePath3, base64_decode($base64Data3)) === false) {
//                         throw new Exception('Error saving image 3');
//                     }
//                     if ($zip->addFile($imagePath3, $filename3) === false) {
//                         throw new Exception('Error adding image 3 to ZIP archive');
//                     }
//                 }
                
//                  if (!empty($base64Data4)) {
//                     $filename4 = 'rv_image4_' . $id . '.jpeg';
//                     $imagePath4 = $tempDir . '/' . $filename4;
//                     if (file_put_contents($imagePath4, base64_decode($base64Data4)) === false) {
//                         throw new Exception('Error saving image 4');
//                     }
//                     if ($zip->addFile($imagePath4, $filename4) === false) {
//                         throw new Exception('Error adding image 4 to ZIP archive');
//                     }
//                 }
                
                
                
//                  if (!empty($base64Data5)) {
//                     $filename5 = 'rv_image5_' . $id . '.jpeg';
//                     $imagePath5 = $tempDir . '/' . $filename5;
//                     if (file_put_contents($imagePath5, base64_decode($base64Data5)) === false) {
//                         throw new Exception('Error saving image 5');
//                     }
//                     if ($zip->addFile($imagePath5, $filename5) === false) {
//                         throw new Exception('Error adding image 5 to ZIP archive');
//                     }
//                 }
                
//                  if (!empty($base64Data6)) {
//                     $filename6 = 'rv_image6_' . $id . '.jpeg';
//                     $imagePath6 = $tempDir . '/' . $filename6;
//                     if (file_put_contents($imagePath6, base64_decode($base64Data6)) === false) {
//                         throw new Exception('Error saving image 6');
//                     }
//                     if ($zip->addFile($imagePath6, $filename6) === false) {
//                         throw new Exception('Error adding image 6 to ZIP archive');
//                     }
//                 }
                
//                  if (!empty($base64Data7)) {
//                     $filename7 = 'rv_image7_' . $id . '.jpeg';
//                     $imagePath7 = $tempDir . '/' . $filename7;
//                     if (file_put_contents($imagePath7, base64_decode($base64Data7)) === false) {
//                         throw new Exception('Error saving image 7');
//                     }
//                     if ($zip->addFile($imagePath7, $filename7) === false) {
//                         throw new Exception('Error adding image 7 to ZIP archive');
//                     }
//                 }
                
//                  if (!empty($base64Data8)) {
//                     $filename8 = 'rv_image8_' . $id . '.jpeg';
//                     $imagePath8 = $tempDir . '/' . $filename8;
//                     if (file_put_contents($imagePath8, base64_decode($base64Data8)) === false) {
//                         throw new Exception('Error saving image 8');
//                     }
//                     if ($zip->addFile($imagePath8, $filename8) === false) {
//                         throw new Exception('Error adding image 8 to ZIP archive');
//                     }
//                 }
                

//                 // Handle image9
//                 if (!empty($base64Data9)) {
//                     $filename9 = 'rv_image9_' . $id . '.jpeg';
//                     $imagePath9 = $tempDir . '/' . $filename9;
//                     if (file_put_contents($imagePath9, base64_decode($base64Data9)) === false) {
//                         throw new Exception('Error saving image 9');
//                     }
                    
//                     // Load the image using GD library
//                     $image9 = imagecreatefromjpeg($imagePath9);
                    
//                     // Get the current dimensions of the image
//                     $width9 = imagesx($image9);
//                     $height9 = imagesy($image9);
                    
//                     // Calculate the new dimensions
//                     $newWidth9 = $width9 * 2.5;
//                     $newHeight9 = $height9 * 2.5;
                    
//                     // Create a new image with the updated dimensions
//                     $resizedImage9 = imagecreatetruecolor($newWidth9, $newHeight9);
                    
//                     // Resize the image
//                     imagecopyresized($resizedImage9, $image9, 0, 0, 0, 0, $newWidth9, $newHeight9, $width9, $height9);
                    
//                     // Save the resized image to a new file
//                     $resizedImagePath9 = $tempDir . '/resized_' . $filename9;
//                     if (imagejpeg($resizedImage9, $resizedImagePath9) === false) {
//                         throw new Exception('Error resizing image 9');
//                     }
                    
//                     // Add the resized image to the ZIP archive
//                     $zip->addFile($resizedImagePath9, $filename9);
                    
//                     // Clean up
//                     imagedestroy($image9);
//                     imagedestroy($resizedImage9);
                    
//                     // Delete temporary files
//                     unlink($imagePath9);
//                     unlink($resizedImagePath9);
//                 }
//             }
            
//             // Close the ZIP archive
//           $zip->close();
            
//             // Download the ZIP file
//             header('Content-Type: application/zip');
//             header('Content-disposition: attachment; filename=' . basename($zipFile));
//             header('Content-Length: ' . filesize($zipFile));
//             readfile($zipFile);
            
//             // Clean up - delete the ZIP file and the temporary images directory
//             unlink($zipFile);
//             $this->deleteDirectory($tempDir);
//         } else {
//             throw new Exception('Failed to create ZIP archive.');
//         }
//     } catch (Exception $e) {
//         echo 'Error: ' . $e->getMessage();
//     }
// }

private function deleteDirectory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!$this->deleteDirectory($dir . '/' . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}

    public function createZipArchive($files, $zipFilename)
    {
        // Create a new ZipArchive instance
        $zip = new ZipArchive();

        // Open the ZIP file for writing
        if ($zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Add each file to the ZIP archive
            foreach ($files as $file) {
                // Specify the path of the file to add to the ZIP archive
                $filePath = $file['path'];

                // Specify the name under which the file will be stored in the ZIP archive
                $zipFilename = $file['zipFilename'];

                // Add the file to the ZIP archive
                $zip->addFile($filePath, $zipFilename);
            }

            // Close the ZIP archive
            $zip->close();

            // Return the ZIP filename
            return $zipFilename;
        } else {
            // Failed to create the ZIP archive
            return false;
        }
    }



    public function filterDatewise()
    {

        $from = $_POST['from'];
        $to = $_POST['to'];
        $code = $_POST['code'];
        //echo $code;die();
        $tbdy = '';
        $fetch_data = $this->Assign_case_model->filter_Createdate($from, $to, $code);
        $numrows = $fetch_data->num_rows();
        //echo $numrows;die("iii");
        if ($numrows > 0) {
?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>
                <tr>
                    <td><input type="checkbox" id="assign" value='<?= $rows->uid; ?>' name="assign"></td>
                    
                    
                    <td><?= $rows->application_id; ?></td>
                            <td><?= $rows->bank_name; ?></td>
                            <td><?= $rows->product_name; ?></td>
                             <td><?= $rows->fi_to_be_conducted; ?></td>
                              <td><?= $rows->customer_name; ?></td>
                               <td><?= $rows->business_address; ?></td>
                                <td><?= $rows->first_name; ?></td>

                                  <td><?= formatdate($rows->tat_start,'d-m-Y h:i A'); ?></td>
                            <td><?= formatdate($rows->tat_end,'d-m-Y h:i A'); ?></td>
                              <td><?= $rows->rv_visit_date; ?></td>
                               <td><?= $rows->status; ?></td>
                   <td>

                                <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                                <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                                <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                                
                                 <?php if ($sessionData['user_status'] !== 'banned'): ?>
                                                 <button type="button" name="delete" id="<?= $rows->uid; ?>" title="delete case" class="btn btn-danger btn-sm delete_case"><i class="fa fa-trash"></i></button>
                                              <?php endif; ?>
                                
                                 
                                 <button type="button" name="download" id="<?= $rows->uid; ?>" title="Download Images" class="btn btn-success btn-sm download_image"><i class="fa fa-download"></i></button>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/assign_case_controller/upload_images/'.$rows->uid);?>" title="Upload Images"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                
                                 <?php
                                if (empty($rows->add_final_status)) { ?>
                                <button type="button" name="final_status" id="<?= $rows->uid; ?>" title="Add Final Status" class="btn btn-warning btn-sm add_final_status"><i class="fa fa-user"></i></button>
                                <?php } 
                                ?>
                                
                               
                                <?php
                                if ($rows->fi_to_be_conducted == 'BV') { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                                    <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>
                                    
                                   <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openBVDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                   
                                   
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-warning btn-sm send-email-bv"><i class="fa fa-envelope"></i></button>
                                    
                                    
                                    
                                <?php } else { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                                    <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                                    
                                   <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                     
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-success btn-sm send-email"><i class="fa fa-envelope"></i></button>
                                <?php  } ?>
                                
                                  



                            </td>
                </tr>
            <?php endforeach; ?>
            <tr></tr>
        <?php } else { ?>

            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
            <tr></tr>

        <?php }
    }


    public function filterfitype()
    {
        $val = $_POST['val'];
        $code = $_POST['code'];

        $tbdy = '';
        $fetch_data = $this->Assign_case_model->filter_fitype($val, $code);
        $numrows = $fetch_data->num_rows();
        if ($numrows > 0) {
        ?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>
                <tr>
                    <td><input type="checkbox" id="assign" value='<?= $rows->uid; ?>' name="assign"></td>
                     <td><?= $rows->application_id; ?></td>
                            <td><?= $rows->bank_name; ?></td>
                            <td><?= $rows->product_name; ?></td>
                             <td><?= $rows->fi_to_be_conducted; ?></td>
                              <td><?= $rows->customer_name; ?></td>
                               <td><?= $rows->business_address; ?></td>
                               <td><?= $rows->first_name; ?></td>
                                  <td><?= formatdate($rows->tat_start,'d-m-Y h:i A'); ?></td>
                            <td><?= formatdate($rows->tat_end,'d-m-Y h:i A'); ?></td>
                              <td><?= $rows->rv_visit_date; ?></td>
                               <td><?= $rows->status; ?></td>
                      <td>

                                <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                                <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                                <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                                
                                 <?php if ($sessionData['user_status'] !== 'banned'): ?>
                                                 <button type="button" name="delete" id="<?= $rows->uid; ?>" title="delete case" class="btn btn-danger btn-sm delete_case"><i class="fa fa-trash"></i></button>
                                              <?php endif; ?>
                                
                                 <button type="button" name="download" id="<?= $rows->uid; ?>" title="Download Images" class="btn btn-success btn-sm download_image"><i class="fa fa-download"></i></button>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/assign_case_controller/upload_images/'.$rows->uid);?>" title="Upload Images"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                
                                 <?php
                                if (empty($rows->add_final_status)) { ?>
                                <button type="button" name="final_status" id="<?= $rows->uid; ?>" title="Add Final Status" class="btn btn-warning btn-sm add_final_status"><i class="fa fa-user"></i></button>
                                <?php } 
                                ?>
                                
                               
                                <?php
                                if ($rows->fi_to_be_conducted == 'BV') { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                                    <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>
                                    
                                    <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openBVDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                    
                                      <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-warning btn-sm send-email-bv"><i class="fa fa-envelope"></i></button>
                                   
                                    
                                    
                                <?php } else { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                                    <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                                    
                                     <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                     
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-success btn-sm send-email"><i class="fa fa-envelope"></i></button>
                                <?php  } ?>
                                
                                  



                            </td>
                </tr>
            <?php endforeach; ?>
            <tr></tr>
        <?php } else { ?>
            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
            <tr></tr>
        <?php }
    }


    public function filterStatus()
    {
        $val = $_POST['val'];
        $code = $_POST['code'];

        $tbdy = '';
        $fetch_data = $this->Assign_case_model->filter_status($val, $code);
        $numrows = $fetch_data->num_rows();
        if ($numrows > 0) {
        ?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>
                <tr>
                    
                      <td><input type="checkbox" id="assign" value='<?= $rows->uid; ?>' name="assign"></td>
                     <td><?= $rows->application_id; ?></td>
                            <td><?= $rows->bank_name; ?></td>
                            <td><?= $rows->product_name; ?></td>
                             <td><?= $rows->fi_to_be_conducted; ?></td>
                              <td><?= $rows->customer_name; ?></td>
                               <td><?= $rows->business_address; ?></td>
                                  <td><?= $rows->first_name; ?></td>
                                  <td><?= formatdate($rows->tat_start,'d-m-Y h:i A'); ?></td>
                            <td><?= formatdate($rows->tat_end,'d-m-Y h:i A'); ?></td>
                              <td><?= $rows->rv_visit_date; ?></td>
                               <td><?= $rows->status; ?></td>
                      <td>
                    

                                <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                                <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                                <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                                <?php if ($sessionData['user_status'] !== 'banned'): ?>
                                                 <button type="button" name="delete" id="<?= $rows->uid; ?>" title="delete case" class="btn btn-danger btn-sm delete_case"><i class="fa fa-trash"></i></button>
                                              <?php endif; ?>
                                
                                 
                                 <button type="button" name="download" id="<?= $rows->uid; ?>" title="Download Images" class="btn btn-success btn-sm download_image"><i class="fa fa-download"></i></button>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/assign_case_controller/upload_images/'.$rows->uid);?>" title="Upload Images"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                
                                 <?php
                                if (empty($rows->add_final_status)) { ?>
                                <button type="button" name="final_status" id="<?= $rows->uid; ?>" title="Add Final Status" class="btn btn-warning btn-sm add_final_status"><i class="fa fa-user"></i></button>
                                <?php } 
                                ?>
                                
                               
                                <?php
                                if ($rows->fi_to_be_conducted == 'BV') { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                                    <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>
                                    
                                    <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openBVDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                    
                                      <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-warning btn-sm send-email-bv"><i class="fa fa-envelope"></i></button>
                                   
                                    
                                <?php } else { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                                    <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                                    
                                     <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                     
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-success btn-sm send-email"><i class="fa fa-envelope"></i></button>
                                <?php  } ?>
                                
                                  



                            </td>
                </tr>
            <?php endforeach; ?>
            <tr></tr>
        <?php } else { ?>
            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
            <tr></tr>
<?php }
    }


    function fetch_all_assign_data()
    {
        try {
            $this->load->model("Assign_case_model");
            $fetch_case = $this->Assign_case_model->make_datatables_assign();
            $data = array();

            foreach ($fetch_case as $row) {
                $sub_array = array();
                $buttons = '';
                $buttons .= '';
                $sub_array[] = $row->id;
                $sub_array[] = $row->application_id;
                $sub_array[] = $row->customer_name;
                $sub_array[] = $row->business_address;
                $sub_array[] = $row->fi_to_be_conducted;
                $sub_array[] = $row->tat_start;
                $sub_array[] = $row->tat_end;
                $sub_array[] = $row->status;
                $sub_array[] = $buttons;
                $data[] = $sub_array;
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->Assign_case_model->get_all_data_assign(),
                "recordsFiltered" => $this->Assign_case_model->get_filtered_data_assign(),
                "data" => $data
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }

    function fetch_single_assignee()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
            foreach ($data as $row) {

                $output['application_id'] = $row->application_id;
                $output['customer_name'] = $row->customer_name;
                $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
                $output['pincode'] = $row->pincode;
                $output['permanent_address'] = $row->permanent_address;
                $output['designation'] = $row->designation;
                $output['product_name'] = $row->product_name;
                $output['residence_address'] = $row->residence_address;
                $output['office_address'] = $row->office_address;
                $output['permanent_address'] = $row->permanent_address;
                $output['dob'] = $row->dob;
                $output['fi_date'] = $row->fi_date;
                $output['source_channel'] = $row->source_channel;
                $output['customer_name'] = $row->customer_name;
                $output['business_address'] = $row->business_address;
                $output['fi_time'] = $row->fi_time;
                $output['fi_flag'] = $row->fi_flag;
                $output['designation'] = $row->designation;
                $output['loan_amount'] = $row->loan_amount;
                $output['station'] = $row->station;
                $output['tat_start'] = formatdate($row->tat_start,'d-m-Y h:i A');
                $output['tat_end'] = formatdate($row->tat_end,'d-m-Y h:i A');
                $output['business_name'] = $row->business_name;
                $output['assigned_to'] = $row->assigned_to;
                $output['remarks'] = $row->remarks;

                $output['bank_name'] = $row->bank_name;
                $output['city'] = $row->city;
                $output['status'] = $row->status;
                $output['code'] = $row->code;
                $output['amount'] = $row->amount;
                $output['vehicle'] = $row->vehicle;
                $output['co_applicant'] = $row->co_applicant;
                $output['guarantee_name'] = $row->guarantee_name;
                $output['single_agent'] = $row->single_agent;
                $output['geo_limit'] = $row->geo_limit;
                $output['created_by'] = $row->created_by;

                $output['created_at'] = formatdate($row->created_at,'d-m-Y h:i A');
                $output['updated_at'] = formatdate($row->updated_at,'d-m-Y h:i A');
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }

    // function fetch_single_rv_data()
    // {
    //     try {
    //         $output = array();
    //         $this->load->model("Assign_case_model");
    //         $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
    //         foreach ($data as $row) {
    //             $output['application_id'] = $row->application_id;
    //             $output['customer_name'] = $row->customer_name;
    //             $output['created_at'] = $row->created_at;
    //             $output['fi_date'] = $row->fi_date;
    //             $output['tat_start'] = formatdate($row->tat_start,'d-m-Y h:i A');
    //             $output['city'] = $row->city;
    //             $output['pincode'] = $row->pincode;
    //             $output['business_address'] = $row->business_address;
    //             $output['tat_end'] = $row->tat_end;
    //             $output['amount'] = $row->amount;
    //             $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
    //             $output['fi_time'] = $row->fi_time;
    //             $output['bank_name'] = $row->bank_name;
    //             $output['code'] = $row->code;
    //             $output['product_name'] = $row->product_name;
    //             $output['dob'] = $row->dob;
    //             $output['fi_flag'] = $row->fi_flag;

    //             $output['geo_limit'] = $row->geo_limit;

    //             $output['rv_lat'] = $row->rv_lat;
    //             $output['rv_long'] = $row->rv_long;
    //             $output['rv_pincode'] = $row->rv_pincode;
    //             $output['rv_location_add'] = $row->rv_location_add;

    //             $output['rv_fi_status'] = $row->rv_fi_status;
    //             $output['rv_make_model'] = $row->rv_make_model;
    //             $output['rv_loan_amt'] = $row->rv_loan_amt;
    //             $output['rv_loan_existing'] = $row->rv_loan_existing;
    //             $output['rv_loan_emi'] = $row->rv_loan_emi;
    //             $output['rv_loan_bankname'] = $row->rv_loan_bankname;

    //             $output['rv_confirm_address'] = $row->rv_confirm_address;
    //             $output['rv_person_met_details'] = $row->rv_person_met_details;
    //             $output['rv_relationship'] = $row->rv_relationship;
    //             $output['rv_residence_ownership'] = $row->rv_residence_ownership;
    //             $output['rv_stability'] = $row->rv_stability;
    //             $output['rv_user_permanent_address'] = $row->rv_user_permanent_address;
    //             $output['rv_rent_per_month'] = $row->rv_rent_per_month;
    //             $output['rv_details_of_earning_member'] = $row->rv_details_of_earning_member;
    //             $output['rv_dependent'] = $row->rv_dependent;
    //             $output['rv_total_family_member'] = $row->rv_total_family_member;
    //             $output['rv_no_of_earning_members'] = $row->rv_no_of_earning_members;
    //             $output['rv_user_office_address'] = $row->rv_user_office_address;
    //             $output['rv_residence_proof'] = $row->rv_residence_proof;
    //             $output['rv_interior_premises'] = $row->rv_interior_premises;
    //             $output['rv_exterior_premises'] = $row->rv_exterior_premises;
    //             $output['rv_agriculture_land'] = $row->rv_agriculture_land;

    //             $output['neighbour_name1'] = $row->neighbour_name1;
    //             $output['neighbour_name2'] = $row->neighbour_name2;
    //             $output['neighbour_house_no_1'] = $row->neighbour_house_no_1;
    //             $output['neighbour_house_no_2'] = $row->neighbour_house_no_2;
    //             $output['neighbour_contact1'] = $row->neighbour_contact1;
    //             $output['neighbour_contact2'] = $row->neighbour_contact2;
    //             $output['neighbour_feedback1'] = $row->neighbour_feedback1;
    //             $output['neighbour_feedback2'] = $row->neighbour_feedback2;
    //             $output['neighbour1_neg_feedback'] = $row->neighbour1_neg_feedback;
    //             $output['neighbour2_neg_feedback'] = $row->neighbour2_neg_feedback;

    //             $output['how_much_land'] = $row->how_much_land;
    //             $output['rv_vehicle_type'] = $row->rv_vehicle_type;
    //             $output['res_proof_number'] = $row->res_proof_number;
    //             $output['consolidated_remark'] = $row->consolidated_remark;
    //             $output['neighbour2_neg_feedback'] = $row->neighbour2_neg_feedback;


    //             $output['rv_cpv_done_by'] = $row->rv_cpv_done_by;
    //             $output['rv_visit_date'] = $row->rv_visit_date;
    //             $output['rv_remarks'] = $row->rv_remarks;
    //             $output['rv_address_yes_no'] = $row->rv_address_yes_no;
    //             $output['rv_vehicle_details	'] = $row->rv_vehicle_details;
    //             $temp_rv_image1 = $row->rv_image1;
    //             $temp_rv_image2 = $row->rv_image2;
    //             $temp_rv_image3 = $row->rv_image3;
    //             $temp_rv_image4 = $row->rv_image4;
    //             $temp_rv_image5 = $row->rv_image5;
    //             $temp_rv_image6 = $row->rv_image6;
    //             $temp_rv_image7 = $row->rv_image7;
    //             $temp_rv_image8 = $row->rv_image8;
    //             $temp_rv_image9 = $row->rv_image9;


    //             if (!empty($row->rv_image1)) {
    //                 $replace_space_rv = str_replace(' ', '+', $temp_rv_image1);
    //                 $output['rv_image1'] = '<img class="rv_image1" src="' . $replace_space_rv . '" height="250" width="250">';
    //             } else {
    //                 $output['rv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->rv_image2)) {
    //                 $replace_space2_rv = str_replace(' ', '+', $temp_rv_image2);
    //                 $output['rv_image2'] = '<img class="rv_image2" src="' . $replace_space2_rv . '" height="250" width="250">';
    //             } else {
    //                 $output['rv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->rv_image3)) {
    //                 $replace_space3_rv = str_replace(' ', '+', $temp_rv_image3);
    //                 $output['rv_image3'] = '<img class="rv_image3" src="' . $replace_space3_rv . '" height="250" width="250">';
    //             } else {
    //                 $output['rv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->rv_image4)) {
    //                 $replace_space4_rv = str_replace(' ', '+', $temp_rv_image4);
    //                 $output['rv_image4'] = '<img class="rv_image4" src="' . $replace_space4_rv . '" height="250" width="250">';
    //             } else {
    //                 $output['rv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }
                
    //             if (!empty($row->rv_image5)) {
    //                 $replace_space5_rv = str_replace(' ', '+', $temp_rv_image5);
    //                 $output['rv_image5'] = '<img class="rv_image5" src="' . $replace_space5_rv . '" height="250" width="250">';
    //             } else {
    //                 $output['rv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->rv_image6)) {
    //                 $replace_space6_rv = str_replace(' ', '+', $temp_rv_image6);
    //                 $output['rv_image6'] = '<img class="rv_image6" src="' . $replace_space6_rv . '" height="250" width="250">';
    //             } else {
    //                 $output['rv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }
                
    //             if (!empty($row->rv_image7)) {
    //                 $replace_space7_rv = str_replace(' ', '+', $temp_rv_image7);
    //                 $output['rv_image7'] = '<img class="rv_image7" src="' . $replace_space7_rv . '" height="250" width="250">';
    //             } else {
    //                 $output['rv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->rv_image8)) {
    //                 $replace_space8_rv = str_replace(' ', '+', $temp_rv_image8);
    //                 $output['rv_image8'] = '<img class="rv_image8" src="' . $replace_space8_rv . '" height="250" width="250">';
    //             } else {
    //                 $output['rv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->rv_image9)) {
    //                 $replace_space9_rv = str_replace(' ', '+', $temp_rv_image9);
    //                 $output['rv_image9'] = '<img class="rv_image9" src="' . $replace_space9_rv . '" height="250" width="250">';
    //             } else {
    //                 $output['rv_image9'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }
                

    //         }
    //         echo json_encode($output);
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login', array('error' => $error));
    //     }
    // }


    function fetch_single_rv_data()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
            foreach ($data as $row) {
                $output['application_id'] = $row->application_id;
                $output['customer_name'] = $row->customer_name;
                $output['created_at'] = $row->created_at;
                $output['fi_date'] = $row->fi_date;
                $output['tat_start'] = $row->tat_start;
                $output['city'] = $row->city;
                $output['pincode'] = $row->pincode;
                $output['business_address'] = $row->business_address;
                $output['tat_end'] = $row->tat_end;
                $output['amount'] = $row->amount;
                $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
                $output['fi_time'] = $row->fi_time;
                $output['bank_name'] = $row->bank_name;
                $output['code'] = $row->code;
                $output['product_name'] = $row->product_name;
                $output['dob'] = $row->dob;
                $output['fi_flag'] = $row->fi_flag;

                $output['geo_limit'] = $row->geo_limit;

                $output['rv_lat'] = $row->rv_lat;
                $output['rv_long'] = $row->rv_long;
                $output['rv_pincode'] = $row->rv_pincode;
                $output['rv_location_add'] = $row->rv_location_add;

                $output['rv_fi_status'] = $row->rv_fi_status;
                $output['rv_make_model'] = $row->rv_make_model;
                $output['rv_loan_amt'] = $row->rv_loan_amt;
                $output['rv_loan_existing'] = $row->rv_loan_existing;
                $output['rv_loan_emi'] = $row->rv_loan_emi;
                $output['rv_loan_bankname'] = $row->rv_loan_bankname;

                $output['rv_confirm_address'] = $row->rv_confirm_address;
                $output['rv_person_met_details'] = $row->rv_person_met_details;
                $output['rv_relationship'] = $row->rv_relationship;
                $output['rv_residence_ownership'] = $row->rv_residence_ownership;
                $output['rv_stability'] = $row->rv_stability;
                $output['rv_user_permanent_address'] = $row->rv_user_permanent_address;
                $output['rv_rent_per_month'] = $row->rv_rent_per_month;
                $output['rv_details_of_earning_member'] = $row->rv_details_of_earning_member;
                $output['rv_dependent'] = $row->rv_dependent;
                $output['rv_total_family_member'] = $row->rv_total_family_member;
                $output['rv_no_of_earning_members'] = $row->rv_no_of_earning_members;
                $output['rv_user_office_address'] = $row->rv_user_office_address;
                $output['rv_residence_proof'] = $row->rv_residence_proof;
                $output['rv_interior_premises'] = $row->rv_interior_premises;
                $output['rv_exterior_premises'] = $row->rv_exterior_premises;
                $output['rv_agriculture_land'] = $row->rv_agriculture_land;

                $output['neighbour_name1'] = $row->neighbour_name1;
                $output['neighbour_name2'] = $row->neighbour_name2;
                $output['neighbour_house_no_1'] = $row->neighbour_house_no_1;
                $output['neighbour_house_no_2'] = $row->neighbour_house_no_2;
                $output['neighbour_contact1'] = $row->neighbour_contact1;
                $output['neighbour_contact2'] = $row->neighbour_contact2;
                $output['neighbour_feedback1'] = $row->neighbour_feedback1;
                $output['neighbour_feedback2'] = $row->neighbour_feedback2;
                $output['neighbour1_neg_feedback'] = $row->neighbour1_neg_feedback;
                $output['neighbour2_neg_feedback'] = $row->neighbour2_neg_feedback;
                $output['rv_vehicle_details'] = $row->rv_vehicle_details; 
                $output['how_much_land'] = $row->how_much_land;
                $output['rv_fi_status_reason'] = $row->rv_fi_status_reason;
                $output['rv_vehicle_type'] = $row->rv_vehicle_type;
                $output['res_proof_number'] = $row->res_proof_number;
                $output['consolidated_remark'] = $row->consolidated_remark;
                $output['neighbour2_neg_feedback'] = $row->neighbour2_neg_feedback;


                $output['rv_cpv_done_by'] = $row->rv_cpv_done_by;
                $output['rv_visit_date'] = $row->rv_visit_date;
                $output['rv_remarks'] = $row->rv_remarks;
                $output['rv_address_yes_no'] = $row->rv_address_yes_no;
              
                $temp_rv_image1 = $row->rv_image1;
                $temp_rv_image2 = $row->rv_image2;
                $temp_rv_image3 = $row->rv_image3;
                $temp_rv_image4 = $row->rv_image4;
                $temp_rv_image5 = $row->rv_image5;
                $temp_rv_image6 = $row->rv_image6;
                $temp_rv_image7 = $row->rv_image7;
                $temp_rv_image8 = $row->rv_image8;
                $temp_rv_image9 = $row->rv_image9;


                if (!empty($row->rv_image1)) {
                    $replace_space_rv = str_replace(' ', '+', $temp_rv_image1);
                    $output['rv_image1'] = '<img class="rv_image1" src="' . $replace_space_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image2)) {
                    $replace_space2_rv = str_replace(' ', '+', $temp_rv_image2);
                    $output['rv_image2'] = '<img class="rv_image2" src="' . $replace_space2_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                

                if (!empty($row->rv_image3)) {
                    $replace_space3_rv = str_replace(' ', '+', $temp_rv_image3);
                    $output['rv_image3'] = '<img class="rv_image3" src="' . $replace_space3_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image4)) {
                    $replace_space4_rv = str_replace(' ', '+', $temp_rv_image4);
                    $output['rv_image4'] = '<img class="rv_image4" src="' . $replace_space4_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                
                if (!empty($row->rv_image5)) {
                    $replace_space5_rv = str_replace(' ', '+', $temp_rv_image5);
                    $output['rv_image5'] = '<img class="rv_image5" src="' . $replace_space5_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image6)) {
                    $replace_space6_rv = str_replace(' ', '+', $temp_rv_image6);
                    $output['rv_image6'] = '<img class="rv_image6" src="' . $replace_space6_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                
                if (!empty($row->rv_image7)) {
                    $replace_space7_rv = str_replace(' ', '+', $temp_rv_image7);
                    $output['rv_image7'] = '<img class="rv_image7" src="' . $replace_space7_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image8)) {
                    $replace_space8_rv = str_replace(' ', '+', $temp_rv_image8);
                    $output['rv_image8'] = '<img class="rv_image8" src="' . $replace_space8_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image9)) {
                    $replace_space9_rv = str_replace(' ', '+', $temp_rv_image9);
                    $output['rv_image9'] = '<img class="rv_image9" src="' . $replace_space9_rv . '" height="250" width="250">';
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


 
    public function agentFilter()
    {
        $val = $_POST['val'];
        $code = $_POST['code'];
        // $status = $_POST['status'];
        $tbdy = '';
        $fetch_data = $this->Assign_case_model->agent_filter($val, $code);
        $numrows = $fetch_data->num_rows();
        if ($numrows > 0) {
        ?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>
                <tr>
                    <td><input type="checkbox" id="assign" value='<?= $rows->uid; ?>' name="assign"></td>
                    <td><?= $rows->application_id; ?></td>
                            <td><?= $rows->bank_name; ?></td>
                            <td><?= $rows->product_name; ?></td>
                             <td><?= $rows->fi_to_be_conducted; ?></td>
                              <td><?= $rows->customer_name; ?></td>
                               <td><?= $rows->business_address; ?></td>
                              <td><?= $rows->first_name; ?></td>
                                  <td><?= formatdate($rows->tat_start,'d-m-Y h:i A'); ?></td>
                            <td><?= formatdate($rows->tat_end,'d-m-Y h:i A'); ?></td>
                              <td><?= $rows->rv_visit_date; ?></td>
                               <td><?= $rows->status; ?></td>
                     <td>

                                <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                                <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                                <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                                
                                 <?php if ($sessionData['user_status'] !== 'banned'): ?>
                                                 <button type="button" name="delete" id="<?= $rows->uid; ?>" title="delete case" class="btn btn-danger btn-sm delete_case"><i class="fa fa-trash"></i></button>
                                              <?php endif; ?>
                                
                                 <button type="button" name="download" id="<?= $rows->uid; ?>" title="Download Images" class="btn btn-success btn-sm download_image"><i class="fa fa-download"></i></button>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/assign_case_controller/upload_images/'.$rows->uid);?>" title="Upload Images"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                
                                 <?php
                                if (empty($rows->add_final_status)) { ?>
                                <button type="button" name="final_status" id="<?= $rows->uid; ?>" title="Add Final Status" class="btn btn-warning btn-sm add_final_status"><i class="fa fa-user"></i></button>
                                <?php } 
                                ?>
                                
                               
                                <?php
                                if ($rows->fi_to_be_conducted == 'BV') { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                                    <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>
                                    
                                    <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openBVDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                    
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-warning btn-sm send-email-bv"><i class="fa fa-envelope"></i></button>
                                    
                                <?php } else { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                                    <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                                    
                                     <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                     
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-success btn-sm send-email"><i class="fa fa-envelope"></i></button>
                                <?php  } ?>
                                
                                  



                            </td>
                </tr>
            <?php endforeach; ?>
            <tr></tr>
        <?php } else { ?>
            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
            <tr></tr>
<?php }
    }

    
    
      public function AppData()
    {
        $appno = $_POST['appno'];
        $code = $_POST['code'];

        $tbdy = '';
        $fetch_data = $this->Assign_case_model->app_data($appno, $code);
        $numrows = $fetch_data->num_rows();
        if ($numrows > 0) {
        ?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>
                <tr>
                    
                    <td><input type="checkbox" id="assign" value='<?= $rows->uid; ?>' name="assign"></td>
                     <td><?= $rows->application_id; ?></td>
                            <td><?= $rows->bank_name; ?></td>
                            <td><?= $rows->product_name; ?></td>
                             <td><?= $rows->fi_to_be_conducted; ?></td>
                              <td><?= $rows->customer_name; ?></td>
                               <td><?= $rows->business_address; ?></td>
                               <td><?= $rows->first_name; ?></td>
                                  <td><?= formatdate($rows->tat_start,'d-m-Y h:i A'); ?></td>
                            <td><?= formatdate($rows->tat_end,'d-m-Y h:i A'); ?></td>
                              <td><?= $rows->rv_visit_date; ?></td>
                               <td><?= $rows->status; ?></td>
                    <td>

                                <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                                <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                                <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                                <?php if ($sessionData['user_status'] !== 'banned'): ?>
                                                 <button type="button" name="delete" id="<?= $rows->uid; ?>" title="delete case" class="btn btn-danger btn-sm delete_case"><i class="fa fa-trash"></i></button>
                                              <?php endif; ?>
                                
                                 
                                 <button type="button" name="download" id="<?= $rows->uid; ?>" title="Download Images" class="btn btn-success btn-sm download_image"><i class="fa fa-download"></i></button>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/assign_case_controller/upload_images/'.$rows->uid);?>" title="Upload Images"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                
                                 <?php
                                if (empty($rows->add_final_status)) { ?>
                                <button type="button" name="final_status" id="<?= $rows->uid; ?>" title="Add Final Status" class="btn btn-warning btn-sm add_final_status"><i class="fa fa-user"></i></button>
                                <?php } 
                                ?>
                                
                               
                                <?php
                                if ($rows->fi_to_be_conducted == 'BV') { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                                    <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>
                                    
                                    <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openBVDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                    
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-warning btn-sm send-email-bv"><i class="fa fa-envelope"></i></button>
                                    
                                    
                                <?php } else { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                                    <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                                    
                                     <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                     
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-success btn-sm send-email"><i class="fa fa-envelope"></i></button>
                                <?php  } ?>
                                
                                  



                            </td>
                </tr>
            <?php endforeach; ?>
            <tr></tr>
        <?php } else { ?>
            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
            <tr></tr>
<?php }
    }


   
      public function MobData()
    {
        $mobno = $_POST['mobno'];
        $code = $_POST['code'];

        $tbdy = '';
        $fetch_data = $this->Assign_case_model->mob_data($mobno, $code);
        $numrows = $fetch_data->num_rows();
        if ($numrows > 0) {
        ?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>
                <tr>
                    
                    <td><input type="checkbox" id="assign" value='<?= $rows->uid; ?>' name="assign"></td>
                     <td><?= $rows->application_id; ?></td>
                            <td><?= $rows->bank_name; ?></td>
                            <td><?= $rows->product_name; ?></td>
                             <td><?= $rows->fi_to_be_conducted; ?></td>
                              <td><?= $rows->customer_name; ?></td>
                               <td><?= $rows->business_address; ?></td>
                                 <td><?= $rows->first_name; ?></td>
                                  <td><?= formatdate($rows->tat_start,'d-m-Y h:i A'); ?></td>
                            <td><?= formatdate($rows->tat_end,'d-m-Y h:i A'); ?></td>
                              <td><?= $rows->rv_visit_date; ?></td>
                               <td><?= $rows->status; ?></td>
                      <td>

                                <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                                <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                                <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                                <?php if ($sessionData['user_status'] !== 'banned'): ?>
                                                 <button type="button" name="delete" id="<?= $rows->uid; ?>" title="delete case" class="btn btn-danger btn-sm delete_case"><i class="fa fa-trash"></i></button>
                                              <?php endif; ?>
                                
                                 
                                 <button type="button" name="download" id="<?= $rows->uid; ?>" title="Download Images" class="btn btn-success btn-sm download_image"><i class="fa fa-download"></i></button>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/assign_case_controller/upload_images/'.$rows->uid);?>" title="Upload Images"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                
                                 <?php
                                if (empty($rows->add_final_status)) { ?>
                                <button type="button" name="final_status" id="<?= $rows->uid; ?>" title="Add Final Status" class="btn btn-warning btn-sm add_final_status"><i class="fa fa-user"></i></button>
                                <?php } 
                                ?>
                                
                               
                                <?php
                                if ($rows->fi_to_be_conducted == 'BV') { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                                    <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>
                                    
                                    <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openBVDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                    
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-warning btn-sm send-email-bv"><i class="fa fa-envelope"></i></button>
                                    
                                    
                                <?php } else { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                                    <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                                    
                                     <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                     
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-success btn-sm send-email"><i class="fa fa-envelope"></i></button>
                                <?php  } ?>
                                
                                  



                            </td>
                </tr>
            <?php endforeach; ?>
            <tr></tr>
        <?php } else { ?>
            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
            <tr></tr>
<?php }
    }



    // function fetch_single_bv_data()
    // {
    //     try {
    //         $output = array();
    //         $this->load->model("Assign_case_model");
    //         $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
    //         foreach ($data as $row) {

    //             $output['application_id'] = $row->application_id;
    //             $output['customer_name'] = $row->customer_name;
    //             $output['bank_name'] = $row->bank_name;

    //             $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
    //             $output['tcp1_name'] = $row->tcp1_name;
    //             $output['tcp2_name'] = $row->tcp2_name;
    //             $output['code'] = $row->code;
    //             $output['city'] = $row->city;
    //             $output['pincode'] = $row->pincode;
    //             $output['amount'] = $row->amount;
    //             $output['business_address'] = $row->business_address;
    //             $output['tat_start'] = formatdate($row->tat_start,'d-m-Y h:i A');
    //             $output['tat_end'] = formatdate($row->tat_end,'d-m-Y h:i A');
    //             $output['business_name'] = $row->business_name;
    //             $output['created_at'] = formatdate($row->created_at,'d-m-Y h:i A');
    //             $output['dob'] = $row->dob;
    //             $output['fi_time'] = $row->fi_time;
    //             $output['fi_date'] = $row->fi_date;
    //             $output['bv_working_since'] = $row->bv_working_since;
    //             $output['bv_signboard_name'] = $row->bv_signboard_name;
    //             $output['bv_office_proof'] = $row->bv_office_proof;
    //             $output['bv_previous_bus_details'] = $row->bv_previous_bus_details;
    //             $output['bv_fi_status'] = $row->bv_fi_status;

    //             $output['bv_lat'] = $row->bv_lat;
    //             $output['bv_long'] = $row->bv_long;
    //             $output['bv_pincode'] = $row->bv_pincode;
    //             $output['bv_location_add'] = $row->bv_location_add;

    //             $output['asset_make'] = $row->asset_make;
    //             $output['asset_model'] = $row->asset_model;
    //             $output['amount'] = $row->amount;
    //             $output['bv_company_name'] = $row->bv_company_name;
    //             $output['bv_person_met'] = $row->bv_person_met;


    //             $output['product_name'] = $row->product_name;
    //             $output['bv_corporate_office'] = $row->bv_corporate_office;
    //             $output['bv_corporate_office'] = $row->bv_corporate_office;
    //             $output['bv_person_designation'] = $row->bv_person_designation;
    //             $output['bv_address_confirmed'] = $row->bv_address_confirmed;
    //             $output['bv_applicant_designation'] = $row->bv_applicant_designation;
    //             $output['bv_income'] = $row->bv_income;
    //             $output['bv_residence_address'] = $row->bv_residence_address;
    //             $output['bv_business_type'] = $row->bv_business_type;
    //             $output['bv_no_employee'] = $row->bv_no_employee;
    //             $output['bv_stocks'] = $row->bv_stocks;
    //             $output['bv_business_activity'] = $row->bv_business_activity;
    //             $output['bv_stability'] = $row->bv_stability;
    //             $output['bv_ownership'] = $row->bv_ownership;
    //             $output['bv_nature_of_business'] = $row->bv_nature_of_business;
    //             $output['bv_proof'] = $row->bv_proof;
    //             $output['bv_vehicle'] = $row->bv_vehicle;
    //             $output['bv_tcp1'] = $row->bv_tcp1;
    //             $output['bv_tcp2'] = $row->bv_tcp2;
    //             $output['bv_verified_name'] = $row->bv_verified_name;
    //             $output['bv_dt_of_cpv'] = $row->bv_dt_of_cpv;
    //             $output['bv_remarks'] = $row->bv_remarks;
    //             $output['status'] = $row->status;

    //             $temp_bv_image1 = $row->bv_image1;
    //             $temp_bv_image2 = $row->bv_image2;
    //             $temp_bv_image3 = $row->bv_image3;
    //             $temp_bv_image4 = $row->bv_image4;
    //             $temp_bv_image5 = $row->bv_image5;
    //             $temp_bv_image6 = $row->bv_image6;
    //             $temp_bv_image7 = $row->bv_image7;
    //             $temp_bv_image8 = $row->bv_image8;
    //             $temp_bv_image9 = $row->bv_image9;


               

    //             if (!empty($row->bv_image1)) {
    //                 $replace_space = str_replace(' ', '+', $temp_bv_image1);
    //                 $output['bv_image1'] = '<img class="bv_image1" src="' . $replace_space . '" height="250" width="250">';
    //             } else {
    //                 $output['bv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->bv_image2)) {
    //                 $replace_space2 = str_replace(' ', '+', $temp_bv_image2);
    //                 $output['bv_image2'] = '<img class="bv_image2" src="' . $replace_space2 . '" height="250" width="250">';
    //             } else {
    //                 $output['bv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }
    //             if (!empty($row->bv_image3)) {
    //                 $replace_space3 = str_replace(' ', '+', $temp_bv_image3);
    //                 $output['bv_image3'] = '<img class="bv_image3" src="' . $replace_space3 . '" height="250" width="250">';
    //             } else {
    //                 $output['bv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->bv_image4)) {
    //                 $replace_space4 = str_replace(' ', '+', $temp_bv_image4);
    //                 $output['bv_image4'] = '<img class="bv_image4" src="' . $replace_space4 . '" height="250" width="250">';
    //             } else {
    //                 $output['bv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->bv_image5)) {
    //                 $replace_space5 = str_replace(' ', '+', $temp_bv_image5);
    //                 $output['bv_image5'] = '<img class="bv_image5" src="' . $replace_space5 . '" height="250" width="250">';
    //             } else {
    //                 $output['bv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->bv_image6)) {
    //                 $replace_space6 = str_replace(' ', '+', $temp_bv_image6);
    //                 $output['bv_image6'] = '<img class="bv_image6" src="' . $replace_space6 . '" height="250" width="250">';
    //             } else {
    //                 $output['bv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->bv_image7)) {
    //                 $replace_space7 = str_replace(' ', '+', $temp_bv_image7);
    //                 $output['bv_image7'] = '<img class="bv_image7" src="' . $replace_space7 . '" height="250" width="250">';
    //             } else {
    //                 $output['bv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->bv_image8)) {
    //                 $replace_space8 = str_replace(' ', '+', $temp_bv_image8);
    //                 $output['bv_image8'] = '<img class="bv_image8" src="' . $replace_space8 . '" height="250" width="250">';
    //             } else {
    //                 $output['bv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }

    //             if (!empty($row->bv_image9)) {
    //                 $replace_space9 = str_replace(' ', '+', $temp_bv_image9);
    //                 $output['bv_image9'] = '<img class="bv_image9" src="' . $replace_space9 . '" height="250" width="250">';
    //             } else {
    //                 $output['bv_image9'] = '<input type="hidden" name="hidden_user_image" value="" />';
    //             }
               
    //         }
    //         echo json_encode($output);
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login', array('error' => $error));
    //     }
    // }

 function fetch_single_bv_data()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
            foreach ($data as $row) {

                $output['application_id'] = $row->application_id;
                $output['customer_name'] = $row->customer_name;
                $output['bank_name'] = $row->bank_name;

                $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
                $output['tcp1_name'] = $row->tcp1_name;
                $output['tcp2_name'] = $row->tcp2_name;
                $output['code'] = $row->code;
                $output['city'] = $row->city;
                $output['bv_type_of_profile'] = $row->bv_type_of_profile;
                $output['bv_ownership_other'] = $row->bv_ownership_other;
                $output['bv_approx_net_salary'] = $row->bv_approx_net_salary;
                $output['bv_approx_gross_salary'] = $row->bv_approx_gross_salary;
                $output['bv_approx_sale'] = $row->bv_approx_sale;
                $output['bv_office_setup'] = $row->bv_office_setup;
                $output['bv_office_setup_desc'] = $row->bv_office_setup_desc;

                $output['rv_loan_amt'] = $row->rv_loan_amt;
                $output['rv_loan_existing'] = $row->rv_loan_existing;
                $output['rv_loan_bankname'] = $row->rv_loan_bankname;
                $output['rv_loan_emi'] = $row->rv_loan_emi;

                $output['bv_vehicle'] = $row->bv_vehicle;
                $output['rv_vehicle_details'] = $row->rv_vehicle_details;
                $output['pincode'] = $row->pincode;
                $output['amount'] = $row->amount;
                $output['business_address'] = $row->business_address;
                $output['tat_start'] = $row->tat_start;
                $output['tat_end'] = $row->tat_end;
                $output['business_name'] = $row->business_name;
                $output['created_at'] = $row->created_at;
                $output['dob'] = $row->dob;
                $output['fi_time'] = $row->fi_time;
                $output['fi_date'] = $row->fi_date;
                $output['bv_working_since'] = $row->bv_working_since;
                $output['bv_signboard_name'] = $row->bv_signboard_name;
                $output['bv_office_proof'] = $row->bv_office_proof;
                $output['bv_previous_bus_details'] = $row->bv_previous_bus_details;
                $output['bv_fi_status'] = $row->bv_fi_status;

                $output['bv_lat'] = $row->bv_lat;
                $output['bv_long'] = $row->bv_long;
                $output['bv_pincode'] = $row->bv_pincode;
                $output['bv_location_add'] = $row->bv_location_add;

                $output['asset_make'] = $row->asset_make;
                $output['asset_model'] = $row->asset_model;
                $output['amount'] = $row->amount;
                $output['bv_company_name'] = $row->bv_company_name;
                $output['bv_person_met'] = $row->bv_person_met;

                $output['bv_tcp1_address'] = $row->bv_tcp1_address;
                $output['bv_tcp2_address'] = $row->bv_tcp2_address;
                  $output['bv_tcp1_contact'] = $row->bv_tcp1_contact;
                $output['bv_tcp2_contact'] = $row->bv_tcp2_contact;
                $output['rv_fi_status_reason'] = $row->rv_fi_status_reason;
                $output['bv_negative1'] = $row->bv_negative1;
                $output['bv_negative2'] = $row->bv_negative2;
                $output['rv_fi_status'] = $row->rv_fi_status;

                $output['consolidated_remark'] = $row->consolidated_remark;


                $output['product_name'] = $row->product_name;
                $output['bv_corporate_office'] = $row->bv_corporate_office;
                $output['bv_corporate_office'] = $row->bv_corporate_office;
                $output['bv_person_designation'] = $row->bv_person_designation;
                $output['bv_address_confirmed'] = $row->bv_address_confirmed;
                $output['bv_applicant_designation'] = $row->bv_applicant_designation;
                $output['bv_income'] = $row->bv_income;
                $output['bv_residence_address'] = $row->bv_residence_address;
                $output['bv_business_type'] = $row->bv_business_type;
                $output['bv_no_employee'] = $row->bv_no_employee;
                $output['bv_stocks'] = $row->bv_stocks;
                $output['bv_business_activity'] = $row->bv_business_activity;
                $output['bv_stability'] = $row->bv_stability;
                $output['bv_ownership'] = $row->bv_ownership;
                $output['bv_nature_of_business'] = $row->bv_nature_of_business;
                $output['bv_proof'] = $row->bv_proof;
                $output['bv_vehicle'] = $row->bv_vehicle;
                $output['bv_tcp1'] = $row->bv_tcp1;
                $output['bv_tcp2'] = $row->bv_tcp2;
                $output['bv_verified_name'] = $row->bv_verified_name;
                $output['bv_dt_of_cpv'] = $row->bv_dt_of_cpv;
                $output['bv_remarks'] = $row->bv_remarks;
                $output['status'] = $row->status;

                $temp_bv_image1 = $row->rv_image1;
                $temp_bv_image2 = $row->rv_image2;
                $temp_bv_image3 = $row->rv_image3;
                $temp_bv_image4 = $row->rv_image4;
                $temp_bv_image5 = $row->rv_image5;
                $temp_bv_image6 = $row->rv_image6;
                $temp_bv_image7 = $row->rv_image7;
                $temp_bv_image8 = $row->rv_image8;
                $temp_bv_image9 = $row->rv_image9;


               

                if (!empty($row->rv_image1)) {
                    $replace_space = str_replace(' ', '+', $temp_bv_image1);
                    $output['rv_image1'] = '<img class="rv_image1" src="' . $replace_space . '" height="250" width="250">';
                } else {
                    $output['rv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image2)) {
                    $replace_space2 = str_replace(' ', '+', $temp_bv_image2);
                    $output['rv_image2'] = '<img class="rv_image2" src="' . $replace_space2 . '" height="250" width="250">';
                } else {
                    $output['rv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                if (!empty($row->rv_image3)) {
                    $replace_space3 = str_replace(' ', '+', $temp_bv_image3);
                    $output['rv_image3'] = '<img class="rv_image3" src="' . $replace_space3 . '" height="250" width="250">';
                } else {
                    $output['rv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image4)) {
                    $replace_space4 = str_replace(' ', '+', $temp_bv_image4);
                    $output['rv_image4'] = '<img class="rv_image4" src="' . $replace_space4 . '" height="250" width="250">';
                } else {
                    $output['rv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image5)) {
                    $replace_space5 = str_replace(' ', '+', $temp_bv_image5);
                    $output['rv_image5'] = '<img class="rv_image5" src="' . $replace_space5 . '" height="250" width="250">';
                } else {
                    $output['rv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image6)) {
                    $replace_space6 = str_replace(' ', '+', $temp_bv_image6);
                    $output['rv_image6'] = '<img class="rv_image6" src="' . $replace_space6 . '" height="250" width="250">';
                } else {
                    $output['rv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image7)) {
                    $replace_space7 = str_replace(' ', '+', $temp_bv_image7);
                    $output['rv_image7'] = '<img class="rv_image7" src="' . $replace_space7 . '" height="250" width="250">';
                } else {
                    $output['rv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image8)) {
                    $replace_space8 = str_replace(' ', '+', $temp_bv_image8);
                    $output['rv_image8'] = '<img class="rv_image8" src="' . $replace_space8 . '" height="250" width="250">';
                } else {
                    $output['rv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image9)) {
                    $replace_space9 = str_replace(' ', '+', $temp_bv_image9);
                    $output['rv_image9'] = '<img class="rv_image9" src="' . $replace_space9 . '" height="250" width="250">';
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




    function fetch_single_assignee_from_app_end()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
            foreach ($data as $row) {



                $output['fi_status'] = $row->fi_status;
                $output['make_model'] = $row->make_model;
                $output['loan_amt'] = $row->loan_amt;
                $output['confirm_address'] = $row->confirm_address;
                $output['person_met_details'] = $row->person_met_details;
                $output['relationship'] = $row->relationship;
                $output['stability'] = $row->stability;
                $output['user_permanent_address'] = $row->user_permanent_address;
                $output['rent_per_month'] = $row->rent_per_month;
                $output['total_family_member'] = $row->total_family_member;
                $output['no_of_earning_members'] = $row->no_of_earning_members;
                $output['details_of_earning_members'] = $row->details_of_earning_members;
                $output['dependent'] = $row->dependent;
                $output['user_office_address'] = $row->user_office_address;
                $output['residence_proof'] = $row->residence_proof;
                $output['agriculture_land'] = $row->agriculture_land;
                $output['exterior_premises'] = $row->exterior_premises;
                $output['interior_premises'] = $row->interior_premises;
                $output['cross_verified_info'] = $row->cross_verified_info;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }



    function fetch_single_rv_case()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_case($_POST["user_id"]);
            foreach ($data as $row) {

                $output['id'] = $row->id;
                $output['bank_name'] = $row->bank_name;
                $output['product_name'] = $row->product_name;
               
                $output['rv_fi_status'] = $row->rv_fi_status;
                $output['rv_loan_amt'] = $row->rv_loan_amt;
                $output['rv_confirm_address'] = $row->rv_confirm_address;
                $output['rv_person_met_details'] = $row->rv_person_met_details;
                $output['rv_relationship'] = $row->rv_relationship;
                $output['rv_residence_ownership'] = $row->rv_residence_ownership;
                $output['rv_stability'] = $row->rv_stability;
                $output['rv_user_permanent_address'] = $row->rv_user_permanent_address;
                $output['rv_rent_per_month'] = $row->rv_rent_per_month;
                $output['rv_total_family_member'] = $row->rv_total_family_member;
                $output['rv_dependent'] = $row->rv_dependent;
                $output['rv_user_office_address'] = $row->rv_user_office_address;
                $output['rv_residence_proof'] = $row->rv_residence_proof;
                $output['rv_agriculture_land'] = $row->rv_agriculture_land;
                $output['rv_exterior_premises'] = $row->rv_exterior_premises;
                $output['rv_interior_premises'] = $row->rv_interior_premises;
                $output['rv_cross_verified_info'] = $row->rv_cross_verified_info;
                $output['rv_vehicle_details'] = $row->rv_vehicle_details;
                $output['rv_neighbour_check1'] = $row->rv_neighbour_check1;
                $output['rv_neighbour_check2'] = $row->rv_neighbour_check2;
                $output['rv_cpv_done_by'] = $row->rv_cpv_done_by;
                $output['rv_remarks'] = $row->rv_remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    public function update_rv_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
            $this->form_validation->set_rules('product_name', 'product_name', 'required');
            $this->form_validation->set_rules('rv_fi_status', 'rv_fi_status', '');
            $this->form_validation->set_rules('rv_loan_amt', 'rv_loan_amt', '');
            $this->form_validation->set_rules('rv_confirm_address', 'rv_confirm_address', '');
            // $this->form_validation->set_rules('rv_address_yes_no', 'rv_address_yes_no', 'required');
            $this->form_validation->set_rules('rv_person_met_details', 'rv_person_met_details', '');
            $this->form_validation->set_rules('rv_relationship', 'rv_relationship', '');
            $this->form_validation->set_rules('rv_residence_ownership', 'rv_residence_ownership', '');
            $this->form_validation->set_rules('rv_stability', 'rv_stability', '');
            $this->form_validation->set_rules('rv_user_permanent_address', 'rv_user_permanent_address', '');
            $this->form_validation->set_rules('rv_rent_per_month', 'rv_rent_per_month', '');
            $this->form_validation->set_rules('rv_total_family_member', 'rv_total_family_member', '');
            $this->form_validation->set_rules('rv_no_of_earning_members', 'rv_no_of_earning_members', '');
            // $this->form_validation->set_rules('rv_details_of_earning_member', 'rv_details_of_earning_member', 'required');
            $this->form_validation->set_rules('rv_dependent', 'rv_dependent', '');
            $this->form_validation->set_rules('rv_user_office_address', 'rv_user_office_address', '');
            $this->form_validation->set_rules('rv_residence_proof', 'rv_residence_proof', '');
            $this->form_validation->set_rules('rv_agriculture_land', 'rv_agriculture_land', '');
            $this->form_validation->set_rules('rv_exterior_premises', 'rv_exterior_premises', '');
            $this->form_validation->set_rules('rv_interior_premises', 'rv_interior_premises', '');
            $this->form_validation->set_rules('rv_cross_verified_info', 'rv_cross_verified_info', '');
            $this->form_validation->set_rules('rv_vehicle_details', 'rv_vehicle_details', '');
            $this->form_validation->set_rules('rv_neighbour_check1', 'rv_neighbour_check1', '');
            $this->form_validation->set_rules('rv_neighbour_check2', 'rv_neighbour_check2', '');
            $this->form_validation->set_rules('rv_cpv_done_by', 'rv_cpv_done_by', '');
            $this->form_validation->set_rules('rv_remarks', 'rv_remarks', '');

            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {

                $rv_cse_id = $_POST["rv_id"];
                $array = array(

                    'bank_name' => $this->input->post('bank_name'),
                    'product_name' => $this->input->post('product_name'),
                    'rv_fi_status' => $this->input->post('rv_fi_status'),
                    'rv_loan_amt' => $this->input->post('rv_loan_amt'),
                    'rv_confirm_address' => $this->input->post('rv_confirm_address'),
                    // 'rv_address_yes_no' => $this->input->post('rv_address_yes_no'),
                    'rv_person_met_details' => $this->input->post('rv_person_met_details'),
                    'rv_relationship' => $this->input->post('rv_relationship'),
                    'rv_residence_ownership' => $this->input->post('rv_residence_ownership'),
                    'rv_stability' => $this->input->post('rv_stability'),
                    'rv_user_permanent_address' => $this->input->post('rv_user_permanent_address'),
                    'rv_rent_per_month' => $this->input->post('rv_rent_per_month'),
                    'rv_total_family_member' => $this->input->post('rv_total_family_member'),
                    'rv_no_of_earning_members' => $this->input->post('rv_no_of_earning_members'),
                    // 'rv_details_of_earning_member' => $this->input->post('rv_details_of_earning_member'),
                    'rv_dependent' => $this->input->post('rv_dependent'),
                    'rv_user_office_address' => $this->input->post('rv_user_office_address'),
                    'rv_residence_proof' => $this->input->post('rv_residence_proof'),
                    'rv_agriculture_land' => $this->input->post('rv_agriculture_land'),
                    'rv_exterior_premises' => $this->input->post('rv_exterior_premises'),
                    'rv_interior_premises' => $this->input->post('rv_interior_premises'),
                    'rv_cross_verified_info' => $this->input->post('rv_cross_verified_info'),
                    'rv_vehicle_details' => $this->input->post('rv_vehicle_details'),
                    'rv_neighbour_check1' => $this->input->post('rv_neighbour_check1'),
                    'rv_neighbour_check2' => $this->input->post('rv_neighbour_check2'),
                    'rv_cpv_done_by' => $this->input->post('rv_cpv_done_by'),
                    'rv_remarks' => $this->input->post('rv_remarks'),

                );

                $this->load->model('Assign_case_model');
                $inserts_id = $this->Assign_case_model->update_rv_data_case($rv_cse_id, $array);
                if ($inserts_id) {
                    $response = array(
                        'success' => true,
                        'message' => "RV Case updated successfully"
                    );
                } else {
                    $response = array(
                        'error' => true,
                        'message' => "Error while saving data !!!!"
                    );
                }
            } else {
                // if error in form validation
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    function fetch_single_bv_case()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_case($_POST["user_id"]);
            foreach ($data as $row) {

                $output['id'] = $row->id;
                $output['bv_corporate_office'] = $row->bv_corporate_office;
                $output['bv_person_designation'] = $row->bv_person_designation;
                $output['bv_address_confirmed'] = $row->bv_address_confirmed;
                $output['bv_applicant_designation'] = $row->bv_applicant_designation;
                $output['bv_income'] = $row->bv_income;
                $output['bv_residence_address'] = $row->bv_residence_address;
                $output['bv_business_type'] = $row->bv_business_type;
                $output['bv_no_employee'] = $row->bv_no_employee;
                $output['bv_stocks'] = $row->bv_stocks;
                $output['bv_business_activity'] = $row->bv_business_activity;
                $output['bv_stability'] = $row->bv_stability;
                $output['bv_ownership'] = $row->bv_ownership;
                $output['bv_nature_of_business'] = $row->bv_nature_of_business;
                $output['bv_proof'] = $row->bv_proof;
                $output['bv_vehicle'] = $row->bv_vehicle;
                $output['bv_tcp1'] = $row->bv_tcp1;
                $output['bv_tcp2'] = $row->bv_tcp2;
                $output['bv_verified_name'] = $row->bv_verified_name;
                $output['bv_dt_of_cpv'] = $row->bv_dt_of_cpv;
                $output['bv_remarks'] = $row->bv_remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    function fetch_single_reassign_case()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_case($_POST["user_id"]);
            foreach ($data as $row) {

                $output['id'] = $row->id;
                $output['code'] = $row->code;
                $output['reassign_remarks'] = $row->reassign_remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }

    function fetch_single_final_status()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_case($_POST["user_id"]);
            foreach ($data as $row) {

                $output['id'] = $row->id;
                $output['add_final_status'] = $row->add_final_status;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }




    private function generateOTP()
    {
        // Generate a random OTP using your preferred method
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        // $otp ='1234';
        return $otp;
    }

    public function sendOTP()
    {
        $response = [];
        $email = 'fi.satfin2@gmail.com';
        //  $email = 'yogitasharma1606@gmail.com';

        // Generate and store the OTP
        $otp = $this->generateOTP();
        // echo $otp;die;
        $responseArray['otp'] = $otp;
        $responseArray['email'] = $email;

        $this->sendOTPEmail($email, $otp);
        $responseArray['msg'] = "Message";
        $responseArray['success'] = 1;
        echo json_encode($responseArray);
        die();
        // echo 'OTP has been sent to your email address.';
    }

    private function sendOTPEmail($email, $otp)
    {
        $this->load->library('email');
        $this->email->from('fi.satfin2@gmail.com', 'Yogita Sharma');
        $this->email->to($email);
        $this->email->subject('OTP Verification');
        $this->email->message('Please use the following OTP for verification: ' . $otp);

        if (!$this->email->send()) {
            // Handle email sending error if necessary
            echo $this->email->print_debugger();
        }
    }



    public function reassign_case_validation()
    {

        $enteredOtp = $this->input->post('otp');
        $response = [];
        $storedOtp = $this->input->post('store_otp');
        // echo $enteredOtp;
        // echo $storedOtp;die;
        if ($enteredOtp == $storedOtp) {

            $reassign_id = $_POST["r_id"];
            $reassign_multi_id = $_POST["multi_id"];
            $assignfrom = $_POST["assignfrom"];

            $array = array(
                'code' => $this->input->post('code'),
                'tat_start' =>  formatDate($this->input->post('tat_start'), 'Y-m-d H:i:s'),
                'tat_end' => formatDate($this->input->post('tat_start'), 'Y-m-d H:i:s'),
                'reassign_remarks' => $this->input->post('reassign_remarks'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $this->load->model('Assign_case_model');
            // $this->Assign_case_model->editData();
            $insert_id = $this->Assign_case_model->update_assignee($reassign_id, $assignfrom, $reassign_multi_id, $array);
            if ($insert_id) {
                $response = array(
                    'success' => 1,
                    'msg' => "Assignee updated successfully"
                );
            } else {
                $response = array(
                    'success' => 0,
                    'msg' => "Error while saving data !!!!"
                );
            }
        } else {
            $response = array(
                'success' => 0,
                'msg' => "please enter valid OTP !!!!"
            );
        }
        echo json_encode($response);
        die;
    }


    // public function reassign_case_validation() {
    //     try {

    //         $this->load->library('form_validation');
    //         $this->form_validation->set_rules('code', 'code', 'required');
    //         $this->form_validation->set_rules('reassign_remarks', 'reassign_remarks', '');

    //         $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    //         if ($this->form_validation->run()) {

    //             $reassign_id = $_POST["r_id"];
    //             $array = array(
    //                 'code' => $this->input->post('code'),
    //                 'reassign_remarks' => $this->input->post('reassign_remarks'),
    //             );

    //             $this->load->model('Assign_case_model');
    //             $insert_id = $this->Assign_case_model->update_assignee($reassign_id, $array);
    //             if ($insert_id) {
    //                 $response = array(
    //                     'success' => true,
    //                     'message' => "Assignee updated successfully"
    //                 );
    //             } else {
    //                 $response = array(
    //                     'error' => true,
    //                     'message' => "Error while saving data !!!!"
    //                 );
    //             }
    //         } else {
    //             // if error in form validation
    //             foreach ($_POST as $key => $value) {
    //                 $response['messages'][$key] = form_error($key);
    //             }
    //         }
    //         echo json_encode($response);
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login', array('error' => $error));
    //     }
    // }

    
    function fetch_single_case()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_case($_POST["user_id"]);
            foreach ($data as $row) {

                $output['id'] = $row->id;
                $output['bank_name'] = $row->bank_name;
                $output['customer_name'] = $row->customer_name;
                $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
                $output['product_name'] = $row->product_name;
                $output['business_address'] = $row->business_address;
                $output['fi_intiation_comments'] = $row->fi_intiation_comments;
                $output['source_channel'] = $row->source_channel;
                $output['designation'] = $row->designation;
                $output['geo_limit'] = $row->geo_limit;
                $output['city'] = $row->city;
                $output['fi_date'] = $row->fi_date;
                $output['fi_time'] = $row->fi_time;
                $output['fi_flag'] = $row->fi_flag;
                $output['tat_start'] = $row->tat_start;
                $output['tat_end'] = $row->tat_end;
                $output['dob'] = $row->dob;
                $output['pincode'] = $row->pincode;
                $output['permanent_address'] = $row->permanent_address;
                $output['remarks'] = $row->remarks;
                $output['amount'] = $row->amount;
                $output['vehicle'] = $row->vehicle;
                $output['co_applicant'] = $row->co_applicant;
                $output['guarantee_name'] = $row->guarantee_name;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }

    public function update_case_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
            $this->form_validation->set_rules('customer_name', 'customer_name', 'required');
            $this->form_validation->set_rules('fi_to_be_conducted', 'fi_to_be_conducted', 'required');
            $this->form_validation->set_rules('product_name', 'product_name', 'required');
            $this->form_validation->set_rules('business_address', 'business_address', 'required');
            $this->form_validation->set_rules('fi_date', 'fi_date', '');
            $this->form_validation->set_rules('fi_time', 'fi_time', '');
            $this->form_validation->set_rules('fi_flag', 'fi_flag', '');
            $this->form_validation->set_rules('tat_start', 'tat_start', '');
            $this->form_validation->set_rules('dob', 'dob', '');
            $this->form_validation->set_rules('tat_end', 'tat_end', '');
            $this->form_validation->set_rules('pincode', 'pincode', '');
            $this->form_validation->set_rules('city', 'city', '');
            $this->form_validation->set_rules('permanent_address', 'permanent_address', '');
            $this->form_validation->set_rules('amount', 'amount', 'required');
            $this->form_validation->set_rules('designation', 'designation', '');
            $this->form_validation->set_rules('co_applicant', 'co_applicant', '');
            $this->form_validation->set_rules('guarantee_name', 'guarantee_name', '');



            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {

                $case_id = $_POST["c_id"];
                $array = array(

                    'bank_name' => $this->input->post('bank_name'),
                    'customer_name' => $this->input->post('customer_name'),
                    'fi_to_be_conducted' => $this->input->post('fi_to_be_conducted'),
                    'product_name' => $this->input->post('product_name'),
                    'business_address' => $this->input->post('business_address'),
                    'geo_limit' => $this->input->post('geo_limit'),
                    'city' => $this->input->post('city'),
                    'fi_date' => $this->input->post('fi_date'),
                    'tat_start' => $this->input->post('tat_start'),
                    'tat_end' => $this->input->post('tat_end'),
                    'dob' => $this->input->post('dob'),
                    'fi_time' => $this->input->post('fi_time'),
                    'fi_flag' => $this->input->post('fi_flag'),
                    'permanent_address' => $this->input->post('permanent_address'),
                    'pincode' => $this->input->post('pincode'),
                    'fi_intiation_comments' => $this->input->post('fi_intiation_comments'),
                   
                    'designation' => $this->input->post('designation'),
                    'remarks' => $this->input->post('remarks'),
                    'amount' => $this->input->post('amount'),
                    'vehicle' => $this->input->post('vehicle'),
                    'co_applicant' => $this->input->post('co_applicant'),
                    'guarantee_name' => $this->input->post('guarantee_name'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                $this->load->model('Assign_case_model');
                $insert_id = $this->Assign_case_model->update_case($case_id, $array);
                if ($insert_id) {
                    $response = array(
                        'success' => true,
                        'message' => "Case updated successfully"
                    );
                } else {
                    $response = array(
                        'error' => true,
                        'message' => "Error while saving data !!!!"
                    );
                }
            } else {
                // if error in form validation
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }

    


    public function update_bv_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bv_corporate_office', 'bv_corporate_office', 'required');
            $this->form_validation->set_rules('bv_person_designation', 'rv_fi_status', 'required');
            $this->form_validation->set_rules('bv_address_confirmed', 'bv_address_confirmed', 'required');
            $this->form_validation->set_rules('bv_applicant_designation', 'bv_applicant_designation', 'required');
            $this->form_validation->set_rules('bv_income', 'bv_income', 'required');
            $this->form_validation->set_rules('bv_residence_address', 'bv_residence_address', 'required');
            $this->form_validation->set_rules('bv_business_type', 'bv_business_type', 'required');
            $this->form_validation->set_rules('bv_no_employee', 'bv_no_employee', 'required');
            $this->form_validation->set_rules('bv_stocks', 'bv_stocks', 'required');
            $this->form_validation->set_rules('bv_business_activity', 'bv_business_activity', 'required');
            $this->form_validation->set_rules('bv_stability', 'bv_stability', 'required');
            $this->form_validation->set_rules('bv_ownership', 'bv_ownership', 'required');
            $this->form_validation->set_rules('bv_nature_of_business', 'bv_nature_of_business', 'required');
            // $this->form_validation->set_rules('rv_details_of_earning_member', 'rv_details_of_earning_member', 'required');
            $this->form_validation->set_rules('bv_proof', 'bv_proof', 'required');
            $this->form_validation->set_rules('bv_vehicle', 'bv_vehicle', 'required');
            $this->form_validation->set_rules('bv_tcp1', 'bv_tcp1', 'required');
            $this->form_validation->set_rules('bv_tcp2', 'bv_tcp2', 'required');
            // $this->form_validation->set_rules('bv_verified_name', 'bv_verified_name', 'required');
            // $this->form_validation->set_rules('bv_dt_of_cpv', 'bv_dt_of_cpv', 'required');
            // $this->form_validation->set_rules('bv_remarks', 'bv_remarks', 'required');


            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {

                $bv_cse_id = $_POST["bv_id"];
                $array = array(

                    'bv_corporate_office' => $this->input->post('bv_corporate_office'),
                    'bv_person_designation' => $this->input->post('bv_person_designation'),
                    'bv_address_confirmed' => $this->input->post('bv_address_confirmed'),
                    'bv_applicant_designation' => $this->input->post('bv_applicant_designation'),
                    'bv_income' => $this->input->post('bv_income'),
                    'bv_residence_address' => $this->input->post('bv_residence_address'),
                    'bv_business_type' => $this->input->post('bv_business_type'),
                    'bv_no_employee' => $this->input->post('bv_no_employee'),
                    'bv_stocks' => $this->input->post('bv_stocks'),
                    'bv_business_activity' => $this->input->post('bv_business_activity'),
                    'bv_stability' => $this->input->post('bv_stability'),
                    'bv_ownership' => $this->input->post('bv_ownership'),
                    'bv_nature_of_business' => $this->input->post('bv_nature_of_business'),
                    // 'rv_details_of_earning_member' => $this->input->post('rv_details_of_earning_member'),
                    'bv_proof' => $this->input->post('bv_proof'),
                    'bv_vehicle' => $this->input->post('bv_vehicle'),
                    'bv_tcp1' => $this->input->post('bv_tcp1'),
                    'bv_tcp2' => $this->input->post('bv_tcp2'),
                    // 'bv_verified_name' => $this->input->post('bv_verified_name'),
                    // 'bv_dt_of_cpv' => $this->input->post('bv_dt_of_cpv'),
                    // 'bv_remarks' => $this->input->post('bv_remarks'),
                    'updated_at' => date('Y-m-d H:i:s'),



                );

                $this->load->model('Assign_case_model');
                $inserts_id_bv = $this->Assign_case_model->update_bv_data_case($bv_cse_id, $array);
                if ($inserts_id_bv) {
                    $response = array(
                        'success' => true,
                        'message' => "BV Case updated successfully"
                    );
                } else {
                    $response = array(
                        'error' => true,
                        'message' => "Error while saving data !!!!"
                    );
                }
            } else {
                // if error in form validation
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    public function add_final_status_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('add_final_status', 'add_final_status', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {
                $status_id = $_POST["a_id"];
                $array = array(
                    'add_final_status' => $this->input->post('add_final_status'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    
                );
                $this->load->model('Assign_case_model');
                $insert_user = $this->Assign_case_model->add_final_status($status_id, $array);
                if ($insert_user) {
                    $response = array(
                        'success' => true,
                        'message' => "Add status updated successfully!"
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
    
    // -------------woring code---------------

//      public function upload_images($uid)
// {
//     $getuf = $this->Assign_case_model->getuf($uid);
//     if (!empty($getuf)) {
//         if ($_FILES) {
//             $data = array();
//             // 1
//             if (isset($_FILES['image_1']) && $_FILES['image_1']['name'] != '') {
//                 $image_1 = $this->uploads('image_1');
//                 if (isset($image_1['rv_images']) && !empty($image_1['rv_images'])) {
//                     $data['rv_image1'] = $image_1['rv_images'];
//                 }
//             }

//           if (isset($_FILES['image_2']) && $_FILES['image_2']['name'] != '') {
//                 $image_1 = $this->uploads('image_2');
//                 if (isset($image_1['rv_images']) && !empty($image_1['rv_images'])) {
//                     $data['rv_image2'] = $image_1['rv_images'];
//                 }
//             }
            
     

//                 // 3
//                 if(isset($_FILES['image_3']) && $_FILES['image_3']['name'] != '') {
//                     $image_3 = $this->uploads('image_3');
//                     if(isset($image_3['rv_images']) && !empty($image_3['rv_images'])) {
//                         $data['rv_image3'] = $image_3['rv_images'];
//                     }
//                 }

//                 // 4
//                 if(isset($_FILES['image_4']) && $_FILES['image_4']['name'] != '') {
//                     $image_4 = $this->uploads('image_4');
//                     if(isset($image_4['rv_images']) && !empty($image_4['rv_images'])) {
//                         $data['rv_image4'] = $image_4['rv_images'];
//                     }
//                 }

//                 // 5
//                 if(isset($_FILES['image_5']) && $_FILES['image_5']['name'] != '') {
//                     $image_5 = $this->uploads('image_5');
//                     if(isset($image_5['rv_images']) && !empty($image_5['rv_images'])) {
//                         $data['rv_image5'] = $image_5['rv_images'];
//                     }
//                 }

//                 // 6
//                 if(isset($_FILES['image_6']) && $_FILES['image_6']['name'] != '') {
//                     $image_6 = $this->uploads('image_6');
//                     if(isset($image_6['rv_images']) && !empty($image_6['rv_images'])) {
//                         $data['rv_image6'] = $image_6['rv_images'];
//                     }
//                 }

//                 // 7
//                 if(isset($_FILES['image_7']) && $_FILES['image_7']['name'] != '') {
//                     $image_7 = $this->uploads('image_7');
//                     if(isset($image_7['rv_images']) && !empty($image_7['rv_images'])) {
//                         $data['rv_image7'] = $image_7['rv_images'];
//                     }
//                 }

//                 // 8
//                 if(isset($_FILES['image_8']) && $_FILES['image_8']['name'] != '') {
//                     $image_8 = $this->uploads('image_8');
//                     if(isset($image_8['rv_images']) && !empty($image_8['rv_images'])) {
//                         $data['rv_image8'] = $image_8['rv_images'];
//                     }
//                 }

//             // 9
//             if (isset($_FILES['image_9']) && $_FILES['image_9']['name'] != '') {
//                 $image_9 = $this->uploads('image_9');
//                 if (isset($image_9['rv_images']) && !empty($image_9['rv_images'])) {
//                     $data['rv_image9'] = $image_9['rv_images'];
//                 }
//             }

//             $this->db->set($data); // Use the "set" method to set the data for update
//             $this->db->where('id', $uid);
//             if ($this->db->update('upload_file')) {
//                 redirect('index.php/assign_case_controller/upload_images/' . $uid);
//             }
//         }

//         $data['uf_data'] = $getuf;
//         $this->load->view('upload_images', $data);
//     }
// }

// public function uploads($image_name = ''){
//         // $type = pathinfo($_FILES[$image_name]['tmp_name'], PATHINFO_EXTENSION);
//         $type = $_FILES[$image_name]['type'];
//         // print_r($_FILES[$image_name]);die;
//         $data = file_get_contents($_FILES[$image_name]['tmp_name']);
//         $_FILES[$image_name]['name'] = 'data:' . $type . ';base64,' . base64_encode($data);

//         $responseData = array('rv_images' => $_FILES[$image_name]['name']);
//         return $responseData;
//     }

   // -------------woring code---------------











    



}
