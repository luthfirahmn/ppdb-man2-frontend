
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_ppdbModel extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_jadwal';
    }
    public function table_list()
    {
        $order  = $this->input->post("order");
        $col = 0;
        $dir = "";

        $this->db->select("*
        ");
        $this->db->from($this->table . ' table');

        if (empty($order)) {
            $this->db->order_by("id", "ASC");
        } else {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $valid_columns = array();

        if (!isset($valid_columns[$col])) {
            $ordr = null;
        } else {
            $ordr = $valid_columns[$col];
        }
        if ($ordr != null) {
            $this->db->order_by($ordr, $dir);
        }

        if ($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        return $this->db->get()->result();
    }

    public function table_count_list()
    {
        // SELECT COUNT DATA ALL
        $this->db->select("*");
        $this->db->from($this->table . ' table');
        return $this->db->get()->num_rows();
    }

    public function table_record_filter()
    {
        // SELECT COUNT FILTR DATA
        $this->db->select("*");
        $this->db->from($this->table . ' table');

        return $this->db->get()->result();
    }

    public function get_all_data($param)
    {
        $this->db->select("*");
        $this->db->from($this->table . ' table');
        return $this->db->get()->result();
    }

    public function get_data_by_id($id)
    {
        $query = $this->db->query("SELECT * 
                                    FROM 
                                    '{$this->table}'
                                    WHERE id = '{$id}'
                                    ");
        $result = $query->row();

        return $result;
    }


    public function data_edit($ID)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("id", $ID);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function validation($post)
    {
        foreach ($post as $key => $val) {
            $this->form_validation->set_rules($key, $key, "required");
        }
        if ($this->form_validation->run() == FALSE) {
            return validation_errors();
        } else {
            return false;
        }
    }

    public function submit_add($post)
    {
        try {
            $this->tStart();
            $data = array(
                'order_no'  => $post['order_no'],
                'jadwal'      => $post['jadwal'],
                'waktu'  => $post['waktu'],
                'desc'      => $post['desc'],
                'btn_login'   => $post['btn_login'],
                'btn_daftar'   => $post['btn_daftar'],
                'btn_alur'   => $post['btn_alur'],
            );

            $validation = $this->validation($data);
            if ($validation) {
                return json_encode(['error' => true, 'msg' => $validation]);
            } else {
                $this->processDB("add", $data, array(), $this->table, "lbsmaster");
                $lastid = $this->db->insert_id();
                $this->tCommit();
                if ($lastid > 1) {
                    $push = json_encode(['error' => false, 'msg' => 'Success insert data']);
                } else {
                    $push = json_encode(['error' => true, 'msg' => 'Error insert data']);
                }
                return $push;
            }
        } catch (Exception $e) {
            $this->tRollback();
            return json_encode(['error' => true, 'msg' => 'Error insert data']);
        }
    }


    public function submit_update($post)
    {
        try {
            $this->tStart();
            $data = array(
                'order_no'  => $post['order_no'],
                'jadwal'      => $post['jadwal'],
                'waktu'  => $post['waktu'],
                'desc'      => $post['desc'],
                'btn_login'   => $post['btn_login'],
                'btn_daftar'   => $post['btn_daftar'],
                'btn_alur'   => $post['btn_alur'],
            );

            $validation = $this->validation($data);
            if ($validation) {
                return json_encode(['error' => true, 'msg' => $validation]);
            } else {
                $update = $this->processDB("edit", $data, array("id" => $post['id']), $this->table, "lbsmaster");
                $this->tCommit();
                if ($update) {
                    $push = json_encode(['error' => false, 'msg' => 'Success update data']);
                } else {
                    $push = json_encode(['error' => true, 'msg' => 'Error update data']);
                }
                return $push;
            }
        } catch (Exception $e) {
            $this->tRollback();
            return json_encode(['error' => true, 'msg' => 'Error update data']);
        }
    }


    public function delete_data($post)
    {
        try {
            $this->tStart();
            $this->processDB("delete", array(), array("id" => $post['id']), $this->table, "lbsmaster");


            if ($this->db->affected_rows() > 0 ? TRUE : FALSE) {
                $push = json_encode(['error' => false, 'msg' => 'Sukses menghapus  data']);
            } else {
                $push = json_encode(['error' => true, 'msg' => 'Gagal menghapus data']);
            }

            $this->tCommit();
            return $push;
        } catch (Exception $e) {
            $this->tRollback();
            return json_encode(['error' => true, 'msg' => 'Gagal menghapus data']);
        }
    }

    public function getParentMenu()
    {
        $this->db->select("DID,Menu");
        $this->db->from('ms_menu');
        $this->db->where("MenuFile = '' ");
        $query = $this->db->get();
        return $query->result_array();
    }
}
