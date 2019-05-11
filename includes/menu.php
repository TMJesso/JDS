<?php

class Menu extends Common
{

	protected static $table_name = 'menu';

	protected static $db_fields = array(
		'id',
		'm_id',
		'type_id',
		'name',
		'm_path',
		'm_url',
		'm_order',
		'visible',
		'security',
		'clearance'
	);

	public $id;

	public $m_id;

	public $type_id;

	public $name;

	public $m_path;

	public $m_url;

	public $m_order;

	public $visible;

	public $security;

	public $clearance;

	/**
	 * find a single menu by its id
	 *
	 * @param string $id
	 * @return object|boolean
	 */
	public static function get_menu_by_m_id($id = '')
	{
		if (self::validate_string($id)) {
			$sql = "SELECT * FROM " . self::$table_name . " ";
			$sql .= "WHERE m_id = '{$id}' ";
			$sql .= "LIMIT 1";
			$result = self::find_by_sql($sql);
			return self::confirm_single_result($result);
		} else {
			return false;
		}
	}

	/**
	 * get all visible menus by security and clearance<br>
	 * where sec >= security
	 * and clr >= clearance<br>
	 *
	 * if the security is set at 0 it will show all visible menu<br>
	 * option for security where sec >= security
	 *
	 * @var int $sec - security
	 * @var int $clr - clearance
	 *     
	 *     
	 */
	public static function get_all_visible_menus($sec, $clr)
	{
		$sql = "SELECT * FROM " . self::$table_name . " ";
		$sql .= "WHERE visible AND {$sec} >= security ";
		$sql .= "AND clearance <= {$clr} ";
		$sql .= "ORDER BY m_order";
		$results = self::find_by_sql($sql);
		return self::confirm_all_results($results);
	}

	public static function get_all_menus_by_type_id($id = '')
	{
		if (empty($id)) {
			return false;
		}
		$sql = "SELECT * FROM " . self::$table_name . " ";
		$sql .= "WHERE type_id = '{$id}' ";
		$sql .= "ORDER BY m_order";
		return self::find_by_sql($sql);
	}

	public static function get_menu_by_find_text($ftext = '')
	{
		if (empty($ftext)) {
			return false;
		}
		$sql = "SELECT * FROM " . self::$table_name . " ";
		$sql .= "WHERE find_text = '{$ftext}' ";
		$sql .= "LIMIT 1";
		$result = self::find_by_sql($sql);
		return ($result) ? array_shift($result) : false;
	}

	public static function find_page_for_breadcrumbs($path, $file)
	{
		global $session;
		$sql = "SELECT * FROM " . self::$table_name . " ";
		$sql .= "WHERE m_path = '{$path}' ";
		$sql .= "AND m_url = '{$file}' ";
		$sql .= "AND visible AND security <= " . $session->get_security() . " ";
		$sql .= "AND clearance <= " . $session->get_clearance() . " ";
		$sql .= "LIMIT 1";
		$results = self::find_by_sql($sql);
		if ($results) {
			$row = array_shift($results);
		} else {
			$row = false;
		}
		return $row;
	}

	public static function generate_table_and_data()
	{
		$obj = new self();
		if ($obj->create_table()) {
			$obj->load_data();
			return "Menu table was created and populated";
		}
	}

	private function create_table()
	{
		global $base;
		$sql = "CREATE TABLE IF NOT EXISTS menu ( ";
		$sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
		$sql .= "m_id varbinary(12) NOT NULL, ";
		$sql .= "type_id varbinary(12) NOT NULL, ";
		$sql .= "name varchar(35) NOT NULL, ";
		$sql .= "m_path varchar(75) NULL DEFAULT NULL";
		$sql .= "m_url varchar(25)NULL DEFAULT NULL, ";
		$sql .= "m_order int(2) NOT NULL DEFAULT '0', ";
		$sql .= "visible tinyint(1) NOT NULL DEFAULT '0', ";
		$sql .= "security int(1) NOT NULL DEFAULT '9', ";
		$sql .= "clearance int(1) NOT NULL DEFAULT '9', ";
		$sql .= "PRIMARY KEY (m_id), ";
		$sql .= "UNIQUE KEY id (id), ";
		$sql .= "KEY m_order (m_order), ";
		$sql .= "KEY type_id (type_id), ";
		$sql .= "KEY name (name), ";
		$sql .= "UNIQUE KEY file (m_path, m_url ";
		$sql .= "FOREIGN KEY (type_id) REFERENCES menu_type (type_id) ";
		$sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
		return $base->query($sql);
	}

	private function load_data()
	{
		global $base;
		$sql = "INSERT IGNORE INTO menu (id, m_id, type_id, name, m_url, m_order, visible, security, clearance) VALUES ";
		$sql .= "(9, 0x32336a6c6c346c6b66717530, 0x373430675842353649354a56, 'Home', 'index.php', 0, 1, 9, 9), ";
		$sql .= "(15, 0x34323938766d30397667656d, 0x373430675842353649354a56, 'System', 'system.php', 6, 1, 0, 0), ";
		$sql .= "(35, 0x375a47353272596a314a6234, 0x373430675842353649354a56, 'CLAD', '/JCS/clad/public/admin/index.php', 3, 1, 0, 0), ";
		$sql .= "(16, 0x4f3077367462794632456735, 0x373430675842353649354a56, 'Logout', '/JCS/public/logout.php', 7, 1, 9, 9), ";
		$sql .= "(31, 0x4f4630556332694a34366735, 0x373430675842353649354a56, 'Tracker', '/JCS/tracker/public/admin/index.php', 1, 1, 0, 0), ";
		$sql .= "(36, 0x5333367138515457576d6b49, 0x373430675842353649354a56, 'Logout', '/JCS/public/admin/logout.php', 7, 1, 0, 0), ";
		$sql .= "(32, 0x54676a43634e416430583436, 0x373430675842353649354a56, 'VMAS', '/JCS/vmas/public/admin/index.php', 2, 1, 0, 0), ";
		$sql .= "(33, 0x5848744d3254513056326967, 0x373430675842353649354a56, 'Home', '/JCS/public/admin/index.php', 0, 1, 0, 0), ";
		$sql .= "(14, 0x633239386866723338683872, 0x373430675842353649354a56, 'Utilities', 'utilities.php', 5, 1, 0, 0), ";
		$sql .= "(30, 0x67327567653376334937655a, 0x624d397977544f3341387035, 'Tracker Login', 'tracker_login.php', 1, 1, 9, 0), ";
		$sql .= "(11, 0x676339323068677634323078, 0x373430675842353649354a56, 'VMAS', '/JCS/vmas/public/index.php', 2, 1, 9, 0), ";
		$sql .= "(34, 0x696446326141305672325039, 0x373430675842353649354a56, 'R&eacute;sum&eacute;', '/JCS/resume/public/admin/index.php', 4, 1, 0, 0), ";
		$sql .= "(10, 0x756d79343371307666727133, 0x373430675842353649354a56, 'Tracker', '/JCS/tracker/public/index.php', 1, 1, 9, 0), ";
		$sql .= "(12, 0x76746a33706d713833766e39, 0x373430675842353649354a56, 'CLAD', '/JCS/clad/public/index.php', 3, 1, 9, 0), ";
		$sql .= "(13, 0x793576303433303932756330, 0x373430675842353649354a56, 'R&eacute;sum&eacute;', '/JCS/resume/public/index.php', 4, 1, 9, 0)";
		$base->query($sql);
	}
}

?>
