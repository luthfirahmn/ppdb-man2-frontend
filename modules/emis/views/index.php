<section class="horizontal-wizard">
    <div class="bs-stepper horizontal-wizard-example">
        <div class="bs-stepper-header">
            <div class="step" id="step-jalur" onclick="switchPage('jalur')">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">1</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Pilih Jalur</span>
                        <span class="bs-stepper-subtitle">Pilihan Jalur Pendaftaran</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" id="step-data-diri" onclick="switchPage('dataDiri')">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Data Diri</span>
                        <span class="bs-stepper-subtitle">Isi Data Diri</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" id="step-alamat" onclick="switchPage('alamat')">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">3</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Alamat</span>
                        <span class="bs-stepper-subtitle">Isi Alamat</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" id="step-asal-sekolah" onclick="switchPage('asalSekolah')">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">4</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Asal Sekolah</span>
                        <span class="bs-stepper-subtitle">Isi Asal Sekolah</span>
                    </span>
                </button>
            </div>
            <div class="step" id="step-orang-tua" onclick="switchPage('ortu')">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">5</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Data Orang Tua</span>
                        <span class="bs-stepper-subtitle">Isi Data Orang Tua</span>
                    </span>
                </button>
            </div>
            <div class="step" id="step-berkas" onclick="switchPage('berkas')">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">6</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Berkas</span>
                        <span class="bs-stepper-subtitle">Form upload berkas</span>
                    </span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <div id="jalur" class="content active dstepper-block formContent">
                <div class="content-header">
                    <h5 class="mb-0">Pilih Jalur</h5>
                    <small class="text-muted">Jalur Pilihan</small>
                </div>
                <form id="form-jalur">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="pilih_jalur">Pilih Jalur</label>
                        <select class="form-control" name="pilih_jalur" id="pilih_jalur">
                            <option value="<?= isset($siswa['id_jalur']) ? $siswa['id_jalur'] : '' ?>" selected>
                                <?= isset($siswa['id_jalur']) ? $siswa['jalur'] : 'Pilih Jalur' ?></option>
                            <?php
                             foreach ($jalur as $row) {
                                echo '<option value="' . $row['id'] . '">' . $row['jalur'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </form>
                <div class="d-flex justify-content-between">
                    <span class="text-danger"> Mohon isi dengan teliti </span>
                    <!-- <button class="btn btn-outline-secondary btn-prev" disabled>
                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                    </button> -->
                    <button class="btn btn-primary " id="next-jalur" type="button">
                        <span class="align-middle d-sm-inline-block d-none">Lanjutkan</span>
                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                    </button>
                </div>
            </div>

            <div id="dataDiri" class="content active dstepper-block formContent" style="display: none;">
                <form id='form-data-diri'>
                    <div class="content-header">
                        <h5 class="mb-0">Data Diri</h5>
                        <small>Masukan Data Diri</small>
                    </div>
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
                            <label class="form-label" for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control"
                                value="<?php echo isset($siswa['nik']) ?$siswa['nik'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                value="<?php echo isset($siswa['tempat_lahir']) ?$siswa['tempat_lahir'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control"
                                value="<?php echo $siswa['tgl_lahir'] ?>" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="<?= isset($siswa['jenis_kelamin']) ? $siswa['jenis_kelamin'] : '' ?>"
                                    selected>
                                    <?= isset($siswa['jenis_kelamin']) ? $siswa['jenis_kelamin'] : 'Pilih Jenis Kelamin' ?>
                                </option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="hobi">Hobi</label>
                            <select class="form-control" name="hobi" id="hobi">
                                <option value="<?= isset($siswa['hobi']) ? $siswa['hobi'] : '' ?>" selected>
                                    <?= isset($siswa['hobi']) ? $siswa['hobi'] : 'Pilih Hobi' ?>
                                </option>
                                <option value="Menyanyi">Menyanyi</option>
                                <option value="Membaca Buku">Membaca Buku</option>
                                <option value="Sepak Bola">Sepak Bola</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="cita">Cita-Cita</label>
                            <select class="form-control" name="cita" id="cita">
                                <option value="<?= isset($siswa['cita']) ? $siswa['cita'] : '' ?>" selected>
                                    <?= isset($siswa['cita']) ? $siswa['cita'] : 'Pilih Cita-cita' ?>
                                </option>
                                <option value="Dokter">Dokter</option>
                                <option value="Polisi">Polisi</option>
                                <option value="Programmer">Programmer</option>
                                <option value="Guru">Guru</option>
                                <option value="Pilot">Pilot</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="npsn">NPSN</label>
                            <input type="text" name="npsn" id="npsn" class="form-control"
                                value="<?php echo isset($siswa['npsn']) ?$siswa['npsn'] : ''  ?>" />
                            <span class="text-danger"><small>*Form ini dapat tidak isi</small></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="no_ijazah">No Ijazah</label>
                            <input type="text" name="no_ijazah" id="no_ijazah" class="form-control"
                                value="<?php echo isset($siswa['no_ijazah']) ?$siswa['no_ijazah'] : ''  ?>" />
                            <span class="text-danger"><small>*Form ini dapat tidak isi</small></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="jumlah_saudara">Jumlah Saudara</label>
                            <input type="number" name="jumlah_saudara" id="jumlah_saudara" class="form-control"
                                value="<?php echo isset($siswa['jumlah_saudara']) ?$siswa['jumlah_saudara'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="anak_ke">Anak-ke</label>
                            <input type="number" name="anak_ke" id="anak_ke" class="form-control"
                                value="<?php echo isset($siswa['anak_ke']) ?$siswa['anak_ke'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tinggi">Tinggi</label>
                            <input type="number" name="tinggi" id="tinggi" class="form-control"
                                value="<?php echo isset($siswa['tinggi']) ?$siswa['tinggi'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="berat">Berat</label>
                            <input type="number" name="berat" id="berat" class="form-control"
                                value="<?php echo isset($siswa['berat']) ?$siswa['berat'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="lingkar_kepala">Lingkar Kepala</label>
                            <input type="number" name="lingkar_kepala" id="lingkar_kepala" class="form-control"
                                value="<?php echo isset($siswa['lingkar_kepala']) ?$siswa['lingkar_kepala'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="pernah_tk">Pernah TK</label>
                            <select class="form-control" name="pernah_tk" id="pernah_tk">
                                <option value="<?= isset($siswa['pernah_tk']) ? $siswa['pernah_tk'] : '' ?>" selected>
                                    <?= isset($siswa['pernah_tk']) ? $siswa['pernah_tk'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Belum">Belum</option>
                                <option value="Pernah">Pernah</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="pernah_paud">Pernah Paud</label>
                            <select class="form-control" name="pernah_paud" id="pernah_paud">
                                <option value="<?= isset($siswa['pernah_paud']) ? $siswa['pernah_paud'] : '' ?>"
                                    selected>
                                    <?= isset($siswa['pernah_paud']) ? $siswa['pernah_paud'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Belum">Belum</option>
                                <option value="Pernah">Pernah</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="hepatitis_b">Hepatitis B</label>
                            <select class="form-control" name="hepatitis_b" id="hepatitis_b">
                                <option value="<?= isset($siswa['hepatitis_b']) ? $siswa['hepatitis_b'] : '' ?>"
                                    selected>
                                    <?= isset($siswa['hepatitis_b']) ? $siswa['hepatitis_b'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Belum">Belum</option>
                                <option value="Pernah">Pernah</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="polio">Polio</label>
                            <select class="form-control" name="polio" id="polio">
                                <option value="<?= isset($siswa['polio']) ? $siswa['polio'] : '' ?>" selected>
                                    <?= isset($siswa['polio']) ? $siswa['polio'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Belum">Belum</option>
                                <option value="Pernah">Pernah</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="bcg">BCG</label>
                            <select class="form-control" name="bcg" id="bcg">
                                <option value="<?= isset($siswa['bcg']) ? $siswa['bcg'] : '' ?>" selected>
                                    <?= isset($siswa['bcg']) ? $siswa['bcg'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Belum">Belum</option>
                                <option value="Pernah">Pernah</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="campak">Campak</label>
                            <select class="form-control" name="campak" id="campak">
                                <option value="<?= isset($siswa['campak']) ? $siswa['campak'] : '' ?>" selected>
                                    <?= isset($siswa['campak']) ? $siswa['campak'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Belum">Belum</option>
                                <option value="Pernah">Pernah</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="dpt">DPT</label>
                            <select class="form-control" name="dpt" id="dpt">
                                <option value="<?= isset($siswa['dpt']) ? $siswa['dpt'] : '' ?>" selected>
                                    <?= isset($siswa['dpt']) ? $siswa['dpt'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Belum">Belum</option>
                                <option value="Pernah">Pernah</option>
                            </select>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary btn-prev" type="button" onclick="switchPage('jalur')">
                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                        </button>
                        <button class="btn btn-primary " type="submit">
                            <span class="align-middle d-sm-inline-block d-none">Lanjutkan</span>
                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                        </button>
                    </div>

                </form>
            </div>
            <button class="btn-next" id="btn-next-data-diri" style="display: none;"> </button>

            <div id="alamat" class="content active dstepper-block formContent" style="display:none">

                <form id='form-alamat'>
                    <div class="content-header">
                        <h5 class="mb-0">Alamat</h5>
                        <small>Isi Alamat</small>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control"
                                value="<?php echo isset($siswa['alamat']) ?$siswa['alamat'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="provinsi">Provinsi</label>
                            <input type="text" name="provinsi" id="provinsi" class="form-control"
                                value="<?php echo isset($siswa['provinsi']) ?$siswa['provinsi'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="kota">Kota</label>
                            <input type="text" name="kota" id="kota" class="form-control"
                                value="<?php echo isset($siswa['kota']) ?$siswa['kota'] : ''  ?>" />
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label" for="kelurahan">Kelurahan</label>
                            <input type="text" name="kelurahan" id="kelurahan" class="form-control"
                                value="<?php echo isset($siswa['kelurahan']) ?$siswa['kelurahan'] : ''  ?>" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="kecamatan">Kecamatan</label>
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control"
                                value="<?php echo isset($siswa['kecamatan']) ?$siswa['kecamatan'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="kode_pos">Kode Pos</label>
                            <input type="number" name="kode_pos" id="kode_pos" class="form-control"
                                value="<?php echo isset($siswa['kode_pos']) ?$siswa['kode_pos'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="jarak_rumah">Jarak Rumah Ke Sekolah</label>
                            <select class="form-control" name="jarak_rumah" id="jarak_rumah">
                                <option value="<?= isset($siswa['jarak_rumah']) ? $siswa['jarak_rumah'] : '' ?>"
                                    selected>
                                    <?= isset($siswa['jarak_rumah']) ? $siswa['jarak_rumah'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="< 1 KM">
                                    < 1 KM</option>
                                <option value="1 - 5 KM"> 1 - 5 KM</option>
                                <option value="5 - 10 KM">5 - 10 KM</option>
                                <option value="> 10 KM">> 10 KM</option>
                                <option value="Luar Provinsi">Luar Provinsi</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="transportasi">Transportasi</label>
                            <select class="form-control" name="transportasi" id="transportasi">
                                <option value="<?= isset($siswa['transportasi']) ? $siswa['transportasi'] : '' ?>"
                                    selected>
                                    <?= isset($siswa['transportasi']) ? $siswa['transportasi'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Mobil">Mobil</option>
                                <option value="Motor">Motor</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="status_tempat">Status Tempat</label>
                            <select class="form-control" name="status_tempat" id="status_tempat">
                                <option value="<?= isset($siswa['status_tempat']) ? $siswa['status_tempat'] : '' ?>"
                                    selected>
                                    <?= isset($siswa['status_tempat']) ? $siswa['status_tempat'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Tinggal Dengan Orang Tua">Tinggal Dengan Orang Tua</option>
                                <option value="Tinggal Dengan Wali">Tinggal Dengan Wali</option>
                                <option value="Kost">Kost</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary btn-prev" type="button"
                            onclick="switchPage('dataDiri')">
                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                        </button>
                        <button class="btn btn-primary " type="submit">
                            <span class="align-middle d-sm-inline-block d-none">Lanjutkan</span>
                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                        </button>
                    </div>

                </form>
            </div>


            <div id="asalSekolah" class="content active dstepper-block formContent" style="display:none">
                <form id='form-asal-sekolah'>
                    <div class="content-header">
                        <h5 class="mb-0">Asal Sekolah</h5>
                        <small>Isi Asal Sekolah</small>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control"
                                value="<?php echo isset($siswa['asal_sekolah']) ?$siswa['asal_sekolah'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="jenis_sekolah">Jenis Sekolah</label>
                            <select class="form-control" name="jenis_sekolah" id="jenis_sekolah">
                                <option value="<?= isset($siswa['jenis_sekolah']) ? $siswa['jenis_sekolah'] : '' ?>"
                                    selected>
                                    <?= isset($siswa['jenis_sekolah']) ? $siswa['jenis_sekolah'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="SMP">SMP</option>
                                <option value="Mts">Mts</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="status_sekolah">Status Sekolah</label>
                            <select class="form-control" name="status_sekolah" id="status_sekolah">
                                <option value="<?= isset($siswa['status_sekolah']) ? $siswa['status_sekolah'] : '' ?>"
                                    selected>
                                    <?= isset($siswa['status_sekolah']) ? $siswa['status_sekolah'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Negri">Negri</option>
                                <option value="Swasta">Swasta</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="kota_sekolah">Kota Sekolah</label>
                            <input type="text" name="kota_sekolah" id="kota_sekolah" class="form-control"
                                value="<?php echo isset($siswa['kota_sekolah']) ?$siswa['kota_sekolah'] : ''  ?>" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary btn-prev" type="button" onclick="switchPage('alamat')">
                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                        </button>
                        <button class="btn btn-primary " type="submit">
                            <span class="align-middle d-sm-inline-block d-none">Lanjutkan</span>
                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                        </button>
                    </div>

                </form>
            </div>

            <div id="ortu" class="content active dstepper-block formContent" style="display:none">

                <form id='form-ortu'>
                    <div class="content-header">
                        <h5 class="mb-0">Orang Tua</h5>
                        <small>Isi Data Orang tua</small>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="no_kk">No KK</label>
                            <input type="text" id="no_kk" name="no_kk" class="form-control"
                                value="<?php echo isset($siswa['no_kk']) ?$siswa['no_kk'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="no_ktp_ayah">No KTP Ayah</label>
                            <input type="text" name="no_ktp_ayah" id="no_ktp_ayah" class="form-control"
                                value="<?php echo isset($siswa['no_ktp_ayah']) ?$siswa['no_ktp_ayah'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_ayah">Nama Ayah</label>
                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control"
                                value="<?php echo isset($siswa['nama_ayah']) ?$siswa['nama_ayah'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                            <input type="text" name="tempat_lahir_ayah" id="tempat_lahir_ayah" class="form-control"
                                value="<?php echo isset($siswa['tempat_lahir_ayah']) ?$siswa['tempat_lahir_ayah'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tgl_lahir_ayah">Tanggal Lahir Ayah</label>
                            <input type="date" name="tgl_lahir_ayah" id="tgl_lahir_ayah" class="form-control"
                                value="<?php echo isset($siswa['tgl_lahir_ayah']) ?$siswa['tgl_lahir_ayah'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="pendidikan_ayah">Pendidikan Ayah</label>
                            <input type="text" name="pendidikan_ayah" id="pendidikan_ayah" class="form-control"
                                value="<?php echo isset($siswa['pendidikan_ayah']) ?$siswa['pendidikan_ayah'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="pekerjaan_ayah">Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control"
                                value="<?php echo isset($siswa['pekerjaan_ayah']) ?$siswa['pekerjaan_ayah'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="no_hp_ayah">No HP Ayah</label>
                            <input type="text" name="no_hp_ayah" id="no_hp_ayah" class="form-control"
                                value="<?php echo isset($siswa['no_hp_ayah']) ?$siswa['no_hp_ayah'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="status_ayah">status_ayah</label>
                            <select class="form-control" name="status_ayah" id="status_ayah">
                                <option value="<?= isset($siswa['status_ayah']) ? $siswa['status_ayah'] : '' ?>"
                                    selected>
                                    <?= isset($siswa['status_ayah']) ? $siswa['status_ayah'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Hidup">Hidup</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="no_ktp_ibu">No KTP Ibu</label>
                            <input type="text" name="no_ktp_ibu" id="no_ktp_ibu" class="form-control"
                                value="<?php echo isset($siswa['no_ktp_ibu']) ?$siswa['no_ktp_ibu'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_ibu">Nama Ibu</label>
                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control"
                                value="<?php echo isset($siswa['nama_ibu']) ?$siswa['nama_ibu'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                            <input type="text" name="tempat_lahir_ibu" id="tempat_lahir_ibu" class="form-control"
                                value="<?php echo isset($siswa['tempat_lahir_ibu']) ?$siswa['tempat_lahir_ibu'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tgl_lahir_ibu">Tanggal Lahir Ibu</label>
                            <input type="date" name="tgl_lahir_ibu" id="tgl_lahir_ibu" class="form-control"
                                value="<?php echo isset($siswa['tgl_lahir_ibu']) ?$siswa['tgl_lahir_ibu'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="pendidikan_ibu">Pendidikan Ibu</label>
                            <input type="text" name="pendidikan_ibu" id="pendidikan_ibu" class="form-control"
                                value="<?php echo isset($siswa['pendidikan_ibu']) ?$siswa['pendidikan_ibu'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="pekerjaan_ibu">Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control"
                                value="<?php echo isset($siswa['pekerjaan_ibu']) ?$siswa['pekerjaan_ibu'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="no_hp_ibu">No HP Ibu</label>
                            <input type="text" name="no_hp_ibu" id="no_hp_ibu" class="form-control"
                                value="<?php echo isset($siswa['no_hp_ibu']) ?$siswa['no_hp_ibu'] : ''  ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="status_ibu">Status Ibu</label>
                            <select class="form-control" name="status_ibu" id="status_ibu">
                                <option value="<?= isset($siswa['status_ibu']) ? $siswa['status_ibu'] : '' ?>" selected>
                                    <?= isset($siswa['status_ibu']) ? $siswa['status_ibu'] : 'Pilih Opsi' ?>
                                </option>
                                <option value="Hidup">Hidup</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="penghasilan_ortu">Penghasilan Orang Tua</label>
                            <input type="text" name="penghasilan_ortu" id="penghasilan_ortu" class="form-control"
                                value="<?php echo isset($siswa['penghasilan_ortu']) ?$siswa['penghasilan_ortu'] : ''  ?>" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary btn-prev" type="button"
                            onclick="switchPage('asalSekolah')">
                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                        </button>
                        <button class="btn btn-primary " type="submit">
                            <span class="align-middle d-sm-inline-block d-none">Lanjutkan</span>
                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div id="berkas" class="content active dstepper-block formContent" style="display:none">
                <?php if($all_jalur != 0) { ?>
                <div class="content-header">
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="card card-transaction">
                            <div class="card-header">
                                <h4 class="card-title">Informasi Berkas Yang Diupload</h4>
                                <h5>Jalur yang dipilih : <b><?= $siswa['jalur'] ?></b></h5>
                                <!-- <h6><small>Isi Data Orang tua</small></h6> -->
                            </div>
                            <div class="card-body">
                                <?php
                                $umum = !empty($all_jalur['syarat_umum']) ? explode(',', $all_jalur['syarat_umum']) : '';
                                $khusus = !empty($all_jalur['syarat_khusus']) ? explode(',', $all_jalur['syarat_khusus']) : '';
                                $info = !empty($all_jalur['info']) ? explode(',', $all_jalur['info']) : '';

                                echo '<h4 class="card-title">Berkas Umum</h4>';
                                foreach ($umum as $row) {
                                    echo '

                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <h6 class="transaction-title">' . $row . '</h6>
                                                <!-- <small>Add Money</small> -->
                                            </div>
                                        </div>
                                    </div>';
                                }

                                if ($khusus != '') {
                                    echo '<h4 class="card-title">Berkas Khusus</h4>';

                                    foreach ($khusus as $row) {
                                        echo '
                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <h6 class="transaction-title">' . $row . '</h6>
                                                <!-- <small>Add Money</small> -->
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                }


                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h5 class="mb-0">Upload Berkas</h5>
                        <form id="form-jalur">
                            <div class="row">
                                <!-- BERKAS KETERANGAN LULUS -->
                                <div class="form-group col-md-8">
                                    <label for="customFile">Surat Keterangan Lulus</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="keterangan_lulus"
                                            name="keterangan_lulus" accept=".jpg,.jpeg,.png,.pdf" />
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <?php
                                    if (!empty($siswa['berkas_keterangan_lulus'])) {
                                        echo '<small class="text-success"><i data-feather="check" class="avatar-icon font-medium-3"></i>Berkas telah terupload</small><br>
                                        ';
                                    }
                                    ?>
                                    <small class="text-danger">Berkas bisa dilewati bila belum memiliki keterangan lulus
                                        atau tanda tangan dari kepala sekolah asal</small><br>
                                    <small>Jika belum meiliki keterangan lulus bisa diganti dengan surat keterangan
                                        duduk di kelas 9 SMP/Mts sederajat sekolah asal dan di tanda tangani asli oleh
                                        kepala sekolah dengan cap basah</small><br>
                                    <small class="text-danger">*Maksimum upload file adalah 2mb dan file upload berupa
                                        pdf,jpg,atau png</small>
                                </div>

                                <!-- BERKAS NISN -->
                                <div class="form-group col-md-8">
                                    <label for="customFile">Berkas/Screenshot NISN</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas_nisn" name="berkas_nisn"
                                            accept=".jpg,.jpeg,.png,.pdf" />
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <?php
                                    if (!empty($siswa['berkas_nisn'])) {
                                        echo '<small class="text-success"><i data-feather="check" class="avatar-icon font-medium-3"></i>Berkas telah terupload</small><br>
                                        ';
                                    }
                                    ?>
                                    <small class="text-danger">*Maksimum upload file adalah 2mb dan file upload berupa
                                        pdf,jpg,atau png</small>
                                </div>

                                <!-- BERKAS RAPOT -->
                                <div class="form-group col-md-8">
                                    <label for="customFile">Berkas Raport Semester 5 atau kelas 3 SMP/Mts</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas_rapot"
                                            name="berkas_rapot" accept=".jpg,.jpeg,.png,.pdf" />
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <?php
                                    if (!empty($siswa['berkas_rapot'])) {
                                        echo '<small class="text-success"><i data-feather="check" class="avatar-icon font-medium-3"></i>Berkas telah terupload</small><br>
                                        ';
                                    }
                                    ?>
                                    <small class="text-danger">*Maksimum upload file adalah 2mb dan file upload berupa
                                        pdf,jpg,atau png</small>
                                </div>

                                <!-- BERKAS AKTE -->
                                <div class="form-group col-md-8">
                                    <label for="customFile">Berkas Akte Kelahiran</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas_akte" name="berkas_akte"
                                            accept=".jpg,.jpeg,.png,.pdf" />
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <?php
                                    if (!empty($siswa['berkas_akte'])) {
                                        echo '<small class="text-success"><i data-feather="check" class="avatar-icon font-medium-3"></i>Berkas telah terupload</small><br>
                                        ';
                                    }
                                    ?>
                                    <small class="text-danger">*Maksimum upload file adalah 2mb dan file upload berupa
                                        pdf,jpg,atau png</small>
                                </div>

                                <!-- BERKAS KK -->
                                <div class="form-group col-md-8">
                                    <label for="customFile">Berkas Kartu Keluarga</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas_kk" name="berkas_kk"
                                            accept=".jpg,.jpeg,.png,.pdf" />
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <?php
                                    if (!empty($siswa['berkas_kk'])) {
                                        echo '<small class="text-success"><i data-feather="check" class="avatar-icon font-medium-3"></i>Berkas telah terupload</small><br>
                                        ';
                                    }
                                    ?>
                                    <small class="text-danger">*Maksimum upload file adalah 2mb dan file upload berupa
                                        pdf,jpg,atau png</small>
                                </div>

                                <!-- BERKAS KTP ORTU -->
                                <div class="form-group col-md-8">
                                    <label for="customFile">Berkas KTP Orang Tua/wali</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas_ktp_ortu"
                                            name="berkas_ktp_ortu" accept=".jpg,.jpeg,.png,.pdf" />
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <?php
                                    if (!empty($siswa['berkas_ktp_ortu'])) {
                                        echo '<small class="text-success"><i data-feather="check" class="avatar-icon font-medium-3"></i>Berkas telah terupload</small><br>
                                        ';
                                    }
                                    ?>
                                    <small class="text-danger">*Maksimum upload file adalah 2mb dan file upload berupa
                                        pdf,jpg,atau png</small>
                                </div>

                                <!-- BERKAS FOTO -->
                                <div class="form-group col-md-8">
                                    <label for="customFile">Pas Photo Berwarna ukuran 3x4 Terbaru</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas_foto" name="berkas_foto"
                                            accept=".jpg,.jpeg,.png,.pdf" />
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <?php
                                    if (!empty($siswa['berkas_foto'])) {
                                        echo '<small class="text-success"><i data-feather="check" class="avatar-icon font-medium-3"></i>Berkas telah terupload</small><br>
                                        ';
                                    }
                                    ?>
                                    <small class="text-danger">*Maksimum upload file adalah 2mb dan file upload berupa
                                        pdf,jpg,atau png</small>
                                </div>

                                <?php
                                if ($siswa['id_jalur'] != 1) {
                                ?>
                                <!-- BERKAS KHUSUS -->
                                <div class="form-group col-md-8">
                                    <label for="customFile">Upload Berkas Khusus </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas_khusus"
                                            name="berkas_khusus" accept=".rar,.jpg,.jpeg,.png,.pdf" />
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <?php
                                        if (!empty($siswa['berkas_khusus'])) {
                                            echo '<small class="text-success"><i data-feather="check" class="avatar-icon font-medium-3"></i>Berkas telah terupload</small><br>
                                        ';
                                        }
                                        ?>
                                    <p>(Sesuai informasi pada setiap jalur, Bila berkas lebih dari 1 mohon satukan
                                        mengukanan aplikasi winrar atau dalam bentuk pdf</p>
                                    <small class="text-danger">*Maksimum upload file adalah 5mb dan file upload berupa
                                        rar,pdf,jpg,atau png</small>
                                </div>
                                <?php
                                }
                                ?>

                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-7">
                        <h5 class="mb-0">Nilai Rapot</h5>

                        <div class="form-group col-md-6">
                            <label class="form-label" for="nilai_mtk">Nilai Matematika</label>
                            <input type="number" name="nilai_mtk" id="nilai_mtk" class="form-control"
                                value="<?php echo isset($siswa['nilai_mtk']) ? $siswa['nilai_mtk'] : '' ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nilai_ips">Nilai IPS</label>
                            <input type="number" name="nilai_ips" id="nilai_ips" class="form-control"
                                value="<?php echo isset($siswa['nilai_ips']) ? $siswa['nilai_ips'] : '' ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nilai_ipa">Nilai IPA</label>
                            <input type="number" name="nilai_ipa" id="nilai_ipa" class="form-control"
                                value="<?php echo isset($siswa['nilai_ipa']) ? $siswa['nilai_ipa'] : '' ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nilai_agama">Nilai Agama</label>
                            <input type="number" name="nilai_agama" id="nilai_agama" class="form-control"
                                value="<?php echo isset($siswa['nilai_agama']) ? $siswa['nilai_agama'] : '' ?>" />
                            <span class="text-danger text-sm"><small>Bila nilai agama lebih dari 1 , mohon isi berupa
                                    rata-rata dari nilai keseluruhan agama</small></span>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-danger"> Tekan Tombol Selesai Bila Telah Mengisi Semua Formulir</span>
                    <a href="#form-data-diri" id="btn-next-jalur" style="display: none;"> </a>
                    <button class="btn btn-primary " id="btn_simpan" type="button">Selesai
                    </button>
                </div>
                <?php } else{
                echo '<div class="content-header">Silahkan Pilih Jalur Terlebih dahulu
                </div>';
            } ?>
            </div>

        </div>
    </div>
</section>

<?php include 'js.php'; ?>
