<?php
//this is the controller, all requests go through this page

//error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//start session
session_start();

//require autoload file created by composer
require_once("vendor/autoload.php");
//require database file
// NOTE: This will be different for each member's version of the site.
require '/home/katheri9/db.php';
//require model files
require_once("model/datalayer.php");
require_once("model/validate.php");

//Create an instance of the base class of fat-free
$f3 = Base::instance();


//define default route -> home.html
$f3->route('GET /', function (){

$view = new Template();
echo $view-> render('views/home.html');
});

//home route for navbar
$f3->route('GET /home', function (){

    $view = new Template();
    echo $view-> render('views/home.html');
});

//define "About" page route
$f3->route('GET /about', function (){

$view = new Template();
echo $view-> render('views/about.html');
});

//define "Available Pets" page route
$f3->route('GET /availablepets', function (){

$view = new Template();
echo $view-> render('views/availablepets.html');
});

//define "Found Pets" page route
$f3->route('GET /foundpets', function (){

    $view = new Template();
    echo $view-> render('views/foundpets.html');
});

//define "Resources" page route
$f3->route('GET /resources', function (){

    $view = new Template();
    echo $view-> render('views/resources.html');
});


//lost pet form route
$f3->route('GET|POST /lostpet', function ($f3){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        $phone = $_POST['phone'];

        if (validName($fname)){
            $_SESSION['fname'] = $fname;
        }else{
        $f3->set('errors["fname"]', 'First name is invalid');
        }

        if (validName($lname)){
            $_SESSION['lname'] = $lname;
        }else{
            $f3->set('errors["lname"]', 'Last name is invalid');
        }

        if (validEmail($email)){
            $_SESSION['email'] = $email;
        }else{
            $f3->set('errors["email"]', 'Email is invalid');
        }

        if (validState($state)){
            $_SESSION['state'] = $state;
        }else{
        $f3->set('errors["state"]', 'State must be selected');
        }

        if (validPhone($phone)){
            $_SESSION['phone'] = $phone;
        }else{
            $f3->set('errors["phone"]', 'Phone number is invalid');
        }

        if(empty($f3->get('errors'))) {
            $f3->reroute('summary');
        }
    }
    $f3->set("states", getState());
    $view = new Template();
    echo $view-> render('views/lostpet.html');
});

//run instance of fat-free
$f3->run();
