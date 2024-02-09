<section class="horizontal-wizard">
    <div class="bs-stepper horizontal-wizard-example">
        <div class="bs-stepper-header">
            <div class="step" id="step-data-diri" data-target="#data-diri">
                <button type="button" class="step-trigger">
                    <!-- <span class="bs-stepper-box">1</span> -->
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Data Diri</span>
                        <span class="bs-stepper-subtitle">Isi data diri untuk mendapatkan kartu ujian BTQ</span>
                    </span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">

            <form id='form-data-diri'>
                <div id="data-diri" class="content active">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nisn">NISN</label>
                            <input type="text" name="nisn" id="nisn" class="form-control"
                                value="<?php echo $siswa['nisn'] ?>" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                value="<?php echo $siswa['nama_lengkap'] ?>" class="form-control" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo $siswa['email'] ?>"
                                class="form-control" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="no_wa">No Whatsapp</label>
                            <input type="text" name="no_wa" id="no_wa" value="<?php echo '0' . $siswa['no_wa'] ?>"
                                class="form-control" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control"
                                value="<?php echo $siswa['tgl_lahir'] ?>" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <h5 class="mt-1 mb-1">Alamat</h5>
                    <div class="row">


                        <div class="form-group col-md-6">
                            <label class="form-label" for="provinsi">Provinsi</label>
                            <input type="text" name="provinsi" id="provinsi" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="kota">Kota</label>
                            <input type="text" name="kota" id="kota" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="kecamatan">Kecamatan</label>
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="kelurahan">Kelurahan</label>
                            <input type="text" name="kelurahan" id="kelurahan" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="rt">RT</label>
                            <input type="text" name="rt" id="rt" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="rw">RW</label>
                            <input type="text" name="rw" id="rw" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" />
                        </div>

                    </div>

                    <h5 class="mt-1 mb-1">Asal Sekolah</h5>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control" />
                        </div>
                    </div>

                    <h5 class="mt-1 mb-1">Data Orang Tua</h5>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_ayah">Nama Ayah</label>
                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="no_hp_ayah">No HP Ayah</label>
                            <input type="text" name="no_hp_ayah" id="no_hp_ayah" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="pekerjaan_ayah">Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control" />
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_ibu">Nama Ibu</label>
                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="no_hp_ibu">No HP Ibu</label>
                            <input type="text" name="no_hp_ibu" id="no_hp_ibu" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="pekerjaan_ibu">Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control" />
                        </div>
                    </div>


                    <div class="d-flex justify-content-between">
                        <span class="text-danger"> Mohon isi dengan teliti </span>
                        <button class="btn btn-primary " type="submit">
                            <span class="align-middle d-sm-inline-block d-none">Selesai</span>
                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                        </button>
                    </div>
                </div>
            </form>
            <button class="btn-next" id="btn-next-data-diri" style="display: none;"> </button>
        </div>
    </div>
</section>

<?php include 'js.php'; ?>
