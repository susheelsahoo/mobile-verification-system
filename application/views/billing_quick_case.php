<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Report Mini Case</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">
        BASE_URL = "<?php echo base_url(); ?>"
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>
    <script>
        $(document).ready(function() {
            var dataTable = $('#fetch_reassign_mini_case_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "ajax": {
                    url: "<?php echo base_url() . 'Reassign_mini_case_controller/fetch_all_transferedMiniCases'; ?>",
                    type: "POST",
                },

                columnDefs: [{
                    "defaultContent": "-",
                    "targets": [1, 8],
                    "orderable": false
                }],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
            });
 });
 
 

 
    </script>
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
            height: 625px;
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
        
        
        
        
     .multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#banknamecheckboxes {
  display: none;
  border: 1px #dadada solid;
}

#banknamecheckboxes label {
  display: block;
}

#banknamecheckboxes label:hover {
  background-color: #1e90ff;
} 

#productcheckboxes {
  display: none;
  border: 1px #dadada solid;
}

#productcheckboxes label {
  display: block;
}

#productcheckboxes label:hover {
  background-color: #1e90ff;
} 

#fitypecheckboxes {
  display: none;
  border: 1px #dadada solid;
}

#fitypecheckboxes label {
  display: block;
}

#fitypecheckboxes label:hover {
  background-color: #1e90ff;
} 



#downloadfieldcheckboxes {
  display: none;
  border: 1px #dadada solid;
}

#downloadfieldcheckboxes label {
  display: block;
}

#downloadfieldcheckboxes label:hover {
  background-color: #1e90ff;
} 

#agentcheckboxes {
  display: none;
  border: 1px #dadada solid;
}

#agentcheckboxes label {
  display: block;
}

#agentcheckboxes label:hover {
  background-color: #1e90ff;
} 
    </style>

    <div class="container">
        <div class="page-header-inner">
            <div class="col-md-4 col-sm-6">
                <div class="row">
                    <div id="dvTitle" class="product_name">
                        <h3><b>RealBits Coders</b></h3>
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
   
     <div class="container">
        <div class="row">
            <form method="post"  id="filterform"  action="<?= base_url() ?>Billing_quick_controller/downloadReport">
            <div class="input-daterange">
                <div class="col-md-3">
                    <!-- <label for="start">From date:</label> -->
                    <input type="date" name="from_date" id="from_date" class="form-control" placeholder="FROM DATE">
                </div>

                <div class="col-md-3">
                    <!-- <label for="start">To date:</label> -->
                    <input type="date" name="to_date" id="to_date" class="form-control" placeholder="TO DATE">
                </div>
                <div class="col-md-3">
                <div class="multiselect">
                <div class="selectBox" onclick="showCheckboxes('Bankname')">
                  <select>
                    <option>Select Bank</option>
                  </select>
                  <div class="overSelect"></div>
                </div>
                <div id="banknamecheckboxes" name="checkboxes">
                   <label for="one"> <input type="checkbox" id="select_allbank" value="">Check ALL</label>
                    <?php $this->val1 =$this->db->query("Select * from add_bank "); 
                    foreach($this->val1->result_array() as $rows){ ?>
                  <label for="one">
                      <input type="checkbox" id="one" name="bankname[]" value="<?php echo $rows['bank_name']?>"/><?php echo $rows['bank_name']?></label>
                    <?php } ?>
                </div>
              </div>
               </div>
                
                
                <div class="col-md-3">
                <div class="multiselect">
                <div class="selectBox" onclick="showCheckboxes('Product')">
                  <select>
                    <option>Select Product</option>
                  </select>
                  <div class="overSelect"></div>
                </div>
                <div id="productcheckboxes" name="checkboxes">
                   <label for="one"> <input type="checkbox" id="select_allproduct">Check All</label>
                    <?php $this->val =$this->db->query("Select * from add_product "); 
                    foreach($this->val->result_array() as $row){ ?>
                  <label for="one">
                      <input type="checkbox" id="one" name="product[]" value="<?php echo $row['product']?>"/><?php echo $row['product']?></label>
                    <?php } ?>
                </div>
              </div>
               </div>
                
                
                
                 <div class="col-md-3">
                <div class="multiselect">
                <div class="selectBox" onclick="showCheckboxes('Agent')">
                  <select>
                    <option>Select Agent</option>
                  </select>
                  <div class="overSelect"></div>
                </div>
                <div id="agentcheckboxes" name="checkboxes">
                   <label for="one"> <input type="checkbox" id="select_allagent">Check All</label>
                    <?php $this->val =$this->db->query("Select * from login "); 
                    foreach($this->val->result_array() as $row){ ?>
                  <label for="one">
                      <input type="checkbox" id="one" name="agent[]" value="<?php echo $row['employee_unique_id']?>"/><?php echo $row['first_name']?></label>
                    <?php } ?>
                </div>
              </div>
               </div>
                
                
                <div class="col-md-3">
                <div class="multiselect">
                <div class="selectBox" onclick="showCheckboxes('FItype')">
                  <select>
                    <option>Select FI Type</option>
                  </select>
                  <div class="overSelect"></div>
                </div>
                <div id="fitypecheckboxes" name="checkboxes">
                   <label for="one"> <input type="checkbox" id="select_allfitype">Check All</label> 
                  <label for="one">
                      <input type="checkbox" id="one" name="FItype[]" value="RV"/>RV</label>
                    <label for="one">   <input type="checkbox" id="one" name="FItype[]" value="BV"/>BV</label>
                   
                </div>
              </div>
               </div>
                
                
                
                
               <div class="col-md-3">
                <div class="multiselect">
                <div class="selectBox" onclick="showCheckboxes('downloadfield')">
                  <select>
                    <option>Fields To be Downloaded</option>
                  </select>
                  <div class="overSelect"></div>
                </div>
                <div id="downloadfieldcheckboxes" name="checkboxes">
                    <label for="one"> <input type="checkbox" id="select_alldownload"> Check All</label>
                    <label for="one">
                   <input type="checkbox" id="one" name="download[]" value="bank_name"/> Bank</label> 
                   <label for="one">
                   <input type="checkbox" id="one" name="download[]" value="customer_name"/> Applicant name</label> 
                   <label for="one">
                   <input type="checkbox" id="one" name="download[]" value="product_name"/> Product</label> 
                   <label for="one">
                   <input type="checkbox" id="one" name="download[]" value="business_address"/> Business Address</label> 
                    <label for="one">   
                    <input type="checkbox" id="one" name="download[]" value="city"/> City </label>
                    <label for="one">   
                    <input type="checkbox" id="one" name="download[]" value="pincode"/> Res pincode</label>
                    <label for="one">   
                    <input type="checkbox" id="one" name="download[]" value="business_name"/> Business name</label>
                    <label for="one">
                   <input type="checkbox" id="one" name="download[]" value="rv_fi_status"/> RV FI Status</label> 
                   <label for="one">
                   <input type="checkbox" id="one" name="download[]" value="amount"/> Amount</label> 

                   <label for="one">
                   <input type="checkbox" id="one" name="download[]" value="code"/> Agent</label> 
                    <label for="one">
                   <input type="checkbox" id="one" name="download[]" value="source_channel"/> Source Channel</label> 
                    
                </div>
              </div>
               </div>
                
              
                

                <div class="col-md-5">
                    <input type="submit" name="filter" id="filter" value="DOWNLOAD" class="btn btn-primary" />
                </div>
            </div>
               
            
            </form>
        </div>
    </div>
     <h2> <?=$this->session->flashdata('msg');?></h2> 
    <!-- <label>From</label>
    <input type="text" name="from" id="from" required value="<?php echo date("Y-m-d"); ?>">
    <label>To</label>
    <input type="text" name="to" id="to" required value="<?php echo date("Y-m-d"); ?>">
    <button class="btn btn-warning " name="sub_btn" id="sub_btn"> GET </button> -->


    <script>
        var expanded = false;

function showCheckboxes(val) {
    if(val=='Bankname'){
        var field="banknamecheckboxes";
    }
     if(val=='Product'){
        var field="productcheckboxes";
    }
     if(val=='FItype'){
        var field="fitypecheckboxes";
    }
    if(val=='downloadfield'){
        var field="downloadfieldcheckboxes";
    }
    if(val=='Agent'){
        var field="agentcheckboxes";
    }
        

    
  var checkboxes = document.getElementById(field);
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
    </script>  
    
    
    <script>
 $("#select_allbank").click(function () {
     $("input[name='bankname[]']").not(this).prop('checked', this.checked);
}); 

 $("#select_allproduct").click(function () {
     $("input[name='product[]']").not(this).prop('checked', this.checked);
}); 

 $("#select_allfitype").click(function () {
     $("input[name='FItype[]']").not(this).prop('checked', this.checked);
}); 

 $("#select_alldownload").click(function () {
     $("input[name='download[]']").not(this).prop('checked', this.checked);
});

 $("#select_allagent").click(function () {
     $("input[name='agent[]']").not(this).prop('checked', this.checked);
}); 
 </script>