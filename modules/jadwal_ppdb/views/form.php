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
                        <input type="hidden" name="id" id="id" value="<?= isset($id) ? $id : 0 ?>">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Urutan</label>
                                <div class="col-sm-10">
                                    <input type="number" name='order_no' class="form-control" value="<?= isset($all_data['order_no']) ? $all_data['order_no'] : '' ?>" placeholder="Masukan Urutan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Title Jadwal</label>
                                <div class="col-sm-10">
                                    <input type="text" name='jadwal' class="form-control" value="<?= isset($all_data['jadwal']) ? $all_data['jadwal'] : '' ?>" placeholder="Masukan Jadwal">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu</label>
                                <div class="col-sm-10">
                                    <input type="date" name='waktu' class="form-control" value="<?= isset($all_data['waktu']) ? date('Y-m-d', strtotime($all_data['waktu'])) : '' ?>" placeholder="Masukan Waktu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="desc">
                                    <?= isset($all_data['desc']) ? $all_data['desc'] : '' ?>
                                   </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label required">Tombol Login</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="btn_login">

                                        <?php
                                        if ($all_data['btn_login'] == '1') {
                                            echo '<option value="1">Aktif</option>';
                                        } else {
                                            echo '<option value="0">Tidak Aktif</option>';
                                        }
                                        ?>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label required">Tombol Daftar</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="btn_daftar">

                                        <?php
                                        if ($all_data['btn_daftar'] == '1') {
                                            echo '<option value="1">Aktif</option>';
                                        } else {
                                            echo '<option value="0">Tidak Aktif</option>';
                                        }
                                        ?>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label required">Tombol Alur</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="btn_alur">

                                        <?php
                                        if ($all_data['btn_alur'] == '1') {
                                            echo '<option value="1">Aktif</option>';
                                        } else {
                                            echo '<option value="0">Tidak Aktif</option>';
                                        }
                                        ?>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
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