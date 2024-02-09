<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function process_login()
    {
        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => true, 'msg' => $errors]);
        } else {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $query = $this->db->query("SELECT * FROM ms_admin WHERE username = '{$email}' AND password =  '{$password}' ");

            $res = $query->row();

            if ($res) {
                $set_session_user               = [];
                $set_session_user['user_id']    = $res->id;
                $set_session_user['email']      = $res->username;
                $set_session_user['name']       = 'Administrator';
                $set_session_user['last_login'] = date('Y-m-d H:i:s');

                set_visitor_session($set_session_user);
                echo json_encode(['error' => false, 'msg' => 'success']);
            } else {
                echo json_encode(['error' => true, 'msg' => 'Email atau Password Salah']);
            }
        }
    }

    public function logout()
    {
        logout();
        redirect('login');
    }

    // public function is_logged_in()
    // {
    //     // echo $this->session->userdata('logged_in');
    //     // die;
    //     if (!$this->session->userdata('logged_in') === TRUE) {
    //         redirect(base_url() . 'login');
    //     } else {

    //         // $this->_breadcrumb[] = 'index';

    //         // $data = array(
    //         //     'contentHeader' => $this->_breadcrumb[0],
    //         //     'breadcrumb' => $this->_breadcrumb,
    //         //     'session' => $this->session->userdata('logged_in')
    //         // );

    //         // $script["js"] = [
    //         //     ASSETS_PATH . "Dashboard/Js/demo.js",
    //         // ];

    //         // $this->template->script($script);
    //         // $this->template->title('Dashboard RedAdmin IMS');
    //         // $this->template->build('v_dashboard', $data);
    //     }
    // }
}
