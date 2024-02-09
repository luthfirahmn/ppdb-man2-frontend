<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Auth
{
	/**
	 * Constructor
	 */
	function __construct()
	{
		//Load your settting here
		$this->ci = &get_instance();

		$this->ci->load->library('session');
		$this->db = $this->ci->db;
		$this->session = $this->ci->session;
	}

	// --------------------------------------------------------------------

	/**
	 * Check user signin status
	 *
	 * @access public
	 * @return bool
	 */
	function is_logged_in()
	{
		return $this->ci->session->userdata('user_id') ? true : false;
	}

	// --------------------------------------------------------------------

	/**
	 * Get User ID
	 *
	 * @access public
	 * @return string
	 */
	function get_user_id()
	{
		return $this->ci->session->userdata('user_id');
	}

	// --------------------------------------------------------------------

	/**
	 * Get User Email
	 *
	 * @access public
	 * @return string
	 */
	function get_email()
	{
		return $this->ci->session->userdata('user_email');
	}

	// --------------------------------------------------------------------

	/**
	 * Get User First Name
	 *
	 * @access public
	 * @return string
	 */
	function get_fname()
	{
		return $this->ci->session->userdata('user_fname');
	}

	// --------------------------------------------------------------------

	/**
	 * Get User First Name
	 *
	 * @access public
	 * @return string
	 */
	function get_lname()
	{
		return $this->ci->session->userdata('user_lname');
	}

	// --------------------------------------------------------------------


	/**
	 * Sign user out
	 *
	 * @access public
	 * @return void
	 */
	function logout()
	{

		$this->ci->session->set_userdata(['user_id' => '', 'username' => '', 'email' => '']);

		$this->ci->session->sess_destroy();

		return true;
	}

	// --------------------------------------------------------------------

	/**
	 * Check password validity
	 *
	 * @access public
	 *
	 * @param object $account
	 * @param string $password
	 *
	 * @return bool
	 */
	function validate_password($password, $password_hash)
	{
		$this->ci->load->helper('passwordhash');

		return validate_password($password, $password_hash) ? true : false;
	}


	function set_visitor_session($params)
	{

		$this->ci->session->set_userdata(['user_id' => $params['user_id'], 'username' => $params['name'], 'email' => $params['email'], 'last_login' => $params['last_login']]);

		return true;
	}
	// --------------------------------------------------------------------

	public function check_session()
	{

		if (!$this->is_logged_in()) {
			redirect('login');
		}
	}

	function get_menu($email = null)
	{
		// pre($aclgroup);

		// $this->db->distinct();
		$this->db->select("t0.DID
						  ,t0.ParentID, 
						  ,t0.Menu,
                          ,t0.Icon, 
                          ,t0.MenuFile AS url 
        				");
		$this->db->from("ms_menu t0");
		$this->db->join("ms_acl_group t1", "t1.MenuID = t0.DID");
		$this->db->join("ms_acl_user_group t2", "t2.ACLGroup = t1.ACLGroup");
		$this->db->where("t2.Email", $email);
		$this->db->where("t0.Active", 1);
		$this->db->order_by("t0.OrderNo", "asc");
		$parent_menu = $this->db->get()->result_array();
		// pre($parent_menu);
		$menuData = array(
			'items' => array(),
			'parents' => array()
		);

		foreach ($parent_menu as $menuItem) {
			$menuData['items'][$menuItem['DID']] = $menuItem;
			$menuData['parents'][$menuItem['ParentID']][] = $menuItem['DID'];
		}

		return $this->buildMenu(0, $menuData);
	}

	function buildMenu($ParentID, $menuData)
	{
		$html = '';

		if (isset($menuData['parents'][$ParentID])) {
			$result2 = $this->db->query("SELECT *,(SELECT tx.ParentID 
											   FROM ms_menu tx 
											   WHERE tx.DID = t0.ParentID ORDER BY OrderNo) 'ppp'
                        			 FROM ms_menu t0 
									 WHERE t0.ParentID = $ParentID 
									 ORDER BY OrderNo");
			foreach ($result2->result_array() as $row) {
				$idp = $row['ParentID'];
			}

			if ($idp == 0) {
				$html = "";
			} else {
				$html = "<ul class ='nav nav-treeview'>\n";
			}

			$CI 	 = &get_instance();
			$urlOpen = $CI->uri->segment(1);

			foreach ($menuData['parents'][$ParentID] as $itemId) {

				$result = $this->db->query("SELECT * FROM ms_menu WHERE ParentID = '$itemId' ");
				$open   = $this->db->query("SELECT t0.DID,t0.ParentID,
													(SELECT ParentID 
														FROM ms_menu 
														WHERE DID = t0.ParentID) AS Lvl3
											FROM ms_menu t0 WHERE t0.MenuFile = '$urlOpen' LIMIT 1");

				if ($result->num_rows() > (int)0 && $ParentID != 0) {
					$submangle  = ' <i class="right fas fa-angle-left"></i>';
				} else {
					$submangle  = '';
				}

				$getOpen 	= "";
				$getOpenLv3 = "";
				$getActive 	= "";
				if ($open->num_rows() > 0 && !empty($urlOpen)) {
					$getOpen 	= $open->row()->ParentID == $menuData['items'][$itemId]['DID'] ? "menu-is-opening menu-open" : "";
					$getActive  = $open->row()->DID == $menuData['items'][$itemId]['DID'] ? "active" : "";
					$getOpenLv3 = $open->row()->Lvl3 == $menuData['items'][$itemId]['DID'] ? "menu-is-opening menu-open" : "";
				}

				$angle = $ParentID == 0 ? ' <i class="right fas fa-angle-left"></i>' : '';

				$html .= "<li class='nav-item {$getOpen} {$getOpenLv3}'>" . "<a class='nav-link {$getActive}' href=\"" . base_url() . "{$menuData['items'][$itemId]['url']}\" title=\"{$menuData['items'][$itemId]['Menu']}\"><i class=\"{$menuData['items'][$itemId]['Icon']}\" style='font-size: 13px;'></i><p>{$menuData['items'][$itemId]['Menu']} {$angle}{$submangle}</p></a>";

				// find childitems recursively
				$html .= $this->buildMenu($itemId, $menuData);
				$html .= '</li>';
			}

			$html .= '</ul>';
		}

		return $html;
	}
}

/* End of file auth.php */
/* Location: ./application/libraries/auth.php */