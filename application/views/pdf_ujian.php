<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Tes BTQ</title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h2>MAN 2 KOTA BANDUNG</h2>
        <h6>No Telepon : (022) 63722262 | Alamat : Jl. Cipadung, No. 57, Kecamatan Cibiru, Kota Bandung, Jawa Barat
            40614 | <br> Email : man2kotabandung@yahoo.com</h6>
        <hr>
        <h3> Peserta Ujian BTQ</h3>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th>NISN</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Tanggal</th>
                <!-- <th>Ruangan</th>
                <th>Penguji</th> -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $all_data->nisn ?></td>
                <td><?php echo $all_data->nama_lengkap ?></td>
                <td><?php echo date('H:i', strtotime($all_data->waktu)) ?></td>
                <td><?php echo date('d M Y', strtotime($all_data->tanggal)) ?></td>
                <!-- <td><?php echo $all_data->ruangan ?></td>
                <td><?php echo $all_data->penguji ?></td> -->
            </tr>

        </tbody>
    </table>
    <!-- <br><br><br> -->
    <!-- <h3>INFORMASI</h3>
    <h4>1. RUANGAN 1 : Ruang Pertemuan</h4>
    <h4>2. RUANGAN 2 : Ruangan LAB Kom 1</h4>
    <h4>3. RUANGAN 3 : Ruangan LAB Kom 2</h4> -->
</body>

</html>
