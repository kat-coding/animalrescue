<?php
class LostPet extends Pets{
    private $_ownerName;
    private $_email;
    private $_phone;
    private $_dateMissing;

    function __construct($ownerName, $email, $phone, $dateMissing){
        parent::__construct($name="?", $age="?", $sex="?", $species="?");
        $this->_ownerName = $ownerName;
        $this->_email = $email;
        $this->_phone = $phone;
        $this->_dateMissing = $dateMissing;
    }

    function getOwnerName()
    {
        return $this->_ownerName;
    }

    function setOwnerName($ownerName)
    {
        $this->_ownerName = $ownerName;
    }

    function getEmail()
    {
        return $this->_email;
    }

    function setEmail($email)
    {
        $this->_email = $email;
    }

    function getPhone()
    {
        return $this->_phone;
    }

    function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    function getDateMissing()
    {
        return $this->_dateMissing;
    }

    function setDateMissing($dateMissing)
    {
        $this->_dateMissing = $dateMissing;
    }


}//end of class
