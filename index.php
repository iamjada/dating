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
require_once('model/validation.php');
require_once('model/data-layer.php');

//Start a session
session_start();

// instantiate fat-free
$f3 = Base::instance();
//$con = new Controller($f3);

/*
//Define default route
$f3->route('GET /', function(){

    $GLOBALS['con']->home();
});
*/

$f3->route('GET /', function(){

    // Display the home page
    $view = new Template(); // instantiate view object
    echo $view->render('views/home.html'); // using view object to display the view page

});

// define personal-info page route
$f3->route('GET /personal', function(){
    // Display the Personal info page
    $view = new Template();
    echo $view->render('views/personal-info.html');

});

//personal info
$f3->route('GET|POST /personal', function ($f3) {

    //Reinitialize a session array
    $_SESSION = array();

    //Initialize variables to store user input
    $userFName = "";
    $userLName ="";
    $userAge = "";
    $userPhone = "";
    $userGender ="";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        // validate first name
        if (validFName($_POST['fName'])) {
            $_SESSION['fName'] = $userFName;
        } //Otherwise, set an error variable in the hive
        else {
            $f3->set('errors["fName"]', 'Please enter a first name');
        }
        // validate last name
        if (validLName($_POST['lName'])) {
            $_SESSION['lName'] = $_POST['lName'];
        } //Otherwise, set an error variable in the hive
        else {
            $f3->set('errors["lName"]', 'Please enter a last name');
        }

        // validate age and store data
        if (validAge($userAge)) {
            $_SESSION['age'] = $userAge;
        }
        else {
            $f3->set('errors["age"]', 'Age must be numeric and between 18 and 118');
        }

        // validate phone number
        if (validPhone($userPhone)) {
            $_SESSION['phoneNum'] = $userPhone;
        }
        else {
            $f3->set('errors["phoneNum"]', 'Please enter a valid phone number');
        }

        $_SESSION['fName'] = $_POST['fName'];
        $_SESSION['lName'] = $_POST['lName'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phoneNum'] = $_POST['phoneNum'];

        // no errors
        if (empty($f3->get('errors'))) {
            header('location: profile');
        }
    }

    //store the user input to the hive
    $f3->set('userFName', $userFName);
    $f3->set('userLName', $userLName);
    $f3->set('userAge', $userAge);
    $f3->set('userPhone', $userPhone);
    $f3->set('userGender', $userGender);

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
$f3->route('GET|POST /interest', function () {

    /* If the form has been submitted, add the data to session
    * and send the user to the next order form
    */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['interest'] = implode(", ", $_POST['interest']);

        header('location: summary');
    }

    // Display the interest page
    $view = new Template();
    echo $view->render('views/interest.html');
});

// summary
$f3->route('GET /summary', function () {
    // Display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

// run fat-free
$f3->run();