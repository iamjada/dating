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

// home page
$f3->route('GET /', function(){

    // Display the home page
    $view = new Template(); // instantiate view object
    echo $view->render('views/home.html'); // using view object to display the view page

});

//personal-info.html
$f3->route('GET|POST /profile', function ($f3) {

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
       if (validAge($_POST['age'])) {
           $_SESSION['age'] = $_POST['age'];
       }
       else {
           $f3->set('errors["age"]', 'Age must be numeric and between 18 and 118');
       }

       // validate phone number
        /*
       if (validPhone($_POST['phone'])) {
           $_SESSION['phone'] = $userPhone;
       }
       else {
           $f3->set('errors["phone"]', 'Please enter a valid phone number');
       }
        */
        $_SESSION['fName'] = $_POST['fName'];
        $_SESSION['lName'] = $_POST['lName'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];


        // no errors
        if (empty($f3->get('errors'))) {
            header('location: profile2');
        }
    }

    //Get the data from the model
    $f3->set('genders', getGender());

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
$f3->route('GET|POST /profile2', function ($f3){
    /* If the form has been submitted, add the data to session
    * and send the user to the next order form
    */

    //Initialize variables to store user input
    $userEmail = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //if email is valid store data
        if (validEmail($userEmail)) {
            $_SESSION['email'] = $userEmail;
        }
        //set an error if not valid
        else {
            $f3->set('errors["email"]', 'Please enter a valid email');
        }

        //var_dump($_POST);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];
    }

    // if no errors
    if (empty($f3->get('errors'))) {
        header('location: profile3');
    }

    //store the user input to the hive
    $f3->set('userEmail', $userEmail);

    // Display the Profile page
    $view = new Template();
    echo $view->render('views/profile.html');

});

// interest.html page
$f3->route('GET|POST /profile3', function ($f3) {

    //Initialize variables for user input
    $userIndoorChoices = array();
    $userOutdoorChoices = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['indoor'])) {

            //get user input
            $userIndoorChoices = $_POST['indoor'];

            //if indoor interests are valid
            if (validIndoor($userIndoorChoices)) {
                $_SESSION['indoor'] = implode(", ", $userIndoorChoices);
            }
            else {
                $f3->set('errors["indoor"]', 'Invalid selection');
            }
        }

        if (!empty($_POST['outdoor'])) {
            //get user input
            $userOutdoorChoices = $_POST['outdoor'];

            //if indoor interests are valid
            if (validOutdoor($userOutdoorChoices)) {
                $_SESSION['outdoor'] = implode(", ", $userOutdoorChoices);
            }
            else {
                $f3->set('errors["outdoor"]', 'Invalid selection');
            }
        }

        if (empty($f3->get('errors'))) {
            header('location: summary');
        }
    }

    //Get the data from the model
    $f3->set('indoorints', getIndoor());
    $f3->set('outdoorints', getOutdoor());

    //Store the user input in the hive
    $f3->set('userIndoorChoices', $userIndoorChoices);
    $f3->set('userOutdoorChoices', $userOutdoorChoices);

    /* If the form has been submitted, add the data to session
    * and send the user to the next order form

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['profile2'] = implode(", ", $_POST['profile3  ']);

        header('location: summary');
    }
    */

    // Display the interest page
    $view = new Template();
    echo $view->render('views/interest.html');
});

// summary.html
$f3->route('GET /summary', function () {
    // Display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

// run fat-free
$f3->run();