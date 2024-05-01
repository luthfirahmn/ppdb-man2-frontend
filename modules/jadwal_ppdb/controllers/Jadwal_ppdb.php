<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Jadwal_ppdb extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_BT   = $this->getAksesUser($this->session->userdata('email'));
        $this->model = $this->Jadwal_ppdbModel;
    }


    public function index()
    {
        $this->setJs('index');
        $this->assetsBuild(array('datatables'));
        $this->template->title('Jadwal PPDB List');
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



        $url_delete = "'" . base_url("Jadwal_ppdb/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {

            $bt_edit = '';
            $bt_delete = '';

            // (kondisi nilai dari MEdit)
            if ($this->_BT->MEdit) {
                $bt_edit = buttons("edit", "location.href='" . base_url("/jadwal_ppdb/form_edit/" . $val->id . "") . "'");
            }
            if ($this->_BT->MDelete) {
                $bt_delete = buttons("delete", "myDelete($val->id)");
            }

            if ($val->btn_login == 1) {
                $btn_login = '<span class="badge badge-success">Login</span>';
            } else {
                $btn_login = '<span class="badge badge-danger">Login</span>';
            }

            if ($val->btn_alur == 1) {
                $btn_alur = '<span class="badge badge-success">Alur</span>';
            } else {
                $btn_alur = '<span class="badge badge-danger">Alur</span>';
            }

            if ($val->btn_daftar == 1) {
                $btn_daftar = '<span class="badge badge-success">Daftar</span>';
            } else {
                $btn_daftar = '<span class="badge badge-danger">Daftar</span>';
            }

            $no++;
            $row = array();
            $row[] = buttons("edit", "location.href='" . base_url("/jadwal_ppdb/form_edit/" . $val->id . "") . "'") . ' ' . buttons("delete", "myDelete($val->id, $url_delete)");
            $row[] = $val->order_no;
            $row[] = $val->jadwal;
            $row[] = date('Y-m-d', strtotime($val->waktu));
            $row[] = $val->desc;
            $row[] = $btn_login . '<br>' . $btn_daftar . '<br>' . $btn_alur;

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
            'status_form'            => 0,
            "MAdd" => $this->_BT->MAdd
        );

        $this->template->title('Buat Jadwal LBS');
        $this->setTitlePage('Form Buat Jadwal');
        $this->template->set_breadcrumb('Form Jadwal', base_url('jadwal_ppdb/form/add'));
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


        $this->template->title('Edit Jadwal LBS');
        $this->setTitlePage('Form Edit Jadwal');
        $this->template->set_breadcrumb('Form Jadwal', base_url('jadwal_ppdb'));
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
