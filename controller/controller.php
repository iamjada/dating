<?php

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
    function personal()
    {
        //If the form has been submitted, add the data to session
        //and send the user to the next order form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);

            //get the data from the post array
            $userFName = trim($_POST['fName']);
            $userLName = trim($_POST['lName']);
            $userAge = trim($_POST['age']);
            $userGender = $_POST['gender'];
            $userPhone = trim($_POST['phoneNum']);

            // validate first name
            if (!$this->_validator->validFName($userFName)) {
                $this->_f3->set('errors["lName"]', "First name cannot be blank and must be alphabetical");
            }

            // validate first name
            if (!$this->_validator->validLName($userLName)) {
                $this->_f3->set('errors["lName"]', "Last name cannot be blank and must be alphabetical");
            }

            // validate age
            if (!$this->_validator->validAge($userAge)) {
                $this->_f3->set('errors["age"]', "Age must be numeric and between 18 and 118");
            }

            // validate phone
            if (!$this->_validator->validPhone($userPhone)) {
                $this->_f3->set('errors["phone"]', "Please enter a valid phone");
            }


            //If there are no errors, redirect to profile route
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->rerout('/profile');

            }
        }

        //Get the data from the model
        //$this->_f3->set('meals', DataLayer::getMeals());

        //Store the user input in the hive
        $this->_f3->set('userFName', $userFName);
        $this->_f3->set('userLName', $userLName);

        $this->_f3->set('userFName', isset($userFName) ? $userFName : "");
        $this->_f3->set('userLName', isset($userLName) ? $userLName : "");
        $this->_f3->set('userAge', isset($userAge) ? $userAge : "");
        $this->_f3->set('userPhone', isset($userPhone) ? $userPhone : "");

        //Display the first order form
        $view = new Template();
        echo $view->render('views/personal-info.html');
    }

    function order2()
    {
        //Initialize variables for user input
        $userConds = array();

        //If the form has been submitted, validate the data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);

            //If condiments are selected
            if (!empty($_POST['conds'])) {

                //Get user input
                $userConds = $_POST['conds'];

                //If condiments are valid
                if (Validation::validCondiments($userConds)) {
                    $_SESSION['order']->setCondiments(implode(", ", $userConds));
                }
                else {
                    $this->_f3->set('errors["conds"]', 'Invalid selection');
                }
            }

            //If the error array is empty, redirect to summary page
            if (empty($this->_f3->get('errors'))) {
                header('location: summary');
            }
        }

        //var_dump($userConds);

        //Get the condiments from the Model and send them to the View
        $this->_f3->set('condiments', DataLayer::getCondiments());

        //Add the user data to the hive
        $this->_f3->set('userConds', $userConds);

        //Display the second order form
        $view = new Template();
        echo $view->render('views/orderForm2.html');
    }

    function summary()
    {
        //Display the second order form
        $view = new Template();
        echo $view->render('views/summary.html');

        //This might be problematic
        unset($_SESSION['order']);
    }
}