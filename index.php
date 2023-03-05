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

//admin login route
$f3->route('GET /loginroute', function(){
    $view = new Template();
    echo $view->render('views/login.html');
});
//run instance of fat-free
$f3->run();
