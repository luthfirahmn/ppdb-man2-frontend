<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lupa_password extends FT_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->wa_url = 'https://app.ruangwa.id/api/';
        // $this->session->sess_destroy();
    }
    public function index()
    {
        $this->load->view('index');
    }


    public function get_otp()
    {
        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('no_wa', 'Nomor WA', 'required');

        $this->form_validation->set_message('required', '%s Harus Diisi');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => true, 'msg' => $errors]);
        } else {
            $no_wa               = (int)$this->input->post('no_wa');

            // check number
            $data_cek = 'token=' . wa_token() . '&number=0' . $no_wa;

            $check_number = wa_post($this->wa_url . 'check_number', $data_cek);

            if ($check_number->onwhatsapp == "false") {
                echo json_encode(['error' => true, 'msg' => $check_number->message]);
                die;
            }

            $query = $this->db->query("SELECT * FROM sys_otp WHERE no_wa = '{$no_wa}' ");
            $otp = $query->row();


            if (!$otp) {
                echo json_encode(['error' => true, 'msg' => 'Nomor tidak terdaftar di PPDB MAN 2 KOTA BANDUNG']);
                die;
            }

            $query = $this->db->query("SELECT * FROM ms_message WHERE msg_type = 'otp' ");
            $msg_otp = $query->row();
            $data_otp = 'token=' . wa_token() . '&number=0' . $no_wa . '&message=' . $msg_otp->message . $otp->otp;
            $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

            if ($check_number) {
                echo json_encode(['error' => false, 'msg' => 'OTP Telah terkirim di nomor whatsappmu']);
                // redirect('userlogin');
            } else {
                echo json_encode(['error' => true, 'msg' => $this->db->error()]);
            }
        }
    }


    public function forgot_password()
    {
        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('no_wa', 'Nomor WA', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $this->form_validation->set_message('required', '%s Harus Diisi');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => true, 'msg' => $errors]);
            die;
        }
        $no_wa            = (int)$this->input->post('no_wa');
        $password            = $this->input->post('password');

        $exect = $this->db->where('no_wa', $no_wa)
            ->update('ms_siswa', array('password' => md5($password), 'no_wa' => $no_wa));
        if ($exect) {

            echo json_encode(['error' => false, 'msg' => 'Informasi lupa password telah dikirim ke nomor whatsappmu']);
            // redirect('userlogin');

        } else {
            echo json_encode(['error' => true, 'msg' => 'Nomor tidak terdaftar']);
        }
    }
}
