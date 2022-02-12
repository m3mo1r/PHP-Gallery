<?php ob_start(); ?>
<?php
defined('DS')            ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT')     ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . 'gallery');
defined('ADMIN_PATH')    ? null : define('ADMIN_PATH', SITE_ROOT . DS . 'admin');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', ADMIN_PATH . DS . 'includes');

require_once(INCLUDES_PATH . DS . "config.php");
require_once(INCLUDES_PATH . DS . "functions.php");
require_once(INCLUDES_PATH . DS . "db.php");
require_once(INCLUDES_PATH . DS . "db_object.php");
require_once(INCLUDES_PATH . DS . "user.php");
require_once(INCLUDES_PATH . DS . "photo.php");
require_once(INCLUDES_PATH . DS . "comment.php");
require_once(INCLUDES_PATH . DS . "pagination.php");
require_once(INCLUDES_PATH . DS . "session.php");
?>