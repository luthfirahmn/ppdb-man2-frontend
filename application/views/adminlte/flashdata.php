<?php 
$error = $this->session->flashdata('error'); 
$success = $this->session->flashdata('success'); 
if($error != '' || $success != ''){
?>
<div class="row">
    <div class="col-md-12">
        <div class="alert <?php echo $error != '' ? 'alert-danger' : 'alert-success'; ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas <?php echo $error != '' ? 'fa-ban': 'fa-check'; ?>"></i> Information!</h5>
            <?php echo $error != '' ? $error : $success; ?>
        </div>
    </div>
</div>
<?php 
}
?>