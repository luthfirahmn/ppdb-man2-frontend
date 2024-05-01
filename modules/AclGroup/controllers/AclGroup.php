<?php defined('BASEPATH') or exit('No direct script access allowed');

class AclGroup extends MY_Template
{
    //required declare
    protected $_breadcrumb;
    public function __construct()
    {
        parent::__construct();
        //required declare

        $this->_breadcrumb[0] = 'AclGroup';
        $this->load->model('AclGroup_model');
        $this->model = $this->AclGroup_model;
    }
    public function index()
    {

        $this->_breadcrumb[] = 'index';

        $data = array(
            'contentHeader' => $this->_breadcrumb[0],
            'breadcrumb' => $this->_breadcrumb,
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
        $this->template->title('AclGroup');
        $this->template->build('index', $data);
    }

    public function get_list()
    {
        // SELECT DATA ALL
        $all_data = $this->model->table_list();
        $recordsTotal = $this->model->table_count_list();
        $recordsFiltered = $this->model->table_record_filter();


        $url_delete = "'" . base_url("AclGroup/delete") . "'";
        $data = array();
        $no = $_POST['start'];
        foreach ($all_data as $key => $val) {
            $no++;
            $row = array();
            $row[] = buttons("edit", "location.href='" . base_url("/AclGroup/form_edit/" . $val->DID . "") . "'") . ' ' . buttons("delete", "myDelete($val->ParamID, $url_delete)");
            $row[] = $val->ParamID;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => count($recordsFiltered),
            "data" => $data,
        );

        echo json_encode($output);
    }
    public function add()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        if ($this->input->post()) {

            $this->db->select("DID");
            $this->db->from("ms_parameter");
            $this->db->where("ParamID", $this->input->post("ParamID"));
            $grup = $this->db->get()->row();

            if ($grup) {
                $output = array(
                    "status"  => false,
                    "message" => "the group already exists..",
                );
                echo json_encode($output);
                die;
            }

            $this->db->trans_begin();

            $insert['ParamVariable'] = "ACL_USER_GROUP";
            $insert['ParamID']       = $this->input->post('ParamID');
            $insert['ParamValue']    = $this->input->post('ParamID');
            $this->db->insert("ms_parameter", $insert);

            $sql  = $this->db->last_query();
            $page = base_url('backend/aclGroup/add');
            tr_log($sql, $page, $this->user);


            $this->db->select("DID");
            $this->db->from("ms_menu");
            $this->db->where("ParentId <> 0");
            $did = $this->db->get()->result_array();
            pre($did);

            foreach ($did as $val) {
                $insertAcl["ACLGroup"] = $this->input->post('ParamID');
                $insertAcl["MenuID"]   = $val["DID"];
                $insertAcl["MView"]    = 0;
                $insertAcl["MAdd"]     = 0;
                $insertAcl["MEdit"]    = 0;
                $insertAcl["MDelete"]  = 0;
                $insertAcl["MPrint"]   = 0;
                $insertAcl["MExport"]  = 0;

                $this->db->insert("ms_acl_group", $insertAcl);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $output = array(
                    "status"  => false,
                    "message" => "Faild Created.!!!",
                );
                echo json_encode($output);
                die;
            } else {
                $this->db->trans_commit();
                $output = array(
                    "status"  => true,
                    "message" => "Success Created..",
                );
                echo json_encode($output);
                die;
            }
        } else {
            $output = array(
                "status"  => false,
                "message" => "Error method Post...",
            );
            echo json_encode($output);
            die;
        }
    }
    public function form_edit()
    {
        //pre($_POST);
        $id = $this->input->post("ParamID");
        /* DATA DATA */
        $this->db->select("*");
        $this->db->from("ms_parameter");
        $this->db->where("DID", $id);
        $this->db->where("ParamVariable", "ACL_USER_GROUP");

        $query    = $this->db->get();
        $all_data = $query->row();

        if ($all_data) {
            $output = array(
                "status"  => true,
                "message" => "success..",
                "data"    => $all_data
            );

            echo json_encode($output);
            die;
        } else {
            $output = array(
                "status"  => true,
                "message" => "Not Found Data..",
            );

            echo json_encode($output);
            die;
        }
    }
    public function edit()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        // pre($_POST);
        // GET DATA ms_parameter
        $this->db->select("ParamID, ParamValue");
        $this->db->from("ms_parameter");
        $this->db->where("DID", $this->input->post('DID'));
        $acl_gorup = $this->db->get()->row();
        // GET DAT ms_parameter
        //pre($acl_gorup);
        $this->db->trans_begin();
        /* UPDATE MS PARAMETER */
        $DID                     = $this->input->post('DID');
        $update['ParamVariable'] = "ACL_USER_GROUP";
        $update['ParamID']       = $this->input->post('ParamID');
        $update['ParamValue']    = $this->input->post('ParamID');

        $this->db->where("DID", $DID);
        $this->db->update("ms_parameter", $update);
        /* UPDATE MS PARAMETER */

        $sql  = $this->db->last_query();
        $page = base_url('aclGroup/edit');
        tr_log($sql, $page, $this->user);

        /* UPDATE MS ACL GROUP */
        $updates['ACLGroup']       = $this->input->post('ParamID');
        $this->db->where("ACLGroup", $acl_gorup->ParamID);
        $this->db->update("ms_acl_group", $updates);
        /* UPDATE MS ACL GROUP */

        /* UPDATE MS ACL USER GROUP */
        $updates['ACLGroup']       = $this->input->post('ParamID');
        $this->db->where("ACLGroup", $acl_gorup->ParamID);
        $this->db->update("ms_acl_user_group", $updates);
        /* UPDATE MS ACL USER GROUP */

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $output = array(
                "status"  => false,
                "message" => "Failed Updated..",
            );
            echo json_encode($output);
            die;
        } else {
            $this->db->trans_commit();
            $output = array(
                "status"  => true,
                "message" => "Success Updated..",
            );
            echo json_encode($output);
            die;
        }
    }
    public function delete()
    {
        if ($this->input->post("DID") != "") {

            $this->db->select("ParamID, ParamValue");
            $this->db->from("ms_parameter");
            $this->db->where("DID", $this->input->post("DID"));
            $param = $this->db->get()->row();

            $this->db->trans_begin();

            $this->db->where('DID', $this->input->post("DID"));
            $this->db->delete('ms_parameter');

            $sql  = $this->db->last_query();
            $page = base_url('aclGroup/delete');
            tr_log($sql, $page, $this->user);

            $this->db->where("ACLGroup", $param->ParamID);
            $this->db->delete("ms_acl_group");

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $output = array(
                    "status"  => false,
                    "message" => "Failed Updated..",
                );
                echo json_encode($output);
                die;
            } else {
                $this->db->trans_commit();
                $output = array(
                    "status"  => true,
                    "message" => "Success Updated..",
                );
                echo json_encode($output);
                die;
            }
        } else {
            $res = array(
                "status" => "Invalid parameter"
            );
            echo json_encode($res);
        }
    }
    public function access_menu()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        /* GET DATA  ROLE*/
        $this->db->select("*");
        $this->db->from("ms_parameter");
        $this->db->where("ParamVariable", "ACL_USER_GROUP");
        $ACL_USER_GROUP = $this->db->get()->result();
        if ($ACL_USER_GROUP) {
            $output = array(
                "status"  => true,
                "message" => "success.!!!",
                "data"    => $ACL_USER_GROUP
            );
            echo json_encode($output);
            die;
        } else {
            $output = array(
                "status"  => false,
                "message" => "Get data Faild.!!!",
            );
            echo json_encode($output);
            die;
        }
    }
    public function access_user()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        if ($this->input->post()) {

            $selected = $this->input->post("selected");
            /* GET DATA  MENU*/
            $menu = $this->db->query(" SELECT mm.DID
                                            ,mm.Menu
											,mag.MenuID
                                            ,mag.ACLGroup 
                                            ,mag.MView
                                            ,mag.MAdd
                                            ,mag.MEdit
                                            ,mag.MDelete
                                            ,mag.MPrint
                                            ,mag.MExport
                                        FROM ms_menu as mm
                                        LEFT JOIN ms_acl_group as mag ON mag.MenuID = mm.DID
                                        WHERE mag.ACLGroup = '{$selected}'
                                        AND mm.ParentID <> 0
                                        GROUP BY mm.DID
                                            ,mm.Menu
											,mag.MenuID
                                            ,mag.ACLGroup 
                                            ,mag.MView
                                            ,mag.MAdd
                                            ,mag.MEdit
                                            ,mag.MDelete
                                            ,mag.MPrint
                                            ,mag.MExport
                                   ")->result();

            if ($menu) {
                $output = array(
                    "status"  => true,
                    "message" => "success.!!!",
                    "data"    => $menu
                );
                echo json_encode($output);
                die;
            } else {
                $output = array(
                    "status"  => false,
                    "message" => "data notfound.!!!",
                );
                echo json_encode($output);
                die;
            }
        } else {
            $this->session->set_flashdata("error_msg", "error Params...");
            redirect('aclGroup/access_menu');
        }
    }
    public function set_access()
    {
        $checked = $this->input->post('checked');

        $checkbox_data = array();
        foreach ($checked as $keys => $val) {
            $checkbox_data[$val["did"]][$val["access"]] = $val["value"];
        }

        foreach ($checkbox_data as $key => $access) {
            $this->db->where("ACLGroup", $this->input->post("aclgroup"));
            $this->db->where("MenuId", $key);
            $this->db->update("ms_acl_group", $access);
        }

        $output = array(
            "status"  => true,
            "message" => "success.!!!",
        );
        echo json_encode($output);
    }

    // public function form()
    // {
    //     //required declare
    //     $this->_breadcrumb[] = 'form';
    //     $data = array(
    //         'contentHeader' => $this->_breadcrumb[0],
    //         'breadcrumb' => $this->_breadcrumb,
    //         'status_form' => 0,
    //     );

    //     $this->template->title('Master Site');
    //     $this->template->build('form', $data);
    // }

    // public function add()
    // {
    //     $this->form_validation->set_error_delimiters('', '<br>');
    //     // $this->form_validation->set_rules('CategoryParentID', 'Parent Category', 'required');

    //     $this->form_validation->set_rules('ParamVariable', 'ParamVariable', 'required');
    //     $this->form_validation->set_rules('ParamID', 'ParamID', 'required');
    //     $this->form_validation->set_rules('ParamValue', 'ParamValue', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         $errors = validation_errors();
    //         echo json_encode(['error' => true, 'msg' => $errors]);
    //     } else {


    //         $data["ParamVariable"]              = $this->input->post('ParamVariable');
    //         $data["ParamID"]                    = $this->input->post('ParamID');
    //         $data["ParamValue"]                 = $this->input->post('ParamValue');

    //         $insert = $this->model->insert_data($data);

    //         if ($insert) {
    //             echo json_encode(['error' => false, 'msg' => 'Sukses menambah data']);
    //         } else {
    //             echo json_encode(['error' => true, 'msg' => 'Error menambah data']);
    //         }
    //     }
    // }
    // public function delete()
    // {
    //     $DID = $this->input->post("DID");
    //     if ($DID != "") {

    //         $this->model->delete_data($DID);

    //         if ($this->db->affected_rows() > 0 ? TRUE : FALSE) {
    //             echo json_encode(['error' => false, 'msg' => 'Sukses menghapus  data']);
    //         } else {
    //             echo json_encode(['error' => true, 'msg' => 'Gagal menghapus data']);
    //         }
    //     } else {
    //         echo json_encode(['error' => true, 'msg' => 'ID tidak ditemukan']);
    //     }
    // }

    // public function form_edit($DID = null)
    // {
    //     $data_edit = $this->model->data_edit($DID);

    //     $this->_breadcrumb[] = 'form';
    //     $data = array(
    //         'contentHeader' => $this->_breadcrumb[0],
    //         'breadcrumb' => $this->_breadcrumb,
    //         'status_form' => 1,
    //         'all_data' => $data_edit

    //     );
    //     //pre($data_edit);

    //     $this->template->title('Master Site');
    //     $this->template->build('form', $data);
    // }

    // public function edit($DID = null)
    // {

    //     $this->form_validation->set_error_delimiters('', '<br>');
    //     $this->form_validation->set_rules('ParamVariable', 'Parameter Variabel', 'required');
    //     $this->form_validation->set_rules('ParamID', 'Parameter ID', 'required');
    //     $this->form_validation->set_rules('ParamValue', 'Parameter Value', 'required');
    //     if ($this->form_validation->run() == FALSE) {
    //         $errors = validation_errors();
    //         echo json_encode(['error' => $errors]);
    //     } else {

    //         if ($this->input->post()) {


    //             $data["ParamVariable"]           = $this->input->post("ParamVariable");
    //             $data["ParamID"]                 = $this->input->post("ParamID");
    //             $data["ParamValue"]              = $this->input->post("ParamValue");


    //             $this->db->save_queries = TRUE;
    //             $this->db->where("DID", $DID);
    //             $edit = $this->model->update_data($data, $DID);
    //             if ($edit) {
    //                 echo json_encode(['error' => false, 'msg' => 'Sukses update data']);
    //             } else {
    //                 echo json_encode(['error' => true, 'msg' => 'Error update data']);

    //                 if ($this->input->post('save') == "savereturn") {
    //                     $this->session->set_flashdata("success_msg", "Data insert success...");
    //                     redirect('Parameter');
    //                 }
    //             }
    //         }
    //     }
    // }
}
