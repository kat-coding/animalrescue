<?php
//this is the controller, all requests go through this page

//error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//start session
session_start();

//require autoload file created by composer
require_once("vendor/autoload.php");

//Create an instance of the base class of fat-free
$f3 = Base::instance();


//define default route -> home.html
$f3->route('GET /', function (){

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


//application form route
$f3->route('GET|POST /apply', function ($f3){

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$_SESSION['name'] = $_POST['name'];
$_SESSION['age'] = $_POST['age'];

$f3->reroute('summary');
}

$view = new Template();
echo $view-> render('views/apply.html');
});

//order form route
$f3->route('GET /summary', function (){
$view = new Template();
echo $view-> render('views/summary.html');
});

//run instance of fat-free
$f3->run();
