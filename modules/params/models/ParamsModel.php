<?php defined('BASEPATH') or exit('No direct script access allowed');

class ParamsModel extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        //required declare
        $this->table = 'ms_parameter';
    }


    public function table_list()
    {

        $order  = $this->input->post("order");
        $col = 0;
        $dir = "";

        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("(DID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ParamVariable LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ParamID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ParamValue LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            )");

        if (empty($order)) {
            $this->db->order_by("DID", "DESC");
        } else {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $valDID_columns = array(
            1 => 'DID',
            2 => 'ParamVariable',
            3 => 'ParamID',
            4 => 'ParamValue',
        );

        if (!isset($valDID_columns[$col])) {
            $ordr = null;
        } else {
            $ordr = $valDID_columns[$col];
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
        return $this->db->get()->num_rows();
    }

    public function table_record_filter()
    {
        // SELECT COUNT FILTR DATA

        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("(DID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ParamVariable LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ParamID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ParamValue LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            )");
        return $this->db->get()->result();
    }

    public function get_all_data($DID)
    {
        $query = $this->db->query("SELECT * 
                                    FROM 
                                    '{$this->table}'
                                    WHERE DID = '{$DID}'
                                    ");
        $result = $query->row_array();

        return $result;
    }
    public function data_edit($ID)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("DID", $ID);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function validation($post)
    {
        foreach ($post as $key => $val) {
            $this->form_validation->set_rules($key, $val, "required");
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
                'ParamID'       => $post['ParamID'],
                'ParamVariable' => $post['ParamVariable'],
                'ParamValue'    => $post['ParamValue']
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
                'ParamID'       => $post['ParamID'],
                'ParamVariable' => $post['ParamVariable'],
                'ParamValue'    => $post['ParamValue']
            );

            $validation = $this->validation($data);
            if ($validation) {
                return json_encode(['error' => true, 'msg' => $validation]);
            } else {
                $update = $this->processDB("edit", $data, array("DID" => $post['DID']), $this->table, "lbsmaster");
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
            $this->processDB("delete", array(), array("DID" => $post['DID']), $this->table, "lbsmaster");


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
}
