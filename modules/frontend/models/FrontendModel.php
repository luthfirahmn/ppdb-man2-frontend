<?php defined('BASEPATH') or exit('No direct script access allowed');

class FrontendModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //required declare
    }

    public function getInfo($param)
    {
        $query = $this->db->query("SELECT t0.desc FROM ms_info t0 WHERE info_type = '{$param}' AND active = 1 ");

        return $query->row()->desc;
    }

    public function getButtonActive()
    {
        $query = $this->db->query("SELECT * FROM ms_button t0 WHERE active = 1 ");

        return $query->row();
    }

    public function getArticle()
    {
        $query = $this->db->query("SELECT * FROM ms_artikel WHERE active = 1 ORDER BY created_time DESC LIMIT 6");

        return $query->result();
    }

    public function getContact()
    {
        $query = $this->db->query("SELECT * FROM ms_kontak");

        return $query->row();
    }

    public function getSlider()
    {
        $query = $this->db->query("SELECT * FROM ms_slider");

        return $query->result();
    }

    public function getArticleDetail($post)
    {

        $query = $this->db->query("SELECT * FROM ms_artikel t0 WHERE id = {$post} ");
        $res = $query->row();
        return $res;
    }
}
