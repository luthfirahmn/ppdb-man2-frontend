<?php
if (!function_exists('get_auth_lib')) {
    function get_auth_lib()
    {
        $ci = &get_instance();
        $ci->load->library('Auth');
        return $ci->auth;
    }
}

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        $check = get_auth_lib()->is_logged_in();
        return $check;
    }
}

if (!function_exists('set_visitor_session')) {
    function set_visitor_session($params)
    {
        $set = get_auth_lib()->set_visitor_session($params);
        return $set;
    }
}

if (!function_exists('logout')) {
    function logout()
    {
        $set = get_auth_lib()->logout();
        return $set;
    }
}

if (!function_exists('check_session')) {
    function check_session()
    {
        $set = get_auth_lib()->check_session();
        return $set;
    }
}

if (!function_exists('check_password')) {
    function check_password($password, $password_hash)
    {
        $check = get_auth_lib()->validate_password($password, $password_hash);
        return $check;
    }
}

// if(!function_exists('check_password'))
// {
// 	function check_password($password, $password_hash)
// 	{
// 		$check = get_auth_lib()->validate_password($password, $password_hash);
// 		return $check;
// 	}
// }

// if(!function_exists('get_visitor_profile'))
// {
// 	function get_visitor_profile($visitor_id)
// 	{
// 		$check = get_auth_lib()->get_visitor_profile($visitor_id);
// 		return $check;
// 	}
// }

// if(!function_exists('get_menu_module'))
// {
// 	function get_menu_module($userid = NULL){
// 		$modules = array();
// 		$modules = get_auth_lib()->get_all_module($userid);
// 		return $modules;
// 	}
// }

// if(!function_exists('is_allowed'))
// {
// 	function is_allowed($userid = NULL,$module = NULL,$function = NULL){
// 		$allowed = get_auth_lib()->is_allowed($userid, $module, $function);
// 		return $allowed;
// 	}
// }
