<?php
session_start();
require_once './Event.php';
$Event=new Event($_GET, $_POST);


$MODEL="Model";
require_once $MODEL.'/Model.php';
require_once $MODEL.'/HomeModel.php';
require_once $MODEL.'/MissionModel.php';
require_once $MODEL.'/TodolistModel.php';

$VIEW="View";
require_once $VIEW."/KSmarty.php";


$CONTROLLER="Controller";
require_once $CONTROLLER.'/Controller.php';
$Controller=new Controller($Event);
$Controller->doAction();





?>

