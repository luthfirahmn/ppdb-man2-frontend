<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    public $db_replica;

    function __construct()
    {
        parent::__construct();
        $this->db_replica     = $this->load->database("replica", TRUE);
    }

    public function processDB($action, $post = array(), $filter = array(), $tablename = FALSE, $conn = "lbsmaster")
    {
        try {
            $conn  = $conn == "replica" ? $this->db_replica : $this->db;
            $table = ($tablename === FALSE) ? $this->_table : $tablename;

            switch ($action) {
                case 'add':
                    $query = $conn->insert($table, $post);
                    break;

                case 'edit':
                    $query = $conn->update($table, $post, $filter);
                    break;

                case 'delete':
                    $query = $conn->delete($table, $filter);
                    break;
            }

            // die($conn->last_query());

            if ($query === FALSE)
                throw new Exception();

            return array("success" => TRUE, "result" => "{$action} succeded");
        } catch (Exception $e) {
            return array("success" => FALSE, "result" => $e->getMessage());
        }
    }

    public function tStart()
    {
        $this->db->trans_start();
    }

    public function tCommit()
    {
        $this->db->trans_commit();
    }

    public function tRollback()
    {
        $this->db->trans_rollback();
    }
}
