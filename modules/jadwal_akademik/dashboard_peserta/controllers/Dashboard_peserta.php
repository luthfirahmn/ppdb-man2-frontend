<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_peserta extends FT_Controller
{
    //required declare
    protected $_breadcrumb;
    public function __construct()
    {
        parent::__construct();
        //required declare
        $this->_breadcrumb[0] = 'Dashboard';
    }
    public function index()
    {

        //required declare
        $this->_breadcrumb[] = 'index';
        $id = $this->session->userdata('id');
        if($id == ''){
                session_destroy();
                redirect('login_peserta');
        }else{
            $query = $this->db->query("SELECT ref_status FROM ms_siswa WHERE id = {$id}");

            $ref_status = $query->row();

            if($ref_status){
                switch($ref_status->ref_status){
                    case 1 :
                        redirect('emis_regular');
                    break;
                    default:
                        $this->page($id);
                    break;
                }


            }else{
                session_destroy();
                redirect('login_peserta');
            }
        }


    }

    public function page($id){

        $query = $this->db->query("SELECT *
                                    FROM info_per_ref
                                    WHERE ref_status IN (SELECT ref_status
                                                         FROM ms_siswa
                                                         WHERE id = {$id})
                                ");
        $getInfo = $query->result();

        $query = $this->db->query("SELECT
                                        i.nisn,
                                        (SELECT berkas_foto FROM ms_siswa_berkas table2 WHERE table2.id_siswa = i.id) foto,
                                        i.nama_lengkap,
                                        CONCAT('0',i.no_wa) AS no_wa,
                                        i.email,
                                        j.jalur
                                    FROM ms_siswa i
                                    LEFT JOIN ms_jalur j ON j.id = i.id_jalur
                                    WHERE i.id = '{$id}'
        ");
        $getInfoPeserta = $query->row_array();

        $data = array(
            'contentHeader'     => $this->_breadcrumb[0],
            'breadcrumb'        => $this->_breadcrumb,
            'info'              => $getInfo,
            'infoPeserta'       => $getInfoPeserta
        );

        $style["css"] = [
            FT_APP_ASSETS . "/css/pages/page-profile.css",

        ];


        $this->template->style($style);
        $this->template->title('Dashboard');
        $this->template->build('dashboard', $data);

    }

    public function download_kartu_btq()
    {
        $id = $this->session->userdata('id');
        $query = $this->db->query("SELECT s.nisn,s.nama_lengkap,i.waktu,i.tanggal,i.ruangan,i.penguji FROM ms_jadwal_btq i LEFT JOIN ms_siswa s ON s.id = i.id_siswa WHERE s.id = '{$id}' ORDER BY i.id ASC");
        $result = $query->row();

        if($result){
        $data['all_data']           =   $result;


        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Kartu Peseta Ujian BTQ.pdf";
        $this->pdf->load_view('pdf_ujian', $data);
        }else{
            session_destroy();
            redirect('login_peserta');
        }
        /*$this->load->view('frontend/page_peserta/pdf_btq', $data);*/
    }

    public function download_status_kelulusan($nisn)
    {
        $query = $this->db->query("SELECT
                                    s.nisn,
                                    s.nama_lengkap,
                                    s.tempat_lahir,
                                    s.tgl_lahir,
                                    s.id_status,
                                    s.waiting_list,
                                    (SELECT jalur FROM ms_jalur WHERE id = s.id_jalur) jalur
                                    FROM ms_siswa s  WHERE s.nisn = {$nisn}
                                    ");
        $result = $query->row();
        $data['all_data']           =   $result;

        if ($result->id_status == 2 or $result->id_status == 3 or $result->id_status == 4 or $result->id_status == 5 or $result->id_status == 8) {
            $data['status_val']           =   'DITERIMA';
            $data['status_id']           =   1;
        } else {
            $data['status_val']           =   'TIDAK DITERIMA';
            $data['status_id']           =   0;
        }



        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Status Kelulusan.pdf";
        if ($result->id_status == 8 and $result->waiting_list != 1) {
            $this->pdf->load_view('kartu_status_akademik', $data);
        } else if ($result->id_status == 80) {
            $this->pdf->load_view('kartu_status_akademik', $data);
        } else if ($result->id_status == 8 and $result->waiting_list == 1) {
            $this->pdf->load_view('kartu_status_waiting_list', $data);
        } else {
            $this->pdf->load_view('kartu_status', $data);
        }
        // $this->load->view('kartu_status', $data);
    }

    public function download_status_kelulusan_non_akademik()
    {
        $id = $this->session->userdata('id');
        if($id == ''){
            redirect('login_peserta');
            die;
        }
        $query = $this->db->query("SELECT
                                    s.nisn,
                                    s.nama_lengkap,
                                    s.tempat_lahir,
                                    s.tgl_lahir,
                                    s.id_status,
                                    s.waiting_list,
                                    (SELECT jalur FROM ms_jalur WHERE id = s.id_jalur) jalur
                                    FROM ms_siswa s  WHERE s.id = {$id}
                                    ");
        $result = $query->row();
        $data['all_data']           =   $result;

        if ($result->id_status == 2 or $result->id_status == 3 or $result->id_status == 4 or $result->id_status == 5 or $result->id_status == 8) {
            $data['status_val']           =   'DITERIMA';
            $data['status_id']           =   1;
        } else {
            $data['status_val']           =   'TIDAK DITERIMA';
            $data['status_id']           =   0;
        }



        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Status Kelulusan.pdf";
        $this->pdf->load_view('kartu_status_non_akademik', $data);
        // if ($result->id_status == 8 and $result->waiting_list != 1) {
        //     $this->pdf->load_view('kartu_status_akademik', $data);
        // } else if ($result->id_status == 80) {
        //     $this->pdf->load_view('kartu_status_akademik', $data);
        // } else if ($result->id_status == 8 and $result->waiting_list == 1) {
        //     $this->pdf->load_view('kartu_status_waiting_list', $data);
        // } else {
        //     $this->pdf->load_view('kartu_status', $data);
        // }
        // $this->load->view('kartu_status', $data);
    }

    public function download_kartu_akademik()
    {
        $id = $this->session->userdata('id');
        if($id == ''){
            redirect('login_peserta');
            die;
        }
        $query = $this->db->query("SELECT  CONCAT('0',siswa.no_wa) as no_wa,
                                            siswa.nama_lengkap,
                                            siswa.nisn,
                                            jadwal.tanggal,
                                            jadwal.jam,
                                            jadwal.ruangan,
                                            (SELECT asal_sekolah FROM ms_siswa_sekolah WHERE id_siswa = siswa.id ORDER BY id DESC LIMIT 1) asal_sekolah
                                            FROM ms_siswa siswa
                                            INNER JOIN ms_jadwal_akademik akademik ON akademik.id_siswa = siswa.id
                                            INNER JOIN conf_jadwal_akademik jadwal ON akademik.id_conf_jadwal_akademik = jadwal.id
                                            WHERE siswa.id = {$id}
                                ");
        $result = $query->row();
        if($result){
            $data['all_data']           =   $result;
            $data['tanggal']           =   $this->format_hari_tanggal($result->tanggal);
            $data['image']          = $this->config->item('base_url') . 'assets/logo.png';
            // pre($data['image']);

            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->filename = "Kartu Peseta Ujian AKADEMIK.pdf";
            $this->pdf->load_view('pdf_jadwal_akademik', $data);
        }else{
            echo"Terjadi kesalahan atau jadwal belum tersedia, Tolong hubungi admin";
        }

        // $this->load->view('pdf_jadwal_akademik', $data);
    }

    function download_kartu_undangan()
    {
        $this->load->helper('download');
        $base_url = ('./assets/undangan.pdf');
        force_download($base_url, NULL);
    }

    function download_kartu_undangan_ketm()
    {
        $this->load->helper('download');
        $base_url = ('./assets/undangan_ketm.pdf');
        force_download($base_url, NULL);
    }

    function format_hari_tanggal($waktu)
    {
        $hari_array = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );
        $hr = date('w', strtotime($waktu));
        $hari = $hari_array[$hr];
        $tanggal = date('j', strtotime($waktu));
        $bulan_array = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];
        $tahun = date('Y', strtotime($waktu));
        $jam = date( 'H:i:s', strtotime($waktu));

        //untuk menampilkan hari, tanggal bulan tahun jam
        //return "$hari, $tanggal $bulan $tahun $jam";

        //untuk menampilkan hari, tanggal bulan tahun
        return "$hari, $tanggal $bulan $tahun";
    }
}
