<!-- 328/dating/classes/member.php-->
<?php
/**
 * Class Member - Class Structure that represents all members
 * @author Jada
 * @version 1.0
 */

class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param $_fname - a String of a member's first name
     * @param $_lname - a String of member's last name
     * @param $_age - int of a member's age
     * @param $_gender - a String of a member's gender
     * @param $_phone - a String of a member's phone number
     */
    public function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
    }

    // setters
    /**
     * @param String $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @param String $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @param String $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @param String $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @param String $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @param String $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @param String $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

    // getters
    /**
     * @return String of a member's first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @return String of a member's last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @return int of a member's age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @return String of a member's gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @return String of a member's phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @return String of a member's email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return String of a member's state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @return String of a member's seeking gender
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @return String of a member's bio
     */
    public function getBio()
    {
        return $this->_bio;
    }




}