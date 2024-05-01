<?php defined('BASEPATH') or exit('No direct script access allowed');

abstract class MY_Controller extends MY_Template
{
    public function __construct()
    {
        parent::__construct();

        $this->template->set_breadcrumb(get_class($this), base_url(strtolower(get_class($this))));
        $this->load->model(get_class($this) . 'Model');

        //checking session
        if (strtolower(get_class($this)) != 'login') {
            (strtolower(get_class($this)) != 'dashboard') ? $this->getAksesUser($this->session->userdata('email')) : '';
        }

        check_session();
    }

    public function setJs($name)
    {
        $this->template->set('js', BASE_URL . 'assets/newAsset/js/' . strtolower(get_class($this)) . '/' . $name . '.js');
    }
    public function setCss($name)
    {
        $this->template->set('css', BASE_URL . 'assets/newAsset/css/' . strtolower(get_class($this)) . '/' . $name . '.css');
    }

    protected function setTitlePage($title = '')
    {
        if ($title == '') {
            $this->template->set('titlePage', get_class($this));
        } else {
            $this->template->set('titlePage', $title);
        }
    }
}
