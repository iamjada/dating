<?php
/**
 * Jada Senebouttarath
 * https://github.com/iamjada/dating
 */
// This is my controller for the dating project

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once('vendor/autoload.php');
//require_once('model/Validation.php');
//require_once('model/DataLayer.php');

//Start a session
session_start();

// instantiate fat-free
$f3 = Base::instance();
$con = new Controller($f3);
//$dataLayer = new DataLayer();

//Define default route (home page)
$f3->route('GET|POST /', function(){

    $GLOBALS['con']->home();
});

// profile1
$f3->route('GET|POST /profile1', function(){

    $GLOBALS['con']->profile1();
});

//personal-info
$f3->route('GET|POST /profile2', function(){

    $GLOBALS['con']->profile2();
});

//interest page
$f3->route('GET|POST /profile3', function(){

    $GLOBALS['con']->profile3();
});

//summary
$f3->route('GET|POST /summary', function(){

    $GLOBALS['con']->summary();
});

// run fat-free
$f3->run();