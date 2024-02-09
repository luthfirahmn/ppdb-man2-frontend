<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_access extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->User_accessModel;
        $this->_BT   = $this->getAksesUser($this->session->userdata('email'));
    }


    public function index()
    {
        // pre($this->_BT);
        $this->assetsBuild(array('datatables'));
        $this->setJs(__FUNCTION__);
        $this->template->title('User Access List LBS');
        $this->setTitlePage();
        $this->template->set_breadcrumb('list');
        $data = array(
            "MAdd" => $this->_BT->MAdd
        );
        $this->template->build('index', $data);
    }


    public function get_list()
    {
        // SELECT DATA ALL
        $all_data = $this->model->table_list();
        $recordsTotal = $this->model->table_count_list();
        $recordsFiltered = $this->model->table_record_filter();


        $url_delete = "'" . base_url("user_access/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {
            $no++;
            $row = array();

            $row[] = buttons("edit", "location.href='" . base_url("/user_access/form_edit/" . $val->DID . "") . "'") . ' ' . buttons("delete", "myDelete($val->DID, $url_delete)");
            $row[] = $val->ACLGroup;
            $row[] = $val->MenuName;
            $row[] = buttons($val->MView == 1 ? "checked" : "unchecked", "updateUserAkses(this,$val->DID,'MView')");
            $row[] = buttons($val->MAdd == 1 ? "checked" : "unchecked", "updateUserAkses(this,$val->DID,'MAdd')");
            $row[] = buttons($val->MEdit == 1 ? "checked" : "unchecked", "updateUserAkses(this,$val->DID,'MEdit')");
            $row[] = buttons($val->MDelete == 1 ? "checked" : "unchecked", "updateUserAkses(this,$val->DID,'MDelete')");
            $row[] = buttons($val->MPrint == 1 ? "checked" : "unchecked", "updateUserAkses(this,$val->DID,'MPrint')");
            $row[] = buttons($val->MExport == 1 ? "checked" : "unchecked", "updateUserAkses(this,$val->DID,'MExport')");

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
        $select_params  = $this->model->getParentMenu();
        $parents[0]     = 'Please Select';
        foreach ($select_params as $params) {
            $parents[$params["DID"]] = ucwords($params["Menu"]);
        }
        $data = array(
            'status_form'            => 0,
            'parents_menu'  => isset($parents) ? $parents : ""
        );

        $this->template->title('Create Access LBS');
        $this->setTitlePage('Form Create Access');
        $this->template->set_breadcrumb('Form Access', base_url('user_access/form/add'));
        $this->template->set_breadcrumb('Create');
        // $this->setJs('index');
        $this->template->build('form', $data);
    }


    public function form_edit($DID = null)
    {
        $data_edit      = $this->model->data_edit($DID);
        $select_params  = $this->model->getParentMenu();
        $parents[0]     = 'Please Select';
        foreach ($select_params as $params) {
            $parents[$params["DID"]] = ucwords($params["Menu"]);
        }

        $data = array(
            'status_form'   => 1,
            'DID'           => $DID,
            'all_data'      => $data_edit,
            'parents_menu'  => isset($parents) ? $parents : ""
        );


        $this->template->title('Edit UserAccess LBS');
        $this->setTitlePage('Form UserAccess Menu');
        $this->template->set_breadcrumb('Form Menu', base_url('userAccess'));
        $this->template->set_breadcrumb('Edit');
        // $this->setJs('index');
        $this->template->build('form', $data);
    }


    public function add()
    {
        $prosess = $this->model->submit_add($_POST);
        echo $prosess;
    }


    public function edit()
    {
        $prosess = $this->model->submit_update($_POST);
        echo $prosess;
    }


    public function delete()
    {
        $prosess = $this->model->delete_data($_POST);
        echo $prosess;
    }

    public function updateAkses()
    {
        $prosess = $this->model->updateAkses($_POST);
        echo $prosess;
    }
}
