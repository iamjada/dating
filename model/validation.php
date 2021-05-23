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
    /*
    if (preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone)) {
        return $phone;
    } else {
        return !empty($phone);
    }
    */
    return !empty(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone));
}
// validEmail checks to see that an email address is valid
function validEmail($email){
    //$reg = '/^[\w!#$%&\'*+\/=?^`{|}~.-]+@[\w]+\.[\w]+$/';
    // reference : https://stackoverflow.com/questions/13719821/email-validation-using-regular-expression-in-php
    //return filter_var($email, FILTER_VALIDATE_EMAIL);
    return !empty(filter_var($email, FILTER_VALIDATE_EMAIL));

}

// validOutdoor checks each selected indoor interest against a list of valid options
function validOutdoor($outdoor)
{
    $validOutdoor = getOutdoor();

    foreach ($outdoor as $userOutdoorChoices) {
        if (!in_array($userOutdoorChoices, $validOutdoor)) {
            return false;
        }
    }
    //All choices are valid
    return true;

}

// validIndoor checks each selected indoor interest against a list of valid options
function validIndoor($indoor)
{
    $validIndoor = getIndoor();

    foreach ($indoor as $userIndoorChoices) {
        if (!in_array($userIndoorChoices, $validIndoor)) {
            return false;
        }
    }
    //All choices are valid
    return true;
}