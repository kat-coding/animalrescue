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
//require '/home/katheri9/db.php';
//require model files
require_once("model/datalayer.php");
require_once("model/validate.php");

//Create an instance of the base class of fat-free
$f3 = Base::instance();
//initiate controller object
$con = new Controller($f3);


//define default route -> home.html
$f3->route('GET /', function (){
    $GLOBALS["con"]->home();
});

//home route for navbar
$f3->route('GET /home', function (){
    $GLOBALS["con"]->home();
});

//define "About" page route
$f3->route('GET /about', function (){
    $GLOBALS["con"]->about();
});

//define "Available Pets" page route
$f3->route('GET /availablepets', function (){
    $GLOBALS["con"]->availablepets();
});

//define "Found Pets" page route
$f3->route('GET /foundpets', function (){
    $GLOBALS["con"]->foundpets();
});

//define "Resources" page route
$f3->route('GET /resources', function (){
    $GLOBALS["con"]->resources();
});


//lost pet form route
$f3->route('GET|POST /lostpet', function ($f3){
    $GLOBALS["con"]->lostpet();
});

$f3->route('GET|POST /summary', function (){
    //TODO change summary function when summary page finished
    $GLOBALS["con"]->summary();
});

//run instance of fat-free
$f3->run();
