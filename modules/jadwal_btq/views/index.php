<section class="content">
    <div class="alert alert-danger notif-msg" style="display:none"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $template['title'] ?></h3>
                        <span class="float-right ml-3">Filter Tanggal <input class="form-control" type="date" name="filter_tanggal" id="filter_tanggal"></span>
                        <span class="float-right">Download Data<br><button type="button" id="btn-download" class="btn btn-primary">Download Data</span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="pull-left">

                        </div>
                        <table id="example1" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>NO WA</th>
                                    <th>Nama Peserta</th>
                                    <th>Jam</th>
                                    <th>Tanggal</th>
                                    <th>Ruangan</th>
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