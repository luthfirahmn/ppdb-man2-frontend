<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Kelulusan</title>
    <style>
    .header {
        width: 50%;
        z-index: 1;
    }

    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        height: 150px;
        text-align: left;
    }

    .status {
        border: 2px solid black;
        margin: auto;
        padding: 20px;
        text-align: center;
        font-weight: bold;
        width: 30%;
    }
    </style>
</head>

<body>
    <div style="text-align:center">
        <img src="data:image/png;base64,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"
            width="90" height="90">
        <h3>
            KEMENTRIAN AGAMA REPUBLIK INDONESIA
            <br> KANTOR KEMENTRIAN AGAMA KOTA BANDUNG
            <br> MADRASAH ALIYAH NEGRI 2
        </h3>
        <h6>No Telepon : (022) 63722262 | Alamat : Jl. Cipadung, No. 57, Kecamatan Cibiru, Kota Bandung, Jawa Barat
            40614 | <br> Email : man2kotabandung@yahoo.com</h6>
        <hr>
        <div>
            <h3>SURAT PENGUMUMAN KELULUSAN</h3>
            <h4>Nomor : 444 tahun 2023 tanggal 19 mei 2023</h4>
            <p>Berdasarkan hasil seleksi, Panitia Penerimaan Peserta Didik Baru (PPDB)
                Madrasah Aliyah Negeri 2 Kota Bandung Tahun Pelajaran 2023/2024, dengan ini menerangkan bahwa :</p>
        </div>

        <table id="table">

            <tr>
                <td>Nama</td>
                <td><?= $all_data->nama_lengkap ?></td>
            </tr>
            <tr>
                <td>NISN</td>
                <td><?= $all_data->nisn ?></td>
            </tr>
            <tr>
                <td>Tempat Tanggal Lahir</td>
                <td><?= $all_data->tempat_lahir . ', ' . date('d m Y', strtotime($all_data->tgl_lahir)) ?></td>
            </tr>

        </table>

        <h4> DINYATAKAN</h4>

        <p class="status"> <?= $status_val ?> </p>

        <?php

        if ($status_id == 1) {
            echo '
        <p>Menjadi Calon Peserta Didik Baru kelas X ( Sepuluh )
            Madrasah Aliyah Negeri 2 Kota Bandung Tahun Pelajaran 2023/2024
            <b> MELALUI ' . strtoupper($all_data->jalur) . ' </b>
        </p>';

            echo ' <p style="text-align: left;"><b>Catatan : </b><br>
            Silahkan anda melakukan Lapor Diri dengan membawa berkas yang diperlukan, pada hari Kamis s/d Sabtu, 08 s/d 10 Juni 2023 Pukul 08.00 s/d 14.00 WIB bertempat di Gedung Serba Guna MAN 2 Kota Bandung. <br> <br>

            1.	Fotocopy Akte Kelahiran <br>
            2.	Fotocopy Kartu Keluarga <br>
            3.	Fotocopy Bukti Keabsahan NISN <br>
            4.	Surat Keterangan/Kelulusan dari Sekolah/Madrasah/Paket B <br>
            5.	Surat Pernyataan Diterima di MAN 2 Kota Bandung (didownload dari web) <br>
            6.	Fotocopy Kartu Tanda Penduduk : <br>
            a.	Ayah <br>
            b.	Ibu <br>
            7.	Pas Photo 3x4 sebanyak 3 lembar (latar biru) <br>

            <b>PERNYATAAN KHUSUS</b> <br>
            a.	Orang Tua/Wali dan Siswa harus hadir <br>
            b.	Surat Keterangan Tidak Mampu (map berwarna biru) <br>
            c.	Sertifikat/Piagam/Medali prestasi (asli) <br>
            d.	Membawa materai Rp.10.000,- (2 lembar) <br>
            e.	Menandatangani Surat Pernyataan Tanggung Jawab Mutlak Orang Tua (disediakan MAN 2 Kota Bandung) <br>


        </p>';
        } else {
            echo ' <p><b>Catatan : </b><br>
            Mohon maaf, anda dinyatakan belum lulus dalam PPDB MAN 2 Kota Bandung jalur akademik, semoga Ananda bisa sukses di Sekolah/Madrasah yang lain.
        </p>';
        }
        ?>


    </div>

</body>

</html>
