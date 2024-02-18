<?php defined('BASEPATH') or exit('No direct script access allowed');

class Emis_regular extends FT_Controller
{
    //required declare
    protected $_breadcrumb;
    public function __construct()
    {
        parent::__construct();
        //required declare
        $this->_breadcrumb[0] = 'Form Data Diri';
    }
    public function index()
    {
        if ($this->session->userdata('status_login') != 1) {
            redirect('login');
        };

        $id = $this->session->userdata('id');


        $query = $this->db->query("SELECT ref_status FROM ms_siswa WHERE id = {$id}");

        $ref_status = $query->row();
        if ($ref_status->ref_status == 2) {
            redirect('dashboard_peserta');
        }


        //required declare
        $this->_breadcrumb[] = 'index';

        $query = $this->db->query("SELECT * FROM ms_jalur WHERE active = 1 ORDER BY id ASC");
        $jalur = $query->result_array();

        $id = $this->session->userdata('id');
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id = '{$id}'");
        $siswa = $query->row_array();

        $data = array(
            'contentHeader' => $this->_breadcrumb[0],
            'breadcrumb' => $this->_breadcrumb,
            'jalur'         => $jalur,
            'siswa'         => $siswa,
        );

        $style["css"] = [
            FT_APP_ASSETS . "vendors/css/forms/wizard/bs-stepper.min.css",
            FT_APP_ASSETS . "vendors/css/forms/select/select2.min.css",
            FT_APP_ASSETS . "css/plugins/forms/form-validation.css",
            FT_APP_ASSETS . "css/plugins/forms/form-wizard.css"

        ];

        $script["js"] = [
            FT_APP_ASSETS . "vendors/js/forms/wizard/bs-stepper.min.js",
            FT_APP_ASSETS . "vendors/js/forms/select/select2.full.min.js",
            FT_APP_ASSETS . "vendors/js/forms/validation/jquery.validate.min.js",
            // FT_APP_ASSETS . "js/scripts/forms/form-wizard.js",
        ];


        $this->template->style($style);
        // pre($a);
        $this->template->script($script);
        $this->template->title('Form Data Diri');
        $this->template->build('index', $data);
    }

    public function validate()
    {
        //required declare
        $this->_breadcrumb[] = 'index';

        $query = $this->db->query("SELECT * FROM ms_jalur WHERE active = 1 ORDER BY id ASC");
        $jalur = $query->result_array();

        $id = $this->session->userdata('id');
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id = '{$id}'");
        $siswa = $query->row_array();

        $data = array(
            'contentHeader' => $this->_breadcrumb[0],
            'breadcrumb' => $this->_breadcrumb,
            'jalur'         => $jalur,
            'siswa'         => $siswa,
        );

        $style["css"] = [
            FT_APP_ASSETS . "vendors/css/forms/wizard/bs-stepper.min.css",
            FT_APP_ASSETS . "vendors/css/forms/select/select2.min.css",
            FT_APP_ASSETS . "css/plugins/forms/form-validation.css",
            FT_APP_ASSETS . "css/plugins/forms/form-wizard.css"

        ];

        $script["js"] = [
            FT_APP_ASSETS . "vendors/js/forms/wizard/bs-stepper.min.js",
            FT_APP_ASSETS . "vendors/js/forms/select/select2.full.min.js",
            FT_APP_ASSETS . "vendors/js/forms/validation/jquery.validate.min.js",
            // FT_APP_ASSETS . "js/scripts/forms/form-wizard.js",
        ];


        $this->template->style($style);
        // pre($a);
        $this->template->script($script);
        $this->template->title('Validasi Folmulir');
        $this->template->build('validate', $data);
    }


    public function data_diri()
    {
        $id = $this->session->userdata('id');
        $query = $this->db->query("SELECT ref_status FROM ms_siswa WHERE id = {$id}");

        $ref_status = $query->row();
        if ($ref_status->ref_status == 2) {
            echo json_encode(['error' => false, 'msg' => 'Sukses']);
            die;
        }


        $this->db->trans_start();
        $data["tempat_lahir"]    = $this->input->post('tempat_lahir');
        $data["jenis_kelamin"]   = $this->input->post('jenis_kelamin');
        $data["ref_status"]   = 2;


        $this->db->where('id', $this->session->userdata('id'))
            ->update('ms_siswa', $data);


        $dataAlamat["id_siswa"]             = $this->session->userdata('id');
        $dataAlamat["alamat"]             = $this->input->post('alamat');
        $dataAlamat["provinsi"]             = $this->input->post('provinsi');
        $dataAlamat["kota"]             = $this->input->post('kota');
        $dataAlamat["kecamatan"]             = $this->input->post('kecamatan');
        $dataAlamat["kelurahan"]             = $this->input->post('kelurahan');
        $dataAlamat["kecamatan"]             = $this->input->post('kecamatan');
        $dataAlamat["rt"]             = $this->input->post('rt');
        $dataAlamat["rw"]             = $this->input->post('rw');

        $this->db->insert('ms_siswa_alamat', $dataAlamat);


        $dataSekolah["id_siswa"]             = $this->session->userdata('id');
        $dataSekolah["asal_sekolah"]             = $this->input->post('asal_sekolah');

        $this->db->insert('ms_siswa_sekolah', $dataSekolah);

        $dataOrtu["id_siswa"]             = $this->session->userdata('id');
        $dataOrtu["nama_ayah"]             = $this->input->post('nama_ayah');
        $dataOrtu["pekerjaan_ayah"]             = $this->input->post('pekerjaan_ayah');
        $dataOrtu["no_hp_ayah"]             = $this->input->post('no_hp_ayah');
        $dataOrtu["nama_ibu"]             = $this->input->post('nama_ibu');
        $dataOrtu["pekerjaan_ibu"]             = $this->input->post('pekerjaan_ibu');
        $dataOrtu["no_hp_ibu"]             = $this->input->post('no_hp_ibu');


        $this->db->insert('ms_siswa_ortu', $dataOrtu);

        sleep(3);

        // Fetch data from temp_jadwal_btq table based on id
        $qJadwal = $this->db->query("SELECT * FROM temp_jadwal_btq WHERE id = 1");
        $result = $qJadwal->row();

        // Get the time and date from the result
        $waktu = $result->waktu;
        $tanggal = $result->tanggal;

        // Check if the time is during the break (11:30 - 13:00)
        $breakStart = strtotime('11:30:00');
        $breakEnd = strtotime('13:00:00');
        $currentTime = strtotime($waktu);

        // Check the total count of rows in ms_jadwal_btq table for the same date
        $qbtqDate = $this->db->query("SELECT COUNT(*) as total FROM ms_jadwal_btq WHERE tanggal = '$tanggal'");
        $countDateResult = $qbtqDate->row();

        if ($countDateResult && $countDateResult->total >= 200) {

            $newDate = date('Y-m-d', strtotime("$tanggal +1 day"));
            $newTime = '08:00:00'; // Set the starting time for the next day
            while (date('N', strtotime($newDate)) >= 6) { // 6 is Saturday, 7 is Sunday
                $newDate = date('Y-m-d', strtotime("$newDate +1 day"));
            }

            // If the count is 200 or more, move to the next day
        } else {
            // If the date is a Saturday or Sunday, move to the next available weekday

            $newDate =  $result->tanggal;
            // Proceed with the existing logic for weekdays
            if ($currentTime >= $breakStart && $currentTime <= $breakEnd) {
                // If the time is during the break, add 1 hour to skip the break
                $newTime = date('H:i:s', strtotime("$waktu +1 hour"));
            } else {
                // Check the total count of rows in ms_jadwal_btq table
                $qbtq = $this->db->query("SELECT COUNT(*) as total FROM ms_jadwal_btq");
                $countResult = $qbtq->row();

                if ($countResult && $countResult->total == 40) {
                    // If the count is 40, add 1 hour to the time
                    $newTime = date('H:i:s', strtotime("$waktu +1 hour"));
                } else {
                    // If the count is not 40, return the original time
                    $newTime = $waktu;
                }
            }
        }
        // pre($newDate);
        // Insert data into ms_jadwal_btq table
        $dataJadwal["id_siswa"] = $this->session->userdata('id');
        $dataJadwal["waktu"] = $newTime;
        $dataJadwal["tanggal"] = $newDate;
        $this->db->insert('ms_jadwal_btq', $dataJadwal);

        // Update data in temp_jadwal_btq table
        $dataJadwalTemp["waktu"] = $newTime;
        $dataJadwalTemp["tanggal"] = $newDate;
        $this->db->where('id', 1);
        $this->db->update('temp_jadwal_btq', $dataJadwalTemp);


        $this->db->trans_complete();


        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            echo json_encode(['error' => true, 'msg' => $this->db->error()]);
        } else {
            # Everything is Perfect.
            # Committing data to the database.
            $this->db->trans_commit();
            echo json_encode(['error' => false, 'msg' => 'Sukses']);
        }
    }
}
