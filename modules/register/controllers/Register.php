<?php defined('BASEPATH') or exit('No direct script access allowed');

class Register extends FT_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->wa_url = 'https://app.ruangwa.id/api/';
redirect('login_peserta');
    }
    public function index()
    {
        $this->load->view('index');
    }


    public function get_otp()
    {
        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('no_wa', 'Nomor WA', 'required|is_unique[ms_siswa.no_wa]');

        $this->form_validation->set_message('is_unique', '%s Sudah terdaftar');
        $this->form_validation->set_message('required', '%s Harus Diisi');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => true, 'msg' => $errors]);
        } else {
            $digits = 4;

            $otp                = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
            $otp_expired        = date("Y-m-d H:i:s", strtotime("+30 minutes"));;
            $no_wa               = (int)$this->input->post('no_wa');

            // check number
            $data_cek = 'token=' . wa_token() . '&number=0' . $no_wa;
            $check_number = wa_post($this->wa_url . 'check_number', $data_cek);
            // pre($check_number);
            if ($check_number->onwhatsapp == "false") {
                echo json_encode(['error' => true, 'msg' => $check_number->message]);
                die;
            }

            $query = $this->db->query("SELECT * FROM sys_otp WHERE no_wa = '{$no_wa}' ");
            $result = $query->num_rows();

            if ($result < 1) {
                $exect = $this->db->insert('sys_otp', array('otp' => $otp, 'no_wa' => $no_wa, 'otp_expired' => $otp_expired));
            } else {
                $exect = $this->db->where('no_wa', $no_wa)
                    ->update('sys_otp', array('otp' => $otp, 'no_wa' => $no_wa, 'otp_expired' => $otp_expired));
            }

            $query = $this->db->query("SELECT * FROM ms_message WHERE msg_type = 'otp' ");
            $msg_otp = $query->row();
            $data_otp = 'token=' . wa_token() . '&number=0' . $no_wa . '&message=' . $msg_otp->message . $otp;
            $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

            if ($check_number) {
                echo json_encode(['error' => false, 'msg' => 'OTP Telah terkirim di nomor whatsappmu']);
                // redirect('userlogin');
            } else {
                echo json_encode(['error' => true, 'msg' => $this->db->error()]);
            }
        }
    }

    public function register_proccess()
    {

        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('nisn', 'NISN', 'is_unique[ms_siswa.nisn]');
        $this->form_validation->set_rules('email', 'Email', 'is_unique[ms_siswa.email]');
        $this->form_validation->set_rules('no_wa', 'Nomor WA', 'is_unique[ms_siswa.no_wa]');

        $this->form_validation->set_message('is_unique', '%s Sudah terdaftar');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => true, 'msg' => $errors]);
        } else {

            $otp = $this->input->post('otp');
            $no_wa = (int)$this->input->post('no_wa');
            $query = $this->db->query("SELECT * FROM sys_otp WHERE no_wa = '{$no_wa}' AND otp = '{$otp}' ");
            $result = $query->num_rows();

            if ($result < 1) {
                echo json_encode(['error' => true, 'msg' => 'Kode OTP salah']);
                die;
            }
            $data["nisn"]                 = $this->input->post('nisn');
            $data["nama_lengkap"]         = strtoupper($this->input->post('nama_lengkap'));
            $data["tgl_lahir"]            = strtoupper($this->input->post('tgl_lahir'));
            $data["no_wa"]                = (int)$this->input->post('no_wa');
            $data["email"]                = $this->input->post('email');
            $data["password"]             = md5($this->input->post('password'));


            $insert = $this->db->insert('ms_siswa', $data);

            if ($insert) {
                echo json_encode(['error' => false, 'msg' => 'Sukses Mendaftar']);
                // redirect('userlogin');
            } else {
                echo json_encode(['error' => true, 'msg' => $this->db->error()]);
            }
        }
    }
}
