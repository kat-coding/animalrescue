<?php

/**
 * Lost Pet Class
 *
 * 328/animalrescue/lostpet.php
 * Authors: Katherine Watkins, Alex Brenna, Dee Brecke
 * LostPet class is a child class of the Pets parent class. It adds four new
 * fields that are relevant to lost pets that are not relevant to shelter pets
 * It contains a parameterized constructor with default values and getters and setters
 * for each field
 */
class LostPet extends Pets{
    private $_ownerName;
    private $_email;
    private $_phone;
    private $_dateMissing;

    /**
     * Parameterized constructor with all fields defaulted to empty string
     * @param $ownerName string name of owner who has lost their pet
     * @param $email string email address of owner who has lost their pet
     * @param $phone string phone number of owner who has lost their pet
     * @param $dateMissing string date pet went missing to the best of the owner's knowledge
     */
    function __construct($ownerName = "", $email = "", $phone = "", $dateMissing = "")
    {
        parent::__construct();
        $this->_ownerName = $ownerName;
        $this->_email = $email;
        $this->_phone = $phone;
        $this->_dateMissing = $dateMissing;
    }

    //getters and setters
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
