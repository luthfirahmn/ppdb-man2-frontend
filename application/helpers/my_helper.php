<?php
if (!function_exists("pre")) {
    function pre($param = array())
    {
        echo "<PRE>";
        print_r($param);
        exit;
    }
}
if (!function_exists("slugify")) {
    function slugify($string)
    {
        $preps = array('in', 'at', 'on', 'by', 'into', 'off', 'onto', 'from', 'to', 'with', 'a', 'an', 'the', 'using', 'for');
        $pattern = '/\b(?:' . join('|', $preps) . ')\b/i';
        $string = preg_replace($pattern, '', $string);
        $string = preg_replace('~[^\\pL\d]+~u', '-', $string);
        $string = trim($string, '-');
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        $string = strtolower($string);
        $string = preg_replace('~[^-\w]+~', '', $string);

        return $string;
    }
}

if (!function_exists("instance")) {
    function instance()
    {
        $ci = &get_instance();

        return $ci;
    }
}


if (!function_exists('get_auth_lib')) {
    function get_auth_lib()
    {
        $ci = &get_instance();
        $ci->load->library('auth');
        return $ci->auth;
    }
}

if (!function_exists('get_menu_module')) {
    function get_menu_module($userid = NULL)
    {
        $modules = array();
        $modules = get_auth_lib()->get_all_module($userid);

        return $modules;
    }
}

if (!function_exists('get_menu')) {
    function get_menu($userid = NULL)
    {
        $allowed_menu = get_auth_lib()->get_menu($userid);
        return $allowed_menu;
    }
}

if (!function_exists("is_logged_in")) {
    function is_logged_in()
    {
        if (instance()->session->userdata('logged_in') === TRUE) {
            redirect('dashboard');
        } else {
            redirect('login');
        }
    }
}

if (!function_exists('Buttons')) {
    function Buttons($buttons = null, $func = null)
    {
        switch ($buttons) {
            case "delete":
                $button = '<button onclick="' . $func . '" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                break;
            case "edit":
                $button = '<button onclick="' . $func . '" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></button>';
                break;
            case "actived":
                $button = '<button onclick="' . $func . '" class="btn btn-warning btn-sm" style="width: 36px; height:30px; "><i class="fas fa-eye"></i></button>';
                break;
            case "disabled":
                $button = '<button onclick="' . $func . '" class="btn btn-warning btn-sm" style="width: 36px; height:30px;"><i class="fas fa-eye-slash"></i></button>';
                break;
            case "check":
                $button = '<button onclick="' . $func . '" class="btn btn-danger btn-sm " style="width: 36px; height:30px;"><i class="fa fa-times"></i></button>';
                break;
            case "checked":
                $button = '<button onclick="' . $func . '" class="btn btn-success btn-sm checked" style="width: 36px; height:30px;"><i class="fa fa-check"></i></button>';
                break;
            case "unchecked":
                $button = '<button onclick="' . $func . '" class="btn btn-danger btn-sm unchecked" style="width: 36px; height:30px;"><i class="fa fa-times"></i></button>';
                break;
            case "used":
                $button = '<button class="btn btn-secondary btn-sm " style="width: 80px; height:30px;" disabled>Used</button>';
                break;
            case "notused":
                $button = '<button onclick="' . $func . '" class="btn btn-danger btn-sm" style="width: 80px; height:30px;">Not Used</button>';
                break;
            case "notsendStatus":
                $button = '<button onclick="' . $func . '" class="btn btn-danger btn-sm " style="width: 36px; height:30px;"><i class="fa fa-times"></i></button>';
                break;
            case "sendStatus":
                $button = '<button onclick="' . $func . '" class="btn btn-success btn-sm" style="width: 36px; height:30px;"><i class="fa fa-check"></i></button>';
                break;
            case "header":
                $button = '<button onclick="' . $func . '" class="btn btn-success btn-sm" style="width: 65px; height:30px;">Header</button>';
                break;
            case "footer":
                $button = '<button onclick="' . $func . '" class="btn btn-danger btn-sm" style="width: 65px; height:30px;">Footer</button>';
                break;
            default:
                $button = '<button onclick="' . $func . '" class="btn btn-info btn-sm"><i class="fas fa-list"></i></button>';
        }
        return $button;

        //   $row[] = $val->Active == 1 ? Buttons("disabled", "myActive($val->DID,1)"):Buttons("actived", "myActive($val->DID,0)");
        //   $row[] = Buttons("delete", "myActive($val->DID,1)").Buttons("edit", "myActive($val->DID,1)");

    }
}

if (!function_exists('categoryTree')) {
    function categoryTree($ParentCategoryID = 0, $sub_mark = '')
    {
        $query = instance()->db->query("SELECT * FROM ms_category WHERE ParentCategoryID = '{$ParentCategoryID}' ORDER BY Category ASC");
        $result = $query->result_array();
        // $a = [];
        if ($result) {
            foreach ($result as $row) {
                echo  '<option value="' . $row['DID'] . '">' . $sub_mark . $row['Category'] . '</option>';
                categoryTree($row['DID'], $sub_mark . '&nbsp;&nbsp;&nbsp;');
            }
            // return $a;
        }
    }
}

if (!function_exists('get_random_string')) {
    function get_random_string($valid_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", $length = 2)
    {
        // start with an empty random string
        $random_string = "";

        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);

        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++) {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);

            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick - 1];

            // add the randomly-chosen char onto the end of our string so far
            $random_string .= $random_char;
        }

        // return our finished random string
        return $random_string;
    }
}
if (!function_exists("dateSekarang")) {
    function dateSekarang($act = 1, $param = FALSE, $convert_normal_date = FALSE)
    {
        if (!empty($param) and $convert_normal_date)
            $param = trim(str_replace(array("T", "Z"), " ", $param));

        if ($param == "0001-01-01 00:00:00")
            return "-";

        if ($act == 1) {
            return date("Y-m-d H:i:s");
        } else if ($act == 2) {
            return date("Y-m-d");
        } else if ($act == 3) {
            return date("d F Y H:i", strtotime($param));
        } else if ($act == 4) {
            return date("d F Y", strtotime($param));
        } else if ($act == 5) {
            return date("Y/m/d");
        } else if ($act == 6) {
            return date("d/m/Y H:i");
        } else if ($act == 7) {
            $paramex = explode("/", substr($param, 0, 10));
            $jam = substr($param, 11, 6);
            return "{$paramex[2]}-{$paramex[1]}-{$paramex[0]} {$jam}";
        } else if ($act == 8) {
            return date("d M Y");
        } else if ($act == 9) {
            return date("Ymd");
        } else if ($act == 10) {
            $paramex = explode("/", substr($param, 0, 10));
            return "{$paramex[2]}-{$paramex[1]}-{$paramex[0]}";
        } else if ($act == 11) {
            $paramex = explode("-", substr($param, 0, 10));
            return "{$paramex[2]}-{$paramex[1]}-{$paramex[0]}";
        } else if ($act == 12) {
            return date("d F Y H:i:s", strtotime($param));
        } else if ($act == 13) {
            return date("d F Y", strtotime($param));
        } else if ($act == 14) {
            return date("H:i", strtotime($param));
        } else if ($act == 15) {
            return date("d", strtotime($param));
        } else if ($act == 16) {
            return date("m", strtotime($param));
        } else if ($act == 17) {
            return date("Y", strtotime($param));
        } else if ($act == 18) {
            return date("Y-m-d H:i:s", strtotime($param));
        } else if ($act == 19) {
            return date("Y-m-d", strtotime($param));
        } else if ($act == 20) {
            return date("Y-m-d H:i", strtotime($param));
        } else if ($act == 21) {
            return date("d F Y H:i", strtotime($param));
        } else if ($act == 22) {
            return date("Y-m-d\TH:i:s\Z", strtotime($param));
        }
    }
}

if (!function_exists('resizeImage')) {
    function resizeImage($SrcImage, $DestImage, $MaxWidth, $MaxHeight, $Quality)
    {
        list($iWidth, $iHeight, $type)      = getimagesize($SrcImage);
        $ImageScale                         = min($MaxWidth / $iWidth, $MaxHeight / $iHeight);
        $NewWidth                           = ceil($ImageScale * $iWidth);
        $NewHeight                          = ceil($ImageScale * $iHeight);
        $NewCanves                          = imagecreatetruecolor($NewWidth, $NewHeight);

        switch (strtolower(image_type_to_mime_type($type))) {
            case 'image/jpeg':
                $NewImage = imagecreatefromjpeg($SrcImage);
                break;
            case 'image/png':
                $NewImage = imagecreatefrompng($SrcImage);
                break;
            case 'image/gif':
                $NewImage = imagecreatefromgif($SrcImage);
                break;
            case 'image/jpg':
                $NewImage = imagecreatefromgif($SrcImage);
                break;
            default:
                return false;
        }

        // Resize Image
        if (imagecopyresampled($NewCanves, $NewImage, 0, 0, 0, 0, $NewWidth, $NewHeight, $iWidth, $iHeight)) {
            // copy file
            if (imagejpeg($NewCanves, $DestImage, $Quality)) {
                imagedestroy($NewCanves);
                return true;
            }
        }
    }
    if (!function_exists('notify_message')) {
        function notify_message($success_msg = "", $error_message = "", $info_message = "")
        {
            $result = "";
            if ($success_msg)
                $result =  '<div class="alert alert-success">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Success!</strong> ' . $success_msg . '
						</div>';
            if ($error_message)
                $result =  '<div class="alert alert-danger">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Error!</strong> ' . $error_message . '
						</div>';
            if ($info_message)
                $result =  '<div class="alert alert-info">
						<button class="close" data-dismiss="alert">&times;</button>
						<strong>Info!</strong> ' . $info_message . '
						</div>';
            return $result;
        }
    }

    if (!function_exists('tr_log')) {
        function tr_log($logquery = null, $logpage = null, $rbu = null)
        {
            $data["LogQuery"]    = $logquery;
            $data["LogPage"]    = $logpage;
            $data["RBU"]         = $rbu;
            $data["RBT"]         = date("Y-m-d H:i:s");

            $result = get_auth_lib()->insert_log($data);

            return $result;
        }
    }
}

if (!function_exists('money_formatting')) {
    function money_formatting($moneyNumber, $matauang = 'Rp.')
    {
        $moneyFormatResult = $matauang . ' ' . number_format((int)$moneyNumber, 0, '.', ',');
        return $moneyFormatResult;
    }
}

if (!function_exists('number_formatting')) {
    function number_formatting($number)
    {
        $numberFormatResult = number_format($number, 2, '.', ',');
        return $numberFormatResult;
    }
}

if (!function_exists('modal')) {
    function modal_view($id = '', $modal_view = '')
    {
        $template =  '
        <div class="modal fade modal-large" id="' . $id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    ' . $modal_view . '
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
        ';

        return $template;
    }
}

if (!function_exists('slice_string')) {
    function slice_string($word, $count)
    {
        $w = substr($word, 0, $count);
        $res = $w . '...';

        return $res;
    }
}


if (!function_exists('wa_token')) {
    function wa_token()
    {
        $token = '7tzJ12yy4a5VMXs5MAdnEvoX8PCC1t8K9mMeDcLaqULMHe14kU';
        // $token = 'ZcHg5YWzsRkjocKu6TcVxcmd9uN8RUiN6928Q9wkVn8oBTEqLD';

        return $token;
    }
}

if (!function_exists('wa_post')) {
    function wa_post($url, $data)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POST => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $decode = json_decode($response);
        return $decode;
    }
}

if (!function_exists('random_digits')) {
    function random_digits()
    {
        $digits = 3;
        return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
    }
}