<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bulk extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_BT   = $this->getAksesUser($this->session->userdata('email'));
    }


    public function index()
    {

        $this->assetsBuild(array('datatables'));
        $this->template->title('Menu List LBS');
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
        $all_data = $this->MenuModel->table_list();
        $recordsTotal = $this->MenuModel->table_count_list();
        $recordsFiltered = $this->MenuModel->table_record_filter();


        $url_delete = "'" . base_url("menu/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {
            $no++;
            $row = array();
            $row[] = buttons("edit", "location.href='" . base_url("/menu/form_edit/" . $val->DID . "") . "'") . ' ' . buttons("delete", "myDelete($val->DID, $url_delete)");
            $row[] = $val->Menu;
            $row[] = $val->MenuRoute;
            $row[] = $val->MenuFile;
            $row[] = $val->OrderNo;

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
        $select_params  = $this->MenuModel->getParentMenu();
        $parents[0]     = 'Please Select';
        foreach ($select_params as $params) {
            $parents[$params["DID"]] = ucwords($params["Menu"]);
        }
        $data = array(
            'status_form'            => 0,
            'parents_menu'  => isset($parents) ? $parents : "",
            "MAdd" => $this->_BT->MAdd
        );

        $this->template->title('Create Menu LBS');
        $this->setTitlePage('Form Create Menu');
        $this->template->set_breadcrumb('Form Menu', base_url('menu/form/add'));
        $this->template->set_breadcrumb('Create');
        // $this->setJs('index');
        $this->template->build('form', $data);
    }


    public function form_edit($DID = null)
    {
        $data_edit      = $this->MenuModel->data_edit($DID);
        $select_params  = $this->MenuModel->getParentMenu();
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


        $this->template->title('Edit Menu LBS');
        $this->setTitlePage('Form Edit Menu');
        $this->template->set_breadcrumb('Form Menu', base_url('menu'));
        $this->template->set_breadcrumb('Edit');
        // $this->setJs('index');
        $this->template->build('form', $data);
    }


    public function add()
    {
        $prosess = $this->MenuModel->submit_add($_POST);
        echo $prosess;
    }


    public function edit()
    {
        $prosess = $this->MenuModel->submit_update($_POST);
        echo $prosess;
    }


    public function delete()
    {
        $prosess = $this->MenuModel->delete_data($_POST);
        echo $prosess;
    }
}
