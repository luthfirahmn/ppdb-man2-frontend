<?php defined('BASEPATH') or exit('No direct script access allowed');

class UserLogin extends MY_Template
{
    //required declare
    protected $_breadcrumb;
    public function __construct()
    {
        parent::__construct();
        //required declare

        $this->_breadcrumb[0] = 'UserLogin';
        $this->load->model('UserLogin_model');
        $this->model = $this->UserLogin_model;
    }
    public function index()
    {
        $this->_breadcrumb[] = 'index';

        $data = array(
            'contentHeader' => $this->_breadcrumb[0],
            'breadcrumb' => $this->_breadcrumb,
        );

        $style["css"] = [
            ASSETS_PATH . "plugins/custom/jquery.dataTables.min.css",
        ];
        $script["js"] = [
            ASSETS_PATH . "plugins/custom/jquery.dataTables.min.js",
            ASSETS_PATH . "plugins/datatables-buttons/js/dataTables.buttons.min.js",
            ASSETS_PATH . "plugins/datatables-buttons/js/buttons.bootstrap4.min.js",
            ASSETS_PATH . "plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
            ASSETS_PATH . "plugins/datatables-buttons/js/buttons.html5.min.js",
            ASSETS_PATH . "plugins/datatables-buttons/js/buttons.print.min.js"
        ];

        $this->template->style($style);
        $this->template->script($script);
        $this->template->title('User Login');
        $this->template->build('index', $data);
    }

    public function get_list()
    {
        // SELECT DATA ALL
        $all_data = $this->model->table_list();
        $recordsTotal = $this->model->table_count_list();
        $recordsFiltered = $this->model->table_record_filter();


        $url_delete = "'" . base_url("UserLogin/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {
            $no++;
            $row = array();
            $row[] = buttons("edit", "location.href='" . base_url("/UserLogin/form_edit/" . $val->DID . "") . "'") . ' ' . buttons("delete", "myDelete($val->DID, $url_delete)");
            $row[] = $val->Email;
            $row[] = $val->Password;
            $row[] = $val->LastLogin;
            $row[] = $val->SessionExpiry;
            $row[] = $val->RememberMe;
            $row[] = $val->ResetPass;
            $row[] = $val->CodeOTP;
            $row[] = $val->EmpID;
            $row[] = $val->AdminPanel;
            $row[] = $val->AppToken;
            $row[] = $val->Active;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => count($recordsFiltered),
            "data" => $data,
        );

        echo json_encode($output);
    }
    public function form()
    {
        // $a = [$this->categoryTree()];
        // pre($a);
        //required declare
        $this->_breadcrumb[] = 'form';
        $data = array(
            'contentHeader' => $this->_breadcrumb[0],
            'breadcrumb' => $this->_breadcrumb,
            'status_form' => 0,
            // 'category'    => $this->categoryTree()
        );
        // $style["css"] = [
        //     ASSETS_PATH . "css/plugins/forms/pickers/form-flat-pickr.css",
        //     ASSETS_PATH . "css/plugins/forms/form-validation.css",
        // ];

        // $script["js"] = [
        //     ASSETS_PATH . "vendors/js/forms/select/select2.full.min.js",
        //     ASSETS_PATH . "vendors/js/forms/validation/jquery.validate.min.js",
        //     ASSETS_PATH . "vendors/js/pickers/flatpickr/flatpickr.min.js",
        // ];


        // $this->template->style($style);
        // $this->template->script($script);
        $this->template->title('Master Site');
        $this->template->build('form', $data);
    }



    public function form_edit($ID = null)
    {
        $data_edit = $this->model->data_edit($ID);
        // pre($data);

        $this->_breadcrumb[] = 'form';
        $data = array(
            'contentHeader' => $this->_breadcrumb[0],
            'breadcrumb' => $this->_breadcrumb,
            'status_form' => 1,
            'all_data' => $data_edit

        );
        //pre($data_edit);

        $this->template->title('Master Site');
        $this->template->build('form', $data);
    }

    public function edit($ID = null)
    {

        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('Email', 'Email', 'required');
        $this->form_validation->set_rules('Password', 'Password', 'required');
        $this->form_validation->set_rules('LastLogin', 'LastLogin', 'required');
        $this->form_validation->set_rules('SessionExpiry', 'SessionExpiry', 'required');
        $this->form_validation->set_rules('RememberMe', 'RememberMe', 'required');
        $this->form_validation->set_rules('ResetPass', 'ResetPass', 'required');
        $this->form_validation->set_rules('CodeOTP', 'CodeOTP', 'required');
        $this->form_validation->set_rules('EmpID', 'EmpID', 'required');
        $this->form_validation->set_rules('AdminPanel', 'AdminPanel', 'required');
        $this->form_validation->set_rules('AppToken', 'AppToken', 'required');
        $this->form_validation->set_rules('Active', 'Active', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {

            if ($this->input->post()) {


                $data["Email"]           = $this->input->post("Email");
                $data["Password"]                 = $this->input->post("Password");
                $data["LastLogin"]              = $this->input->post("LastLogin");
                $data["SessionExpiry"]              = $this->input->post("SessionExpiry");
                $data["RememberMe"]              = $this->input->post("RememberMe");
                $data["ResetPass"]              = $this->input->post("ResetPass");
                $data["CodeOTP"]              = $this->input->post("CodeOTP");
                $data["EmpID"]              = $this->input->post("EmpID");
                $data["AdminPanel"]              = $this->input->post("AdminPanel");
                $data["AppToken"]              = $this->input->post("AppToken");
                $data["Active"]              = $this->input->post("Active");


                $this->db->save_queries = TRUE;
                $this->db->where("DID", $ID);
                $edit = $this->model->update_data($data, $ID);
                if ($edit) {
                    echo json_encode(['error' => false, 'msg' => 'Sukses update data']);
                } else {
                    echo json_encode(['error' => true, 'msg' => 'Error update data']);

                    if ($this->input->post('save') == "savereturn") {
                        $this->session->set_flashdata("success_msg", "Data insert success...");
                        redirect('UserLogin');
                    }
                }
            }
        }
    }
}
