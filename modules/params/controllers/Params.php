<?php defined('BASEPATH') or exit('No direct script access allowed');

class Params extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->ParamsModel;
    }


    public function index()
    {
        $this->assetsBuild(array('datatables'));
        $this->template->title('Params List LBS');
        $this->setTitlePage();
        $this->template->set_breadcrumb('list');
        $this->template->build('index');
    }


    public function get_list()
    {
        // SELECT DATA ALL
        $all_data = $this->model->table_list();
        $recordsTotal = $this->model->table_count_list();
        $recordsFiltered = $this->model->table_record_filter();


        $url_delete = "'" . base_url("params/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {
            $no++;
            $row = array();
            $row[] = buttons("edit", "location.href='" . base_url("/params/form_edit/" . $val->DID . "") . "'") . ' ' . buttons("delete", "myDelete($val->DID, $url_delete)");
            $row[] = $val->ParamVariable;
            $row[] = $val->ParamID;
            $row[] = $val->ParamValue;


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
        $data = array(
            'status_form' => 0
        );

        $this->template->title('Create Params LBS');
        $this->setTitlePage('Form Create Params');
        $this->template->set_breadcrumb('Form Params', base_url('params/form/add'));
        $this->template->set_breadcrumb('Create');
        $this->template->build('form', $data);
    }

    public function form_edit($DID = null)
    {
        $data_edit      = $this->model->data_edit($DID);

        $data = array(
            'status_form'   => 1,
            'DID'           => $DID,
            'all_data'      => $data_edit,
        );

        // pre($data);
        $this->template->title('Edit Params LBS');
        $this->setTitlePage('Form Edit Params');
        $this->template->set_breadcrumb('Form Params', base_url('menu'));
        $this->template->set_breadcrumb('Edit');
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
}
