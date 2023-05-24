<?php
$res_data = [];
if ($this->session->flashdata('res_data')) {
    $res_data = $this->session->flashdata('res_data');
    // unset($_SESSION['res_data']);
?>

    <div class="alert alert-<?php echo $res_data['type'] ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $res_data['massege']; ?>
    </div>
<?php
}

?>


<script>
    setTimeout(function() {
        $(".alert-dismissible").hide();
    }, 5000);
</script>