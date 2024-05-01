<?php defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    // a
    public function check_login($email = '', $password = '')
    {
        $query =  $this->db->query("SELECT 
                                         l.Email
                                         ,l.Password
                                         ,e.ACLGroup
                                    FROM ms_login l
                                    LEFT JOIN ms_employee e ON e.Email = l.Email
                                    WHERE Email = '{$email}'
                                    AND Password = '{$password}'
                                    AND l.Active = 1
                                    ");

        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}
