<?php defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FrontendModel');
        $this->model = $this->FrontendModel;
    }

    public function index()
    {
        $getButton = $this->button($this->model->getButtonActive()->button);
        $data = array(
            'infoHeader' =>  $this->model->getInfo('header') != null ? $this->model->getInfo('header') : 'Selamat datang di website PPDB MAN 2 KOTA BANDUNG',
            'infoPopup' => $this->model->getInfo('popup') != null ? $this->model->getInfo('popup') : 'Selamat datang di website PPDB MAN 2 KOTA BANDUNG',
            'getButtonData' => $this->model->getButtonActive(),
            'getButton' => $getButton,
            'getArticle' => count($this->model->getArticle()) > 0 ? $this->model->getArticle() : 0,
            'getContact' => $this->model->getContact(),
            'getSlider' => $this->model->getSlider(),
        );

        $this->load->view('frontend/index', $data);
    }

    public function button($param)
    {
        $login_path = base_url() . '/login_peserta';
        $register_path = base_url() . '/register';
        switch ($param) {
            case 0:
                return '';
                break;
            case 1:
                return '
                    <div class="main-button-red me-2">
                        <a href="' . $login_path . '"
                            class="">
                            <i class="fa fa-sign-in"></i> Login
                        </a>
                    </div>
                    <div class="main-button-yellow ">
                        <a href="' . $register_path . '"
                        class="">
                        <i class="fa fa-address-card"></i> Daftar
                    </a>
                    </div>

                ';
                break;
            case 2:
                return '

                 <div class="main-button-red me-2">
                        <a href="' . $login_path . '"
                            class="">
                            <i class="fa fa-sign-in"></i> Login
                        </a>
                    </div>
                   ';
                break;
            case 3:
                return '';
                break;
        }
    }

    public function detail($id)
    {
        $prosess = $this->model->getArticleDetail($id);

        $this->load->view('frontend/detail', $prosess);
    }
}
