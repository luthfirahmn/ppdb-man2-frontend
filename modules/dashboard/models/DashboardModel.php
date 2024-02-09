<?php defined('BASEPATH') or exit('No direct script access allowed');

class DashboardModel extends MY_Model
{


    public function __construct()
    {
        parent::__construct();
        //required declare
    }

    public function total_pendaftar()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa");
        $result = $query->num_rows();

        return $result;
    }

    public function total_pendaftar_isi_form()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE status_data_diri = 1 AND status_alamat = 1 AND status_asal_sekolah = 1 AND status_ortu = 1");
        $result = $query->num_rows();

        return $result;
    }

    public function total_pendaftar_isi_berkas()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE status_berkas = 1");
        $result = $query->num_rows();

        return $result;
    }

    public function total_pendaftar_lulus_btq()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id_status = 1");
        $result = $query->num_rows();

        return $result;
    }

    public function total_pendaftar_tidak_lulus_btq()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id_status = 9");
        $result = $query->num_rows();

        return $result;
    }

    public function total_pendaftar_akademik()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id_jalur = 1 ");
        $result = $query->num_rows();

        return $result;
    }

    public function total_pendaftar_prestasi()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id_jalur = 2 AND id_status IN (2,20,1)");
        $result = $query->num_rows();

        return $result;
    }

    public function total_pendaftar_ppt()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id_jalur = 4 AND id_status IN (4,40,1) ");
        $result = $query->num_rows();

        return $result;
    }

    public function total_pendaftar_ketm()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id_jalur = 3 AND id_status IN (3,30,1) ");
        $result = $query->num_rows();

        return $result;
    }

    public function total_pendaftar_agama()
    {
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id_jalur = 5 AND id_status IN (5,50,1)");
        $result = $query->num_rows();

        return $result;
    }
}