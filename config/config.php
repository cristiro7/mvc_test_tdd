<?php

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Base URL
 * This is the base url of our app. if you go live with your app, put your full domain name here.
 */
define ('BASE_PATH','http://localhost/mvc/mvc_test_tdd/');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, type etc.
 */
define ('DB_HOST',  'localhost');
define ('DB_NAME',  'mvc_test_tdd');
define ('DB_USER',  'root');
define ('DB_PASS',  '');

/**
 * Configuration for: Folders
 * Here you define where your folders are. Unless you have renamed them, there's no need to change this.
 */
define ('LIBRARY_PATH',     'library/');
define ('CONTROLLERS_PATH', 'controllers/');
define ('MODELS_PATH',      'models/');
define ('VIEWS_PATH',       'views/');
