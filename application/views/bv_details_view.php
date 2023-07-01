
<!DOCTYPE html>
<html>

<head>
    <title>View BV Case Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;

        }

        .form-heading {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #0e88c5;
            color: #fff;
            padding: 10px;
            height: 22px;
        }

        headres{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #0e88c5;
            color: #fff;
            padding: 10px;
            height: 10px;
        }

        .row {
            display: flex;
            align-items: center;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 5px 0;
        }

        .column {
            flex-basis: 20%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .column:not(:last-child) {
            border-right: 1px solid #ccc;
        }

        .label {
            font-weight: bold;
        }

        .line {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 1px;
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <button class="btn btn-primary btn-sm" onclick="printPage()">Print</button>
    <div class="container">
       
        <header>
            <h2><?php echo $bvdetails['bank_name']; ?> <?php echo $bvdetails['product_name']; ?>  ( <?php echo $bvdetails['fi_to_be_conducted']; ?> )</h2>
        </header>
        <br>
        <div class="row">
            <div class="column">
                <div class="label">APPLICATION ID</div>
            </div>
            <div class="column">
                <?php echo $bvdetails['application_id']; ?>
            </div>
            <div class="column">
                <div class="label">APPLICANT NAME</div>
            </div>
            <div class="column">
               <?php echo $bvdetails['customer_name']; ?>
            </div>
        </div>
        <header>
        <h2>BUSINESS VERIFICATION REPORT</h2>
           
        </header>
        
 

       

        <div class="row">
            <div class="column">
                <div class="label">MOBILE:</div>
            </div>
            <div class="column">
               <?php echo $bvdetails['mobile']; ?>
            </div>
            <div class="column">
                <div class="label">CREATED DATE:</div>
            </div>
            <div class="column">
               <?php echo $bvdetails['created_at']; ?>
            </div>
        </div>
        
         <div class="row">
            <div class="column">
                <div class="label">TAT START</div>
            </div>
            <div class="column">
                <?php echo $bvdetails['tat_start']; ?>
            </div>
            <div class="column">
                <div class="label">TAT END</div>
            </div>
            <div class="column">
               <?php echo $bvdetails['tat_end']; ?>
            </div>
        </div>
        
         <div class="row">
            <div class="column">
                <div class="label">ADDRESS</div>
            </div>
            <div class="column">
               <?php echo $bvdetails['business_address']; ?>
            </div>
           
              
            </div>
        
        <div class="row">
            <div class="column">
                <div class="label">CITY</div>
            </div>
            <div class="column">
                <?php echo $bvdetails['city']; ?>
            </div>
            <div class="column">
                <div class="label">PINCODE</div>
            </div>
            <div class="column">
               <?php echo $bvdetails['pincode']; ?>
            </div>
        </div>




        
        
        <headres>
            <h2>COMPANY DETAILS</h2>
        </headres>

        <div class="row">
            <div class="column">
                <div class="label">COMPANY NAME</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_company_name']; ?>
            </div>
            <div class="column">
                
                <div class="label">PERSON MET</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_person_met']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">PERSON MET DESIGNATION</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_person_designation']; ?>
            </div>
            <div class="column">
                <div class="label">ADDRESS CONFIRMED</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_address_confirmed']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">APPLICANT DESIGNATION</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_applicant_designation']; ?>
            </div>
            
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">TYPE OF PROFILE</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_type_of_profile']; ?>
            </div>
            <div class="column">
                <div class="label">NATURE OF BUSINESS</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_nature_of_business']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                <div class="label">RESIDENCE ADDRESS</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['rv_user_permanent_address']; ?>
            </div>
            
        </div>
        
           <headres>
            <h2>BUSINESS DETAILS</h2>
        </headres>
        
         <div class="row">
            <div class="column">
                
                <div class="label">OFFICE OWNERSHIP</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_ownership']; ?>
            </div>
            <div class="column">
                <div class="label">OWNERSHIP (OTHER)</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_ownership_other']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">WORKING SINCE</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_working_since']; ?>
            </div>
            <div class="column">
                <div class="label">APPROX SALE</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_approx_sale']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">APPROX INCOME</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_income']; ?>
            </div>
            <div class="column">
                <div class="label">NO. OF EMPLOYEE</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_no_employee']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">APPROX GROSS SALARY</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_approx_gross_salary']; ?>
            </div>
            <div class="column">
                <div class="label">APPROX NET SALARY</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_approx_net_salary']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">STOCKS</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_stocks']; ?>
            </div>
            <div class="column">
                <div class="label">STABILITY</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_stability']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">OFFICE PROOF SEEN</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_office_proof']; ?>
            </div>
            <div class="column">
                <div class="label">PROOF</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_proof']; ?>
            </div>
            
        </div>
        
        
        
         <headres>
            <h2>OTHER DETAILS</h2>
        </headres>
        
        <div class="row">
            <div class="column">
                
                <div class="label">BUSINESS ACTIVITY</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_business_activity']; ?>
            </div>
            <div class="column">
                <div class="label">NAME MENTIONED IN SIGNBOARD</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_signboard_name']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">DETAILS OF EARNING MEMBERS</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['rv_details_of_earning_member']; ?>
            </div>
            <div class="column">
                <div class="label">DEPENDENT MEMBERS</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['rv_dependent']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                <div class="label">PREVIOUS BUSINESS DETAILS</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_previous_bus_details']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">OFFIE SETUP</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_office_setup']; ?>
            </div>
            <div class="column">
                <div class="label">OFFICE SETUP DESCRIPTION</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_office_setup_desc']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">VEHICLE TYPE</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_vehicle']; ?>
            </div>
            <div class="column">
                <div class="label">VEHICLE DETAILS</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['rv_vehicle_details']; ?>
            </div>
            
        </div>
        
        
         <headres>
            <h2>LOAN INFORMATION</h2>
        </headres>
        
        <div class="row">
            <div class="column">
                
                <div class="label">LOAN EXISTING</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['rv_loan_existing']; ?>
            </div>
            <div class="column">
                <div class="label">LOAN AMOUNT</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['rv_loan_amt']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">LOAN BANK NAME</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['rv_loan_bankname']; ?>
            </div>
            <div class="column">
                <div class="label">LOAN EMI</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['rv_loan_emi']; ?>
            </div>
            
        </div>
        
         <headres>
            <h2>TCP INFORMATION</h2>
        </headres>
     
        
        <div class="row">
            <div class="column">
                
                <div class="label">TCP 1 NAME</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['tcp1_name']; ?>
            </div>
            <div class="column">
                <div class="label">TCP 2 NAME</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['tcp2_name']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">TCP 1 ADDRESS/DESIGNATION</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_tcp1_address']; ?>
            </div>
            <div class="column">
                <div class="label">TCP 2 ADDRESS/DESIGNATION</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_tcp2_address']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">TCP 1 CONTACT</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_tcp1_contact']; ?>
            </div>
            <div class="column">
                <div class="label">TCP 2 CONTACT</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_tcp2_contact']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">TCP 1 FEEDBACK</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_tcp1']; ?>
            </div>
            <div class="column">
                <div class="label">TCP 2 FEEDBACK</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_tcp2']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">FEEDBACK REASON</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_negative1']; ?>
            </div>
            <div class="column">
                <div class="label">FEEDBACK REASON</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_negative2']; ?>
            </div>
            
        </div>
        
       
        
        <headres>
            <h2>STATUS</h2>
        </headres>
        
         <div class="row">
            <div class="column">
                
                <div class="label">FI STATUS</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['rv_fi_status']; ?>
            </div>
            <div class="column">
                <div class="label">STATUS</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['status']; ?>
            </div>
            
        </div>
        <div class="row">
            <div class="column">
                <div class="label">FI STATUS REASON (IF ANY)</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['rv_fi_status_reason']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                <div class="label">REMARKS (IF ANY)</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_remarks']; ?>
            </div>
            
        </div>
        
       
        
        <headres>
            <h2>CONSOLIDATED REMARK</h2>
        </headres>

        <div class="row">
           
              <?php echo $bvdetails['consolidated_remark']; ?>
            
            
        </div>
        
         
        <br>
       
       <style>
           .image-container {
    position: relative;
}

.hover-image {
    transition: transform 0.3s ease;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.hover-image:hover {
    transform: scale(1.5);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    background-color: #f1f1f1;
    border: 1px solid #ccc;
}



       </style>
       
       <?php
// $gdInfo = gd_info();
// var_dump($gdInfo['JPEG Support']);
?>
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
?>

<?php
// if (!empty($bvdetails['rv_image1'])) {
//     $rv_image1 = str_replace(' ', '+', $bvdetails['rv_image1']);

//     // Decode the base64 image to get the original image data
//         $imageData = base64_decode(trim($rv_image1));


//     // Create an image resource from the decoded data
//     $image = imagecreatefromstring($imageData);

//     if ($image !== false) {
//         // Apply image enhancements (example: sharpening)
//         $sharpened = imageconvolution($image, array(
//             array(-1, -1, -1),
//             array(-1, 16, -1),
//             array(-1, -1, -1)
//         ), 8, 0);

//         // Save the enhanced image to a new file with higher quality
//         $outputFile = 'path/to/enhanced_image.jpeg';
//         imagejpeg($sharpened, $outputFile, 90); // Adjust the quality value as desired (e.g., 90)

//         // Encode the enhanced image file as a new base64 blob with higher quality
//         $enhancedImageData = file_get_contents($outputFile);
//         $enhancedBase64 = base64_encode($enhancedImageData);

//         // Output the enhanced image with the new base64 blob
//         // echo '<img src="data:image/jpeg;base64,' . $enhancedBase64 . '" class="hover-image" style="width: 300px; height: 300px;">';
//         //   echo '<img src="' . $enhancedBase64 . '" class="hover-image" style="width: 300px; height: 300px;">';
//           echo '<img src="' . $enhancedBase64 . '" class="hover-image" style="width: 300px; height: 300px;">';


//         // Clean up: delete the temporary enhanced image file
//         unlink($outputFile);
//     } else {
//         echo 'Failed to create image resource.';
//     }
// }
?>


      <?php
if (!empty($bvdetails['rv_image1'])) {
    $rv_image1 = str_replace(' ', '+', $bvdetails['rv_image1']);
    echo '<img src="' . $rv_image1 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>

    
      <?php
if (!empty($bvdetails['rv_image2'])) {
    $rv_image2 = str_replace(' ', '+', $bvdetails['rv_image2']);
    echo '<img src="' . $rv_image2 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
        <?php
if (!empty($bvdetails['rv_image3'])) {
    $rv_image3 = str_replace(' ', '+', $bvdetails['rv_image3']);
    echo '<img src="' . $rv_image3 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
        <?php
if (!empty($bvdetails['rv_image4'])) {
    $rv_image4 = str_replace(' ', '+', $bvdetails['rv_image4']);
    echo '<img src="' . $rv_image4 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
       <?php
if (!empty($bvdetails['rv_image5'])) {
    $rv_image5 = str_replace(' ', '+', $bvdetails['rv_image5']);
    echo '<img src="' . $rv_image5 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
        <?php
if (!empty($bvdetails['rv_image6'])) {
    $rv_image6 = str_replace(' ', '+', $bvdetails['rv_image6']);
    echo '<img src="' . $rv_image6 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
       <?php
if (!empty($bvdetails['rv_image7'])) {
    $rv_image7 = str_replace(' ', '+', $bvdetails['rv_image7']);
    echo '<img src="' . $rv_image7 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>

      <?php
if (!empty($bvdetails['rv_image8'])) {
    $rv_image8 = str_replace(' ', '+', $bvdetails['rv_image8']);
    echo '<img src="' . $rv_image8 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
    <?php
if (!empty($bvdetails['rv_image9'])) {
    $rv_image9 = str_replace(' ', '+', $bvdetails['rv_image9']);
    echo '<img src="' . $rv_image9 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>


      

        <headres>
            <h2>LOCATION</h2>
        </headres>
        
         <div class="row">
            <div class="column">
                
                <div class="label">LATITUDE</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_lat']; ?>
            </div>
            <div class="column">
                <div class="label">LONGITUDE</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_long']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">ADDRESS</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['bv_location_add']; ?>
            </div>
            <div class="column">
                <div class="label">PINCODE</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_pincode']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">AGENT CODE</div>
            </div>
            <div class="column">
             <?php echo $bvdetails['code']; ?>
            </div>
            <div class="column">
                <div class="label">CPV DATE</div>
            </div>
            <div class="column">
              <?php echo $bvdetails['bv_dt_of_cpv']; ?>
            </div>
            
        </div>
        
        



        
     
        
        

    
    </div>
    <script>
        function printPage() {
            window.print();
        }
    </script>
     
  
    
</body>

</html>
