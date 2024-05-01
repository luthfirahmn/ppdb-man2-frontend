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
                        <input type="hidden" name="status_form" id="status_form" value="<?= $status_form ?>">
                        <input type="hidden" name="DID" id="DID" value="<?= isset($DID) ? $DID : 0 ?>">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Menu Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name='Menu' class="form-control" value="<?= isset($all_data['Menu']) ? $all_data['Menu'] : '' ?>" placeholder="Enter Menu Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Parent Menu</label>
                                <div class="col-sm-10">
                                    <?= form_dropdown("", $parents_menu, isset($all_data["ParentID"]) ? $all_data["ParentID"] : 0, "class=\"form-control\" data-placeholder=\"--Choose Options--\" id=\"ParentID\" name=\"ParentID\" ") ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Menu File</label>
                                <div class="col-sm-10">
                                    <input type="text" name='MenuFile' class="form-control" value="<?= isset($all_data['MenuFile']) ? $all_data['MenuFile'] : '' ?>" placeholder="Enter Menu File">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Icon Menu</label>
                                <div class="col-sm-10">
                                    <input type="text" name='Icon' class="form-control" value="<?= isset($all_data['Icon']) ? $all_data['Icon'] : '' ?>" placeholder="Enter Icon Menu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Order By</label>
                                <div class="col-sm-10">
                                    <input type="text" name='OrderNo' class="form-control" value="<?= isset($all_data['OrderNo']) ? $all_data['OrderNo'] : '' ?>" placeholder="Enter Order By">
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-actions form-group">
                                    <a href="<?= base_url() ?><?= $this->uri->segment(1) ?>" class="btn btn-danger float-right">Cancel</a>
                                    <button type="button" style=" margin-right : 6px;" class="btn btn-primary float-right" onclick="SaveForm()"><i class="fa fa-check"></i> Save </button>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>