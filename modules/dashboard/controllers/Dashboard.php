<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->DashboardModel;
    }

    public function index()
    {
        $total_pendaftar = $this->model->total_pendaftar();
        $total_pendaftar_isi_form = $this->model->total_pendaftar_isi_form();
        $total_pendaftar_isi_berkas = $this->model->total_pendaftar_isi_berkas();
        $total_pendaftar_lulus_btq = $this->model->total_pendaftar_lulus_btq();
        $total_pendaftar_tidak_lulus_btq = $this->model->total_pendaftar_tidak_lulus_btq();
        $total_pendaftar_akademik = $this->model->total_pendaftar_akademik();
        $total_pendaftar_prestasi = $this->model->total_pendaftar_prestasi();
        $total_pendaftar_ketm = $this->model->total_pendaftar_ketm();
        $total_pendaftar_ppt = $this->model->total_pendaftar_ppt();
        $total_pendaftar_agama = $this->model->total_pendaftar_agama();

        // $this->assetsBuild(array('datatables'));
        $this->template->title('Dashboard');
        $this->setTitlePage();
        $this->template->set_breadcrumb('dashboard');
        $data = array(
            "total_pendaftar" => $total_pendaftar,
            "total_pendaftar_isi_form" => $total_pendaftar_isi_form,
            "total_pendaftar_isi_berkas" => $total_pendaftar_isi_berkas,
            "total_pendaftar_lulus_btq" => $total_pendaftar_lulus_btq,
            "total_pendaftar_tidak_lulus_btq" => $total_pendaftar_tidak_lulus_btq,
            "total_pendaftar_akademik" => $total_pendaftar_akademik,
            "total_pendaftar_prestasi" => $total_pendaftar_prestasi,
            "total_pendaftar_ketm" => $total_pendaftar_ketm,
            "total_pendaftar_ppt" => $total_pendaftar_ppt,
            "total_pendaftar_agama" => $total_pendaftar_agama
        );

        $this->template->build('index', $data);
    }
}
