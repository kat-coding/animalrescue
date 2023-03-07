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
        $view = new Template();
        echo $view-> render('views/missing.html');
    }

    function resources()
    {
        $view = new Template();
        echo $view-> render('views/resources.html');
    }


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