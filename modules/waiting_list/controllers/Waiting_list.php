<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Waiting_list extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_BT   = $this->getAksesUser($this->session->userdata('email'));
        $this->model = $this->Waiting_listModel;
    }


    public function index()
    {
        $this->setJs(__FUNCTION__);
        $this->assetsBuild(array('datatables'));
        $this->template->title('Waiting List');
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


        $url_delete = "'" . base_url("waiting_list/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {

            $no++;
            $row = array();
            $row[] = '<button type="button" onclick="action_waiting_list(' . $val->nisn . ',8)" class="btn btn-danger btn-sm">Luluskan</button>';
            $row[] = $no;
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

    public function get_peserta_waiting_list($nisn)
    {
        $prosess = $this->model->get_peserta_waiting_list($nisn);
        echo $prosess;
    }

    public function aksi_waiting_list()
    {
        $prosess = $this->model->aksi_waiting_list($_POST['nisn'], $_POST['status']);
        echo $prosess;
    }
}
