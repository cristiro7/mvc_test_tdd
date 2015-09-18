<?php
/**
 * Application Calculate The Salary For Employee Weekly
 *
 * @author Nguyen Dinh Thuan
 * @link http://localhost/salary
 */

// Defines
define ('DS', DIRECTORY_SEPARATOR);
define ('HOME', dirname(__FILE__));

// Load application config (error reporting, database credentials.)
require_once HOME . DS . 'config' . DS . 'config.php';

// The auto-loader to load the php-login related internal stuff automatically
require_once HOME . DS . 'config' . DS . 'autoload.php';


// Start our application
$boostrap = new Application();
