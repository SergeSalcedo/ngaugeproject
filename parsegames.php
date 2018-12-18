<?php
include('db_connector.php'); 
session_start();
//Logged in user

if(!isset($_SESSION['username'])){
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
  	    session_destroy();
  	    unset($_SESSION['username']);
  	    header("location: login.php");
    }
    
    $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
    $query = $db->prepare("SELECT * FROM user WHERE username = '".$_SESSION['username']."'");
    $query->execute();
    
    if($query->rowCount() > 0){
        while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $uid = $fetch['user_id'];
        }
    }

$db = new PDO('mysql:host =127.0.0.1; dbname = ngauge', 'amaterixen', '');

require 'Classes/addgames.php';

if(isset($_POST['tags'])){
    //Tags are the actions we want to perform: Add someone, block, etc
    if($_POST['tags'] == "addGame"){
        $addgames = new addgames;
        $addgames->addGame($uid, $_POST['G_ID']);
    }
    else if($_POST['tags'] == "remove"){
        $addgames = new addgames;
        $addgames->remove($uid, $_POST['G_ID']);
    }
}