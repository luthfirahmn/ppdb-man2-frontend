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

    public function download_kartu_akademik($nisn)
    {
        $query = $this->db->query("SELECT s.nisn,
                                            s.nama_lengkap,
                                            i.sesi,
                                            i.tanggal,
                                            i.ruangan
                                            FROM ms_jadwal_akademik i
                                            LEFT JOIN ms_siswa s ON s.nisn = i.nisn
                                            WHERE s.nisn = {$nisn}
                                ");
        $result = $query->row();
        $tanggal = $result->tanggal . ' JUNI 2022';

        if ($result->sesi == 1) {
            $sesi = '08.00 - 09.00';
        } else if ($result->sesi == 2) {
            $sesi = '09.30 - 10.30';
        } else if ($result->sesi == 3) {
            $sesi = '11.00 - 12.00';
        } else if ($result->sesi == 4) {
            $sesi = '12.30 - 13.30';
        } else if ($result->sesi == 5) {
            $sesi = '14.00 - 15.00';
        } else {
            $sesi = 'Tidak ada sesi, Mohon Hubungi Panitia';
        }


        $data['all_data']           =   $result;
        $data['tanggal']           =   $tanggal;
        $data['sesi']           =   $sesi;

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Kartu Peseta Ujian AKADEMIK.pdf";
        $this->pdf->load_view('kartu_ujian_akademik', $data);
        // $this->load->view('kartu_ujian_akademik', $data);
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
}
