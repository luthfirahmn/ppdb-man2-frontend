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
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ParamVariable</label>
                                <div class="col-sm-10">
                                    <input type="text" name='ParamVariable' class="form-control" value="<?= isset($all_data['ParamVariable']) ? $all_data['ParamVariable'] : '' ?>" placeholder="Enter ParamVariable">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ParamID</label>
                                <div class="col-sm-10">
                                    <input type="text" name='ParamID' class="form-control" value="<?= isset($all_data['ParamID']) ? $all_data['ParamID'] : '' ?>" placeholder="Enter ParamID">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ParamValue</label>
                                <div class="col-sm-10">
                                    <input type="text" name='ParamValue' class="form-control" value="<?= isset($all_data['ParamValue']) ? $all_data['ParamValue'] : '' ?>" placeholder="Enter ParamValue">
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