<?php defined('BASEPATH') or exit('No direct script access allowed');

abstract class MY_Template extends MX_Controller
{

    protected $_css;
    protected $_js;

    public function __construct()
    {
        parent::__construct();
        $this->template->set_partial('sidebar', 'adminlte/sidebar');
        $this->template->set_partial('content-header', 'adminlte/content-header');
    }

    public function assetsBuild($asset = [])
    {
        foreach ($asset as $assets) {
            foreach ($this->config->item('ex_layouts_' . $assets) as $key => $value) {
                switch ($key) {
                    case 'css':
                        foreach ($value as $data) {
                            $this->_css[] = $data;
                        }
                        break;
                    case 'js':
                        foreach ($value as $data) {
                            $this->_js[] = $data;
                        }
                        break;
                }
            }
        }
        $this->assetsRequest();
    }


    public function assetsRequest()
    {
        $this->template->set('pageCSS', $this->_css);
        $this->template->set('pageJS', $this->_js);
    }


    public function show_error($heading, $message, $template = 'error_general')
    {
        $templates_path = config_item('error_views_path');
        if (empty($templates_path)) {
            $templates_path = VIEWPATH . 'errors' . DIRECTORY_SEPARATOR;
        }

        if (is_cli()) {
            $message = "\t" . (is_array($message) ? implode("\n\t", $message) : $message);
            $template = 'cli' . DIRECTORY_SEPARATOR . $template;
        } else {
            $message = '<p>' . (is_array($message) ? implode('</p><p>', $message) : $message) . '</p>';
            $template = 'html' . DIRECTORY_SEPARATOR . $template;
        }

        ob_start();
        include($templates_path . $template . '.php');
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }


    public function getAksesUser($user = null)
    {
        $menuFile = strtolower(get_class($this));

        $sql = $this->db->query("SELECT
                                     t0.DID
                                    ,t1.*
                                 FROM ms_menu t0
                                 LEFT JOIN ms_acl_group t1 ON t1.MenuID = t0.DID
                                 LEFT JOIN ms_acl_user_group t2 ON t2.ACLGroup = t1.ACLGroup
                                 WHERE
                                     t0.MenuFile = '$menuFile'
                                 AND t2.Email = '$user'
                               ");
        if ($sql->num_rows() < 1) {
            echo $this->show_error($heading = '', $message = BASE_URL, 'error_akses');
            exit(4); // EXIT_UNKNOWN_FILE
        }
        if ($sql->row()->MView < 1) {
            echo $this->show_error($heading = '', $message = BASE_URL, 'error_akses');
            exit(4); // EXIT_UNKNOWN_FILE
        }

        return $sql->row();
    }
}
