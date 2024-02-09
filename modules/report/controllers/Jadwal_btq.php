<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Jadwal_btq extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_BT   = $this->getAksesUser($this->session->userdata('email'));
        $this->model = $this->Jadwal_btqModel;
    }


    public function index()
    {
        $this->setJs('index');
        $this->assetsBuild(array('datatables'));
        $this->template->title('Jadwal BTQ List');
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


        $url_delete = "'" . base_url("jadwal_btq/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {
            $no++;
            $row = array();
            // $row[] = buttons("edit", "location.href='" . base_url("/Jadwal_btq/form_edit/" . $val->id . "") . "'") . ' ' . buttons("delete", "myDelete($val->id, $url_delete)");
            $row[] = '';
            $row[] = $no;
            $row[] = $val->nisn;
            $row[] = $val->no_wa;
            $row[] = $val->nama_lengkap;
            $row[] = $val->waktu;
            $row[] = $val->tanggal;
            $row[] = $val->ruangan;

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


    public function get_list_filter()
    {
        // pre($_POST['filter']);
        $filter = $_POST['filter'];
        // SELECT DATA ALL
        $all_data = $this->model->table_list($filter);
        $recordsTotal = $this->model->table_count_list($filter);
        $recordsFiltered = $this->model->table_record_filter($filter);


        $url_delete = "'" . base_url("jadwal_btq/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {
            $no++;
            $row = array();
            // $row[] = buttons("edit", "location.href='" . base_url("/Jadwal_btq/form_edit/" . $val->id . "") . "'") . ' ' . buttons("delete", "myDelete($val->id, $url_delete)");
            $row[] = '';
            $row[] = $no;
            $row[] = $val->nisn;
            $row[] = $val->no_wa;
            $row[] = $val->nama_lengkap;
            $row[] = $val->waktu;
            $row[] = $val->tanggal;
            $row[] = $val->ruangan;

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

    public function export_jadwal($filter = '')
    {
        $fill = isset($filter) ? $filter : 0;
        $user = $this->model->get_all_data($fill);
        // pre($user);
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        //auto width cell
        foreach (range('A', 'G') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        // Set document properties
        $spreadsheet->getProperties()->setCreator('MAN 2 KOTA BANDUNG')
            ->setLastModifiedBy('MAN 2 KOTA BANDUNG')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('result file');

        // Add some datas
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'NO WA')
            ->setCellValue('D1', 'NAMA LENGKAP')
            ->setCellValue('E1', 'JAM')
            ->setCellValue('F1', 'TANGGAL')
            ->setCellValue('G1', 'RUANGAN');

        // Miscellaneous glyphs, UTF-8
        $i = 2;
        $no = 1;
        foreach ($user as $data) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no)
                ->setCellValue('B' . $i, $data->nisn)
                ->setCellValue('C' . $i, $data->no_wa)
                ->setCellValue('D' . $i, $data->nama_lengkap)
                ->setCellValue('E' . $i, $data->waktu)
                ->setCellValue('F' . $i, $data->tanggal)
                ->setCellValue('G' . $i, $data->ruangan);
            $i++;
            $no++;
        }


        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('DATA PESERTA BTQ ' . $filter);

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="DATA PESERTA BTQ.xlsx"');
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

    public function export_jadwals()
    {
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('MAN 2 Bandung')
            ->setLastModifiedBy('MAN 2 Bandung')
            ->setTitle("Jadwal BTQ")
            ->setSubject("Jadwal BTQ")
            ->setDescription("Jadwal BTQ")
            ->setKeywords("Jadwal BTQ");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('J1:J7')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NISN"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NO WA");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA PESERTA");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "TANGGAL");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JAM");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "RUANGAN");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $siswa = $this->model->get_all_data();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->nisn);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->no_wa);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->tanggal);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->waktu);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->ruangan);
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Jadwal BTQ");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Jadwal BTQ.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
