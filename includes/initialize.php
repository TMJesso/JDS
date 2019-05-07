<?php
$errors = array();
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER["DOCUMENT_ROOT"] . DS . 'JCS');
defined('SITE_HTTP') ? null : define('SITE_HTTP', DS . 'JCS' . DS);

defined('LIB_PATH')         ? null : define('LIB_PATH', SITE_ROOT . DS . 'includes' . DS);
defined('PUBLIC_PATH')      ? null : define('PUBLIC_PATH', SITE_HTTP . 'public' . DS);
defined('ADMIN_PATH')       ? null : define('ADMIN_PATH', PUBLIC_PATH . 'admin' . DS);
defined('CSS_PATH')         ? null : define('CSS_PATH', PUBLIC_PATH . 'csscode' . DS);
defined('JS_PATH')          ? null : define('JS_PATH', PUBLIC_PATH . 'jscode' . DS);
defined('MEDIA')            ? null : define('MEDIA', PUBLIC_PATH . DS . 'media' . DS);
defined('LAYOUT')           ? null : define('LAYOUT', SITE_ROOT . DS . 'includes' . DS . 'layouts' . DS);
defined('PUBLIC_TRACKER')   ? null : define('PUBLIC_TRACKER', PUBLIC_PATH . 'tracker' . DS . 'public' . DS);
defined('TRACKER')          ? null : define('TRACKER', PUBLIC_TRACKER . 'admin' . DS);
defined('PUBLIC_RESUME')    ? null : define('PUBLIC_RESUME', PUBLIC_PATH . 'resume' . DS . 'public' . DS);
defined('RESUME')           ? null : define('RESUME', PUBLIC_RESUME . 'admin' . DS);
defined('PUBLIC_TROLLY')    ? null : define('PUBLIC_TROLLY', PUBLIC_PATH . 'trolly' . DS . 'public' . DS);
defined('TROLLY')           ? null : define('TROLLY', PUBLIC_TROLLY . 'admin' . DS);
// defined('PUBLIC_VMAS')      ? null : define('PUBLIC_VMAS', SITE_HTTP . DS . 'vmas' . DS . 'public' . DS);
// defined('VMAS')             ? null : define('VMAS', PUBLIC_VMAS . 'admin' . DS);
// defined('PUBLIC_CLAD')      ? null : define('PUBLIC_CLAD', SITE_HTTP . DS . 'clad' . DS . 'public' . DS);
// defined('CLAD')             ? null : define('CLAD', PUBLIC_CLAD . 'admin' . DS);

require_once LIB_PATH . 'connect.php';
require_once LIB_PATH . 'methods.php';
require_once LIB_PATH . 'common.php';
require_once LIB_PATH . 'database.php';
require_once LIB_PATH . 'menu_type.php';
require_once LIB_PATH . 'menu.php';
require_once LIB_PATH . 'menu_tier1.php';
require_once LIB_PATH . 'menu_tier2.php';
require_once LIB_PATH . 'user.php';
require_once LIB_PATH . 'user_details.php';
require_once LIB_PATH . 'yek_tracker.php';
require_once LIB_PATH . 'tracker_login.php';
require_once LIB_PATH . 'summary.php';
require_once LIB_PATH . 'station.php';
require_once LIB_PATH . 'stops.php';
// require_once LIB_PATH . 'log.php';
require_once LIB_PATH . 'session.php';

?>
