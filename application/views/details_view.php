
<!DOCTYPE html>
<html>

<head>
    <title>View RV Case Details</title>
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
</head>

<body>
    
    <button class="btn btn-primary btn-sm" onclick="printPage()">Print</button>
    <div class="container">
       
        <header>
            <h2><?php echo $details['bank_name']; ?> <?php echo $details['product_name']; ?>  ( <?php echo $details['fi_to_be_conducted']; ?> )</h2>
        </header>
        <br>
        <div class="row">
            <div class="column">
                <div class="label">APPLICATION ID</div>
            </div>
            <div class="column">
                <?php echo $details['application_id']; ?>
            </div>
            <div class="column">
                <div class="label">APPLICANT NAME</div>
            </div>
            <div class="column">
               <?php echo $details['customer_name']; ?>
            </div>
        </div>
        <header>
        <h2>RESIDENCE VERIFICATION REPORT</h2>
           
        </header>

       

        <div class="row">
            <div class="column">
                <div class="label">MOBILE:</div>
            </div>
            <div class="column">
               <?php echo $details['mobile']; ?>
            </div>
            <div class="column">
                <div class="label">CREATED DATE:</div>
            </div>
            <div class="column">
               <?php echo $details['created_at']; ?>
            </div>
        </div>
        
         <div class="row">
            <div class="column">
                <div class="label">TAT START</div>
            </div>
            <div class="column">
                <?php echo $details['tat_start']; ?>
            </div>
            <div class="column">
                <div class="label">TAT END</div>
            </div>
            <div class="column">
               <?php echo $details['tat_end']; ?>
            </div>
        </div>
        
         <div class="row">
            <div class="column">
                <div class="label">ADDRESS</div>
            </div>
            <div class="column">
               <?php echo $details['business_address']; ?>
            </div>
           
              
            </div>
        
        <div class="row">
            <div class="column">
                <div class="label">CITY</div>
            </div>
            <div class="column">
                <?php echo $details['city']; ?>
            </div>
            <div class="column">
                <div class="label">PINCODE</div>
            </div>
            <div class="column">
               <?php echo $details['pincode']; ?>
            </div>
        </div>




        <headres>
            <h2>ADDRESS CONFIRMATION</h2>
        </headres>

        <div class="row">
            <div class="column">
                <div class="label">ADDRESS CONFIRMED</div>
            </div>
            <div class="column">
              <?php echo $details['rv_address_yes_no']; ?>
            </div>
            
        </div>
        
        <headres>
            <h2>DETAILS OF PERSON</h2>
        </headres>

        <div class="row">
            <div class="column">
                <div class="label">PERSON MET DETAILS</div>
            </div>
            <div class="column">
             <?php echo $details['rv_person_met_details']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">RELATIONSHIP WITH APPLICANTt</div>
            </div>
            <div class="column">
             <?php echo $details['rv_relationship']; ?>
            </div>
            <div class="column">
                <div class="label">STABILITY</div>
            </div>
            <div class="column">
              <?php echo $details['rv_stability']; ?>
            </div>
            
        </div>
        
           <headres>
            <h2>RESIDENCE DETAILS</h2>
        </headres>
        
         <div class="row">
            <div class="column">
                
                <div class="label">OWNERSHIP OF RESIDENCE</div>
            </div>
            <div class="column">
             <?php echo $details['rv_residence_ownership']; ?>
            </div>
            <div class="column">
                <div class="label">RENT PER MONTH</div>
            </div>
            <div class="column">
              <?php echo $details['rv_rent_per_month']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                <div class="label">PERMANENT ADDRESS</div>
            </div>
            <div class="column">
             <?php echo $details['rv_user_permanent_address']; ?>
            </div>
            
        </div>
        
         <headres>
            <h2>FAMILY INFORMATION</h2>
        </headres>
        
        <div class="row">
            <div class="column">
                
                <div class="label">TOTAL FAMILY MEMBERS</div>
            </div>
            <div class="column">
             <?php echo $details['rv_total_family_member']; ?>
            </div>
            <div class="column">
                <div class="label">EARNING MEMBERS</div>
            </div>
            <div class="column">
              <?php echo $details['rv_no_of_earning_members']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">DETAILS OF EARNING MEMBERS</div>
            </div>
            <div class="column">
             <?php echo $details['rv_details_of_earning_member']; ?>
            </div>
            <div class="column">
                <div class="label">DEPENDENT MEMBERS</div>
            </div>
            <div class="column">
              <?php echo $details['rv_dependent']; ?>
            </div>
            
        </div>
        
         <headres>
            <h2>OTHER INFORMATION</h2>
        </headres>
        
        <div class="row">
            <div class="column">
                
                <div class="label">USER OFFICE ADDRESS</div>
            </div>
            <div class="column">
             <?php echo $details['rv_user_office_address']; ?>
            </div>
            
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">RESIDENCE PROOF</div>
            </div>
            <div class="column">
              <?php echo $details['rv_residence_proof']; ?>
            </div>
            <div class="column">
                <div class="label">RESIDENCE PROOF NUMBER</div>
            </div>
            <div class="column">
              <?php echo $details['res_proof_number']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">EXTERIOR</div>
            </div>
            <div class="column">
              <?php echo $details['rv_exterior_premises']; ?>
            </div>
            <div class="column">
                <div class="label">INTERIOR</div>
            </div>
            <div class="column">
              <?php echo $details['rv_interior_premises']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">AGRICULTURE LEND (IF ANY)</div>
            </div>
            <div class="column">
              <?php echo $details['rv_agriculture_land']; ?>
            </div>
            <div class="column">
                <div class="label">HOW MUCH LEND</div>
            </div>
            <div class="column">
              <?php echo $details['how_much_land']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">VEHICLE TYPE</div>
            </div>
            <div class="column">
              <?php echo $details['rv_vehicle_type']; ?>
            </div>
            <div class="column">
                <div class="label">VEHICLE DETAIL'S </div>
            </div>
            <div class="column">
              <?php echo $details['rv_vehicle_details']; ?>
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
             <?php echo $details['rv_loan_existing']; ?>
            </div>
            <div class="column">
                <div class="label">LOAN AMOUNT</div>
            </div>
            <div class="column">
              <?php echo $details['rv_loan_amt']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">LOAN BANK NAME</div>
            </div>
            <div class="column">
             <?php echo $details['rv_loan_bankname']; ?>
            </div>
            <div class="column">
                <div class="label">LOAN EMI</div>
            </div>
            <div class="column">
              <?php echo $details['rv_loan_emi']; ?>
            </div>
            
        </div>
        
        <headres>
            <h2>NEIGHBOUR CHECK</h2>
        </headres>
        
         <div class="row">
            <div class="column">
                
                <div class="label">NEIGHBOUR 1</div>
            </div>
            <div class="column">
             <?php echo $details['neighbour_name1']; ?>
            </div>
            <div class="column">
                <div class="label">NEIGHBOUR 2</div>
            </div>
            <div class="column">
              <?php echo $details['neighbour_name2']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">HOUSE DETAILS</div>
            </div>
            <div class="column">
             <?php echo $details['neighbour_house_no_1']; ?>
            </div>
            <div class="column">
                <div class="label">HOUSE DETAILS</div>
            </div>
            <div class="column">
              <?php echo $details['neighbour_house_no_2']; ?>
            </div>
            
        </div>
         <div class="row">
            <div class="column">
                
                <div class="label">NEIGHBOUR 1 CONTACT</div>
            </div>
            <div class="column">
             <?php echo $details['neighbour_contact1']; ?>
            </div>
            <div class="column">
                <div class="label">NEIGHBOUR 2 CONTACT</div>
            </div>
            <div class="column">
              <?php echo $details['neighbour_contact2']; ?>
            </div>
            
        </div>
         <div class="row">
            <div class="column">
                
                <div class="label">NEIGHBOUR 1 FEEDBACK</div>
            </div>
            <div class="column">
             <?php echo $details['neighbour_feedback1']; ?>
            </div>
            <div class="column">
                <div class="label">NEIGHBOUR 2 FEEDBACK</div>
            </div>
            <div class="column">
              <?php echo $details['neighbour_feedback2']; ?>
            </div>
            
        </div>
         <div class="row">
            <div class="column">
                
                <div class="label">FEEDBACK REASON</div>
            </div>
            <div class="column">
             <?php echo $details['neighbour1_neg_feedback']; ?>
            </div>
            <div class="column">
                <div class="label">FEEDBACK REASON</div>
            </div>
            <div class="column">
              <?php echo $details['neighbour2_neg_feedback']; ?>
            </div>
            
        </div>
        
        <headres>
            <h2>CONSOLIDATED REMARK</h2>
        </headres>

        <div class="row">
           
              <?php echo $details['consolidated_remark']; ?>
            
            
        </div>
        
         <headres>
            <h2>STATUS & REMARK</h2>
        </headres>
        
         <div class="row">
            <div class="column">
                
                <div class="label">FI STATUS</div>
            </div>
            <div class="column">
             <?php echo $details['rv_fi_status']; ?>
            </div>
            <div class="column">
                <div class="label">FI STATUS REASON</div>
            </div>
            <div class="column">
              <?php echo $details['rv_fi_status_reason']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                <div class="label">ADDITIONAL REMARKS</div>
            </div>
            <div class="column">
              <?php echo $details['rv_remarks']; ?>
            </div>
            
        </div>
        
        
        
  <br>
       
         
    <?php
if (!empty($details['rv_image1'])) {
    $rv_image1 = str_replace(' ', '+', $details['rv_image1']);
    echo '<img src="' . $rv_image1 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
      <?php
if (!empty($details['rv_image2'])) {
    $rv_image2 = str_replace(' ', '+', $details['rv_image2']);
    echo '<img src="' . $rv_image2 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
        <?php
if (!empty($details['rv_image3'])) {
    $rv_image3 = str_replace(' ', '+', $details['rv_image3']);
    echo '<img src="' . $rv_image3 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
        <?php
if (!empty($details['rv_image4'])) {
    $rv_image4 = str_replace(' ', '+', $details['rv_image4']);
    echo '<img src="' . $rv_image4 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
       <?php
if (!empty($details['rv_image5'])) {
    $rv_image5 = str_replace(' ', '+', $details['rv_image5']);
    echo '<img src="' . $rv_image5 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
        <?php
if (!empty($details['rv_image6'])) {
    $rv_image6 = str_replace(' ', '+', $details['rv_image6']);
    echo '<img src="' . $rv_image6 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
       <?php
if (!empty($details['rv_image7'])) {
    $rv_image7 = str_replace(' ', '+', $details['rv_image7']);
    echo '<img src="' . $rv_image7 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>

      <?php
if (!empty($details['rv_image8'])) {
    $rv_image8 = str_replace(' ', '+', $details['rv_image8']);
    echo '<img src="' . $rv_image8 . '" class="hover-image" style="width: 480px; height: 400px;">';
}
?>
    
    <?php
if (!empty($details['rv_image9'])) {
    $rv_image9 = str_replace(' ', '+', $details['rv_image9']);
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
             <?php echo $details['rv_lat']; ?>
            </div>
            <div class="column">
                <div class="label">LONGITUDE</div>
            </div>
            <div class="column">
              <?php echo $details['rv_long']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                
                <div class="label">ADDRESS</div>
            </div>
            <div class="column">
             <?php echo $details['rv_location_add']; ?>
            </div>
            <div class="column">
                <div class="label">PINCODE</div>
            </div>
            <div class="column">
              <?php echo $details['rv_pincode']; ?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="column">
                
                <div class="label">AGENT CODE</div>
            </div>
            <div class="column">
             <?php echo $details['code']; ?>
            </div>
            <div class="column">
                <div class="label">CPV DONE BY</div>
            </div>
            <div class="column">
              <?php echo $details['rv_cpv_done_by']; ?>
            </div>
            
        </div>
        
         <div class="row">
            <div class="column">
                <div class="label">VISIT DATE</div>
            </div>
            <div class="column">
              <?php echo $details['rv_visit_date']; ?>
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
