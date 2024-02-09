<?php defined('BASEPATH') or exit('No direct script access allowed');

class FT_Template extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->template->set_partial('sidebar', 'mantemplate/sidebar');
        $this->template->set_partial('sidebar_frontend', 'mantemplate/sidebar_frontend');
        $this->template->set_partial('content-header', 'mantemplate/content-header');
        $this->template->set_partial('header', 'mantemplate/header');
        $this->template->set_partial('header_frontend', 'mantemplate/header_frontend');
    }
}
