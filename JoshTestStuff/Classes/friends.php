<?php

class Friends{
    static public function renderFriendShip($user1, $user2, $type){
        if(!empty($user1) && !empty($user2)){
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            switch($type){
                case 'isThereRequestPending';
                    $query = $db->prepare("SELECT * FROM friends WHERE user1 = '".$user1."' AND user2 = '".$user2."' AND friendship_official = '0' OR user1 = '".$user2."' AND user2 = '".$user1."' AND friendship_official = '0'");
                    $query->execute();
                    
                    return $query->rowCount();
                    break;
                case 'isThereFriendShip';
                    $query = $db->prepare("SELECT * FROM friends WHERE user1 = '".$user1."' AND user2 = '".$user2."' AND friendship_official = '1' OR user1 = '".$user2."' AND user2 = '".$user1."' AND friendship_official = '1'");
                    $query->execute();
                    
                    return $query->rowCount();
                    break;
            }
        }
    }
    
    static public function add($uid, $user2){
        
        if(!empty($uid) && !empty($user2)){
            //global $db;
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            $response = array();
            
            $uid = (int) $uid;
            $user2 = (int) $user2;
            
            if($uid != $user2){
                $f = new friends;
                $check = $f->renderFriendShip($uid, $user2, 'isThereFriendShip');
                
                if($check == 0){
                    
                    $insert = $db->prepare("INSERT INTO friends (user1, user2, friendship_official) VALUES ('".$uid."', '".$user2."', '0')");
                    //$insert = $db->prepare("INSERT INTO friends VALUES('',".$uid.", ".$user2.", '0', now())");
                    $insert->execute();
                    
                    //$db = "INSERT INTO user (user1, user2, friendship_official) VALUES ('".$uid."', '".$user2."', '0')";
                    
                    $response['code'] = 1;
                    $response['msg'] = "Request Sent!";
                    echo json_encode($response);
                    return false;
                    
                }
                else{
                    $response['code'] = 0;
                    $response['msg'] = "Already friends!";
                    echo json_encode($response);
                    return false;
                }
            }
            else{
                $response['code'] = 0;
                $response['msg'] = "You can't friend yourself!";
                echo json_encode($response);
                return false;
            }
        }
    }
    
    static public function unfriend($uid, $user2){
        if(!empty($uid) && !empty($user2)){
            //global $db;
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            $response = array();
            
            $uid = (int) $uid;
            $user2 = (int) $user2;
            
            if($uid != $user2){
                $f = new friends;
                $check = $f->renderFriendShip($uid, $user2, 'isThereFriendShip');
                
                if($check == 1){
                    
                    $delete = $db->prepare("DELETE FROM friends WHERE user1 = '".$uid."' AND user2 = '".$user2."' OR user1 = '".$user2."' AND user2 = '".$uid."'");
                    //$insert = $db->prepare("INSERT INTO friends VALUES('',".$uid.", ".$user2.", '0', now())");
                    $delete->execute();
                    
                    //$query = "DELETE * FROM friends WHERE user1 = '".$uid."' AND user2 = '".$user2."' OR user1 = '".$user2."' AND user2 = '".$uid."'";
                    
                    //$db = "INSERT INTO user (user1, user2, friendship_official) VALUES ('".$uid."', '".$user2."', '0')";
                    
                    $response['code'] = 1;
                    $response['msg'] = "Friend Removed!";
                    echo json_encode($response);
                    return false;
                    
                }
                else{
                    $response['code'] = 0;
                    $response['msg'] = "Friend already removed!";
                    echo json_encode($response);
                    return false;
                }
            }
            else{
                $response['code'] = 0;
                $response['msg'] = "Please contact support woah!";
                echo json_encode($response);
                return false;
            }
        }
        
        
        
        /*if(!empty($uid) && !empty($user2)){
            //global $db;
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            $response = array();
            
            $uid = (int) $uid;
            $user2 = (int) $user2;
            
            
            
            //DELETE FROM table_name WHERE condition;
        }*/
    }
    
    static public function accept($uid, $user2){
        if(!empty($uid) && !empty($user2)){
            //global $db;
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            $response = array();
            
            $uid = (int) $uid;
            $user2 = (int) $user2;
            
            if($uid != $user2){
                
                $update = $db->prepare("UPDATE friends SET friendship_official = '1' WHERE user1 = '".$uid."' AND user2 = '".$user2."' OR user1 = '".$user2."' AND user2 = '".$uid."'");
                $update->execute();
                /*$f = new friends;
                $check = $f->renderFriendShip($uid, $user2, 'isThereFriendShip');
                
                if($check == 1){
                    
                    $update = $db->prepare("UPDATE friends SET friendship_official = '1' WHERE user1 = '".$uid."' AND user2 = '".$user2."' OR user1 = '".$user2."' AND user2 = '".$uid."'");
                    $update->execute();
                    
                    
                    $response['code'] = 1;
                    $response['msg'] = "Friend Added!";
                    echo json_encode($response);
                    return false;
                    
                }
                else{
                    $response['code'] = 0;
                    $response['msg'] = "An error has occurred! ".(string)$uid." ".(string)$user2.".";
                    echo json_encode($response);
                    return false;
                }*/
            }
            /*else{
                $response['code'] = 0;
                $response['msg'] = "Please contact support! ".(string)$uid." ".(string)$user2.".";
                echo json_encode($response);
                return false;
            }*/
        }
    }
    
    static public function ignore($uid, $user2){
        if(!empty($uid) && !empty($user2)){
            //global $db;
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            $response = array();
            
            $uid = (int) $uid;
            $user2 = (int) $user2;
            
            if($uid != $user2){
                
                $delete = $db->prepare("DELETE FROM friends WHERE user1 = '".$uid."' AND user2 = '".$user2."' AND friendship_official = 0 OR user1 = '".$user2."' AND user2 = '".$uid."' AND friendship_official = 0");
                $delete->execute();
            }
        }
    }
}