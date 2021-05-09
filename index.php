<?php
/**
 * Jada Senebouttarath
 * https://github.com/iamjada/dating
 */
// This is my controller for the dating project

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

// Require autoload file
require_once('vendor/autoload.php');

// instantiate fat-free
$f3 = Base::instance();

// define default route
$f3->route('GET /', function(){

    // Display the home page
    $view = new Template(); // instantiate view object
    echo $view->render('views/home.html'); // using view object to display the view page

});

// personal info
$f3->route('GET|POST /personal', function () {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['fName'] = $_POST['fName'];
        $_SESSION['lName'] = $_POST['lName'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];
        header('location: profile.html');
    }

    // Display the Personal info page
    $view = new Template();
    echo $view->render('views/personal-info.html');
});

// profile.html page
$f3->route('GET|POST /profile', function () {
    /* If the form has been submitted, add the data to session
    * and send the user to the next order form
    */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];
        header('location: interest');
    }

    // Display the Profile page
    $view = new Template();
    echo $view->render('views/profile.html');
});

// interest page
$f3->route('GET /summary', function () {
    // Display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});



// run fat-free
$f3->run();