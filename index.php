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
$f3->route('GET /missingPostInfo', function ($f3)
{
    $GLOBALS['con']->missingPetInfo($f3);

});
//define "Resources" page route
$f3->route('GET /resources', function (){

    $view = new Template();
    echo $view-> render('views/resources.html');
});

//lost pet form route
$f3->route('GET|POST /lostpet', function ($f3){
    $GLOBALS['con']->lostpet($f3);
});

//summary lost pet route
$f3->route('GET|POST /summary', function ($dataLayer){
    $GLOBALS['con']->summary($dataLayer);
});
//submit lost pet route
$f3->route('GET|POST /submit', function ($dataLayer){
    $GLOBALS['con']->submit($dataLayer);
});

//admin add new shelter pet route
$f3->route('GET|POST /shelterPet', function($f3){
    $GLOBALS['con']->shelterPet($f3);
});

//summary shelter pet route
$f3->route('GET|POST /spsummary', function ($dataLayer){
    $GLOBALS['con']->spsummary($dataLayer);
});
//submit shelter pet route
$f3->route('GET|POST /spsubmit', function ($dataLayer){
    $GLOBALS['con']->spsubmit($dataLayer);
});
//route to admin page
$f3->route('GET /adminpage', function ($f3){
    $GLOBALS['con']->adminpage();
});
//admin login route--not working yet
$f3->route('GET|POST /loginroute', function(){
    $GLOBALS['con']->loginroute();
});
//admin show all pets
$f3->route('GET|POST /showAllPets', function(){
    $GLOBALS['con']->showAllPets();
});

//run instance of fat-free
$f3->run();
