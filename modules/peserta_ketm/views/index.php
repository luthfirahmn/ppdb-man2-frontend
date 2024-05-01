<section class="content">
    <div class="alert alert-danger notif-msg" style="display:none"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $template['title'] ?></h3>
                        <span class="float-right">Download Data<br><a href="<?php echo base_url('peserta_ketm/export_data/3') ?>" class="btn btn-primary"> <i class="fa fa-download"></i> Download Data</a></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="pull-left">
                        </div>
                        <table id="example1" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>NISN</th>
                                    <th>NO WA</th>
                                    <th>Nama Peserta</th>
                                    <th>Jalur Pilihan</th>
                                    <th>Status Penilaian</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>