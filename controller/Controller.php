<!-- 328/dating/classes/Controller.php -->

<?php

// this class will define a method for each of the routes
class Controller
{
    // fields
    private $_f3; //router

    // constructor
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    //Display the home page
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    //Display the personal-info.html page
    function profile1()
    {
        $_SESSION = array();
        // premium membership
        if (isset($_POST['premium'])) {
            $user = new PremiumMember('Joe','Schmo',20, 'Male','111-111-1111');
        } else {
            $user = new Member('Kevin','Schmo',20, 'Male','111-111-1111');
        }

        //If the form has been submitted, add the data to session
        //and send the user to the next order form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);
            //Initialize variables to store user input
            $user->setFname($_POST['fname']);
            $user->setLname($_POST['lname']);
            $user->setAge($_POST['age']);
            $user->setPhone($_POST['phone']);
            $user->setGender($_POST['gender']);


            /*
            //Initialize variables to store user input
            $userFName = "";
            $userLName = "";
            $userAge = "";
            $userPhone = "";
            $userGender = "";
            */

            /*
            //get the data from the post array
            $userFName = $_POST['fName'];
            $userLName = $_POST['lName'];
            $userAge = $_POST['age'];
            $userGender = $_POST['gender'];
            $userPhone = $_POST['phoneNum'];
            $_SESSION['gender'] = $userGender;
            */

            // validate first name
            $userFName = $_POST['fname'];
            if (Validation::validName($userFName)) {
                $_SESSION['fName'] = $_POST['fName'];
            } else {
                $this->_f3->set('errors["fName"]', "Please enter a valid first name");
            }
            // validate last name
            $userLName = $_POST['lname'];
            if (Validation::validName($userLName)) {
                $_SESSION['lName'] = $_POST['lName'];
            } else {
                $this->_f3->set('errors["lName"]', "Please enter a valid last name");
            }

            // validate age
            $userAge = $_POST['age'];
            if (Validation::validAge($userAge)) {
                $_SESSION['age'] = $_POST['age'];

            } else {
                $this->_f3->set('errors["age"]', "Age must be numeric and between 18 and 118");
            }

            // validate phone number
            $userPhone = $_POST['phone'];
            if (Validation::validPhone($userPhone)) {
                $_SESSION['phone'] = $_POST['phone'];
            } else {
                $this->_f3->set('errors["phone"]', "Please enter a valid phone");
            }

            $this->_f3->set('gender', (new DataLayer)->getGender());

            //Get the data
            $this->_f3->set('user', $_POST['premium']);
            $this->_f3->set('userFName', $user->getFname());
            $this->_f3->set('userLName', $user->getLname());
            $this->_f3->set('userAge', $user->getAge());
            $this->_f3->set('userPhone', $user->getPhone());
            $this->_f3->set('userGender', $user->getGender());

            $_SESSION['user'] = $user;

            //If there are no errors, redirect to profile route
            if (empty($this->_f3->get('errors'))) {
                header('/profile2');
            }
        }

        /*
        //Get the data from the model
        $this->_f3->set('gender', DataLayer::getGender());
        $this->_f3->set('userFName', isset($userFName) ? $userFName : "");
        $this->_f3->set('userLName', isset($userLName) ? $userLName : "");
        $this->_f3->set('userAge', isset($userAge) ? $userAge : "");
        $this->_f3->set('userPhone', isset($userPhone) ? $userPhone : "");
        */

        //Display profile1 form (personal-info.html)
        $view = new Template();
        echo $view->render('views/personal-info.html');
    }

    // display the profile2 (profile.html)
    function profile2()
    {
        $user = $_SESSION['user'];

        /*
        //Initialize variables to store user input
        $user->setEmail("");
        $user->setState("");
        $user->setSeeking("");
        $user->setBio("");
        */

        //If the form has been submitted, validate the data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);

            $userEmail = $_POST['email'];

            // validate email address
            if (Validation::validEmail($userEmail)) {
                $_SESSION['email'] = $_POST['email'];
            } else {
                $this->_f3->set('errors["email"]', "Please enter a valid email");
            }

            // store the user inputs
            $user->setState($_POST['state']);
            $user->setSeeking($_POST['seeking']);
            $user->setBio($_POST['bio']);

            // membership status
            if (empty($this->_f3->get('errors'))) {
                // premium member
                if ($user instanceof PremiumMember) {
                    header('location: profile3');
                }
                // regular member
                header('location: summary');
            }
        }

        $this->_f3->set('seekGender', (new DataLayer)->getSeeking());
        $this->_f3->set('userEmail', $user->getEmail());
        $this->_f3->set('userState', $user->getState());
        $this->_f3->set('userSeeking', $user->getSeeking());
        $this->_f3->set('userBio', $user->getBio());


        //Display profile form (profile.html)
        $view = new Template();
        echo $view->render('views/profile.html');

    }

    // interest page (interest.html)
    function profile3()
    {
        $userIndoor = array();
        $userOutdoor = array();
        $user = $_SESSION['user'];


        //If the form has been submitted, add the data to session
        //and send the user to the next order form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);
            $userIndoor = $_POST['fName'];

            if(Validation::validIndoor($userIndoor)){
                $_SESSION['indoor'] = implode(", ", $userIndoor);
            } else {
                $this->_f3->set('errors["indoor"]', 'Invalid selection');
            }

            if(Validation::validOutdoor($userOutdoor)){
                $_SESSION['outdoor'] = implode(", ", $userOutdoor);
            } else {
                $this->_f3->set('errors["outdoor"]', 'Invalid selection');
            }

            if (empty($this->_f3->get('errors'))) {
                header('location: summary');
            }
        }

        // get and set
        $this->_f3->set('indoor', $user->getIndoor());
        $this->_f3->set('outdoor', $user->getOutdoor());

        /*
        $this->_f3->set('indoor', getIndoor());
        $this->_f3->set('outdoor', getOutdoor());
        */

        // store
        $this->_f3->set('userIndoor', $userIndoor());
        $this->_f3->set('userOutdoor', $userOutdoor());

        // display page
        $view = new Template();
        echo $view->render('views/interest.html');

    }

    // display the summary page
    function summary()
    {
        //Display the second order form
        $view = new Template();
        echo $view->render('views/summary.html');

        unset($_SESSION['biography']);

    }
}