<?php
//controller/controller.php
class Controller
{
    //first field is fatfree oject/router
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * @return void
     * Routing functions for pages within site
     */
    function home()
    {
        $view = new Template();
        echo $view-> render('views/home.html');
    }
    function about()
    {
        $view = new Template();
        echo $view-> render('views/about.html');
    }
    function availablepets()
    {
        $availablepets= $GLOBALS['dataLayer']->getavailablepets();
        $this->_f3->set('availablepets', $availablepets);
        echo "<pre>";
        var_dump($_POST);
        var_dump($availablepets);
        echo "</pre>";
        $view = new Template();
        echo $view-> render('views/adoptable.html');
    }
    function foundpets()
    {
        $view = new Template();
        echo $view-> render('views/found.html');
    }
    function missingpets()
    {
        //Get the data from the model
        $lost= $GLOBALS['dataLayer']->getLostPets();
        $this->_f3->set('LostPets', $lost);
        echo "<pre>";
        var_dump($_POST);
        var_dump($lost);
        echo "</pre>";
        $view = new Template();
        echo $view-> render('views/missing.html');
    }

    function resources()
    {
        $view = new Template();
        echo $view-> render('views/resources.html');
    }


    function lostpet($_f3)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $newLostPet = new LostPet();

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
            $newLostPet->setDescription($description);
            $newLostPet->setDateMissing($dateMissing);
            //set owners name to object
            if(Validate::validName($fname) & Validate::validName($lname)){
                $ownerName = $fname." ".$lname;
                $newLostPet->setOwnerName($ownerName);
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
                $newLostPet->setName($pname);
            }else {
                $this->_f3->set('errors["pname"]', 'Invalid name');
            }
            //set email to object
            if (Validate::validEmail($email)){
                $newLostPet->setEmail($email);
            }else{
                $this->_f3->set('errors["email"]', 'Email is invalid');
            }
            //set state to object
            if (Validate::validState($state)){
                $newLostPet->setState($state);
            }else{
                $this->_f3->set('errors["state"]', 'State must be selected');
            }
            //set city to object
            if(Validate::validCity($city)){
                $newLostPet->setCity($city);
            }else{
                $this->_f3->set('errors["city"]', 'Invalid city');
            }
            //set phone to object
            if (Validate::validPhone($phone)){
                $newLostPet->setPhone($phone);
            }else{
                $this->_f3->set('errors["phone"]', 'Phone number is invalid');
            }
            //set species
            if(Validate::validSpecies($species)){
                $newLostPet->setSpecies($species);
            }else{
                $this->_f3->set('errors["species"]', 'Species is invalid');
            }
            //set age
            if(Validate::validAge($age)){
                $newLostPet->setAge($age);
            }else{
                $this->_f3->set('errors["age"]', 'Age must be 1-2 digit number');
            }
            //set set to object
            if(Validate::validSex($sex)){
                $newLostPet->setSex($sex);
            }else{
                $this->_f3->set('errors["sex"]', 'Invalid sex');
            }
            //set date missing to object
            if(Validate::validMissingDate($dateMissing)){
                $newLostPet->setDateMissing($dateMissing);
            }else{
                $this->_f3->set('errors["datemissing"]', 'Invalid date');
            }
            //if image uploaded run the upload function in controller
            if(!empty($_FILES["file"]["name"])) {
                $imgURL = Upload::uploadImage($_f3);
                if(Validate::validIMGURL($imgURL)){
                    $newLostPet->setImgUrl($imgURL);
                }else{
                    $newLostPet->setImgUrl(substr($imgURL, 0, 10));
                }
                //ELSE{ errors set in uploadImage() function based on the error}
            }else{
                $newLostPet->setImgUrl("upload-img/generic.png");
            }


            if(empty($this->_f3->get('errors'))) {
                $_SESSION['newLostPet'] = $newLostPet;
                $this->_f3->reroute('summary');
            }
        }
        $this->_f3->set("states", Datalayer::getState());
        $view = new Template();
        echo $view-> render('views/lostpet.html');
    }
    function summary()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->_f3->reroute('submit');

        }
        else {
            $view = new Template();
            echo $view->render('views/summary.html');
//        var_dump($_SESSION);
        }

    }
    function submit()
    {
        $GLOBALS['dataLayer']->addLostPet($_SESSION['newLostPet']);
        session_destroy();
        $this->_f3->reroute('missingpets');
    }

    /**
     * uploadImage function for client image uploads
     * @return void uploads images to upload-img directory
     *
     * THIS WAS MOVED TO UPLOAD CLASS
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
//            $allowTypes = array('jpg','png','jpeg','gif','pdf');
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
//                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
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


    function loginroute()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(checkLogin()){
                $this->_f3->reroute('adminpage');
            }

        }
       // $this->_f3->set('username', sha1('syntaxians'));
        //$this->_f3->set('password', sha1('catdog'));
        $view = new Template();
        echo $view->render('views/login.html');
    }

    function newShelterPet()
    {
        $view = new Template();
        echo $view->render('views/addShelterPet.html');
    }

    function confirm()
    {
        $view = new Template();
        echo $view->render('views/addShelterPet.html');
    }

}