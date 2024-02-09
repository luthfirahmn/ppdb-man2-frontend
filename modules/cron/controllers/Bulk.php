<?php

class Bulk extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->wa_url = 'https://app.ruangwa.id/api/';
    }

    public function index()
    {
        echo "succcess";
    }

    public function testing_wa()
    {

                $msg = "Testing connection whatsapp success";
                $data_otp = 'token=' . wa_token() . '&number=081312566813&message=' . $msg;
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    echo "Testing connection whatsapp success";
                } else {
                    echo "Testing connection whatsapp error" ;
                }
    }

    public function send_message_status_btq()
    {
        $query = $this->db->query("SELECT no_wa,s.id, nama_lengkap,pengumuman,info FROM ms_siswa s LEFT JOIN ms_status si ON si.status = s.id_status WHERE active = 0 AND id_status != 0");
        $result = $query->result();

        if ($result) {
            foreach ($result as $row) {
                $msg = "INFORMASI KELULUSAN TES BTQ . Atas nama : " . $row->nama_lengkap . " " . $row->pengumuman . $row->info;
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id);
                    $update = $this->db->update('ms_siswa', ['active' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_jadwal_btq()
    {

        $query = $this->db->query("SELECT s.no_wa,s.nisn,s.nama_lengkap,i.id as id_jadwal,i.waktu,i.tanggal,i.ruangan FROM ms_jadwal_btq i LEFT JOIN ms_siswa s ON s.id = i.id_siswa WHERE i.active = 0");
        $result = $query->result();

        if ($result) {
            foreach ($result as $row) {
                $msg = "Kartu Tes BTQ sudah bisa didownlod, Silahkan login kehalaman dashboard. Tertera atas nama :" . $row->nama_lengkap . " Dengan nomor NISN : " . $row->nisn . " Dipersilahkan datang untuk ujian BTQ pada Tanggal : " . $row->tanggal . " Di Jam : " . $row->waktu . " Di Ruangan : " . $row->ruangan . " Dengan memperlihatkan kartu tes atau screenshot kartu tes . Dengan menggunakan pakaian muslim/muslimah, dan membawa alat tulis. masuk melalui gerbang bawah MAN 2 (jl.Al Misbah) dengan tidak mennggunaakan kendaraan roda 4";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id_jadwal);
                    $this->db->update('ms_jadwal_btq', ['active' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_belum_berkas()
    {
        $start = 0;

        if ($start == 1) {
            $query = $this->db->query("SELECT no_wa FROM ms_siswa WHERE id_status = 1 AND status_berkas = 0 ");
            $result = $query->result();

            foreach ($result as $row) {
                $msg = "Mengingatkan kembali bagi peserta yang belum mengisi form berkas, harap segera mengisi form berkas pada website PPDB MAN 2 KOTA BANDUNG untuk lanjut ketahap berikutnya. Form berkas selambat-lambatnya ditutup untuk JALUR NON AKADEMIK (PRESTASI,KETM,PPT,KEAGAMAAN ISLAM) Adalah tanggal 11 MEI 2022 jam 00:00 WIB Dan Untuk JALUR AKADEMIK ditutup tanggal 2 JUNI 2022 Jam 00:00 WIB .";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);
                if ($check_number) {
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "start tidak aktif";
        }
    }

    public function send_message_jadwal_prestasi()
    {
        $query = $this->db->query("SELECT no_wa,id,id_status FROM ms_siswa s WHERE id_jalur = 2 AND id_status = 1 AND pengumuman_all = 0 ");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg = "INFORMASI JADWAL UJIAN PRAKTEK JALUR PRESTASI . Informasi jadwal dapat di download di link berikut : https://ppdb.man2kotabandung.sch.id/download/jadwal_prestasi";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id);
                    $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_jadwal_tes_prestasi()
    {

        $query = $this->db->query("SELECT s.no_wa,s.nisn,s.nama_lengkap,i.id as id_jadwal,i.waktu,i.tanggal FROM ms_jadwal_prestasi i LEFT JOIN ms_siswa s ON s.nisn = i.nisn WHERE i.active = 0");
        $result = $query->result();

        if ($result) {
            foreach ($result as $row) {
                $msg = "Tertera atas nama :" . $row->nama_lengkap . " Dengan nomor NISN : " . $row->nisn . " Dipersilahkan datang untuk melakukan tes prestasi tahfiz pada Tanggal : " . $row->tanggal . " Di Jam : " . $row->waktu;
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id_jadwal);
                    $this->db->update('ms_jadwal_prestasi', ['active' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_jadwal_ppt()
    {
        $query = $this->db->query("SELECT no_wa,id,id_status,nama_lengkap,nisn FROM ms_siswa s WHERE id_jalur = 4 AND id_status = 1 ");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg = "Tertera atas nama : " . $row->nama_lengkap . " Dengan nomor NISN : " . $row->nisn . " Hari Kamis tanggal 19 Mei 2022 jam 08.00 wajib hadir di ruang pertemuan dengan membawa berkas asli sesuai dengan yg diupload di web dan satu berkas foto copynya di masukan ke map warna kuning di luar map diberi nama NISN, No WA yg digunakan untuk daftar dan asal sekolah";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id);
                    $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_jadwal_keagamaan()
    {
        $query = $this->db->query("SELECT no_wa,id,id_status,nama_lengkap,nisn FROM ms_siswa s WHERE id_jalur = 5 AND id_status = 1");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg = "Tertera atas nama : " . $row->nama_lengkap . " Dengan nomor NISN : " . $row->nisn . " Hari Jumat tanggal 20 Mei 2022 jam 08.00 wajib hadir di Gedung Serba Guna. dengan membawa seluruh berkas asli yg diupload beserta foto copy nya rangkap satu, masukan ke map warna merah  di luarnya diberi nama, NISN, asal sekolah dan no WA yg digunakan pada saat daftar";
                // $msg = 'Maaf ada kesalahan jadwal untuk peserta yang mengambil jalur keagamaan. mohon ditunggu untuk pemberitahuan jadwal melalui whatsapp';
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id);
                    $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }


    public function send_message_random()
    {
        $query = $this->db->query("SELECT no_wa FROM ms_siswa s WHERE id_status = 1 ");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg = "Diinformasikan kepada seluruh calon peserta bila memiliki kesulitan tentang";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id);
                    // $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }


    public function send_message_tes_akademik()
    {
        $query = $this->db->query("SELECT no_wa FROM ms_siswa s WHERE id_status NOT IN (9,0,1)");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg = "Diinformasikan kepada seluruh calon peserta, status kelulusan untuk jalur non akademik dan download kartu tes akademik telah tersedia silahkan login ke website PPDB MAN 2 KOTA BANDUNG. ";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id);
                    // $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_info_akademik()
    {
        $query = $this->db->query("SELECT no_wa FROM ms_siswa s WHERE id_status != 9 AND pengumuman_all = 0");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg =
                    "Diberitahukan kepada seluruh pendaftar calon Peserta  PPDB MAN 2 Kota Bandung tahun Tahun Pelajaran 2022/2023 :
                    1. Penutupan pendaftaran dilakukan tanggal 28 Mei 2022.
                    2. Test Baca Tulis Qur'an terakhir tanggal 30 Mei 2022  sampai jam 14.00 WIB.
                    3. Apload berkas terakhir bagi peserta yang telah dinyatakan lolos test Baca Tulus Qur'an, terakhir tanggal 2 Juni 2022 sampai jam 14.00 WIB. Dengan log in kembali di web PPDB MAN 2 Kota Bandung
                    4. Bagi calon peserta jalur akademik pengunduhan kartu peserta test akademik dapat dilakukan mulai tanggal 30 Mei s/d tanggal 4 Juni 2022 sampai jam 14.00 WIB dengan log in ke web PPDB MAN 2 Kota Bandung. Untuk kemudian kartu test tersebut beserta foto copy raport semester 1 di kelas IX SMP/MTS asal, yg sudah dilegalisir, wajib di bawa saat test berlangsung sesuai dengan jadwal test yg tertera di kartu test masing- masing.
                    5. Peserta test akademik wajib membawa foto copy raport semester 1 di kelas IX SMP/MTS asal yg telah dilegalisir oleh pihak sekolah yang bersangkutan saat test akademik dilaksanakan (sesuai pada waktu test yang tertera di kartu test)
                    6. Pengumuman hasil seleksi jalur akademik insyaallah di laksanakan pada tanggal 17 Juni 2022 melalui notifikasi WA masing- masing calon peserta.
                    7. Pengumuman hasil seleksi calon peserta didik baru jalur Non Akademik (jalur KETM, jalur Prestasi, jalur Keagamaan dan jalur PPT) insyaallah diumumkan pada tanggal 30 Mei 2022. Melalui WA masing-masing peserta.
                    8. Pengumuman resmi ini juga dapat akses di web PPDB  MAN 2 Kota Bandung.";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id);
                    $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_random_non_akademik()
    {
        $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id_status IN (2,3,4,5)");
        // $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id =2");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg =
                    "Info no humas MAN 2 KOTA BANDUNG hubungi no whatsapp : 082124982579 ";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id);
                    // $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_random2()
    {
        $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id_status IN (2,3,4,5)");
        // $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id =2");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg =
                    "Assalamualaikum wr wb
Demi kenyamanan bersama, dimohon dengan hormat kepada orangtua/wali calon peserta didik yang akan daftar ulang, untuk:
1. Tidak menggunakan kendaraan roda 4 dikarenakan lahan parkir MAN 2 yang terbatas dan sedang berlangsung PAT.
2. Hadir bersama calon siswanya karena akan dilakukan pengukuran seragam.
Atas perhatian dan kerjasamanya kami haturkanterimakasih";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('id', $row->id);
                    // $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_random3()
    {
        $query = $this->db->query("SELECT no_wa,id,nisn FROM ms_siswa s WHERE nisn IN (SELECT nisn FROM ms_jadwal_akademik)");
        // $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id =2");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg =
                    "Assalamualaikum wr wb
Kepada peserta tes akademik di informasikan sebagai berikut:
1. Tidak menggunakan kendaraan roda 4.
2. Peserta test akademik menggunakan baju muslim/muslimah sekolah/Madrasah.
Atas perhatian dan kerjasamanya kami haturkanterimakasih
Info humas : 082124982579 ";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('nisn', $row->nisn);
                    $update = $this->db->update('ms_jadwal_akademik', ['active' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    // public function send_message_random_non_akademik()
    // {
    //     $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id_status IN (2,3,4,5)");
    //     // $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id =2");
    //     $result = $query->result();
    //     if ($result) {
    //         foreach ($result as $row) {
    //             $msg =
    //                 "Info no humas MAN 2 KOTA BANDUNG hubungi no whatsapp : 082124982579 ";
    //             $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
    //             // pre($data_otp);
    //             $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

    //             if ($check_number) {
    //                 $this->db->where('id', $row->id);
    //                 // $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
    //                 echo "sukses kirim pada nomor" . $row->no_wa;
    //             } else {
    //                 echo "error kirim pada nomor" . $row->no_wa;
    //             }
    //         }
    //     } else {
    //         echo "tidak ada data";
    //     }
    // }

    public function send_message_jadwal_kelulusan_akademik()
    {
        $query = $this->db->query("SELECT no_wa,id,nisn FROM ms_siswa s WHERE nisn IN (SELECT nisn FROM ms_jadwal_akademik)");
        // $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id =2");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg =
                    "Assalamualaikum wr wb
Informasi kelulusan telah tersedia diwebsite PPDB MAN 2 KOTA BANDUNG,
Silahkan Login untuk melihat informasi kelulusan.
Semua pertanyaan ditampung melalui humas, mmohon hubungi nomor yang tertera : 082124982579 ";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('nisn', $row->nisn);
                    $update = $this->db->update('ms_jadwal_akademik', ['active' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function generate_jadwal_akademik()
    {
        $query = $this->db->query("SELECT s.nisn
                                    FROM ms_siswa s
                                    WHERE nisn NOT IN
                                        (SELECT nisn
                                        FROM ms_jadwal_akademik)
                                    AND id_status = 1 AND id_jalur = 1
                                    ORDER by id ASC
                             ");

        $result = $query->result();

        if ($result) {
            foreach ($result as $row) {
                $query = $this->db->query("SELECT *
                                            FROM ms_jadwal_akademik
                                            ORDER BY id DESC
                                            LIMIT 1");

                $get_jadwal = $query->row();

                if (!$get_jadwal) {
                    $this->db->insert(
                        "ms_jadwal_akademik",
                        array(
                            "nisn"    => $row->nisn,
                            "tanggal" => 6,
                            "sesi"   => 1,
                            "ruangan" => 1
                        )
                    );

                    die;
                }

                $query = $this->db->query("SELECT *
                                            FROM ms_jadwal_akademik
                                            WHERE tanggal = {$get_jadwal->tanggal}
                                            ");

                $count_tanggal = $query->num_rows();
                echo "Count Tanggal" . $count_tanggal;

                if ($count_tanggal >= 300) {
                    $tanggal = $get_jadwal->tanggal + 1;
                } else {
                    $tanggal = $get_jadwal->tanggal;
                }


                $query = $this->db->query("SELECT *
                                            FROM ms_jadwal_akademik
                                            WHERE sesi = {$get_jadwal->sesi}
                                            AND tanggal = {$tanggal}
                                            ");

                $count_sesi = $query->num_rows();
                echo "Count Sesi" . $count_sesi;
                if ($count_sesi >= 60) {
                    $sesi = $get_jadwal->sesi + 1;
                } else if ($count_sesi > 0 and $count_sesi <= 60) {
                    $sesi = $get_jadwal->sesi;
                } else {
                    $sesi = 1;
                }

                $query = $this->db->query("SELECT *
                                            FROM ms_jadwal_akademik
                                            WHERE ruangan = {$get_jadwal->ruangan}
                                            AND sesi = {$sesi}
                                            AND tanggal = {$tanggal}

                                            ");

                $count_ruangan = $query->num_rows();
                echo "ruangan : " . $count_ruangan;
                if ($count_ruangan >= 20) {
                    $ruangan = $get_jadwal->ruangan + 1;
                } else if ($count_ruangan > 0 and $count_ruangan <= 20) {
                    $ruangan = $get_jadwal->ruangan;
                } else {
                    $ruangan = 1;
                }

                // if ($count_ruangan >= 20) {
                //     if ($get_jadwal->ruangan == 3) {
                //         $ruangan = 1;
                //     } else {
                //         $ruangan = $get_jadwal->ruangan + 1;
                //     }
                // } else {
                //     $ruangan = $get_jadwal->ruangan;
                // }


                $data = array(
                    "nisn"    => $row->nisn,
                    "tanggal" => $tanggal,
                    "sesi"   => $sesi,
                    "ruangan" => $ruangan
                );

                $insert = $this->db->insert("ms_jadwal_akademik", $data);

                if ($insert) {
                    echo "Sukses Pada NISN: " . $row->nisn . "<br>";
                } else {
                    echo "Gagal Pada NISN: " . $row->nisn . "<br>";
                }
            }
        } else {
            echo "Tidak ada data";
        }
    }

    public function generate_jadwal_akademik_non()
    {
        $query = $this->db->query("SELECT s.nisn
                                    FROM ms_siswa s
                                    WHERE nisn NOT IN
                                        (SELECT nisn
                                        FROM ms_jadwal_akademik)
                                    AND id_status IN (20,30,40,50)
                             ");

        $result = $query->result();

        if ($result) {
            foreach ($result as $row) {
                $query = $this->db->query("SELECT *
                                            FROM ms_jadwal_akademik
                                            ORDER BY id DESC
                                            LIMIT 1");

                $get_jadwal = $query->row();

                if (!$get_jadwal) {
                    $this->db->insert(
                        "ms_jadwal_akademik",
                        array(
                            "nisn"    => $row->nisn,
                            "tanggal" => 6,
                            "sesi"   => 1,
                            "ruangan" => 1
                        )
                    );

                    die;
                }

                $query = $this->db->query("SELECT *
                                            FROM ms_jadwal_akademik
                                            WHERE tanggal = {$get_jadwal->tanggal}
                                            ");

                $count_tanggal = $query->num_rows();
                echo "Count Tanggal" . $count_tanggal;

                if ($count_tanggal >= 300) {
                    $tanggal = $get_jadwal->tanggal + 1;
                } else {
                    $tanggal = $get_jadwal->tanggal;
                }


                $query = $this->db->query("SELECT *
                                            FROM ms_jadwal_akademik
                                            WHERE sesi = {$get_jadwal->sesi}
                                            AND tanggal = {$tanggal}
                                            ");

                $count_sesi = $query->num_rows();
                echo "Count Sesi" . $count_sesi;
                if ($count_sesi >= 60) {
                    $sesi = $get_jadwal->sesi + 1;
                } else if ($count_sesi > 0 and $count_sesi <= 60) {
                    $sesi = $get_jadwal->sesi;
                } else {
                    $sesi = 1;
                }

                $query = $this->db->query("SELECT *
                                            FROM ms_jadwal_akademik
                                            WHERE ruangan = {$get_jadwal->ruangan}
                                            AND sesi = {$sesi}
                                            AND tanggal = {$tanggal}

                                            ");

                $count_ruangan = $query->num_rows();
                echo "ruangan : " . $count_ruangan;
                if ($count_ruangan >= 20) {
                    $ruangan = $get_jadwal->ruangan + 1;
                } else if ($count_ruangan > 0 and $count_ruangan <= 20) {
                    $ruangan = $get_jadwal->ruangan;
                } else {
                    $ruangan = 1;
                }

                // if ($count_ruangan >= 20) {
                //     if ($get_jadwal->ruangan == 3) {
                //         $ruangan = 1;
                //     } else {
                //         $ruangan = $get_jadwal->ruangan + 1;
                //     }
                // } else {
                //     $ruangan = $get_jadwal->ruangan;
                // }


                $data = array(
                    "nisn"    => $row->nisn,
                    "tanggal" => $tanggal,
                    "sesi"   => $sesi,
                    "ruangan" => $ruangan
                );

                $insert = $this->db->insert("ms_jadwal_akademik", $data);

                if ($insert) {
                    echo "Sukses Pada NISN: " . $row->nisn . "<br>";
                } else {
                    echo "Gagal Pada NISN: " . $row->nisn . "<br>";
                }
            }
        } else {
            echo "Tidak ada data";
        }
    }


    public function send_message_undangan()
    {
        $query = $this->db->query("SELECT no_wa,
                                          id,
                                          nisn,
                                          nama_lengkap
                                   FROM ms_siswa s
                                   WHERE id_status IN (2,3,4,5,8)
                                    AND pengumuman_all = 0
                                 ");
        // $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id =2");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg =
                    "Assalamualaikum wr wb
Atas Nama : " . $row->nama_lengkap . "
Dengan NISN : " . $row->nisn . " .
Kami mengundang anda untuk hadir pada acara Rapat Orang tua/Wali
yang akan dilaksanakan di MAN 2 KOTA BANDUNG pada hari Sabtu, 25 Juni 2022 .
Dimohon untuk mendownload surat undangan melalui website https://ppdb.man2kotabandung.sch.id/ .
Semua pertanyaan ditampung melalui humas, mmohon hubungi nomor yang tertera : 082124982579 ";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('nisn', $row->nisn);
                    $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }

    public function send_message_undangan_pengumuman_1()
    {
        $query = $this->db->query("SELECT no_wa,
                                          id,
                                          nisn,
                                          nama_lengkap
                                   FROM ms_siswa s
                                   WHERE id_status IN (2,3,4,5,8)
                                    AND pengumuman_all = 0
                                 ");
        // $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id =2");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg =
                    "Assalamualaikum wr wb
Sehubungan dengan keterbatasan lahan parkir di MAN 2 Kota Bandung, dimohon orang tua/wali Peserta didik baru tidak menggunakan kendaraan roda 4 pada saat mengikuti rapat komite Sabtu, 25 Juni 2022.
Atas perhatian dan kerjasamanya diucapkan terimakasih..
Semua pertanyaan ditampung melalui humas, mmohon hubungi nomor yang tertera : 082124982579 ";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('nisn', $row->nisn);
                    $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }


    public function send_message_baru()
    {

        $type = 'PENGUMUMAN KEGIATAN PENMBEKALAN MATSAMA 2';
        $desc = 'Siswa yang lulus di id 2,3,4,5,8';

        $query = $this->db->query("SELECT no_wa,
                                          nisn,
                                          nama_lengkap
                                   FROM ms_siswa s
                                   WHERE id_status IN (2,3,4,5,8)
                                   AND nisn NOT IN (SELECT nisn FROM send_message_status WHERE type = '{$type}')
                                   LIMIT 20
                                 ");
        $result = $query->result();

        if ($result) {
            foreach ($result as $row) {
                $msg =
                    "Assalamualaikum Wr. Wb.
Diberitahukan kepada Peserta Didik Baru Th 2022-2023. Diwajibkan hadir dalam kegiatan pembekalan MATSAMA 2022 yang dilaksanakan
Pada hari Sabtu,
Tanggal 16 Juli 2022
Pukul 08. 00 WIB
Tempat. Lapangan DOM Kampus Man 2 Kota Bandung
Menggunakan seragam lengkap putih biru atau seragam SMP.
Demikian pemberitahuan ini, Mohon hadir tepat waktu...
Wassalamu' alaikum Wr.Wb.


Ttd
Panitia MATSAMA 2022.";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $data  = array(
                        "nisn" => $row->nisn,
                        "nama" => $row->nama_lengkap,
                        "no_wa" => $row->no_wa,
                        "msg" => $msg,
                        "type" => $type,
                        "desc" => $desc,
                        "date" => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('send_message_status', $data);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }


    public function send_message_undangan_pengumuman_2()
    {
        $query = $this->db->query("SELECT no_wa,
                                          id,
                                          nisn,
                                          nama_lengkap
                                   FROM ms_siswa s
                                   WHERE id_status IN (2,3,4,5,8)
                                    AND pengumuman_all = 0
                                 ");
        // $query = $this->db->query("SELECT no_wa,id FROM ms_siswa s WHERE id =2");
        $result = $query->result();
        if ($result) {
            foreach ($result as $row) {
                $msg =
                    "Assalamualaikum wr.wb
Diinformasikan kepada seluruh calon siswa  baru MAN 2 Kota Bandung Tahun Pelajaran 2022/2023 :
1. Psikotes dilaksanakan pada hari Sabtu, 2 Juli 2022 mulai pukul 09.00.WIB - 12.30 WIB.
2. Siswa diharuskan hadir ke madrasah minimal 15 menit sebelum pelaksanaan psikotes.
3. Sebelum pelaksanaan psikotes, siswa harus mendapatkan istirahat/tidur yang cukup (malamnya tidak boleh begadang).
4. Siswa diharuskan sarapan terlebih dahulu di rumahnya masing-masing sebelum berangkat ke madrasah.
5. Siswa diharuskan menggunakan seragam PSAS SMP/MTs/Pontren asal dengan membawa alat tulis berupa pensil 2B, penghapus steadler dan papan dada.
6. Siswa yang berhalangan hadir mengikuti psikotes, orangtua / wali dari siswa yang bersangkutan diharuskan konfirmasi kepada pihak MAN 2 kota Bandung dengan datang langsung menemui BP/BK di ruangannya.
Semua pertanyaan ditampung melalui humas, mohon hubungi nomor yang tertera : 082124982579
Demikian Informasi ini disampaikan untuk dilaksanakan sebagaimana mestinya
Terimakasih";
                $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
                // pre($data_otp);
                $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

                if ($check_number) {
                    $this->db->where('nisn', $row->nisn);
                    $update = $this->db->update('ms_siswa', ['pengumuman_all' => 1]);
                    echo "sukses kirim pada nomor" . $row->no_wa;
                } else {
                    echo "error kirim pada nomor" . $row->no_wa;
                }
            }
        } else {
            echo "tidak ada data";
        }
    }
}
