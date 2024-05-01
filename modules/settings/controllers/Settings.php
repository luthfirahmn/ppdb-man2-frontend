<?php defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends FT_Controller
{
    //required declare
    protected $_breadcrumb;
    public function __construct()
    {
        parent::__construct();
        //required declare
        $this->_breadcrumb[0] = 'Pengaturan Akun';
    }
    public function index()
    {

        //required declare
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
                    case 1:
                        redirect('emis_regular');
                        break;
                    default:
                        $this->page($id);
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


        $query = $this->db->query("SELECT
                                        i.id,
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
            'infoPeserta'       => $getInfoPeserta
        );

        $style["css"] = [
            FT_APP_ASSETS . "/css/pages/page-profile.css",
            FT_APP_ASSETS . "/css/plugins/forms/form-validation.css",



        ];

        $script["js"] = [
            FT_APP_ASSETS . "vendors/js/forms/validation/jquery.validate.min.js",

        ];


        $this->template->script($script);
        $this->template->style($style);
        $this->template->title('Pengaturan Akun');
        $this->template->build('settings', $data);
    }


    public function change_password()
    {
        $id_siswa               = $this->input->post('id_siswa');
        $data["password"]             = md5($this->input->post('password'));


        $this->db->where("id", $id_siswa);
        $action = $this->db->update('ms_siswa', $data);

        if ($action) {
            echo json_encode(['error' => false]);
            // redirect('userlogin');
        } else {
            echo json_encode(['error' => true]);
        }
    }
}
