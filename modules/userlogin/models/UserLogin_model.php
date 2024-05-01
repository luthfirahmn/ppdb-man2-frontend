<?php defined('BASEPATH') or exit('No direct script access allowed');

class UserLogin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //required declare
        $this->table = 'ms_login';
    }
    public function table_list()
    {
        $order  = $this->input->post("order");
        $col = 0;
        $dir = "";

        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("(DID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or Email LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or Password LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or LastLogin LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or SessionExpiry LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or RememberMe LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ResetPass LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or CodeOTP LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or EmpID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or AdminPanel LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or AppToken LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or Active LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            )");

        if (empty($order)) {
            $this->db->order_by("CustomerID", "DESC");
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
            3 => 'Password',
            4 => 'LastLogin',
            5 => 'SessionExpiry',
            6 => 'RememberMe',
            7 => 'ResetPass',
            8 => 'CodeOTP',
            9 => 'EmpID',
            10 => 'AdminPanel',
            11 => 'AppToken',
            12 => 'Active',

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
                            or Email LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or Password LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or LastLogin LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or SessionExpiry LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or RememberMe LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or ResetPass LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or CodeOTP LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or EmpID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or AdminPanel LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or AppToken LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or Active LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            )");
        return $this->db->get()->result();
    }

    public function get_all_data($ID)
    {
        $query = $this->db->query("SELECT * 
                                    FROM 
                                    '{$this->table}'
                                    WHERE DID = '{$ID}'
                                    ");
        $result = $query->row_array();

        return $result;
    }

    // public function insert_data($data)
    // {
    //     $query = $this->db->insert($this->table,  $data);

    //     if ($query) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function delete_data($ID)
    // {
    //     $query = $this->db->where('CustomerID', $ID);
    //     $this->db->delete($this->table);

    //     if ($query) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    public function data_edit($ID)
    {
        $this->db->select("*");
        $this->db->from("ms_login");
        $this->db->where("DID", $ID);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_data($data, $ID)
    {
        $query = $this->db->where('DID', $ID)
            ->update($this->table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
