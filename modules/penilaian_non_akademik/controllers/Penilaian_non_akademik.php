<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Penilaian_non_akademik extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_BT   = $this->getAksesUser($this->session->userdata('email'));
        $this->model = $this->Penilaian_non_akademikModel;
    }


    public function index()
    {
        $this->setJs("index");
        $this->assetsBuild(array('datatables'));
        $this->template->title('Penialain Non Akademik List');
        $this->setTitlePage('Penilaian Peserta Non Akademik');
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
            // $row[] = buttons("edit", "location.href='" . base_url("/Penilaian_non_akademik/form_edit/" . $val->id . "") . "'") . ' ' . buttons("delete", "myDelete($val->id, $url_delete)");
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

    public function download_template()
    {
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
            ->setCellValue('A1', 'NISN')
            ->setCellValue('B1', 'STATUS KELULUSAN');





        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('PENILAIAN NON AKADEMIK');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="PENILAIAN NON AKADEMIK.xlsx"');
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


    public function upload_nilai()
    {
        $config['upload_path'] = realpath('assets/uploads');
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload('upload_nilai')) {
            $data_upload = $this->upload->data();
            $excelreader     = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $loadexcel         = $excelreader->load('assets/uploads/' . $data_upload['file_name']);
            $sheet             = $loadexcel->getActiveSheet()->toArray();
            unset($sheet[0]);
            // pre($sheet);
            foreach ($sheet as $row) {
                unset($row[2]);
                unset($row[3]);
                unset($row[4]);

                $query = $this->db->query("SELECT id_jalur,id_status FROM ms_siswa WHERE nisn = {$row[0]} ");
                $res_jalur  = $query->row();

                if ($res_jalur->id_jalur == '2') {
                    if ($row[1] == 'L') {
                        $status = 2;
                    } else if ($row[1] == 'TL') {
                        $status = 20;
                    } else {
                        $status = $res_jalur->id_status;
                    }
                } else if ($res_jalur->id_jalur == '3') {
                    if ($row[1] == 'L') {
                        $status = 3;
                    } else if ($row[1] == 'TL') {
                        $status = 30;
                    } else {
                        $status = $res_jalur->id_status;
                    }
                } else if ($res_jalur->id_jalur == '4') {
                    if ($row[1] == 'L') {
                        $status = 4;
                    } else if ($row[1] == 'TL') {
                        $status = 40;
                    } else {
                        $status = $res_jalur->id_status;
                    }
                } else if ($res_jalur->id_jalur == '5') {
                    if ($row[1] == 'L') {
                        $status = 5;
                    } else if ($row[1] == 'TL') {
                        $status = 50;
                    } else {
                        $status = $res_jalur->id_status;
                    }
                } else {
                    $status = $res_jalur->id_status;
                }

                // $status = $row[1] == 'L' ? 1 : $row[1] == 'TL' ? 9 : 0;
                $array = array(
                    'nisn' => $row[0],
                    'status' => $status,
                    'type' => 'NON AKADEMIK'
                );
                $query = $this->db->query("SELECT * FROM tr_penilaian WHERE nisn = '{$row[0]}' ");

                $res = $query->row();
                // pre($res);
                if ($res) {
                    $action = $this->db->where('nisn', $row[0])
                        ->update('tr_penilaian', $array);
                } else {
                    $action = $this->db->insert('tr_penilaian', $array);
                }
            }
            echo json_encode(['error' => false, 'msg' => 'Sukses Mengupload Nilai']);
            // unlink(realpath('assets/' . $data_upload['file_name']));
        } else {
            echo json_encode(['error' => true, 'msg' => 'Gagal Mengupload Nilai']);

            // unlink(realpath('assets/' . $data_upload['file_name']));
        }
    }


    public function delete_hasil()
    {
        $this->db->where('Type', 'NON AKADEMIK');
        $delete = $this->db->delete('tr_penilaian');

        if ($delete) {
            json_encode(['error' => false, 'msg' => 'Sukses Membatalkan penilaian']);
        } else {
            json_encode(['error' => true, 'msg' => 'Gagal Membatalkan penilaian']);
        }
    }


    public function penilaian()
    {

        $query = $this->db->query("SELECT * FROM tr_penilaian WHERE Type = 'NON AKADEMIK' ORDER BY id ASC");
        $result = $query->result();

        if ($result) {
            foreach ($result as $row) {

                $array = array('id_status' => $row->status);
                $this->db->where('nisn', $row->nisn);
                $update = $this->db->update('ms_siswa', $array);

                if ($update) {
                    $this->db->where('nisn', $row->nisn);
                    $delete = $this->db->delete('tr_penilaian');
                }
            }

            echo json_encode(['error' => false, 'msg' => 'Sukses Memproses penilaian']);
        } else {
            echo json_encode(['error' => true, 'msg' => 'Tidak ada data yang dinilai']);
        }
    }

    // public function export_data()
    // {

    //     // Create new Spreadsheet object
    //     $spreadsheet = new Spreadsheet();

    //     // Set document properties
    //     $spreadsheet->getProperties()->setCreator('MAN 2 KOTA BANDUNG')
    //         ->setLastModifiedBy('MAN 2 KOTA BANDUNG')
    //         ->setTitle('Office 2007 XLSX Test Document')
    //         ->setSubject('Office 2007 XLSX Test Document')
    //         ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
    //         ->setKeywords('office 2007 openxml php')
    //         ->setCategory('result file');


    //     //auto width cell
    //     foreach (range('A', 'Z') as $columnID) {
    //         $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
    //             ->setAutoSize(true);
    //     }

    //     // Add some datas
    //     $spreadsheet->setActiveSheetIndex(0)
    //         ->setCellValue('A1', 'NO')
    //         ->setCellValue('B1', 'NISN')
    //         ->setCellValue('C1', 'NIK')
    //         ->setCellValue('D1', 'NAMA LENGKAP')
    //         ->setCellValue('E1', 'TEMPAT LAHIR')
    //         ->setCellValue('F1', 'TANGGAL LAHIR')
    //         ->setCellValue('G1', 'JENIS KELAMIN')
    //         ->setCellValue('H1', 'HOBI')
    //         ->setCellValue('I1', 'CITA-CITA')
    //         ->setCellValue('J1', 'EMAIL')
    //         ->setCellValue('K1', 'NO WA')
    //         ->setCellValue('L1', 'JUMLAH SAUDARA')
    //         ->setCellValue('M1', 'ANAK KE')
    //         ->setCellValue('N1', 'NPSN')
    //         ->setCellValue('O1', 'NO IJAZAH')
    //         ->setCellValue('P1', 'TK')
    //         ->setCellValue('Q1', 'PAUD')
    //         ->setCellValue('R1', 'TINGGI')
    //         ->setCellValue('S1', 'BERAT')
    //         ->setCellValue('T1', 'LINGKAR KEPALA')
    //         ->setCellValue('U1', 'HEPATITIS B')
    //         ->setCellValue('V1', 'POLIO')
    //         ->setCellValue('W1', 'BCG')
    //         ->setCellValue('X1', 'CAMPAK')
    //         ->setCellValue('Y1', 'DPT')
    //         ->setCellValue('Z1', 'JALUR PILIHAN');


    //     // Rename worksheet
    //     $spreadsheet->getActiveSheet()->setTitle('DATA DIRI PESERTA ');

    //     // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    //     $spreadsheet->setActiveSheetIndex(0);

    //     // Redirect output to a client’s web browser (Xlsx)
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="DATA DIRI PESERTA.xlsx"');
    //     header('Cache-Control: max-age=0');
    //     // If you're serving to IE 9, then the following may be needed
    //     header('Cache-Control: max-age=1');

    //     // If you're serving to IE over SSL, then the following may be needed
    //     header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    //     header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    //     header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    //     header('Pragma: public'); // HTTP/1.0
    //     ob_end_clean();
    //     $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    //     $writer->save('php://output');
    //     exit;
    // }
}
