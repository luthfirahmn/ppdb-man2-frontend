<section class="content">
    <div class="container-fluid">
        <div class="alert alert-danger error-msg" style="display:none"></div>
        <div class="row">

            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $template['title'] ?></h3>
                    </div>
                    <form class="form-horizontal " method="post" enctype="multipart/form-data" id="formadd">
                        <div class="card-body">
                            <!-- <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Parent Category</label>
                                <div class="col-sm-10">
                                    <select name='ParentCategoryID' class="form-control">
                                        <option value="0">Make Parent</option>
                                        <?php categoryTree() ?>
                                    </select>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name='Email' class="form-control" value="<?= isset($all_data['Email']) ? $all_data['Email'] : '' ?>" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" name='Password' class="form-control" value="<?= isset($all_data['Password']) ? $all_data['Password'] : '' ?>" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">LastLogin</label>
                                <div class="col-sm-10">
                                    <input type="text" name='LastLogin' class="form-control" value="<?= isset($all_data['LastLogin']) ? $all_data['LastLogin'] : '' ?>" placeholder="Enter LastLogin">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">SessiionExpiry</label>
                                <div class="col-sm-10">
                                    <input type="text" name='SessionExpiry' class="form-control" value="<?= isset($all_data['SessionExpiry']) ? $all_data['SessionExpiry'] : '' ?>" placeholder="Enter SessiionExpiry">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">RememberMe</label>
                                <div class="col-sm-10">
                                    <input type="text" name='RememberMe' class="form-control" value="<?= isset($all_data['RememberMe']) ? $all_data['RememberMe'] : '' ?>" placeholder="Enter RememberMe">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ResetPass</label>
                                <div class="col-sm-10">
                                    <input type="text" name='ResetPass' class="form-control" value="<?= isset($all_data['ResetPass']) ? $all_data['ResetPass'] : '' ?>" placeholder="Enter ResetPass">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">CodeOTP</label>
                                <div class="col-sm-10">
                                    <input type="text" name='CodeOTP' class="form-control" value="<?= isset($all_data['CodeOTP']) ? $all_data['CodeOTP'] : '' ?>" placeholder="Enter CodeOTP">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">EmpID</label>
                                <div class="col-sm-10">
                                    <input type="text" name='EmpID' class="form-control" value="<?= isset($all_data['EmpID']) ? $all_data['EmpID'] : '' ?>" placeholder="Enter EmpID">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">AdminPanel</label>
                                <div class="col-sm-10">
                                    <input type="text" name='AdminPanel' class="form-control" value="<?= isset($all_data['AdminPanel']) ? $all_data['AdminPanel'] : '' ?>" placeholder="Enter AdminPanel">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">AppToken</label>
                                <div class="col-sm-10">
                                    <input type="text" name='AppToken' class="form-control" value="<?= isset($all_data['AppToken']) ? $all_data['AppToken'] : '' ?>" placeholder="Enter AppToken">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Active</label>
                                <div class="col-sm-10">
                                    <input type="text" name='Active' class="form-control" value="<?= isset($all_data['Active']) ? $all_data['Active'] : '' ?>" placeholder="Enter Active">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-actions form-group">
                                    <a href="<?= base_url("/UserLogin/index") ?>" class="btn btn-danger float-right">Cancel</a>
                                    <button type="button" style=" margin-right : 6px;" id="save" name="save" class="btn btn-primary float-right save"><i class="fa fa-check"></i> Save </button>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- update -->
<script>
    //ajax add
    $('#save').on('click', function() {
        <?php if ($status_form == 0) : ?>
            var link = '<?php echo base_url('UserLogin/add') ?>';
        <?php else : ?>
            var link = '<?php echo base_url() ?>UserLogin/edit/<?php echo $all_data['DID'] ?>';
            var form =
            <?php endif; ?>
            $.ajax({
                type: "post",
                url: link,
                data: new FormData($('#formadd')[0]),
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.save').attr('disable', 'disabled');
                    $('.save').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.save').removeAttr('disable');
                    $('.save').html('<i class="ti-save"> </i> Save');
                },
                success: function(data) {
                    if (data.error == false) {
                        swal.fire({
                            title: "Success",
                            text: data.msg,
                            type: "success"
                        }).then(function() {
                            window.location.href = "<?php echo base_url('UserLogin') ?>";
                        });
                    } else {
                        $(".error-msg").css('display', 'block');
                        $(".error-msg").html(data.msg);
                        window.scrollTo(0, 0)
                    }
                },

            });
    });
</script>