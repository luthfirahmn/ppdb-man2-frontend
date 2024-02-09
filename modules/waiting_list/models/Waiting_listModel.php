
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Waiting_listModel extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_siswa';
        $this->wa_url = 'https://app.ruangwa.id/api/';
    }
    public function table_list()
    {

        $this->db->select("*, 
                            (SELECT jalur FROM ms_jalur WHERE id = table.id_jalur) as jalur,
                            (SELECT status_desc FROM ms_status WHERE status = table.id_status) as status,
                            CONCAT('0',no_wa) as no_wa,
        ");
        $this->db->from($this->table . ' table');
        $this->db->where("(nisn LIKE '%" . $_REQUEST['search']['value'] . "%' or
                            no_wa LIKE '%" . $_REQUEST['search']['value'] . "%' or
                            nama_lengkap LIKE '%" . $_REQUEST['search']['value'] . "%'
                            )");
        $this->db->where('id_status', 80);
        $this->db->order_by("id", "ASC");



        if ($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        return $this->db->get()->result();
    }

    public function table_count_list()
    {
        // SELECT COUNT DATA ALL
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where('id_status', 80);
        return $this->db->get()->num_rows();
    }

    public function table_record_filter()
    {
        // SELECT COUNT FILTR DATA
        $this->db->select("*, 
        (SELECT jalur FROM ms_jalur WHERE id = table.id_jalur) as jalur,
        (SELECT status_desc FROM ms_status WHERE id = table.id_status) as status,
");
        $this->db->from($this->table . ' table');
        $this->db->where("(nisn LIKE '%" . $_REQUEST['search']['value'] . "%' or
        no_wa LIKE '%" . $_REQUEST['search']['value'] . "%' or
        nama_lengkap LIKE '%" . $_REQUEST['search']['value'] . "%'
        )");
        $this->db->where('id_status', 80);

        return $this->db->get()->result();
    }

    public function get_all_data($id)
    {
        $query = $this->db->query("SELECT * 
                                    FROM 
                                    '{$this->table}'
                                    WHERE id = '{$id}'
                                    ");
        $result = $query->row_array();

        return $result;
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
            if ($key != 'MenuFile') {
                $this->form_validation->set_rules($key, $val, "required");
            }
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
                'ParentID'  => $post['ParentID'],
                'Menu'      => $post['Menu'],
                'MenuFile'  => $post['MenuFile'],
                'Icon'      => $post['Icon'],
                'OrderNo'   => $post['OrderNo']
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
                'ParentID'  => $post['ParentID'],
                'Menu'      => $post['Menu'],
                'MenuFile'  => $post['MenuFile'],
                'Icon'      => $post['Icon'],
                'OrderNo'   => $post['OrderNo']
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

    public function get_peserta_waiting_list($nisn)
    {
        $query = $this->db->query("SELECT *,
        CONCAT('0',no_wa) as no_wa,
        (SELECT jalur FROM ms_jalur WHERE id = ms_siswa.id_jalur) as jalur,
        (SELECT status_desc FROM ms_status WHERE status = ms_siswa.id_status) as status
        FROM ms_siswa 
        WHERE nisn = {$nisn} 
        AND id_status IN (20,30,40,50,80)");
        $result = $query->row();

        if ($result) {
            return json_encode(['error' => false, 'data' => $result]);
        } else {
            return json_encode(['error' => true]);
        }
    }


    public function aksi_waiting_list($nisn, $status)
    {
        $update = $this->db->query("UPDATE ms_siswa
                                    SET id_status = $status,waiting_list = 1
                                    WHERE nisn = {$nisn}
                                    ");
        if ($update) {
            $query = $this->db->query("SELECT * 
                                       FROM ms_siswa
                                       WHERE nisn = {$nisn}
                                    ");
            $row = $query->row();
            $msg =
                "Assalamualaikum wr wb
Atas Nama : " . $row->nama_lengkap . "
Dengan NISN : " . $row->nisn . " .
Anda telah lulus di MAN 2 KOTA BANDUNG melalui waiting list, Mohon cek status kelulusan dengan login ke website PPDB MAN 2 KOTA BANDUNG https://ppdb.man2kotabandung.sch.id/ . ";
            $data_otp = 'token=' . wa_token() . '&number=0' . $row->no_wa . '&message=' . $msg;
            // pre($data_otp);
            $check_number = wa_post($this->wa_url . 'send_message', $data_otp);

            return json_encode(['error' => false, 'msg' => 'Update data peserta berhasil']);
        } else {
            return json_encode(['error' => false, 'msg' => 'Update data peserta gagal']);
        }
    }
}
