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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

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

        /* .container {
            border-radius: 5px;
            padding: 20px;
            margin-left: 20px;
            margin-right: 20px;
        } */

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

        input[type=submit] {
            background-color: #90EE90;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
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
        <a href="" class="btn btn-info">Admin</a>
    </div>
    <br>
    <figure data-title="UPLOAD FILE" style="color:#0e88c5;">
        <figcaption>
            <div class="container" id="menu1">
                <form action="<?= base_url('Upload_case_controller/index') ?>" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="bank">
                                <h4><b>Bank</b></h4>
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="bank" name="bank">
                                <option value="" selected>-- SELECT BANK --</option>
                                <?php foreach ($bank_names as $bank) { ?>
                                    <option value="<?= $bank['bank_name']; ?>"><?= $bank['bank_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="product">
                                <h4><b>Upload Product</b></h4>
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="upload_type" name="upload_type">
                                <option value="" selected>-- SELECT Type --</option>
                                <option value="create_case"> Create Case </option>
                                <option value="mini_case"> Mini Case </option>

                            </select>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="product">
                                <h4><b>Upload Excel</b></h4>
                            </label>
                        </div>
                        <div class="col-sm-8">

                            <input class="form-control" type="file" name="upload_excel" required />
                            <br>
                            <hr>
                            <b><input class="form-control" type="submit" name="submit" value="Upload Excel" onclick="myFunction()"></b>
                            <?php if ($this->session->flashdata('success')) { ?>
                                <p><?= $this->session->flashdata('success') ?></p>
                                <!-- echo "Hello by PHP echo";   -->
                            <?php  } ?>
                            <?php if ($this->session->flashdata('error')) { ?>
                                <p><?= $this->session->flashdata('error') ?></p>
                            <?php  } ?>

                        </div>
                    </div>
                </form>
                <!-- <br> 
                 <div class="row">
                    <div class="col-sm-2">
                        <label for="product">
                            <h4><b>Upload Excel</b></h4>
                        </label>
                    </div>
                    <div class="col-sm-8">
                        <b><input class="form-control" type="submit" name="submit" value="Submit Details"></b>
                    </div>
                </div> -->

            </div>
        </figcaption>
    </figure>
</body>

</html>