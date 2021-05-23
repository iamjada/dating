<?php
/* validation.php
 * Validate data
 *
 */

// validFName for first name checks to see that a string all alphabetic
function validFName($first)
{
    return !empty(trim($first)) && ctype_alpha($first);
}

// validLName for first name checks to see that a string all alphabetic
function validLName($last)
{
    return !empty(trim($last)) && ctype_alpha($last);
}

// validAge check to see that an age is numeric and between 18 and 118
function validAge($age)
{
    return !empty(is_numeric($age)) && $age >= 18 && $age <= 118;
}
// validPhone checks to see that a phone number is valid
function validPhone($phone)
{
    return !empty(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone));
}
// validEmail checks to see that an email address is valid

function isValidEmail($email){
    //$reg = '/^[\w!#$%&\'*+\/=?^`{|}~.-]+@[\w]+\.[\w]+$/';
    // reference : https://stackoverflow.com/questions/13719821/email-validation-using-regular-expression-in-php
    //return filter_var($email, FILTER_VALIDATE_EMAIL);
    return !empty(filter_var($email, FILTER_VALIDATE_EMAIL));

}

// validOutdoor checks each selected indoor interest against a list of valid options
function validOutdoor($outdoor)
{
    $valid = false;
    foreach ($outdoor as $selected) {
        if (in_array($selected, $this->_dataLayer->getOutdoor())) {
            $valid = true;
        }else {
            $valid = false;
        }
    }
    return $valid;

}

// validIndoor checks each selected indoor interest against a list of valid options
function validIndoor($indoor)
{
    $valid = false;
    foreach ($indoor as $selected) {
        if (in_array($selected, $this->_dataLayer->getIndoor())) {
            $valid = true;
        }else {
            $valid = false;
        }
    }
    return $valid;
}