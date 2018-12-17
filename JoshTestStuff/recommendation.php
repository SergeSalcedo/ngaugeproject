<?php
    /*$db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
    $query = $db->prepare("SELECT * FROM user WHERE username = '".$_SESSION['username']."'");
    $query->execute();
    
    if($query->rowCount() > 0){
        while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $uid = $fetch['user_id'];
        }
    }*/
    
    /*session_start();
    $_SESSION['uid'] = 17;
    
    $uid = $_SESSION['uid'];*/
    
    /*$db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');*/
    
    /*$mygames = $db->prepare("SELECT game_id FROM user_games WHERE user_id = '".$uid."'");
    $mygames->execute();
    
    
    $potentialfriends = $db->prepare("SELECT user_id FROM user_games WHERE game_id");
    $potentialfriends->execute();*/
    
    
    
    //Put together version of the two above
    /*$query = $db->prepare("
        SELECT user_id FROM user_games 
        WHERE user_id != '".$uid."' AND game_id IN (
            SELECT game_id FROM user_games WHERE user_id = '".$uid."')
    ");
    $query->execute();*/
    
    /*$query = $db->prepare("
        SELECT * FROM user
        WHERE user_id IN(
        SELECT user_id FROM user_games 
        WHERE user_id != '".$uid."' AND game_id IN (
            SELECT game_id FROM user_games WHERE user_id = '".$uid."')
    )");
    $query->execute();*/
    
    $queryRecommendations = $db->prepare("
        SELECT * FROM user
        WHERE user_id IN(
        SELECT user_id FROM user_games 
        WHERE user_id != '".$uid."' AND game_id IN (
            SELECT game_id FROM user_games WHERE user_id = '".$uid."')
    )");
    $queryRecommendations->execute();
    
    if($queryRecommendations->rowCount() > 0){
        while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $rid = $fetch['user_id'];
            $rname = $fetch['username'];
            $rcounty = $fetch['user_county'];
        }
    }
    
    if($queryUser->rowCount() > 0){
        while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $id = $fetch['user_id'];
            $name = $fetch['username'];
            
            
        
        }
    }
  
    
?>