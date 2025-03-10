
<?php defined('BASEPATH') or exit('No direct script access allowed');

class ReportModel extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_siswa';
    }
    public function table_list()
    {
        $order  = $this->input->post("order");
        $col = 0;
        $dir = "";

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
        $this->db->where('id_jalur', 3);
        $this->db->where('id_status', 1);

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
        $valid_columns = array(
            0 => 'id',
            1 => 'nisn',
            2 => 'no_wa',
            3 => 'nama_lengkap',
            4 => 'id_jalur',
            5 => 'id_status'
        );

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
        $this->db->from($this->table);
        $this->db->where('id_jalur', 3);
        $this->db->where('id_status', 1);
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
        $this->db->where('id_jalur', 3);
        $this->db->where('id_status', 1);

        return $this->db->get()->result();
    }

    public function get_all_data($id)
    {
        $query = $this->db->query("SELECT *,CONCAT('0',no_wa) AS no_wa, (SELECT jalur FROM ms_jalur  WHERE id = table1.id_jalur) as jalur
                                    FROM 
                                    {$this->table} as table1
                                    WHERE {$id}
                                    ORDER BY id ASC
                                    ");
        $result = $query->result();
        // pre($result);
        return $result;
    }

    public function get_rapot_peserta()
    {
        $query = $this->db->query("SELECT table1.*,
                                        CONCAT('0',table1.no_wa) AS no_wa,
                                        table2.nilai_mtk,
                                        table2.nilai_ipa,
                                        table2.nilai_ips,
                                        table2.nilai_agama
                                    FROM 
                                    {$this->table} as table1
                                    JOIN ms_siswa_berkas as table2 ON table2.id_siswa = table1.id
                                    WHERE table1.nisn IN (SELECT nisn FROM ms_jadwal_akademik)
                                    ORDER BY table1.id ASC
                                    ");
        $result = $query->result();
        // pre($result);
        return $result;
    }

    public function get_alamat($id)
    {
        $query = $this->db->query("SELECT *
                                    FROM 
                                    ms_siswa_alamat as table1
                                    LEFT JOIN ms_siswa as table2 ON table1.id_siswa = table2.id
                                    WHERE table1.id_siswa IN 
                                    (SELECT id FROM ms_siswa 
                                            WHERE {$id} 
                                    )
                                    ORDER BY table2.id ASC
                                    ");
        $result = $query->result();
        // pre($result);
        return $result;
    }

    public function get_asal_sekolah($id)
    {
        $query = $this->db->query("SELECT *
                                    FROM 
                                    ms_siswa_sekolah as table1
                                    LEFT JOIN ms_siswa as table2 ON table1.id_siswa = table2.id
                                    WHERE table1.id_siswa IN 
                                    (SELECT id FROM ms_siswa 
                                            WHERE {$id} 
                                    )
                                    ORDER BY table2.id ASC
                                    ");
        $result = $query->result();
        // pre($result);
        return $result;
    }

    public function get_orang_tua($id)
    {
        $query = $this->db->query("SELECT *
                                    FROM 
                                    ms_siswa_ortu as table1
                                    LEFT JOIN ms_siswa as table2 ON table1.id_siswa = table2.id
                                    WHERE table1.id_siswa IN 
                                    (SELECT id FROM ms_siswa 
                                            WHERE {$id} 
                                    )
                                    ORDER BY table2.id ASC
                                    ");
        $result = $query->result();
        // pre($result);
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
}
