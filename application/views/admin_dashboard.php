<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/theme1.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="Stylesheet" type="text/css" href="assets/global/plugins/bootstrap/css/bootstrap.min.css" />
  <title>Banking System</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
</head>
<body>

  <style>
    body {
      padding-top: 20px;
      padding-right: 80px;
      padding-left: 80px;
      font-family: 'Poppins', serif;
    }

    figure {
      width: 1170px;
      height: 560px;
      border-radius: 4px;
      border: 2px solid #ccc;
      position: relative;
      padding: 48px 10px 10px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }


    figure:before {
      content: attr(data-title);
      position: absolute;
      top: 0px;
      left: 0;
      width: 100%;
      height: 40px;
      line-height: 40px;
      text-indent: 10px;
      border-bottom: 2px solid #ccc;
    }
  </style>

  <style>
    .SubmenuBox {
      height: 160px;
      width: 100%;
      margin-bottom: 20px;
      text-align: center;
    }

    .SubmenuText {
      font-size: 16px;
      font-weight: bold;
      display: block;
      padding-bottom: 5px;
      color: #375b91;
    }



    .SubmenuBox a {
      height: 100%;
      width: 100%;
      display: block;
      padding: 20px 12px;
      border: 1px solid #eee;
      background: #fcfcfc;
    }

    .SubmenuBox a:hover {
      background: #fff;
      text-decoration: none !important;
      box-shadow: 0 0 10px #eee;
    }

    .SubmenuBox a:focus {
      text-decoration: none !important;
    }

    .SubmenuText2 {
      font-size: 12px;
      font-weight: normal;
      display: block;
      color: #2a2a2a;
    }

    .SubmenuBox img {
      height: 48px;
      width: 48px;
      margin-bottom: 10px;
    }

    td {
      padding: 5px !important;
      border-width: 0 !important;
      border-style: None !important;
      border-radius: 2px;
    }

    td a {
      font-weight: normal !Important;
    }

    td img {
      height: 48px;
      width: 48px;
    }

    .linkthumbnails {
      padding: 15px;
    }

    .card {
      position: relative;
      width: 350px;
      padding: 20px;
      box-shadow: 3px 10px 20px rgba(0, 0, 0, 0.2);
      border-radius: 3px;
      border: 0;
      float: left;
      margin-bottom: 15px;
      margin-left: 15px;
      align-items: center;


    }

    .circle {
      border-radius: 3px;
      width: 130px;
      height: 130px;
      background: black;
      position: absolute;
      right: 0px;
      top: 0;
      background-image: linear-gradient(to top, #28aef0 0%, #0e88c5 100%);
      border-bottom-left-radius: 170px;
    }

    .mybtn-right {
      text-align: right;
      padding-right: 180px;
      clear: both;
    }

    .veri {
      text-align: center;
    }

    .logout {
      text-align: right;
    }

    .content {
      margin-top: 25px;
      display: flex;
      flex-direction: column;
    }

    .btn-info {
      /* color: #0e88c5; */
      background-color: #0e88c5;
      border-color: #0e88c5
    }
  </style>

  <div class="container">
    <div class="page-header-inner">

      <div class="col-md-4 col-sm-6">
        <div class="row">
          <div id="dvTitle" class="product_name">
            <!-- <img src="/images/mobileforce.jpg" alt="logo" width="500" height="600"> -->
            <h3><b>Bodvid Private Limited</b></h3>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-sm-6">
        <div class="row">
          <div id="dvTitle" class="veri">
            <h3><b>Verification System (1.0.0)</b></h3>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-sm-6">
        <div class="row">
          <div id="dvTitle" class="logout">
            <?php
            $user = $this->session->userdata('user');
            extract($user);
            ?>
            <h3><?php echo $username; ?> <b><a id="lblLogOut" href="<?php echo base_url(); ?>user/logout">LogOut</a></b></h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>

  <div class="mybtn-right">
    <a href="<?php echo base_url(); ?>home" class="btn btn-info" class="btn btn-info">Dashboard</a>
    <a href="<?php echo base_url(); ?>Create_cse/create_c" class="btn btn-info">Case</a>
    <a href="<?php echo base_url(); ?>Report_controller/report_page_open" class="btn btn-info">Report</a>
    <a href="<?php echo base_url(); ?>Admin_dashboard_controller/admin_dashboard" class="btn btn-info">Admin</a>
  </div>
  <br>

  <figure data-title="USER MANAGEMENT" style="color:#0e88c5;">
    <figcaption>
      <div class="card">
        <div class="title">
        <a href="<?php echo base_url(); ?>Create_user_controller/create_user">
          <h3><b>Manage Users</b></h3>
        </div>
        <div class="content">
          <div class="social">
            <i class="fab fa-codepen"></i>
            <h4 style="color:#525251;">View Details, Add Details</h4>
          </div>
          <div class="social">
            <i class="fab fa-linkedin"></i>
            <h4 style="color:#525251;">Edit Users and their Roles</h4>
          </div>
        </div>
        <div class="circle"></div>
      </div>

      <div class="card">
        <div class="title">
        <a href="<?php echo base_url(); ?>Add_bank_controller/add_bank">
          <h3><b>Add Bank</b></h3>
        </div>
        <div class="content">
          <div class="social">
            <i class="fab fa-codepen"></i>
            <h4 style="color:#525251;">View Details, Add Details</h4>
          </div>
          <div class="social">
            <i class="fab fa-linkedin"></i>
            <h4 style="color:#525251;">Status Active / Inactive</h4>
          </div>
        </div>
        <div class="circle"></div>
      </div>

      <div class="card">
        <div class="title">
        <a href="<?php echo base_url(); ?>Add_product_controller/add_product">
          <h3><b>Add Product</b></h3>
        </div>
        <div class="content">
          <div class="social">
            <i class="fab fa-codepen"></i>
            <h4 style="color:#525251;">View Details, Add Details</h4>
          </div>
          <div class="social">
            <i class="fab fa-linkedin"></i>
            <h4 style="color:#525251;">Status Active / Inactive</h4>
          </div>
        </div>
        <div class="circle"></div>
      </div>
    </figcaption>
  </figure>

</body>

</html>