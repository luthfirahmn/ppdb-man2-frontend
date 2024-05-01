<?php defined('BASEPATH') or exit('No direct script access allowed');

class Emis extends FT_Controller
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
        $this->_breadcrumb[] = 'index';

        $id = $this->session->userdata('id');
        if ($id == '') {
            session_destroy();
            redirect('login_peserta');
        } else {
            $query = $this->db->query("SELECT ref_status FROM ms_siswa WHERE id = {$id}");

            $ref_status = $query->row();

            if ($ref_status) {
                switch ($ref_status->ref_status) {
                    case 3:
                        $this->page($id);
                        break;
                    default:
                        redirect('dashboard_peserta');
                        break;
                }
            } else {
                session_destroy();
                redirect('login_peserta');
            }
        }
    }

    public function page($id)
    {
        //required declare

        $query = $this->db->query("SELECT * FROM ms_jalur WHERE active = 1 ORDER BY id ASC");
        $jalur = $query->result_array();

        $query = $this->db->query("SELECT
                                        t0.*,
                                        t1.jalur,
                                        t2.*,
                                        t3.*,
                                        t4.*,
                                        t5.*
                                    FROM ms_siswa t0
                                    LEFT JOIN ms_jalur t1 ON t1.id = t0.id_jalur
                                    LEFT JOIN ms_siswa_alamat t2 ON t2.id_siswa = t0.id
                                    LEFT JOIN ms_siswa_sekolah t3 ON t3.id_siswa = t0.id
                                    LEFT JOIN ms_siswa_ortu t4 ON t4.id_siswa = t0.id
                                    LEFT JOIN ms_siswa_berkas t5 ON t5.id_siswa = t0.id
                                    WHERE t0.id = {$id}
                                    ");
        $siswa = $query->row_array();

        $query = $this->db->query("SELECT *
                                    FROM ms_jalur j
                                    WHERE j.id IN (SELECT id_jalur FROM ms_siswa WHERE id = {$id}) ");
        $all_jalur = $query->row_array();

        $data = array(
            'contentHeader' => $this->_breadcrumb[0],
            'breadcrumb' => $this->_breadcrumb,
            'jalur'         => $jalur,
            'all_jalur'         => $all_jalur ? $all_jalur : 0,
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
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        $query = $this->db->query("SELECT * FROM ms_siswa WHERE id = {$id}");
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

    public function pilih_jalur()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('pilih_jalur', 'Jalur', 'required');

        $this->form_validation->set_message('required', '%s Harus Diisi');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => true, 'msg' => $errors]);
            die;
        }
        $data["id_jalur"]             = $this->input->post('pilih_jalur');


        $update = $this->db->where('id', $this->session->userdata('id'))
            ->update('ms_siswa', $data);

        if ($update) {
            echo json_encode(['error' => false, 'msg' => 'Sukses']);
            // redirect('userlogin');
        } else {
            echo json_encode(['error' => true, 'msg' => $this->db->error()]);
        }
    }

    public function data_diri()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }

        $data["nik"]             = $this->input->post('nik');
        $data["tempat_lahir"]             = $this->input->post('tempat_lahir');
        $data["jenis_kelamin"]             = $this->input->post('jenis_kelamin');
        $data["hobi"]             = $this->input->post('hobi');
        $data["cita"]             = $this->input->post('cita');
        $data["jumlah_saudara"]             = $this->input->post('jumlah_saudara');
        $data["anak_ke"]             = $this->input->post('anak_ke');
        $data["npsn"]             = $this->input->post('npsn');
        $data["no_ijazah"]             = $this->input->post('no_ijazah');
        $data["pernah_tk"]             = $this->input->post('pernah_tk');
        $data["pernah_paud"]             = $this->input->post('pernah_paud');
        $data["tinggi"]             = $this->input->post('tinggi');
        $data["berat"]             = $this->input->post('berat');
        $data["lingkar_kepala"]             = $this->input->post('lingkar_kepala');
        $data["hepatitis_b"]             = $this->input->post('hepatitis_b');
        $data["polio"]             = $this->input->post('polio');
        $data["bcg"]             = $this->input->post('bcg');
        $data["campak"]             = $this->input->post('campak');
        $data["dpt"]             = $this->input->post('dpt');
        $data["status_data_diri"]             = 1;


        $update = $this->db->where('id', $this->session->userdata('id'))
            ->update('ms_siswa', $data);

        if ($update) {
            echo json_encode(['error' => false, 'msg' => 'Sukses']);
            // redirect('userlogin');
        } else {
            echo json_encode(['error' => true, 'msg' => $this->db->error()]);
        }
    }

    public function alamat()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        $data["id_siswa"]             = $this->session->userdata('id');
        $data["alamat"]             = $this->input->post('alamat');
        $data["provinsi"]             = $this->input->post('provinsi');
        $data["kota"]             = $this->input->post('kota');
        $data["kecamatan"]             = $this->input->post('kecamatan');
        $data["kelurahan"]             = $this->input->post('kelurahan');
        $data["kecamatan"]             = $this->input->post('kecamatan');
        $data["kode_pos"]             = $this->input->post('kode_pos');
        $data["jarak_rumah"]             = $this->input->post('jarak_rumah');
        $data["transportasi"]             = $this->input->post('transportasi');
        $data["status_tempat"]             = $this->input->post('status_tempat');
        $data_status["status_alamat"]             = 1;


        $update = $this->db->where('id_siswa', $this->session->userdata('id'))
            ->update('ms_siswa_alamat', $data);

        $this->db->where('id', $this->session->userdata('id'))
            ->update('ms_siswa', $data_status);

        if ($update) {
            echo json_encode(['error' => false, 'msg' => 'Sukses']);
            // redirect('userlogin');
        } else {
            echo json_encode(['error' => true, 'msg' => $this->db->error()]);
        }
    }

    public function sekolah()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        $data["id_siswa"]             = $this->session->userdata('id');
        $data["asal_sekolah"]             = $this->input->post('asal_sekolah');
        $data["jenis_sekolah"]             = $this->input->post('jenis_sekolah');
        $data["status_sekolah"]             = $this->input->post('status_sekolah');
        $data["kota_sekolah"]             = $this->input->post('kota_sekolah');
        $data_status["status_asal_sekolah"]             = 1;


        $update = $this->db->where('id_siswa', $this->session->userdata('id'))
            ->update('ms_siswa_sekolah', $data);

        $this->db->where('id', $this->session->userdata('id'))
            ->update('ms_siswa', $data_status);

        if ($update) {
            echo json_encode(['error' => false, 'msg' => 'Sukses']);
            // redirect('userlogin');
        } else {
            echo json_encode(['error' => true, 'msg' => $this->db->error()]);
        }
    }

    public function orang_tua()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        $data["id_siswa"]             = $this->session->userdata('id');
        $data["no_kk"]             = $this->input->post('no_kk');
        $data["no_ktp_ayah"]             = $this->input->post('no_ktp_ayah');
        $data["nama_ayah"]             = $this->input->post('nama_ayah');
        $data["tempat_lahir_ayah"]             = $this->input->post('tempat_lahir_ayah');
        $data["tgl_lahir_ayah"]             = $this->input->post('tgl_lahir_ayah');
        $data["pendidikan_ayah"]             = $this->input->post('pendidikan_ayah');
        $data["pekerjaan_ayah"]             = $this->input->post('pekerjaan_ayah');
        $data["no_hp_ayah"]             = $this->input->post('no_hp_ayah');
        $data["status_ayah"]             = $this->input->post('status_ayah');
        $data["no_ktp_ibu"]             = $this->input->post('no_ktp_ibu');
        $data["nama_ibu"]             = $this->input->post('nama_ibu');
        $data["tempat_lahir_ibu"]             = $this->input->post('tempat_lahir_ibu');
        $data["tgl_lahir_ibu"]             = $this->input->post('tgl_lahir_ibu');
        $data["pendidikan_ibu"]             = $this->input->post('pendidikan_ibu');
        $data["pekerjaan_ibu"]             = $this->input->post('pekerjaan_ibu');
        $data["no_hp_ibu"]             = $this->input->post('no_hp_ibu');
        $data["status_ibu"]             = $this->input->post('status_ibu');
        $data["penghasilan_ortu"]             = $this->input->post('penghasilan_ortu');
        $data_status["status_ortu"]             = 1;


        $update = $this->db->where('id_siswa', $this->session->userdata('id'))
            ->update('ms_siswa_ortu', $data);

        $this->db->where('id', $this->session->userdata('id'))
            ->update('ms_siswa', $data_status);

        if ($update) {
            echo json_encode(['error' => false, 'msg' => 'Sukses']);
            // redirect('userlogin');
        } else {
            echo json_encode(['error' => true, 'msg' => $this->db->error()]);
        }
    }


    public function berkas_keterangan_lulus()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        if (isset($_POST)) {



            $query = $this->db->query("SELECT * FROM ms_siswa_berkas WHERE id_siswa = {$id}");
            $result = $query->row();

            if ($result) {

                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'keterangan_lulus' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('keterangan_lulus')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {

                    if ($result->berkas_keterangan_lulus != '') {
                        unlink(UPLOAD_BERKAS . $result->berkas_keterangan_lulus);
                    }
                    $uploadData = $this->upload->data();

                    $data = array(
                        "berkas_keterangan_lulus" => $uploadData["file_name"]
                    );
                    $this->db->where("id_siswa", $id);
                    $update = $this->db->update('ms_siswa_berkas', $data);
                    if ($update) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            } else {
                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'keterangan_lulus' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('keterangan_lulus')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {
                    $uploadData = $this->upload->data();

                    $data = array(
                        "id_siswa"                 => $id,
                        "berkas_keterangan_lulus" => $uploadData["file_name"]
                    );
                    $insert = $this->db->insert('ms_siswa_berkas', $data);
                    if ($insert) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            }
        } else {
            echo json_encode(array("error" => true, "msg" => "File tidak ditemukan"));
        }
    }

    public function berkas_nisn()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        if (isset($_POST)) {

            $query = $this->db->query("SELECT * FROM ms_siswa_berkas WHERE id_siswa = {$id} ");
            $result = $query->row();

            if ($result) {

                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_nisn' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_nisn')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {

                    if ($result->berkas_nisn != '') {
                        unlink(UPLOAD_BERKAS . $result->berkas_nisn);
                    }
                    $uploadData = $this->upload->data();

                    $data = array(
                        "berkas_nisn" => $uploadData["file_name"]
                    );
                    $this->db->where("id_siswa", $id);
                    $update = $this->db->update('ms_siswa_berkas', $data);
                    if ($update) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            } else {
                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_nisn' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_nisn')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {
                    $uploadData = $this->upload->data();

                    $data = array(
                        "id_siswa"                 => $id,
                        "berkas_nisn" => $uploadData["file_name"]
                    );
                    $insert = $this->db->insert('ms_siswa_berkas', $data);
                    if ($insert) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            }
        } else {
            echo json_encode(array("error" => true, "msg" => "File tidak ditemukan"));
        }
    }

    public function berkas_rapot()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        if (isset($_POST)) {

            $query = $this->db->query("SELECT * FROM ms_siswa_berkas WHERE id_siswa = {$id} ");
            $result = $query->row();

            if ($result) {

                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_rapot' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_rapot')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {

                    if ($result->berkas_rapot != '') {
                        unlink(UPLOAD_BERKAS . $result->berkas_rapot);
                    }
                    $uploadData = $this->upload->data();

                    $data = array(
                        "berkas_rapot" => $uploadData["file_name"]
                    );
                    $this->db->where("id_siswa", $id);
                    $update = $this->db->update('ms_siswa_berkas', $data);
                    if ($update) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            } else {
                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_rapot' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_rapot')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {
                    $uploadData = $this->upload->data();

                    $data = array(
                        "id_siswa"                 => $id,
                        "berkas_rapot" => $uploadData["file_name"]
                    );
                    $insert = $this->db->insert('ms_siswa_berkas', $data);
                    if ($insert) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            }
        } else {
            echo json_encode(array("error" => true, "msg" => "File tidak ditemukan"));
        }
    }

    public function berkas_akte()
    {
        if (isset($_POST)) {

            $id = $this->session->userdata('id');
            if ($id == '') {
                echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
                die;
            }

            $query = $this->db->query("SELECT * FROM ms_siswa_berkas WHERE id_siswa = {$id} ");
            $result = $query->row();

            if ($result) {

                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_akte' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_akte')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {

                    if ($result->berkas_akte != '') {
                        unlink(UPLOAD_BERKAS . $result->berkas_akte);
                    }
                    $uploadData = $this->upload->data();

                    $data = array(
                        "berkas_akte" => $uploadData["file_name"]
                    );
                    $this->db->where("id_siswa", $id);
                    $update = $this->db->update('ms_siswa_berkas', $data);
                    if ($update) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            } else {
                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_akte' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_akte')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {
                    $uploadData = $this->upload->data();

                    $data = array(
                        "id_siswa"                 => $id,
                        "berkas_akte" => $uploadData["file_name"]
                    );
                    $insert = $this->db->insert('ms_siswa_berkas', $data);
                    if ($insert) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            }
        } else {
            echo json_encode(array("error" => true, "msg" => "File tidak ditemukan"));
        }
    }

    public function berkas_kk()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        if (isset($_POST)) {

            $query = $this->db->query("SELECT * FROM ms_siswa_berkas WHERE id_siswa = {$id} ");
            $result = $query->row();

            if ($result) {

                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_kk' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_kk')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {

                    if ($result->berkas_kk != '') {
                        unlink(UPLOAD_BERKAS . $result->berkas_kk);
                    }
                    $uploadData = $this->upload->data();

                    $data = array(
                        "berkas_kk" => $uploadData["file_name"]
                    );
                    $this->db->where("id_siswa", $id);
                    $update = $this->db->update('ms_siswa_berkas', $data);
                    if ($update) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            } else {
                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_kk' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_kk')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {
                    $uploadData = $this->upload->data();

                    $data = array(
                        "id_siswa"                 => $id,
                        "berkas_kk" => $uploadData["file_name"]
                    );
                    $insert = $this->db->insert('ms_siswa_berkas', $data);
                    if ($insert) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            }
        } else {
            echo json_encode(array("error" => true, "msg" => "File tidak ditemukan"));
        }
    }

    public function berkas_ktp_ortu()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        if (isset($_POST)) {

            $query = $this->db->query("SELECT * FROM ms_siswa_berkas WHERE id_siswa = {$id} ");
            $result = $query->row();

            if ($result) {

                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_ktp_ortu' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_ktp_ortu')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {

                    if ($result->berkas_ktp_ortu != '') {
                        unlink(UPLOAD_BERKAS . $result->berkas_ktp_ortu);
                    }
                    $uploadData = $this->upload->data();

                    $data = array(
                        "berkas_ktp_ortu" => $uploadData["file_name"]
                    );
                    $this->db->where("id_siswa", $id);
                    $update = $this->db->update('ms_siswa_berkas', $data);
                    if ($update) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            } else {
                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_ktp_ortu' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_ktp_ortu')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {
                    $uploadData = $this->upload->data();

                    $data = array(
                        "id_siswa"                 => $id,
                        "berkas_ktp_ortu" => $uploadData["file_name"]
                    );
                    $insert = $this->db->insert('ms_siswa_berkas', $data);
                    if ($insert) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            }
        } else {
            echo json_encode(array("error" => true, "msg" => "File tidak ditemukan"));
        }
    }

    public function berkas_foto()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        if (isset($_POST)) {

            $query = $this->db->query("SELECT * FROM ms_siswa_berkas WHERE id_siswa = {$id} ");
            $result = $query->row();

            if ($result) {

                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_foto' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_foto')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {

                    if ($result->berkas_foto != '') {
                        unlink(UPLOAD_BERKAS . $result->berkas_foto);
                    }
                    $uploadData = $this->upload->data();

                    $data = array(
                        "berkas_foto" => $uploadData["file_name"]
                    );
                    $this->db->where("id_siswa", $id);
                    $update = $this->db->update('ms_siswa_berkas', $data);
                    if ($update) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            } else {
                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png';
                $config['max_size'] = 2000;
                $config['file_name'] = 'berkas_foto' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_foto')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {
                    $uploadData = $this->upload->data();

                    $data = array(
                        "id_siswa"                 => $id,
                        "berkas_foto" => $uploadData["file_name"]
                    );
                    $insert = $this->db->insert('ms_siswa_berkas', $data);
                    if ($insert) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            }
        } else {
            echo json_encode(array("error" => true, "msg" => "File tidak ditemukan"));
        }
    }

    public function berkas_khusus()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        if (isset($_POST)) {

            $query = $this->db->query("SELECT * FROM ms_siswa_berkas WHERE id_siswa = {$id} ");
            $result = $query->row();

            if ($result) {

                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png|rar';
                $config['max_size'] = 5000;
                $config['file_name'] = 'berkas_khusus' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_khusus')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {

                    if ($result->berkas_khusus != '') {
                        unlink(UPLOAD_BERKAS . $result->berkas_khusus);
                    }
                    $uploadData = $this->upload->data();

                    $data = array(
                        "berkas_khusus" => $uploadData["file_name"]
                    );
                    $this->db->where("id_siswa", $id);
                    $update = $this->db->update('ms_siswa_berkas', $data);
                    if ($update) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            } else {
                $config['upload_path'] = UPLOAD_BERKAS;
                $config['allowed_types'] = 'pdf|jpeg|jpg|png|rar';
                $config['max_size'] = 5000;
                $config['file_name'] = 'berkas_khusus' . $id . random_digits();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('berkas_khusus')) {
                    echo json_encode(array("error" => true, "msg" => "error: " . $this->upload->display_errors(),));
                } else {
                    $uploadData = $this->upload->data();

                    $data = array(
                        "id_siswa"                 => $id,
                        "berkas_khusus" => $uploadData["file_name"]
                    );
                    $insert = $this->db->insert('ms_siswa_berkas', $data);
                    if ($insert) {
                        echo json_encode(array("error" => false, "msg" => 'Success upload berkas'));
                    } else {
                        echo json_encode(array("error" => true, "msg" => 'Error upload berkas'));
                    }
                }
            }
        } else {
            echo json_encode(array("error" => true, "msg" => "File tidak ditemukan"));
        }
    }


    public function save()
    {
        $id = $this->session->userdata('id');
        if ($id == '') {
            echo json_encode(['error' => true, 'msg' => 'Session telah habis, mohon untuk logout dan login kembali']);
            die;
        }
        $query = $this->db->query("SELECT *,(SELECT id_jalur FROM ms_siswa WHERE id = {$id}) as id_jalur FROM ms_siswa_berkas WHERE id_siswa = {$id}");
        $berkas = $query->row();
        // pre($berkas);
        if (
            $berkas->berkas_keterangan_lulus == '' ||
            $berkas->berkas_nisn == '' ||
            $berkas->berkas_rapot == '' ||
            $berkas->berkas_akte == '' ||
            $berkas->berkas_kk == '' ||
            $berkas->berkas_foto == '' ||
            $berkas->berkas_ktp_ortu == ''
        ) {
            // pre($berkas);
            echo json_encode(['error' => true, 'msg' => 'Harap upload semua persyaratan']);
            die;
        }

        if ($berkas->id_jalur != 1 && empty($berkas->berkas_khusus)) {
            echo json_encode(['error' => true, 'msg' => 'Harap upload semua persyaratan']);
            die;
        }

        switch ($berkas->id_jalur) {
            case 1:
                $ref_status = 5;
                break;
            case 2:
                $ref_status = 6;
                break;
            case 3:
                $ref_status = 7;
                break;
            case 4:
                $ref_status = 8;
                break;
        }
        $data["nilai_mtk"]             = $this->input->post('nilai_mtk');
        $data["nilai_ipa"]             = $this->input->post('nilai_ipa');
        $data["nilai_ips"]             = $this->input->post('nilai_ips');
        $data["nilai_agama"]             = $this->input->post('nilai_agama');


        $update = $this->db->where('id_siswa', $this->session->userdata('id'))
            ->update('ms_siswa_berkas', $data);

        if ($update) {
            $this->db->where('id', $this->session->userdata('id'))
                ->update('ms_siswa', ['status_berkas' => 1, 'ref_status' => $ref_status]);
            echo json_encode(['error' => false, 'msg' => 'Sukses']);
            // redirect('userlogin');
        } else {
            echo json_encode(['error' => true, 'msg' => 'Error']);
        }
    }
}
