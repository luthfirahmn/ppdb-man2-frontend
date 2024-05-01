<style>
    .left-col {
        float: left;
        width: 50%;
    }

    .center-col {
        float: left;
        width: 50%;
    }

    .right-col {
        float: left;
        width: 50%;
    }
</style>

<section class="content">
    <div class="alert alert-danger notif-msg" style="display:none"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Pengaturan</h3><br><br>
                        <span class="float-left mr-1">Upload & Preview Penilaian
                            <br>
                            <input type="file" class="form-control" name="upload_nilai" id="upload_nilai">
                        </span>
                        <span class="float-left ">Download Template<br><a href="<?php echo base_url('penilaian_btq/download_template') ?>" class="btn btn-primary"> <i class="fa fa-download"></i> Download Template</a></span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="alert alert-info alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <h5><i class="icon fas fa-info"></i> Cara penilaian</h5>
                    1.Download Template untuk memasukan nisn dan status kelulusan
                    2.Upload file di bagian "Upload & Preview"
                    3.Pada tabel di bawah akan tersedia preview untuk melihat kembali data peserta dan status yang di upload
                    4.Klik tombol "Selesai & Nilai" setelah selesai di cek/review
                    *Tombol reset berefungsi untuk membatalkan proses penilaian
                </div>
            </div>
            <div class="col-6">
                <div class="alert alert-info alert-dismissible">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <h5><i class="icon fas fa-info"></i> Kode Penilaian</h5>
                    Beri status "L" untuk peserta yang lulus<br>
                    Beri status "TL" untuk peserta yang tidak lulus<br>
                    Beri status kosong untuk peserta yang belum dinilai
                </div>
            </div>

            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title"><?php echo $template['title'] ?></h3>
                        <span class="float-right">
                            <span class="float-right mr-1"><button type="button" id="penilaian" class="btn btn-primary"> <i class="fa fa-check"></i> Selesai & Nilai</button></span>
                        </span>
                        <span class="float-right mr-1"><button type="button" id="reset_hasil" class="btn btn-danger"> <i class="fa fa-ban"></i> Reset</button></span>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="pull-left">

                        </div>
                        <table id="example" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>NO WA</th>
                                    <th>Nama Peserta</th>
                                    <th>Jalur Pilihan</th>
                                    <th>Status Penilaian (Sementara)</th>
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