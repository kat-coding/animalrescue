<?php
class ShelterPet extends Pets{
    private $_status;
    private $_goodWithKids;
    private $_goodWithOtherPets;
    private $_healthConditions;

    function __construct($status, $goodWithKids, $goodWithOtherPets, $healthConditions){
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