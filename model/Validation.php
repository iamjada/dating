<?php
/* Validation.php
 * Validate data
 *
 */
class Validation {
    // checks to see that a string all alphabetic
    static function validName($name)
    {
        return preg_match('/^[a-zA-Z]+$/', $name) == 1;
        //return !empty(trim($name)) && ctype_alpha($name);
    }

// validAge check to see that an age is numeric and between 18 and 118
    static function validAge($age)
    {
        return !empty(is_numeric($age)) && $age >= 18 && $age <= 118;
    }

// validPhone checks to see that a phone number is valid
    static function validPhone($phone)
    {
        $pattern = '/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/';
        return preg_match($pattern, $phone) == 1;
        /*
        if (preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone)) {
            return $phone;
        } else {
            return !empty($phone);
        }
        */
    }
// validEmail checks to see that an email address is valid
    static function validEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            return true;
        }
        return false;
        /*
        //$reg = '/^[\w!#$%&\'*+\/=?^`{|}~.-]+@[\w]+\.[\w]+$/';
        // reference : https://stackoverflow.com/questions/13719821/email-validation-using-regular-expression-in-php
        //return !empty(filter_var($email, FILTER_VALIDATE_EMAIL));
        */

    }

// validOutdoor checks each selected indoor interest against a list of valid options
    static function validOutdoor($outdoor)
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
    static function validIndoor($indoor)
    {
        $validIndoor = getIndoor();

        foreach ($indoor as $userIndoor) {
            if (!in_array($userIndoor, $validIndoor)) {
                return false;
            }
        }
        //All choices are valid
        return true;
    }
}
