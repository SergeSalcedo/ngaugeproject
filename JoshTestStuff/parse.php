<?php
session_start();
//Logged in user
$_SESSION['uid'] = 16;

$db = new PDO('mysql:host =127.0.0.1; dbname = ngauge', 'amaterixen', '');

require 'Classes/friends.php';

if(isset($_POST['tags'])){
    //Tags are the actions we want to perform: Add someone, block, etc
    if($_POST['tags'] == "addFriend"){
        $friends = new friends;
        $friends->add($_POST['uid'], $_SESSION['uid']);
    }
    else if($_POST['tags'] == "unfriend"){
        $friends = new friends;
        $friends->unfriend($_POST['uid'], $_SESSION['uid']);
    }
    else if($_POST['tags'] == "accept"){
        $friends = new friends;
        $friends->accept($_POST['uid'], $_SESSION['uid']);
    }
    else if($_POST['tags'] == "ignore"){
        $friends = new friends;
        $friends->ignore($_POST['uid'], $_SESSION['uid']);
    }
}