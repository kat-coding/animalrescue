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
     * @return void
     * default route which renders the home page for the website
     */
    function home()
    {
        $view = new Template();
        echo $view-> render('views/home.html');
    }

    /**
     * Route which renders the "about" page of the site
     * @return void
     */
    function about()
    {
        $view = new Template();
        echo $view-> render('views/about.html');
    }

    /**
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
        echo "<pre>";
        var_dump($_GET);
        var_dump($_POST);
        echo "</pre>";
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
     * This function renders the page where the user can enter
     * their lost pet info. It validates all of the information that
     * is provided and displays the States drop down menu. If all data
     * is validated, it reroutes to the summary page
     * @return void
     */
    function lostpet()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $state = $_POST['state'];
            $phone = $_POST['phone'];
            $imgURL = "";
            $statusMsg = "";

            if (validName($fname)){
                $_SESSION['fname'] = $fname;
            }else{
                $this->_f3->set('errors["fname"]', 'First name is invalid');
            }

            if (validName($lname)){
                $_SESSION['lname'] = $lname;
            }else{
                $this->_f3->set('errors["lname"]', 'Last name is invalid');
            }

            if (validEmail($email)){
                $_SESSION['email'] = $email;
            }else{
                $this->_f3->set('errors["email"]', 'Email is invalid');
            }

            if (validState($state)){
                $_SESSION['state'] = $state;
            }else{
                $this->_f3->set('errors["state"]', 'State must be selected');
            }

            if (validPhone($phone)){
                $_SESSION['phone'] = $phone;
            }else{
                $this->_f3->set('errors["phone"]', 'Phone number is invalid');
            }
            //if image uploaded run the upload function in controller
            if(!empty($_FILES["file"]["name"])) {
                $this->uploadImage();
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
     * This is the summary page for the lost pets form
     * It renders summary.html which offers the user the opportunity
     * to check the information they added and submit it.
     * @return void
     */
    function summary()
    {
//        var_dump($_SESSION);
        $view = new Template();
        echo $view-> render('views/summary.html');
    }

    /**
     * uploadImage function for client image uploads
     * @return void uploads images to upload-img directory
     */
    function uploadImage()
    {
        $targetDir = "upload-img/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $_SESSION['file']= $_FILES["file"]["name"];
        if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
            //allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            if(in_array($fileType, $allowTypes)){
                //upload file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    $statusMsg = "The file ".$fileName. " has been uploaded.";
                    $_SESSION['imgURL'] = $targetFilePath;

                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                    $this->_f3->set('errors["imgUpload"]', $statusMsg);
                }
            }else{
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                $this->_f3->set('errors["imgUpload"]', $statusMsg);
            }
        }else{
            $statusMsg = 'Please select a file to upload.';
            $this->_f3->set('errors["imgUpload"]', $statusMsg);
        }
    }

    /**
     * TODO: Finish writing this and get it to work
     * This is the route to the admin login page. The user enters
     * their login and password and if valid, they are rerouted
     * to the admin page
     * @param $f3
     * @return void
     */
    function loginroute($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo 'You want to go to admin page.';
        }
        $f3->set('username', sha1('syntaxians'));
        $f3->set('password', sha1('catdog'));
        $view = new Template();
        echo $view->render('views/login.html');
    }
}