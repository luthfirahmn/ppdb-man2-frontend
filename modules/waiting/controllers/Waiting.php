<?php defined('BASEPATH') or exit('No direct script access allowed');

class Waiting extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('WaitingModel');
        $this->model = $this->WaitingModel;
    }

    public function index()
    {
        $getButton = $this->button($this->model->getButtonActive()->button);
        $data = array(
            // 'infoHeader' =>  $this->model->getInfo('header') != null ? $this->model->getInfo('header') : 'Selamat datang di website PPDB MAN 2 KOTA BANDUNG',
            // 'infoPopup' => $this->model->getInfo('popup') != null ? $this->model->getInfo('popup') : 'Selamat datang di website PPDB MAN 2 KOTA BANDUNG',
            // 'getButtonData' => $this->model->getButtonActive(),
            // 'getButton' => $getButton,
            // 'getArticle' => count($this->model->getArticle()) > 0 ? $this->model->getArticle() : 0,
            // 'getContact' => $this->model->getContact(),
            'getSlider' => $this->model->getSlider(),
        );

        $this->load->view('waiting/index', $data);
    }

    public function button($param)
    {
        $path = base_url() . '/login_peserta';
        switch ($param) {
            case 0:
                return '<button class="inline-flex text-white bg-gray-500 border-0 py-1 px-4 focus:outline-none rounded" disabled>Pendaftaran belum dibuka</button>';
                break;
            case 1:
                return '<a href="' . $path . '" class="inline-flex text-white bg-indigo-500 border-0 py-1 px-4 focus:outline-none hover:bg-indigo-600 rounded">Pendaftaran / login</a>';
                break;
            case 2:
                return '<a href="' . $path . '" class="inline-flex text-white bg-indigo-500 border-0 py-1 px-4 focus:outline-none hover:bg-indigo-600 rounded">Login</a>';
                break;
            case 3:
                return '<button class="inline-flex text-white bg-gray-500 border-0 py-1 px-4 focus:outline-none rounded" disabled>Pendaftaran ditutup</button>';
                break;
        }
    }

    public function getArticleDetail($id)
    {
        $prosess = $this->model->getArticleDetail($id);
        echo $prosess;
    }


    public function downloadFileAlur()
    {
        $this->load->helper('download');
        // Set the file path
        $file_path = ASSETS . 'images/alur.pdf';

        // Set the suggested file name
        $file_name = 'ALUR_PPDB.pdf';

        // Use the force_download helper to initiate the download
        force_download($file_name, file_get_contents($file_path));
    }


    public function downloadFileAgenda()
    {
        $this->load->helper('download');
        // Set the file path
        $file_path = ASSETS . 'images/agenda_jalur.pdf';

        // Set the suggested file name
        $file_name = 'AGENDA_&_JALUR_PENDAFTARAN_PPDB.pdf';

        // Use the force_download helper to initiate the download
        force_download($file_name, file_get_contents($file_path));
    }
}
