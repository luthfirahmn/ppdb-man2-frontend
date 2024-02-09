<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Peserta_prestasi extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_BT   = $this->getAksesUser($this->session->userdata('email'));
        $this->model = $this->Peserta_prestasiModel;
    }


    public function index()
    {

        $this->assetsBuild(array('datatables'));
        $this->template->title('Peserta Prestasi List');
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
            // $row[] = buttons("edit", "location.href='" . base_url("/peserta_prestasi/form_edit/" . $val->id . "") . "'") . ' ' . buttons("delete", "myDelete($val->id, $url_delete)");
            $row[] =
                empty($val->status_berkas) ? '<button class="btn btn-default btn-sm" style="width:40px"><i class="fa fa-times"></i></button>' :
                '<a href="' . BASE_URL . 'peserta_prestasi/download_berkas/' . $val->id . '" class="btn btn-primary btn-sm" style="width:40px"><i class="fa fa-download"></i></a>';
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

    public function download_berkas($id)
    {
        // echo "tes";
        $query = $this->db->query("SELECT *,(SELECT nama_lengkap FROM ms_siswa WHERE id = {$id}) as nama_lengkap FROM ms_siswa_berkas WHERE id_siswa = '{$id}' ");
        $res = $query->row();
        // pre($res);
        if (!$res) {
            redirect('peserta_prestasi');
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
            $res->berkas_khusus,
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

    public function export_data($params = '')
    {
        $param = isset($params) ? $params : 0;
        $data_diri = $this->model->get_all_data($param);
        $alamat = $this->model->get_alamat($param);
        // pre($data_diri);
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('MAN 2 KOTA BANDUNG')
            ->setLastModifiedBy('MAN 2 KOTA BANDUNG')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('result file');


        //auto width cell
        foreach (range('A', 'Z') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        // Add some datas
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'NIK')
            ->setCellValue('D1', 'NAMA LENGKAP')
            ->setCellValue('E1', 'TEMPAT LAHIR')
            ->setCellValue('F1', 'TANGGAL LAHIR')
            ->setCellValue('G1', 'JENIS KELAMIN')
            ->setCellValue('H1', 'HOBI')
            ->setCellValue('I1', 'CITA-CITA')
            ->setCellValue('J1', 'EMAIL')
            ->setCellValue('K1', 'NO WA')
            ->setCellValue('L1', 'JUMLAH SAUDARA')
            ->setCellValue('M1', 'ANAK KE')
            ->setCellValue('N1', 'NPSN')
            ->setCellValue('O1', 'NO IJAZAH')
            ->setCellValue('P1', 'TK')
            ->setCellValue('Q1', 'PAUD')
            ->setCellValue('R1', 'TINGGI')
            ->setCellValue('S1', 'BERAT')
            ->setCellValue('T1', 'LINGKAR KEPALA')
            ->setCellValue('U1', 'HEPATITIS B')
            ->setCellValue('V1', 'POLIO')
            ->setCellValue('W1', 'BCG')
            ->setCellValue('X1', 'CAMPAK')
            ->setCellValue('Y1', 'DPT')
            ->setCellValue('Z1', 'JALUR PILIHAN');

        // Miscellaneous glyphs, UTF-8
        $i = 2;
        $no = 1;
        foreach ($data_diri as $data) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no)
                ->setCellValue('B' . $i, $data->nisn)
                ->setCellValue('C' . $i, "'" . $data->nik)
                ->setCellValue('D' . $i, $data->nama_lengkap)
                ->setCellValue('E' . $i, $data->tempat_lahir)
                ->setCellValue('F' . $i, $data->tgl_lahir)
                ->setCellValue('G' . $i, $data->jenis_kelamin)
                ->setCellValue('H' . $i, $data->hobi)
                ->setCellValue('I' . $i, $data->cita)
                ->setCellValue('J' . $i, $data->email)
                ->setCellValue('K' . $i, "'" . $data->no_wa)
                ->setCellValue('L' . $i, $data->jumlah_saudara)
                ->setCellValue('M' . $i, $data->anak_ke)
                ->setCellValue('N' . $i, $data->npsn)
                ->setCellValue('O' . $i, $data->no_ijazah)
                ->setCellValue('P' . $i, $data->pernah_tk)
                ->setCellValue('Q' . $i, $data->pernah_paud)
                ->setCellValue('R' . $i, $data->tinggi)
                ->setCellValue('S' . $i, $data->berat)
                ->setCellValue('T' . $i, $data->lingkar_kepala)
                ->setCellValue('U' . $i, $data->hepatitis_b)
                ->setCellValue('V' . $i, $data->polio)
                ->setCellValue('W' . $i, $data->bcg)
                ->setCellValue('X' . $i, $data->campak)
                ->setCellValue('Y' . $i, $data->dpt)
                ->setCellValue('Z' . $i, $data->jalur);
            $i++;
            $no++;
        }


        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('DATA DIRI PESERTA ');

        // add second sheet
        $spreadsheet->createSheet();

        // Add some data
        //auto width cell
        foreach (range('A', 'L') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        // Add some datas
        $spreadsheet->setActiveSheetIndex(1)
            ->setCellValue('A1', 'NO')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'NAMA SISWA')
            ->setCellValue('D1', 'ALAMAT')
            ->setCellValue('E1', 'PROVINSI')
            ->setCellValue('F1', 'KOTA')
            ->setCellValue('G1', 'KECAMATAN')
            ->setCellValue('H1', 'KELURAHAN')
            ->setCellValue('I1', 'KODE POS')
            ->setCellValue('J1', 'JARAK RUMAH')
            ->setCellValue('K1', 'TRANSPORTASI')
            ->setCellValue('L1', 'STATUS TEMPAT');

        // Miscellaneous glyphs, UTF-8
        $i = 2;
        $no = 1;
        foreach ($alamat as $data) {

            $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue('A' . $i, $no)
                ->setCellValue('B' . $i, $data->nisn)
                ->setCellValue('C' . $i, $data->nama_lengkap)
                ->setCellValue('D' . $i, $data->alamat)
                ->setCellValue('E' . $i, $data->provinsi)
                ->setCellValue('F' . $i, $data->kota)
                ->setCellValue('G' . $i, $data->kecamatan)
                ->setCellValue('H' . $i, $data->kelurahan)
                ->setCellValue('I' . $i, $data->kode_pos)
                ->setCellValue('J' . $i, $data->jarak_rumah)
                ->setCellValue('K' . $i, $data->transportasi)
                ->setCellValue('L' . $i, $data->status_tempat);
            $i++;
            $no++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('ALAMAT');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="DATA DIRI PESERTA.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
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
