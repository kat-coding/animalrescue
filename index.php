<?php
//this is the controller, all requests go through this page

//error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require autoload file created by composer
require_once("vendor/autoload.php");

//start session
session_start();

//Create an instance of the base class of fat-free
$f3 = Base::instance();

//Instantiate a controller object
$con = new Controller($f3);
$dataLayer = new DataLayer();
//define default route -> home.html
$f3->route('GET /', function()
{
    $GLOBALS['con']->home();
});

//home route for navbar
$f3->route('GET /home', function()
{
    $GLOBALS['con']->home();
});

//define "About" page route
$f3->route('GET /about', function()
{
    $GLOBALS['con']->about();
});

//define "Available Pets" page route
$f3->route('GET /adoptable', function()
{
    $GLOBALS['con']->availablepets();
});

//define "Found Pets" page route
$f3->route('GET /foundpets', function()
{
    $GLOBALS['con']->foundpets();
});

//define "Missing Pets" page route
$f3->route('GET /missingpets', function ()
{
    $GLOBALS['con']->missingpets();
});

//define "Missing Pets info" page route
$f3->route('GET /missingPostInfo', function ()
{
    $view = new Template();
    echo $view-> render('views/missingPostInfo.html');
});
//define "Resources" page route
$f3->route('GET /resources', function (){

    $view = new Template();
    echo $view-> render('views/resources.html');
});
//

//lostpet form route
$f3->route('GET|POST /lostpet', function ($f3){
    $GLOBALS['con']->lostpet();
});


//summary route
$f3->route('GET /summary', function (){
$view = new Template();
echo $view-> render('views/summary.html');
});

$f3->route('GET /adminpage', function ($f3){
    $GLOBALS['con']->adminpage();
});

//admin login route
$f3->route('GET|POST /loginroute', function(){
    $GLOBALS['con']->loginroute();
});
//run instance of fat-free
$f3->run();
