<!DOCTYPE html>
<html>
<head>
    <title>My Assign Cases</title>
</head>
<body>
    <!--<h1>hdsjhds</h1>-->
    <?php foreach ($results as $result): ?>
    <!--<?php var_dump($results); ?>-->
    
        <h1>ID: <?php echo $result->application_id; ?></h1>
        <h2>FI Type: <?php echo $result->fi_to_be_conducted; ?></h2>
        <h2>Customer name: <?php echo $result->customer_name; ?></h2>
        <h2>Mobile: <?php echo $result->mobile; ?></h2>
        <h2>Product: <?php echo $result->product_name; ?></h2>
        <h2>Address: <?php echo $result->business_address; ?></h2>
        <!--<h2>Agent Code: <?php echo $result->code; ?></h2>-->
    
        
    <?php
    $rv_image1 = str_replace(' ', '+', $result->rv_image1);
    ?>
    <img src="<?php echo $rv_image1; ?>" style="width: 300px; height: 300px;">
    
    
    <?php
    $rv_image2 = str_replace(' ', '+', $result->rv_image2);
    ?>
    <img src="<?php echo $rv_image2; ?>" style="width: 300px; height: 300px;">
    
     <?php
    $rv_image3 = str_replace(' ', '+', $result->rv_image3);
    ?>
    <img src="<?php echo $rv_image3; ?>" style="width: 300px; height: 300px;">
    
    
     <?php
    $rv_image4 = str_replace(' ', '+', $result->rv_image4);
    ?>
    <img src="<?php echo $rv_image4; ?>" style="width: 300px; height: 300px;">
    
     <?php
    $rv_image5 = str_replace(' ', '+', $result->rv_image5);
    ?>
    <img src="<?php echo $rv_image5; ?>" style="width: 300px; height: 300px;">
    
    
     <?php
    $rv_image6 = str_replace(' ', '+', $result->rv_image6);
    ?>
    <img src="<?php echo $rv_image6; ?>" style="width: 300px; height: 300px;">
    
     <?php
    $rv_image7 = str_replace(' ', '+', $result->rv_image7);
    ?>
    <img src="<?php echo $rv_image7; ?>" style="width: 300px; height: 300px;">
    
     <?php
    $rv_image8 = str_replace(' ', '+', $result->rv_image8);
    ?>
    <img src="<?php echo $rv_image8; ?>" style="width: 300px; height: 300px;">
    
     <?php
    $rv_image9 = str_replace(' ', '+', $result->rv_image9);
    ?>
    <img src="<?php echo $rv_image9; ?>" style="width: 300px; height: 300px;">
    <hr>
    
   


 
        
        
    <?php endforeach; ?>
</body>
</html>
