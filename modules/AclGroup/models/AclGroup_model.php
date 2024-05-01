<?php defined('BASEPATH') or exit('No direct script access allowed');

class AclGroup_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //required declare
    }
    public function table_list()
    {
        $order  = $this->input->post("order");
        $col = 0;
        $dir = "";

        $this->db->select("*");
        $this->db->from("ms_parameter");
        $this->db->where("ParamVariable = 'ACL_USER_GROUP'");
        $this->db->where("(ParamID LIKE '%" . $_REQUEST['search']['value'] . "%' 
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
            1 => 'ms_parameter.ParamVariable',
            2 => 'ms_parameter.ParamID',

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
        $this->db->from("ms_parameter");
        $this->db->where("ParamVariable = 'ACL_USER_GROUP'");
        return $this->db->get()->num_rows();
    }

    public function table_record_filter()
    {
        // SELECT COUNT FILTR DATA

        $this->db->select("*");
        $this->db->from("ms_parameter");
        $this->db->where("ParamVariable = 'ACL_USER_GROUP'");
        $this->db->where("(paramID LIKE '%" . $_REQUEST['search']['value'] . "%'
                            )");
        return $this->db->get()->result();
    }

    public function get_all_data($DID)
    {
        $query = $this->db->query("SELECT * 
                                    FROM ms_acl_group
                                    WHERE DID = '{$DID}'
                                    ");
        $result = $query->row_array();

        return $result;
    }
}
