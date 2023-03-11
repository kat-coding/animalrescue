<?php
/**
 * 328/animalrescue/pets.php
 * Authors: Katherine Watkins, Alex Brenna, Dee Brecke
 * LostPet class is the parent class for all pets in this project. It has
 * fields that are relevant to all pets. Five fields are required but all fields are
 * defaulted to an empty string.
 * It contains a parameterized constructor with default values and getters and setters
 * for each field
 */
class Pets
{
    //required fields
    private $_name;
    private $_age;
    private $_sex;
    private $_species;
    private $_state;

    private $_city;
    private $_imgUrl;
    private $_description;

    /**
     * Parameterized constructor
     * @param $name string name of animal
     * @param $age string age of animal
     * @param $sex string gender of animal
     * @param $species string species--is it a dog or a cat or other?
     * @param $state US State in which the animal lives
     * (we cross-reference our pets with other shelters)
     */
    function __construct($name = "", $age = "", $sex ="", $species = "", $state="")
    {
        $this->_name = $name;
        $this->_age = $age;
        $this->_sex = $sex;
        $this->_species = $species;
        $this->_state = $state;
        $this->_city = "";
        $this->_imgUrl = "";
        $this->_description = "";
    }

    //getters and setters for each field
    function getName()
    {
        return $this->_name;
    }

    function setName($name)
    {
        $this->_name = $name;
    }

    function getAge()
    {
        return $this->_age;
    }

    function setAge($age)
    {
        $this->_age = $age;
    }

    function getSex()
    {
        return $this->_sex;
    }

    function setSex($sex)
    {
        $this->_sex = $sex;
    }
    function getSpecies()
    {
        return $this->_species;
    }

    function setSpecies($species)
    {
        $this->_species = $species;
    }
    function getState()
    {
        return $this->_state;
    }

    function setState($state)
    {
        $this->_state = $state;
    }
    function getCity()
    {
        return $this->_city;
    }

    function setCity($city)
    {
        $this->_city = $city;
    }
    function getMicrochip()
    {
        return $this->_microchip;
    }

    function setMicrochip($microchip)
    {
        $this->_microchip = $microchip;
    }
    function getimgUrl()
    {
        return $this->_imgUrl;
    }

    function setImgUrl($imgUrl)
    {
        $this->_imgUrl = $imgUrl;
    }
    function getDescription()
    {
        return $this->_description;
    }

    function setDescription($description)
    {
        $this->_description = $description;
    }


}//end pets parent class