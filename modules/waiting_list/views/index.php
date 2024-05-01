<section class="content">
    <div class="alert alert-danger notif-msg" style="display:none"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Cari Peserta</h3><br><br>
                        <span class="float-left mr-1">NISN
                            <br>
                            <input type="text" class="form-control" name="nisn" id="nisn">
                        </span>
                        <span class="float-left mb-4"><br><button type="button" class="btn btn-primary" id="cari_peserta"> <i class="fa fa-search"></i></button></span>
                        <div id="aksi">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $template['title'] ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="pull-left">

                        </div>
                        <table id="example1" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Urutan Waiting List</th>
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