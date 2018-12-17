<?php
session_start();
//Logged in user
$_SESSION['uid'] = 15;

$db = new PDO('mysql:host =127.0.0.1; dbname = ngauge', 'amaterixen', '');

require 'Classes/addgames.php';

if(isset($_POST['tags'])){
    //Tags are the actions we want to perform: Add someone, block, etc
    if($_POST['tags'] == "addGame"){
        $addgames = new addgames;
        $addgames->addGame($_SESSION['uid'], $_POST['G_ID']);
    }
    else if($_POST['tags'] == "remove"){
        $addgames = new addgames;
        $addgames->remove($_SESSION['uid'], $_POST['G_ID']);
    }
}