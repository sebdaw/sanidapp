<?php
require_once 'constants.php';
require_once 'Autoload.php';
Autoload::init();

$ctrl = new PermissionController();
ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);
// var_dump($ctrl->getSectionPermissions(1,1));

var_dump(PasswordHasher::hash(''));

?>