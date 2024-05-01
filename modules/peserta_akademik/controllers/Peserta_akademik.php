<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

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
        $this->template->title('Peserta Akademik List');
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


        $url_delete = "'" . base_url("akademik/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {

            $no++;
            $row = array();
            $row[] =
                empty($val->status_berkas) ? '<button class="btn btn-default btn-sm" style="width:40px"><i class="fa fa-times"></i></button>' :
                '<a href="' . BASE_URL . 'peserta_akademik/download_berkas/' . $val->id . '" class="btn btn-primary btn-sm" style="width:40px"><i class="fa fa-download"></i></a>';
            // $row[] = '';
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



    // public function download_zip($id)
    // {
    //     $query = $this->db->query("SELECT * FROM ms_siswa_berkas WHERE id_siswa = '{$id}' ");
    //     $res = $query->row();
    //     // pre($res);
    //     if (!$res) {
    //         redirect('peserta_akademik');
    //         die;
    //     }
    //     $files = array(
    //         $res->berkas_keterangan_lulus,
    //         $res->berkas_nisn,
    //         $res->berkas_rapot,
    //         $res->berkas_akte,
    //         $res->berkas_kk,
    //         $res->berkas_ktp_ortu,
    //         $res->berkas_foto,
    //         // $res->berkas_khusus,
    //         // $res->pernyataan_persetujuan_ortu
    //     );
    //     // pre($files);
    //     $zipname = 'Berkas_' . $id . '.zip';
    //     $zip = new ZipArchive;
    //     $zip->open($zipname, ZipArchive::CREATE);
    //     foreach ($files as $file) {
    //         $path = SISWA_BERKAS . $file;
    //         $zip->addFromString(basename($path),  file_get_contents($path));
    //     }
    //     $zip->close();

    //     header("Content-type: application/zip");
    //     header("Content-Transfer-Encoding: Binary");
    //     header("Content-Disposition: attachment; filename=$zipname");
    //     header("Content-length: " . filesize($zipname));
    //     header("Pragma: no-cache");
    //     header("Expires: 0");
    //     readfile("$path");
    // }

    public function download_berkas($id)
    {
        // echo "tes";
        $query = $this->db->query("SELECT *,(SELECT nama_lengkap FROM ms_siswa WHERE id = {$id}) as nama_lengkap FROM ms_siswa_berkas WHERE id_siswa = '{$id}' ");
        $res = $query->row();
        // pre($res);
        if (!$res) {
            redirect('peserta_akademik');
            die;
        }
        $array = array(
            $res->berkas_keterangan_lulus,
            $res->berkas_nisn,
            $res->berkas_rapot,
            $res->berkas_akte,
            $res->berkas_kk,
            $res->berkas_ktp_ortu,
            $res->berkas_foto,
            // $res->berkas_khusus,
            // $res->pernyataan_persetujuan_ortu
        );

        foreach ($array as $file => $row) {
            $path = SISWA_BERKAS . $row;

            $ch = curl_init($path);
            $fp = fopen(TRASH_PATH . $row, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }

        $name = str_replace(" ", "_", $res->nama_lengkap);

        //Archive name
        $archive_file_name =  $name . '.zip';
        // pre($archive_file_name);
        //Download Files path
        $file_path = TRASH_PATH;


        $this->zipFilesAndDownload($array, $archive_file_name, $file_path);
    }

    function zipFilesAndDownload($file_names, $archive_file_name, $file_path)
    {
        //echo $file_path;die;
        $zip = new ZipArchive();
        //create the file and throw the error if unsuccessful
        if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE) !== TRUE) {
            exit("cannot open <$archive_file_name>\n");
        }
        //add each files of $file_name array to archive
        foreach ($file_names as $files) {
            $zip->addFile($file_path . $files, $files);
            //echo $file_path.$files,$files."

        }
        $zip->close();
        //then send the headers to force download the zip file
        $yourfile = realpath($archive_file_name);

        $file_name = basename($yourfile);

        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Length: " . filesize($yourfile));
        ob_end_clean();
        flush();
        readfile($yourfile);

        foreach ($file_names as $file => $row) {
            // pre($file);
            unlink(TRASH_PATH . $row);
        }

        if (file_exists($yourfile)) {
            unlink($yourfile);
        }
        exit;
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
