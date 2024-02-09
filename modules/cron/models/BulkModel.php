
<?php defined('BASEPATH') or exit('No direct script access allowed');

class BulkModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_menu';
    }
}
