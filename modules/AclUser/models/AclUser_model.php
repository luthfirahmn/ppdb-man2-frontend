<?php defined('BASEPATH') or exit('No direct script access allowed');

class AclUser_model extends CI_Model
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
        $this->db->from($this->table);
        $this->db->where("(Email LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ACLGroup LIKE '%" . $_REQUEST['search']['value'] . "%' 
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
            2 => 'Email',
            3 => 'ACLGroup'

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
        $all_data = $this->db->get()->result();
        // 
        return $all_data;
    }

    public function table_record_filter()
    {
        // SELECT COUNT FILTR DATA

        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("(DID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or Email LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ACLGroup LIKE '%" . $_REQUEST['search']['value'] . "%' 
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
    public function user()
    {
        $Email = $this->db->query("SELECT Email FROM ms_acl_user_group")->result();

        $this->db->select('*');
        $this->db->from('ms_login as login');
        foreach ($Email as $row) :
            $EmailResult = $row->Email;

            $this->db->where('login.Email !=', $EmailResult);
        endforeach;
        $this->db->where('login.Active ', '1');
        $user = $this->db->get()->result();

        return $user;
    }
}
