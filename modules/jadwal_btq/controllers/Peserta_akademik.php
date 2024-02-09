<?php defined('BASEPATH') or exit('No direct script access allowed');

class Peserta_akademik extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_BT   = $this->getAksesUser($this->session->userdata('email'));
        $this->model = $this->Peserta_akademikModel;
    }


    public function index()
    {

        $this->assetsBuild(array('datatables'));
        $this->template->title('Peserta BTQ List');
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


        $url_delete = "'" . base_url("menu/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {
            $no++;
            $row = array();
            // $row[] = buttons("edit", "location.href='" . base_url("/peserta_akademik/form_edit/" . $val->id . "") . "'") . ' ' . buttons("delete", "myDelete($val->id, $url_delete)");
            $row[] = '';
            $row[] = $val->nisn;
            $row[] = $val->no_wa;
            $row[] = $val->nama_lengkap;
            $row[] = $val->jalur;
            $row[] = $val->status;

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
            $parents[$params["id"]] = ucwords($params["Menu"]);
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


    public function form_edit($id = null)
    {
        $data_edit      = $this->model->data_edit($id);
        $data = array(
            'status_form'   => 1,
            'id'           => $id,
            'all_data'      => $data_edit,
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
