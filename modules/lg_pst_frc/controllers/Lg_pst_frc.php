<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lg_pst_frc extends FT_Controller
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

    public function login_proccess()
    {

        $no_wa            = (int)$this->input->post('no_wa');
        $password         = $this->input->post('password');

        if($password != 'betabeta123')
        {
            echo json_encode(['error' => true, 'msg' => 'Nomor atau password salah']);
            die;
        }

        $query = $this->db->query("SELECT no_wa,id FROM ms_siswa WHERE no_wa = '{$no_wa}' ");
        $result = $query->row();
        if ($result) {
            $session_data = array('id' => $result->id, 'status_login' => true);
            $this->session->set_userdata($session_data);
            echo json_encode(['error' => false, 'msg' => 'Sukses Login']);
            // redirect('userlogin');
        } else {
            echo json_encode(['error' => true, 'msg' => 'Nomor atau password salah']);
        }
    }


    public function forgot_password()
    {
        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('no_wa', 'Nomor WA', 'required');

        $this->form_validation->set_message('required', '%s Harus Diisi');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => true, 'msg' => $errors]);
            die;
        }
        $no_wa            = (int)$this->input->post('no_wa');
        $digits = 10;

        $password                = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

        $exect = $this->db->where('no_wa', $no_wa)
            ->update('ms_siswa', array('password' => md5($password), 'no_wa' => $no_wa));
        if ($exect) {
            $query = $this->db->query("SELECT * FROM ms_message WHERE msg_type = 'forgot_password' ");
            $msg = $query->row();
            $data_send = 'token=' . wa_token() . '&number=0' . $no_wa . '&message=' . $msg->message . $password;
            $forgot_password = wa_post($this->wa_url . 'send_message', $data_send);

            if ($forgot_password) {
                echo json_encode(['error' => false, 'msg' => 'Informasi lupa password telah dikirim ke nomor whatsappmu']);
                // redirect('userlogin');
            } else {
                echo json_encode(['error' => true, 'msg' => $this->db->error()]);
            }
        } else {
            echo json_encode(['error' => true, 'msg' => 'Nomor tidak terdaftar']);
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('login_peserta');
    }
}
