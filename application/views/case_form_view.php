<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/theme1.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="Stylesheet" type="text/css" href="assets/global/plugins/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <script type="text/javascript">
        BASE_URL = "<?php echo base_url(); ?>"
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <style>
        body {
            box-sizing: border-box;
            left: 200px;
            font-family: 'Poppins', serif;
        }

        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=reset] {
            background-color: #008CBA;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=reset]:hover {
            background-color: #24a0ed;
        }

        div {
            padding-right: 30px;
            padding-left: 80px;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        header {
            background-color: #0e88c5;
            color: #fff;
            padding: 20px;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .mybtn-right {
            text-align: right;
            padding-right: 180px;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {

            .col-25,
            .col-75,
            input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
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
            background-color: #0e88c5;
            border-color: #0e88c5
        }
    </style>


    <script>
        $(document).ready(function() {


            $('#form_bank').submit(function(e) {
                e.preventDefault();
                var me = $(this);

                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {

                        // me[0].reset();
                        if (response.success == true) {
                            alert("Case Generated Successfully!");
                            location.reload();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#menu1').modal('hide');
                            swal.fire({
                                title: "Added",
                                text: "Case has been Generated!",
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            dataTable.ajax.reload();
                            // reset the form
                            // me[0].reset();
                            alert("Case Generated Successfully!");
                            // $('#form-coupons')[0].reset();

                        } else {
                            // prepare error
                            $.each(response.messages, function(key, value) {
                                var element = $('#' + key);
                                element.closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('.text-danger')
                                    .remove();

                                element.after(value);
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        //  swal.fire("Error deleting!", "Please try again later !!!", "error");

                        swal.fire({
                            title: "Error saving...",
                            text: "Please try again later !!!",
                            icon: 'error',
                            type: "error",
                            timer: 3000
                        });
                    }
                });
            });

            $('.fi_to_be_conducted_rv').change(function() {
                if ($('.fi_to_be_conducted_rv:checked').length == 0) {
                    $('#residence_section').addClass('hide');
                } else {
                    $('#residence_section').removeClass('hide');
                }
            });
            $('.fi_to_be_conducted_bv').change(function() {
                if ($('.fi_to_be_conducted_bv:checked').length == 0) {
                    $('#business_section').addClass('hide');
                } else {
                    $('#business_section').removeClass('hide');
                }
            });
            $('#single_agent').on('change', function() {
                is_signle = $("#single_agent").find(":selected").val();
                if (is_signle == 'no') {
                    $('#Second_agent').removeClass('hide');
                } else {
                    $('#Second_agent').addClass('hide');
                }
            });
        });
    </script>
</head>

<body>
    <div class="">
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
        <a href="<?php echo base_url(); ?>home" class="btn btn-info">Dashboard</a>
        <a href="<?php echo base_url(); ?>Create_cse/create_c" class="btn btn-info">Case</a>
        <a href="<?php echo base_url(); ?>Report_controller/report_page_open" class="btn btn-info">Report</a>
        <a href="<?php echo base_url(); ?>Admin_dashboard_controller/admin_dashboard" class="btn btn-info">Admin</a>
    </div>
    <br>

    <div class="container" id="menu1">
        <header>
            <h4>Create Case</h4>
        </header>
        <?php echo form_open('Case_form/create_case_form_submit', array("id" => "form_bank", "class" => "form-horizontal")); ?>
        <div class="row">
            <div class="col-25">
                <label for="bank_name">
                    Bank<span class="text-danger"> *</span>
                </label>
            </div>
            <div class="col-75">
                <select class="form-control" id="bank_name" name="bank_name">
                    <option value="" selected>-- SELECT BANK --</option>
                    <?php foreach ($bank_names as $bank) { ?>
                        <option value="<?= $bank['bank_name']; ?>"><?= $bank['bank_name']; ?></option>
                    <?php } ?>
                </select>

            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="product_name">Product<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <select class="form-control" id="product_name" name="product_name">
                    <option value="" selected>-- SELECT PRODUCT --</option>
                    <?php foreach ($product_data as $product) { ?>
                        <option value="<?= $product['product']; ?>"><?= $product['product']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="fi_to_be_conducted">Fi type<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <input type="checkbox" class="fi_to_be_conducted_rv" name="fi_to_be_conducted[]" value="RV">
                <label for="fi_to_be_conducted"> RV</label>
                <input type="checkbox" class="fi_to_be_conducted_bv" name="fi_to_be_conducted[]" value="BV">
                <label for="fi_to_be_conducted"> BV</label>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="application_id">Reference No.<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <input class="form-control" type="text" id="application_id" name="application_id" placeholder="Enter your Reference Number">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="customer_name">Applicant Name<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <input class="form-control" type="text" id="customer_name" name="customer_name" placeholder="Enter your Applicant Name">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="dob">DOB</label>
            </div>
            <div class="col-75">
                <input class="form-control" id="dob" name="dob" placeholder="start Date and Time" type="date" value="" />
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="amount">Amount<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <input class="form-control" type="number" id="amount" name="amount" placeholder="Enter Amount">
            </div>
        </div>
        <span id="business_section" class="hide">
            <div class="row">
                <div class="col-25">
                    <label for="business_address">Business Add.</label>
                </div>
                <div class="col-75">
                    <input class="form-control" type="text" id="business_address" name="address[]" placeholder="Enter Business Address">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="business_name">Business Name</label>
                </div>
                <div class="col-75">
                    <input class="form-control" type="text" id="business_name" name="name[]" placeholder="Enter Business name">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="city">Business City</label>
                </div>
                <div class="col-75">
                    <input class="form-control" type="text" id="business_city" name="city[]" placeholder="Enter Business City">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="pincode">Business Pincode</label>
                </div>
                <div class="col-75">
                    <input class="form-control" type="number" id="business_pincode" name="pincode[]" placeholder="Enter Business pincode">
                </div>
            </div>
        </span>
        <span id="residence_section" class="hide">
            <div class="row">
                <div class="col-25">
                    <label for="residence_address">Residence Add.</label>
                </div>
                <div class="col-75">
                    <input class="form-control" type="text" id="residence_address" name="address[]" placeholder="Enter Residence Address">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="city">Residence City</label>
                </div>
                <div class="col-75">
                    <input class="form-control" type="text" id="residence_city" name="city[]" placeholder="Enter Residence City">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="pincode">Pincode</label>
                </div>
                <div class="col-75">
                    <input class="form-control" type="number" id="residence_pincode" name="pincode[]" placeholder="Enter Residence pincode">
                </div>
            </div>
        </span>


        <div class="row">
            <div class="col-25">
                <label for="vehicle">Vehicle<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <input class="form-control" type="text" id="vehicle" name="vehicle" placeholder="Enter Vehicle">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="co_applicant">Co-Applicant<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <input class="form-control" type="text" id="co_applicant" name="co_applicant" placeholder="Enter your Co - Applicant Name">
            </div>
        </div>


        <div class="row">
            <div class="col-25">
                <label for="guarantee_name">Guarantee Name<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <input class="form-control" type="text" id="guarantee_name" name="guarantee_name" placeholder="Enter your Guarantee Name">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="single_agent">Signle Agent</label>
            </div>
            <div class="col-75">
                <select class="form-control" id="single_agent" name="single_agent">
                    <!-- <option value="" selected>-- CHOOSE --</option> -->
                    <option value="yes" selected>YES</option>
                    <option value="no">NO</option>
                </select>
            </div>
        </div>


        <div class="row" id="First_agent">
            <div class="col-25">
                <label for="code">RV Agent</label>
            </div>
            <div class="col-75">
                <select class="form-control code" name="agent_1">
                    <option value="" selected>-- SELECT AGENT CODE --</option>
                    <?php foreach ($agent_code as $agent) { ?>
                        <option value="<?= $agent['employee_unique_id']; ?>"><?= $agent['first_name'] . ' - ' . $agent['employee_unique_id']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row hide" id="Second_agent">
            <div class="col-25">
                <label for="code"> BV Agent</label>
            </div>
            <div class="col-75">
                <select class="form-control code" name="agent_2">
                    <option value="" selected>-- SELECT AGENT CODE --</option>
                    <?php foreach ($agent_code as $agent) { ?>
                        <option value="<?= $agent['employee_unique_id']; ?>"><?= $agent['first_name'] . ' - ' . $agent['employee_unique_id']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="geo_limit">Geo Limit<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <select class="form-control" id="geo_limit" name="geo_limit">
                    <option value="" selected>-- SELECT GEO LIMIT --</option>
                    <option value="local">LOCAL</option>
                    <option value="outstation">OUTSTATION</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="tat">TAT<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <select class="form-control" id="tat" name="tat">
                    <option value="" selected>-- SELECT TAT TIME --</option>
                    <option value="00:00">00:00</option>
                    <option value="00:05">00:05</option>
                    <option value="00:10">00:10</option>
                    <option value="00:15">00:15</option>
                    <option value="00:20">00:20</option>
                    <option value="00:25">00:25</option>
                    <option value="00:30">00:30</option>
                    <option value="00:35">00:35</option>
                    <option value="00:40">00:40</option>
                    <option value="00:45">00:45</option>
                    <option value="00:50">00:50</option>
                    <option value="00:55">00:55</option>
                    <option value="01:00">01:00</option>
                    <option value="01:05">01:05</option>
                    <option value="01:10">01:10</option>
                    <option value="01:15">01:15</option>
                    <option value="01:20">01:20</option>
                    <option value="01:25">01:25</option>
                    <option value="01:30">01:30</option>
                    <option value="01:35">01:35</option>
                    <option value="01:40">01:40</option>
                    <option value="01:45">01:45</option>
                    <option value="01:50">01:50</option>
                    <option value="01:55">01:55</option>
                    <option value="02:00">02:00</option>
                    <option value="02:05">02:05</option>
                    <option value="02:10">02:10</option>
                    <option value="02:15">02:15</option>
                    <option value="02:20">02:20</option>
                    <option value="02:25">02:25</option>
                    <option value="02:30">02:30</option>
                    <option value="02:35">02:35</option>
                    <option value="02:40">02:40</option>
                    <option value="02:45">02:45</option>
                    <option value="02:50">02:50</option>
                    <option value="02:55">02:55</option>
                    <option value="03:00">03:00</option>
                    <option value="03:05">03:05</option>
                    <option value="03:10">03:10</option>
                    <option value="03:15">03:15</option>
                    <option value="03:20">03:20</option>
                    <option value="03:25">03:25</option>
                    <option value="03:30">03:30</option>
                    <option value="03:35">03:35</option>
                    <option value="03:40">03:40</option>
                    <option value="03:45">03:45</option>
                    <option value="03:50">03:50</option>
                    <option value="03:55">03:55</option>
                    <option value="04:00">04:00</option>
                    <option value="04:05">04:05</option>
                    <option value="04:10">04:10</option>
                    <option value="04:15">04:15</option>
                    <option value="04:20">04:20</option>
                    <option value="04:25">04:25</option>
                    <option value="04:30">04:30</option>
                    <option value="04:35">04:35</option>
                    <option value="04:40">04:40</option>
                    <option value="04:45">04:45</option>
                    <option value="04:50">04:50</option>
                    <option value="04:55">04:55</option>
                    <option value="05:00">05:00</option>
                    <option value="05:05">05:05</option>
                    <option value="05:10">05:10</option>
                    <option value="05:15">05:15</option>
                    <option value="05:20">05:20</option>
                    <option value="05:25">05:25</option>
                    <option value="05:30">05:30</option>
                    <option value="05:35">05:35</option>
                    <option value="05:40">05:40</option>
                    <option value="05:45">05:45</option>
                    <option value="05:50">05:50</option>
                    <option value="05:55">05:55</option>
                    <option value="06:00">06:00</option>
                    <option value="06:05">06:05</option>
                    <option value="06:10">06:10</option>
                    <option value="06:15">06:15</option>
                    <option value="06:20">06:20</option>
                    <option value="06:25">06:25</option>
                    <option value="06:30">06:30</option>
                    <option value="06:35">06:35</option>
                    <option value="06:40">06:40</option>
                    <option value="06:45">06:45</option>
                    <option value="06:50">06:50</option>
                    <option value="06:55">06:55</option>
                    <option value="07:00">07:00</option>
                    <option value="07:05">07:05</option>
                    <option value="07:10">07:10</option>
                    <option value="07:15">07:15</option>
                    <option value="07:20">07:20</option>
                    <option value="07:25">07:25</option>
                    <option value="07:30">07:30</option>
                    <option value="07:35">07:35</option>
                    <option value="07:40">07:40</option>
                    <option value="07:45">07:45</option>
                    <option value="07:50">07:50</option>
                    <option value="07:55">07:55</option>
                    <option value="08:00">08:00</option>
                    <option value="08:05">08:05</option>
                    <option value="08:10">08:10</option>
                    <option value="08:15">08:15</option>
                    <option value="08:20">08:20</option>
                    <option value="08:25">08:25</option>
                    <option value="08:30">08:30</option>
                    <option value="08:35">08:35</option>
                    <option value="08:40">08:40</option>
                    <option value="08:45">08:45</option>
                    <option value="08:50">08:50</option>
                    <option value="08:55">08:55</option>
                    <option value="09:00">09:00</option>
                    <option value="09:05">09:05</option>
                    <option value="09:10">09:10</option>
                    <option value="09:15">09:15</option>
                    <option value="09:20">09:20</option>
                    <option value="09:25">09:25</option>
                    <option value="09:30">09:30</option>
                    <option value="09:35">09:35</option>
                    <option value="09:40">09:40</option>
                    <option value="09:45">09:45</option>
                    <option value="09:50">09:50</option>
                    <option value="09:55">09:55</option>
                    <option value="10:00">10:00</option>
                    <option value="10:05">10:05</option>
                    <option value="10:10">10:10</option>
                    <option value="10:15">10:15</option>
                    <option value="10:20">10:20</option>
                    <option value="10:25">10:25</option>
                    <option value="10:30">10:30</option>
                    <option value="10:35">10:35</option>
                    <option value="10:40">10:40</option>
                    <option value="10:45">10:45</option>
                    <option value="10:50">10:50</option>
                    <option value="10:55">10:55</option>
                    <option value="11:00">11:00</option>
                    <option value="11:05">11:05</option>
                    <option value="11:10">11:10</option>
                    <option value="11:15">11:15</option>
                    <option value="11:20">11:20</option>
                    <option value="11:25">11:25</option>
                    <option value="11:30">11:30</option>
                    <option value="11:35">11:35</option>
                    <option value="11:40">11:40</option>
                    <option value="11:45">11:45</option>
                    <option value="11:50">11:50</option>
                    <option value="11:55">11:55</option>
                    <option value="12:00">12:00</option>
                    <option value="12:05">12:05</option>
                    <option value="12:10">12:10</option>
                    <option value="12:15">12:15</option>
                    <option value="12:20">12:20</option>
                    <option value="12:25">12:25</option>
                    <option value="12:30">12:30</option>
                    <option value="12:35">12:35</option>
                    <option value="12:40">12:40</option>
                    <option value="12:45">12:45</option>
                    <option value="12:50">12:50</option>
                    <option value="12:55">12:55</option>
                    <option value="13:00">13:00</option>
                    <option value="13:05">13:05</option>
                    <option value="13:10">13:10</option>
                    <option value="13:15">13:15</option>
                    <option value="13:20">13:20</option>
                    <option value="13:25">13:25</option>
                    <option value="13:30">13:30</option>
                    <option value="13:35">13:35</option>
                    <option value="13:40">13:40</option>
                    <option value="13:45">13:45</option>
                    <option value="13:50">13:50</option>
                    <option value="13:55">13:55</option>
                    <option value="14:00">14:00</option>
                    <option value="14:05">14:05</option>
                    <option value="14:10">14:10</option>
                    <option value="14:15">14:15</option>
                    <option value="14:20">14:20</option>
                    <option value="14:25">14:25</option>
                    <option value="14:30">14:30</option>
                    <option value="14:35">14:35</option>
                    <option value="14:40">14:40</option>
                    <option value="14:45">14:45</option>
                    <option value="14:50">14:50</option>
                    <option value="14:55">14:55</option>
                    <option value="15:00">15:00</option>
                    <option value="15:05">15:05</option>
                    <option value="15:10">15:10</option>
                    <option value="15:15">15:15</option>
                    <option value="15:20">15:20</option>
                    <option value="15:25">15:25</option>
                    <option value="15:30">15:30</option>
                    <option value="15:35">15:35</option>
                    <option value="15:40">15:40</option>
                    <option value="15:45">15:45</option>
                    <option value="15:50">15:50</option>
                    <option value="15:55">15:55</option>
                    <option value="16:00">16:00</option>
                    <option value="16:05">16:05</option>
                    <option value="16:10">16:10</option>
                    <option value="16:15">16:15</option>
                    <option value="16:20">16:20</option>
                    <option value="16:25">16:25</option>
                    <option value="16:30">16:30</option>
                    <option value="16:35">16:35</option>
                    <option value="16:40">16:40</option>
                    <option value="16:45">16:45</option>
                    <option value="16:50">16:50</option>
                    <option value="16:55">16:55</option>
                    <option value="17:00">17:00</option>
                    <option value="17:05">17:05</option>
                    <option value="17:10">17:10</option>
                    <option value="17:15">17:15</option>
                    <option value="17:20">17:20</option>
                    <option value="17:25">17:25</option>
                    <option value="17:30">17:30</option>
                    <option value="17:35">17:35</option>
                    <option value="17:40">17:40</option>
                    <option value="17:45">17:45</option>
                    <option value="17:50">17:50</option>
                    <option value="17:55">17:55</option>
                    <option value="18:00">18:00</option>
                    <option value="18:05">18:05</option>
                    <option value="18:10">18:10</option>
                    <option value="18:15">18:15</option>
                    <option value="18:20">18:20</option>
                    <option value="18:25">18:25</option>
                    <option value="18:30">18:30</option>
                    <option value="18:35">18:35</option>
                    <option value="18:40">18:40</option>
                    <option value="18:45">18:45</option>
                    <option value="18:50">18:50</option>
                    <option value="18:55">18:55</option>
                    <option value="19:00">19:00</option>
                    <option value="19:05">19:05</option>
                    <option value="19:10">19:10</option>
                    <option value="19:15">19:15</option>
                    <option value="19:20">19:20</option>
                    <option value="19:25">19:25</option>
                    <option value="19:30">19:30</option>
                    <option value="19:35">19:35</option>
                    <option value="19:40">19:40</option>
                    <option value="19:45">19:45</option>
                    <option value="19:50">19:50</option>
                    <option value="19:55">19:55</option>
                    <option value="20:00">20:00</option>
                    <option value="20:05">20:05</option>
                    <option value="20:10">20:10</option>
                    <option value="20:15">20:15</option>
                    <option value="20:20">20:20</option>
                    <option value="20:25">20:25</option>
                    <option value="20:30">20:30</option>
                    <option value="20:35">20:35</option>
                    <option value="20:40">20:40</option>
                    <option value="20:45">20:45</option>
                    <option value="20:50">20:50</option>
                    <option value="20:55">20:55</option>
                    <option value="21:00">21:00</option>
                    <option value="21:05">21:05</option>
                    <option value="21:10">21:10</option>
                    <option value="21:15">21:15</option>
                    <option value="21:20">21:20</option>
                    <option value="21:25">21:25</option>
                    <option value="21:30">21:30</option>
                    <option value="21:35">21:35</option>
                    <option value="21:40">21:40</option>
                    <option value="21:45">21:45</option>
                    <option value="21:50">21:50</option>
                    <option value="21:55">21:55</option>
                    <option value="22:00">22:00</option>
                    <option value="22:05">22:05</option>
                    <option value="22:10">22:10</option>
                    <option value="22:15">22:15</option>
                    <option value="22:20">22:20</option>
                    <option value="22:25">22:25</option>
                    <option value="22:30">22:30</option>
                    <option value="22:35">22:35</option>
                    <option value="22:40">22:40</option>
                    <option value="22:45">22:45</option>
                    <option value="22:50">22:50</option>
                    <option value="22:55">22:55</option>
                    <option value="23:00">23:00</option>
                    <option value="23:05">23:05</option>
                    <option value="23:10">23:10</option>
                    <option value="23:15">23:15</option>
                    <option value="23:20">23:20</option>
                    <option value="23:25">23:25</option>
                    <option value="23:30">23:30</option>
                    <option value="23:35">23:35</option>
                    <option value="23:40">23:40</option>
                    <option value="23:45">23:45</option>
                    <option value="23:50">23:50</option>
                    <option value="23:55">23:55</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="remarks">Remarks<span class="text-danger"> *</span></label>
            </div>
            <div class="col-75">
                <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks" type="text"></textarea>
            </div>
        </div>

        <br>

        <div class="row">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>

        <?php echo form_close(); ?>

    </div>


</body>



</html>