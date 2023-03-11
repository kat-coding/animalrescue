<?php
/**
 * Shelter Pet Class
 *
 * 328/animalrescue/classes/shelterpet.php
 * Authors: Katherine Watkins, Alex Brenna, Dee Brecke
 * ShelterPet class is a child class of the Pets parent class. It adds four new
 * fields that are relevant to shelter pets that are not of concern to lost pets
 * It contains a parameterized constructor with default values and getters and setters
 * for each field
 */
class ShelterPet extends Pets{
    private $_status;
    private $_goodWithKids;
    private $_goodWithOtherPets;
    private $_healthConditions;

    /**
     * Parameterized constructor with all fields defaulted to unknown
     * @param $status string representing if the animal is adoptable, pending, or adopted
     * @param $goodWithKids string which checks to see if the shelter pet is a good match
     * for a family with children
     * @param $goodWithOtherPets string which checks to see if the shelter pet is a good match
     * for a family with other pets
     * @param $healthConditions string list of known health issues defaulted to unknown
     */
    function __construct($status="unknown", $goodWithKids="unknown",
                         $goodWithOtherPets="unknown", $healthConditions="unknown")
    {
        parent::__construct($name="?", $age="?", $sex="?", $species="?");
        $this->_status = $status;
        $this->_goodWithKids = $goodWithKids;
        $this->_goodWithOtherPets = $goodWithOtherPets;
        $this->_healthConditions = $healthConditions;
    }

    function getStatus()
    {
        return $this->_status;
    }

    function setStatus($status)
    {
        $this->_status = $status;
    }

    function getGoodWithKids()
    {
        return $this->_goodWithKids;
    }

    function setGoodWithKids($goodWithKids)
    {
        $this->_goodWithKids = $goodWithKids;
    }

    function getGoodWithOtherPets()
    {
        return $this->_goodWithOtherPets;
    }
    function setGoodWithOtherPets($goodWithOtherPets)
    {
        $this->_goodWithOtherPets = $goodWithOtherPets;
    }
    function getHealthConditions()
    {
        return $this->_healthConditions;
    }

    function setHealthConditions($healthConditions)
    {
        $this->_healthConditions = $healthConditions;
    }


}//end of class