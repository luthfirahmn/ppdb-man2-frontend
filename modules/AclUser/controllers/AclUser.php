<?php defined('BASEPATH') or exit('No direct script access allowed');

class AclUser extends MY_Template
{
    //required declare
    protected $_breadcrumb;
    public function __construct()
    {
        parent::__construct();
        //required declare

        $this->_breadcrumb[0] = 'Acl User';
        $this->load->model('AclUser_model');
        $this->model = $this->AclUser_model;
    }
    public function index()
    {
        $this->_breadcrumb[] = 'index';

        $all_data = $this->model->table_count_list();
        $user = $this->model->user();


        $this->db->select("*");
        $this->db->from("ms_acl_user_group");
        $selected = $this->db->get()->result();

        $data = array(
            'contentHeader' => $this->_breadcrumb[0],
            'breadcrumb' => $this->_breadcrumb,
            'all_data' => $all_data,
            'user' => $user,
            'selected' => $selected
        );

        $style["css"] = [
            ASSETS_PATH . "plugins/custom/jquery.dataTables.min.css",
        ];
        $script["js"] = [
            ASSETS_PATH . "plugins/custom/jquery.dataTables.min.js",
            ASSETS_PATH . "plugins/datatables-buttons/js/dataTables.buttons.min.js",
            ASSETS_PATH . "plugins/datatables-buttons/js/buttons.bootstrap4.min.js",
            ASSETS_PATH . "plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
            ASSETS_PATH . "plugins/datatables-buttons/js/buttons.html5.min.js",
            ASSETS_PATH . "plugins/datatables-buttons/js/buttons.print.min.js"
        ];



        $this->template->style($style);
        $this->template->script($script);
        $this->template->title('Acl User');
        $this->template->build('index', $data);
    }

    public function get_list()
    {
        // SELECT DATA ALL
        $all_data = $this->model->table_list();
        $recordsTotal = $this->model->table_count_list();
        $recordsFiltered = $this->model->table_record_filter();


        // $url_delete = "'" . base_url("AclUser/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {
            $no++;
            $row = array();
            // $row[] = buttons("edit", "location.href='" . base_url("/site/form_edit/" . $val->DID . "") . "'") . ' ' . buttons("delete", "myDelete($val->DID, $url_delete)");
            $row[] = $val->Email;
            $row[] = $val->ACLGroup;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => count($recordsFiltered),
            "data" => $data,
            "all_data" => $all_data,
        );

        echo json_encode($output);
    }

    function GetAclUser()
    {

        $Group = $this->input->post('Group');
        $this->db->select('*');
        $this->db->from('ms_acl_user_group');
        $this->db->where('ACLGroup', $Group);
        $data = $this->db->get()->result();
    }
    public function SelectedProcess()
    {

        $LogDID = $this->input->post('LogDID');
        $DID = $this->input->post('DID');
        $SelectGroup = $this->input->post('SelectGroup');

        for ($count = 0; $count < count($LogDID); $count++) {
            $LogDIDCount = $LogDID[$count];
            $LogEmail = $this->db->query("SELECT Email FROM ms_login where DID = $LogDIDCount")->row()->Email;
            $data  = array(
                'Email' => $LogEmail,
                'ACLGroup' => $SelectGroup
            );

            $this->db->where('Email', $LogEmail);
            $q = $this->db->get('ms_acl_user_group');
            $this->db->reset_query();

            if ($q->num_rows() > 0) {
                $this->db->where('Email', $LogEmail)->update('ms_acl_user_group', $data);
                $this->db->query("DELETE FROM ms_acl_user_group WHERE Email IS NULL");
            } else {
                $this->db->set('Email', $LogEmail)->insert('ms_acl_user_group', $data);
                $this->db->query("DELETE FROM ms_acl_user_group WHERE Email IS NULL");
            }
        }
        for ($count = 0; $count < count($DID); $count++) {
            $DIDCount = $DID[$count];
            $AclDID = $this->db->query("SELECT DID FROM ms_acl_user_group where DID = $DIDCount")->row()->DID;

            $this->db->where('DID', $AclDID)->Delete('ms_acl_user_group');
        }
    }
}
