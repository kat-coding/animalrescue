<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/../pdo-config.php');

/**
 * Authors: Dee Brecke, Alex Brenna, Katherine Watkins
 * This class contains methods and functions to interact with the database
 * and to add dropdown items to the pages
 */
class DataLayer
{
    // Database connection object
    private $_dbh;

    /**
     * Constructor
     *
     * This is the constructor function for the database object (PDO)
     */
    function __construct()
    {
        try {
            //Instantiate a PDO object
            $this->_dbh = new PDO(DB_DRIVER, USERNAME, PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Available pets function
     *
     * This function interacts with the database to populate the adoptable
     * pets table in adoptable.html
     * @return array|false
     */
    function getavailablepets()
    {
        //1. Define the query
        $sql = "SELECT * FROM pets, shelterPet where shelterPet.PetID=pets.PetID";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        //5. Process the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lost pets function
     *
     * This function interacts with the database to populate the lost
     * pets table in missing.html
     * @return array|false
     */
    function getLostPets()
    {
        //1. Define the query
        $sql = "SELECT * FROM pets, lostPets where lostPets.PetID=pets.PetID";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        //5. Process the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * This pulls up a specific pet based on the pet id (when "more info" is clicked
     * on missing pets page)
     * @param $id pet ID for specific pet that was clicked on
     * @return array|false data from database associated with a particular pet ID
     */
    function getLostPet($id)
    {
        //1. Define the query
        $sql = "SELECT * FROM pets, lostPets where lostPets.PetID=pets.PetID and lostPets.PetID =$id";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        //5. Process the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return string[] array of US States to go in drop-down menus
     */
    static function  getState()
    {
        return array("AL" => "Alabama", "AK" => "Alaska", "AZ" => "Arizona", "AR" => "Arkansas", "CA" => "California",
            "CO" => "Colorado", "CT" => "Connecticut", "DE" => "Delaware", "DC" => "District Of Columbia", "FL" => "Florida",
            "GA" => "Georgia", "HI" => "Hawaii", "ID" => "Idaho", "IL" => "Illinois", "IN" => "Indiana",
            "IA" => "Iowa", "KS" => "Kansas", "KY" => "Kentucky", "LA" => "Louisiana", "ME" => "Maine",
            "MD" => "Maryland", "MA" => "Massachusetts", "MI" => "Michigan", "MN" => "Minnesota", "MS" => "Mississippi",
            "MO" => "Missouri", "MT" => "Montana", "NE" => "Nebraska", "NV" => "Nevada", "NH" => "New Hampshire",
            "NJ" => "New Jersey", "NM" => "New Mexico", "NY" => "New York", "NC" => "North Carolina", "ND" => "North Dakota",
            "OH" => "Ohio", "OK" => "Oklahoma", "OR" => "Oregon", "PA" => "Pennsylvania", "RI" => "Rhode Island",
            "SC" => "South Carolina", "SD" => "South Dakota", "TN" => "Tennessee", "TX" => "Texas", "UT" => "Utah",
            "VA" => "Virginia", "WA" => "Washington", "WV" => "West Virginia", "WI" => "Wisconsin", "WY" => "Wyoming");
    }

    /**
     * Function for adding pets to database
     *
     * This function takes in a pet object and inserts the fields of the
     * pet parent class into the database. This is a necessary first step to
     * be able to insert a shelter pet or lost pet because the pet ID is auto-generated
     * in the database. It returns a unique pet id which can be passed into the
     * other functions to add to the other tables in the database
     * @param $pet pet object containing required fields for all pets
     * @return $id unique id for pet
     */
    function insertIntoPets($pet)
    {
        //pet table
        $name = $pet->getName();
        $age = $pet->getAge();
        $sex = $pet->getSex();
        $species = $pet->getSpecies();
        $description = $pet->getDescription();
        $imgUrl = $pet->getimgUrl();
        $state = $pet->getState();
        $city = $pet->getCity();
        //define query
        $sql = "INSERT INTO `pets`(`Name`, `Age`, `Sex`, `Species`, `Description`, `ImgUrl`, `State`, `City`) 
                VALUES (:name,:age,:sex, :species, :description, :imgUrl, :state, :city)";
        //prepare statement
        $statement = $this->_dbh->prepare($sql);
        //bind parameters
        $statement->bindParam(':name', $name);
        $statement->bindParam(':age', $age);
        $statement->bindParam(':sex', $sex);
        $statement->bindParam(':species', $species);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':imgUrl', $imgUrl);
        $statement->bindParam(':state', $state);
        $statement->bindParam(':city', $city);
        //execute statement
        $statement->execute();
        //get id
        $id = $this->_dbh->lastInsertId();
        return $id;
    }

    /**
     * @param $id
     * @param $ownerName
     * @param $email
     * @param $phone
     * @param $datemissing
     * @return void
     */

    function insertIntoLostPets($id, $ownerName, $email, $phone, $datemissing){
        //define query
        $sql = "INSERT INTO `lostPets`(`PetID`, `OwnersName`, `Email`, `Phone`, `Datamissing`) 
                VALUES (:id,:ownerName,:email,:phone,:datemissing)";
        //prepare statement
        $statement = $this->_dbh->prepare($sql);
        //bind parameters
        $statement->bindParam(':id', $id);
        $statement->bindParam(':ownerName', $ownerName);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':datemissing', $datemissing);

        //execute statement
        $statement->execute();
    }

    /**
     * @param $lostPet
     * @return void
     */
    function addLostPet($lostPet){

        //add to pet table and get id
        $id = DataLayer :: insertIntoPets($lostPet);
        //lost pet table
        $ownerName = $lostPet->getOwnerName();
        $email = $lostPet->getEmail();
        $phone = $lostPet->getPhone();
        $dateMissing = $lostPet->getDateMissing();
        DataLayer :: insertIntoLostPets($id, $ownerName, $email, $phone, $dateMissing);
    }

    /**
     * @param $shelterPet
     * @return void
     */
    function addShelterPet($shelterPet){
        //add to pet table and get id
        $id = DataLayer :: insertIntoPets($shelterPet);
        //lost pet table
        $status = $shelterPet->getStatus();
        $goodWithKids = $shelterPet->getGoodWithKids();
        $goodWithOtherPets = $shelterPet->getGoodWithOtherPets();
        $healthConditions = $shelterPet->getHealthConditions();
        DataLayer :: insertIntoShelterPets($id, $status, $goodWithKids, $goodWithOtherPets, $healthConditions);
    }

    /**
     * @param $id
     * @param $status
     * @param $goodWithKids
     * @param $goodWithOtherPets
     * @param $healthConditions
     * @return void
     */
    function insertIntoShelterPets($id, $status, $goodWithKids, $goodWithOtherPets, $healthConditions){
        //define query
        $sql = "INSERT INTO `shelterPet`(`PetID`, `Status`, `GoodWithKids`, `GoodWithOtherPets`, `HealthConditions`) 
                VALUES (:id,:status,:goodWithKids,:goodWithOtherPets,:healthConditions)";
        //prepare statement
        $statement = $this->_dbh->prepare($sql);
        //bind parameters
        $statement->bindParam(':id', $id);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':goodWithKids', $goodWithKids);
        $statement->bindParam(':goodWithOtherPets', $goodWithOtherPets);
        $statement->bindParam(':healthConditions', $healthConditions);

        //execute statement
        $statement->execute();
        $newID = $this->_dbh->lastInsertId();
        echo $newID;
    }


}