<?php
/**
 * Controller class
 *
 * 328/animalrescue/controller/controller.php
 * Authors: Katherine Watkins, Alex Brenna, Dee Brecke
 * This class contains methods with all the conditional logic for routing
 * The controller object is passed into the routes on index.php
 */
class Controller
{
    //first field is fatfree object/router
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

 //Routing functions for pages within site

    /**
     * Home page route
     *
     * @return void
     * default route which renders the home page for the website
     */
    function home()
    {
        $view = new Template();
        echo $view-> render('views/home.html');
    }

    /**
     * About page route
     *
     * Route which renders the "about" page of the site
     * @return void
     */
    function about()
    {
        $view = new Template();
        echo $view-> render('views/about.html');
    }

    /**
     * Adoptable pets page route
     *
     * This function calls the getavailablepets function from
     * the datalayer class and renders the adoptable.html page
     * @return void
     */
    function availablepets()
    {
        $availablepets= $GLOBALS['dataLayer']->getavailablepets();
        $this->_f3->set('availablepets', $availablepets);
        /*echo "<pre>";
        var_dump($_POST);
        var_dump($availablepets);
        echo "</pre>";*/
        $view = new Template();
        echo $view-> render('views/adoptable.html');
    }

    /**
     * TODO: Write this page or remove this route
     * Route which renders the found pets page
     * @return void
     */
    function foundpets()
    {
        $view = new Template();
        echo $view-> render('views/found.html');
    }

    /**
     * Missing Pets page route
     *
     * This method calls the getLostPets function in
     * the datalayer class and renders the missing pets page
     * @return void
     */
    function missingpets()
    {
        //Get the data from the model
        $lost= $GLOBALS['dataLayer']->getLostPets();
        $this->_f3->set('LostPets', $lost);
        /*echo "<pre>";
        var_dump($_POST);
        var_dump($lost);
        echo "</pre>";*/
        $view = new Template();
        echo $view-> render('views/missing.html');
    }

    /**
     * Route renders the missingPostInfo page
     * TODO: check if this is a redundant route (info appears to be already coded into missing.html)
     * @return void
     */
    function missingPetInfo(){

        //Get the data from the model
        $lost= $GLOBALS['dataLayer']->getLostPet($_GET['id']);
        $this->_f3->set('LostPet', $lost);
        /*echo "<pre>";
        var_dump($_GET);
        var_dump($lost);
        echo "</pre>";*/
        $view = new Template();
        echo $view-> render('views/missingPostInfo.html');
    }

    /**
     * Route that renders the resources page that we haven't built yet
     * TODO: remove this route or create resources page
     * @return void
     */
    function resources()
    {
        $view = new Template();
        echo $view-> render('views/resources.html');
    }

    /**
     * Lost Pet Form Route
     *
     * This function renders the page where the user can enter
     * their lost pet info. It validates all the information that
     * is provided and displays the States drop down menu. If all data
     * is validated, it reroutes to the summary page
     * @return void
     */
    function lostpet($_f3)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $newLostPet = new LostPet();
            $_SESSION['newLostPet'] = $newLostPet;

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $state = $_POST['state'];
            $phone = $_POST['phone'];
            $pname = $_POST['pname'];
            $species = $_POST['species'];
            $age = $_POST['age'];
            $description = $_POST['description'];
            $sex = $_POST['sex'];
            $dateMissing = $_POST['datemissing'];
            $city = $_POST['city'];

            //set description to object
            $_SESSION['newLostPet']->setDescription($description);
            $_SESSION['newLostPet']->setDateMissing($dateMissing);
            //set owners name to object
            if(Validate::validName($fname) & Validate::validName($lname)){
                $ownerName = $fname." ".$lname;
                $_SESSION['newLostPet']->setOwnerName($ownerName);
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
            }
            else {
                if (Validate::validName($fname)) {
                    $_SESSION['fname'] = $fname;
                } else {
                    $this->_f3->set('errors["fname"]', 'First name is invalid');
                }

                if (Validate::validName($lname)) {
                    $_SESSION['lname'] = $lname;
                } else {
                    $this->_f3->set('errors["lname"]', 'Last name is invalid');
                }
            }
            //set pet name to object
            if(Validate::validName($pname)){
                $_SESSION['newLostPet']->setName($pname);
            }else {
                $this->_f3->set('errors["pname"]', 'Invalid name');
            }
            //set email to object
            if (Validate::validEmail($email)){
                $_SESSION['newLostPet']->setEmail($email);
            }else{
                $this->_f3->set('errors["email"]', 'Email is invalid');
            }
            //set state to object
            if (Validate::validState($state)){
                $_SESSION['newLostPet']->setState($state);
            }else{
                $this->_f3->set('errors["state"]', 'State must be selected');
            }
            //set city to object
            if(Validate::validCity($city)){
                $_SESSION['newLostPet']->setCity($city);
            }else{
                $this->_f3->set('errors["city"]', 'Invalid city');
            }
            //set phone to object
            if (Validate::validPhone($phone)){
                $_SESSION['newLostPet']->setPhone($phone);
            }else{
                $this->_f3->set('errors["phone"]', 'Phone number is invalid');
            }
            //set species
            if(Validate::validSpecies($species)){
                $_SESSION['newLostPet']->setSpecies($species);
            }else{
                $this->_f3->set('errors["species"]', 'Species is invalid');
            }
            //set age
            if(Validate::validAge($age)){
                $_SESSION['newLostPet']->setAge($age);
            }else{
                $this->_f3->set('errors["age"]', 'Age must be 1-2 digit number');
            }
            //set sex to object
            if(Validate::validSex($sex)){
                $_SESSION['newLostPet']->setSex($sex);
            }else{
                $this->_f3->set('errors["sex"]', 'Invalid sex');
            }
            //set date missing to object
            if(Validate::validMissingDate($dateMissing)){
                $_SESSION['newLostPet']->setDateMissing($dateMissing);
            }else{
                $this->_f3->set('errors["datemissing"]', 'Invalid date');
            }
            //if image uploaded run the upload function in controller
            if(!empty($_FILES["file"]["name"])) {
                $imgURL = Upload::uploadImage($_f3);
                if(Validate::validIMGURL($imgURL)){
                    $_SESSION['newLostPet']->setImgUrl($imgURL);
                }else{
                    $_SESSION['newLostPet']->setImgUrl(substr($imgURL, 0, 10));
                }
                //ELSE{ errors set in uploadImage() function based on the error}
            }else{
                $_SESSION['newLostPet']->setImgUrl("upload-img/generic.png");
            }


            if(empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('summary');
            }
        }
        $this->_f3->set("states", Datalayer::getState());
        $view = new Template();
        echo $view-> render('views/lostpet.html');
    }

    /**
     * Lost Pet Summary Page Route
     *
     * This is the summary page for the lost pets form
     * It renders summary.html which offers the user the opportunity
     * to check the information they added and submit it.
     * @return void
     */
    function summary()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->_f3->reroute('submit');

        } else {
            $view = new Template();
            echo $view->render('views/summary.html');
//        var_dump($_SESSION);
        }
    }

    /**
     * Missing Pets submission route
     *
     * This function calls the addLostPet function on the current session,
     * ends the session and then reroutes the user back to the missing pets
     * page (that should show the newly added pet)
     * @return void
     */
    function submit()
    {
        $GLOBALS['dataLayer']->addLostPet($_SESSION['newLostPet']);
        session_destroy();
        $this->_f3->reroute('missingpets');
    }


    /**
     * Add Shelter Pet form route
     *
     * This method renders the form for the admin to add a new pet
     * to the pets and shelter pets tables in the database. It validates
     * the info and reroutes to the shelter pet summary page
     * @return void
     */
    function shelterpet($_f3)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $newShelterPet = new ShelterPet();
            $_SESSION['newShelterPet'] = $newShelterPet;

            $name = $_POST['name'];
            $age = $_POST['age'];
            $sex = $_POST['sex'];
            $species = $_POST['species'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $goodwpets = $_POST['goodwpets'];
            $kids = $_POST['kids'];
            $health = $_POST['health'];

            //set whatever we are not validating
            $_SESSION['newShelterPet']->setDescription($description);
            $_SESSION['newShelterPet']->setStatus($status);
            $_SESSION['newShelterPet']->setGoodWithKids($kids);
            $_SESSION['newShelterPet']->setGoodWithOtherPets($goodwpets);
            $_SESSION['newShelterPet']->setHealthConditions($health);
            //set pet name to object
            if(Validate::validName($name)){
                $_SESSION['newShelterPet']->setName($name);
            }else {
                $this->_f3->set('errors["name"]', 'Invalid name');
            }

            //set US state to object
            if (Validate::validState($state)){
                $_SESSION['newShelterPet']->setState($state);
            }else{
                $this->_f3->set('errors["state"]', 'State must be selected');
            }
            //set city to object
            if(Validate::validCity($city)){
                $_SESSION['newShelterPet']->setCity($city);
            }else{
                $this->_f3->set('errors["city"]', 'Invalid city');
            }
            //set species
            if(Validate::validSpecies($species)){
                $_SESSION['newShelterPet']->setSpecies($species);
            }else{
                $this->_f3->set('errors["species"]', 'Species is invalid');
            }
            //set age
            if(Validate::validAge($age)){
                $_SESSION['newShelterPet']->setAge($age);
            }else{
                $this->_f3->set('errors["age"]', 'Age must be 1-2 digit number');
            }
            //set sex to object
            if(Validate::validSex($sex)){
                $_SESSION['newShelterPet']->setSex($sex);
            }else{
                $this->_f3->set('errors["sex"]', 'Invalid sex');
            }

            //if image uploaded run the upload function in controller
            if(!empty($_FILES["file"]["name"])) {
                $imgURL = Upload::uploadImage($this->_f3);
                if(Validate::validIMGURL($imgURL)){
                    $_SESSION['newShelterPet']->setImgUrl($imgURL);
                }else{
                    $$_SESSION['newShelterPet']->setImgUrl(substr($imgURL, 0, 10));
                }
                //ELSE{ errors set in uploadImage() function based on the error}
            }else{
                $$_SESSION['newShelterPet']->setImgUrl("upload-img/generic.png");
            }

            if(empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('spsummary');
            }
        }//end of if POST
        $this->_f3->set("states", Datalayer::getState());
        $view = new Template();
        echo $view-> render('views/addShelterPet.html');
    }//end of shelterpet()


    /**
     * summary route for shelter pet
     *
     * This method displays the information that was entered into
     * the add shelter pet form and reroutes to the submit
     * page when the user (admin) hits the submit button
     * @return void
     */
    function spsummary()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->_f3->reroute('spsubmit');

        } else {
            $view = new Template();
            echo $view->render('views/shelterPetSummary.html');
//        var_dump($_SESSION);
        }
    }
    /**
     * submit route for shelter pet
     *
     * This function calls the addShelterPet function on the current session,
     * ends the session and then reroutes the user back to the admin page
     *
     * @return void
     */
    function spsubmit()
    {
        $GLOBALS['dataLayer']->addShelterPet($_SESSION['newShelterPet']);
        session_destroy();
        $this->_f3->reroute('adminpage');
    }

    /**
     * I believe this is a redundant route
     * TODO: delete this route if it is redundant
     * @return void
     */
        function confirm()
    {
        $view = new Template();
        echo $view->render('views/addShelterPet.html');
    }
/*
    /** This was moved to class
     * uploadImage function for client image uploads
     * @return void uploads images to upload-img directory
     */
//    function uploadImage()
//    {
//        $targetDir = "upload-img/";
//        $fileName = basename($_FILES["file"]["name"]);
//        $targetFilePath = $targetDir . $fileName;
//        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
//        $_SESSION['file']= $_FILES["file"]["name"];
//        if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
//            //allow certain file formats
//            $allowTypes = array('jpg','png','jpeg');
//            if(in_array($fileType, $allowTypes)){
//                //upload file to server
//                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
//                    $statusMsg = "The file ".$fileName. " has been uploaded.";
//                    $_SESSION['imgURL'] = $targetFilePath;
//
//                }else{
//                    $statusMsg = "Sorry, there was an error uploading your file.";
//                    $this->_f3->set('errors["imgUpload"]', $statusMsg);
//                }
//            }else{
//                $statusMsg = 'Sorry, only JPG, JPEG files are allowed to upload.';
//                $this->_f3->set('errors["imgUpload"]', $statusMsg);
//            }
//        }else{
//            $statusMsg = 'Please select a file to upload.';
//            $this->_f3->set('errors["imgUpload"]', $statusMsg);
//        }
//    }

    function adminpage()
    {
        $view = new Template();
        echo $view->render('views/admin.html');
    }

    /**
     * TODO: Finish writing this and get it to work
     * This is the route to the admin login page. The user enters
     * their login and password and if valid, they are rerouted
     * to the admin page
     * @return void
     */
    function loginroute()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['username'];
            $pw = $_POST['password'];
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';

            if(Validate::checkLogin($user, $pw)){
                echo "valid";
                $this->_f3->reroute('adminpage');
            }
        }
        //$f3->set('username', sha1('syntaxians'));
        //$f3->set('password', sha1('catdog'));
        $view = new Template();
        echo $view->render('views/login.html');
    }

    function showAllPets()
    {
        $view = new Template();
        echo $view->render('views/allPets.html');
    }


}