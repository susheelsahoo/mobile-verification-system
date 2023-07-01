<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/theme1.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- <link rel="Stylesheet" type="text/css" href="assets/global/plugins/bootstrap/css/bootstrap.min.css" /> -->
    <title>Banking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css"> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

    <script type="text/javascript">
        BASE_URL = "<?php echo base_url(); ?>"
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>


<h4>Please upload image with 300px height and 300px width, otherwise the image may not upload properly.</h4><br>
<h4>To resize the image, follow this  <a href="https://imageresizer.com/">link</a></h4>

<div class="container">
    <br>
    <div class="row">
        <form action="<?php echo base_url('assign_case_controller/upload_images/'.$uf_data['id']);?>" method="post" enctype="multipart/form-data">
            <div class = "col-md-6">
                <label for="file">Image 1</label>
                <input type="file" name="image_1" class="form-control" <?php echo (isset($uf_data['rv_image1']) && !empty($uf_data['rv_image1'])) ? "disabled":""?>>
            </div>
            <div class = "col-md-6">
                <label for="file">Image 2</label>
                <input type="file" name="image_2" class="form-control" <?php echo (isset($uf_data['rv_image2']) && !empty($uf_data['rv_image2'])) ? "disabled":""?>>
            </div>
            <div class = "col-md-6">
                <label for="file">Image 3</label>
                <input type="file" name="image_3" class="form-control" <?php echo (isset($uf_data['rv_image3']) && !empty($uf_data['rv_image3'])) ? "disabled":""?>>
            </div>
            <div class = "col-md-6">
                <label for="file">Image 4</label>
                <input type="file" name="image_4" class="form-control" <?php echo (isset($uf_data['rv_image4']) && !empty($uf_data['rv_image4'])) ? "disabled":""?>>
            </div>
            <div class = "col-md-6">
                <label for="file">Image 5</label>
                <input type="file" name="image_5" class="form-control" <?php echo (isset($uf_data['rv_image5']) && !empty($uf_data['rv_image5'])) ? "disabled":""?>>
            </div>
            <div class = "col-md-6">
                <label for="file">Image 6</label>
                <input type="file" name="image_6" class="form-control" <?php echo (isset($uf_data['rv_image6']) && !empty($uf_data['rv_image6'])) ? "disabled":""?>>
            </div>
            <div class = "col-md-6">
                <label for="file">Image 7</label>
                <input type="file" name="image_7" class="form-control" <?php echo (isset($uf_data['rv_image7']) && !empty($uf_data['rv_image7'])) ? "disabled":""?>>
            </div>
            <div class = "col-md-6">
                <label for="file">Image 8</label>
                <input type="file" name="image_8" class="form-control" <?php echo (isset($uf_data['rv_image8']) && !empty($uf_data['rv_image8'])) ? "disabled":""?>>
            </div>
            <div class = "col-md-6">
                <label for="file">Image 9</label>
                <input type="file" name="image_9" class="form-control" <?php echo (isset($uf_data['rv_image9']) && !empty($uf_data['rv_image9'])) ? "disabled":""?>>
            </div><br>
            <div class = "col-md-6">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>


</body>

</html>