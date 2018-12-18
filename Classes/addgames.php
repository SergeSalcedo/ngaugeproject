<?php

class addgames{
    static public function renderPlayedGame($user, $game, $type){
        if(!empty($user) && !empty($game)){
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            switch($type){
                /*case 'isThereRequestPending';
                    $query = $db->prepare("SELECT * FROM friends WHERE user1 = '".$user1."' AND user2 = '".$user2."' AND friendship_official = '0' OR user1 = '".$user2."' AND user2 = '".$user1."' AND friendship_official = '0'");
                    $query->execute();
                    
                    return $query->rowCount();
                    break;*/
                case 'isGameAdded';
                    $query = $db->prepare("SELECT * FROM user_games WHERE user_id = '".$user."' AND game_id = '".$game."'");
                    $query->execute();
                    
                    return $query->rowCount();
                    break;
            }
        }
    }
    
    static public function addGame($uid, $g_id){
        
        if(!empty($uid) && !empty($g_id)){
            //global $db;
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            $response = array();
            
            $uid = (int) $uid;
            $g_id = (string) $g_id;
            
            
                $g = new addgames;
                $check = $g->renderPlayedGame($uid, $g_id, 'isGameAdded');
                
                if($check == 0){
                    
                    $insert = $db->prepare("INSERT INTO user_games (user_id, game_id) VALUES ('".$uid."', '".$g_id."')");
                    //$insert = $db->prepare("INSERT INTO friends VALUES('',".$uid.", ".$user2.", '0', now())");
                    $insert->execute();
                    
                    //$db = "INSERT INTO user (user1, user2, friendship_official) VALUES ('".$uid."', '".$user2."', '0')";
                    
                    $response['code'] = 1;
                    $response['msg'] = "Game Added!";
                    echo json_encode($response);
                    return false;
                    
                }
                else{
                    $response['code'] = 0;
                    $response['msg'] = "Already added!";
                    echo json_encode($response);
                    return false;
                }
            }
            
        }
    
    static public function remove($uid, $g_id){
        if(!empty($uid) && !empty($g_id)){
            //global $db;
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            $response = array();
            
            $uid = (int) $uid;
            $g_id = (string) $g_id;
            
            
                $g = new addgames;
                $check = $g->renderPlayedGame($uid, $g_id, 'isGameAdded');
                
                if($check == 1){
                    
                    $delete = $db->prepare("DELETE FROM user_games WHERE user_id = '".$uid."' AND game_id = '".$g_id."'");
                    //$insert = $db->prepare("INSERT INTO friends VALUES('',".$uid.", ".$user2.", '0', now())");
                    $delete->execute();
                    
                    //$query = "DELETE * FROM friends WHERE user1 = '".$uid."' AND user2 = '".$user2."' OR user1 = '".$user2."' AND user2 = '".$uid."'";
                    
                    //$db = "INSERT INTO user (user1, user2, friendship_official) VALUES ('".$uid."', '".$user2."', '0')";
                    
                    $response['code'] = 1;
                    $response['msg'] = "Game Removed!";
                    echo json_encode($response);
                    return false;
                    
                }
                else{
                    $response['code'] = 0;
                    $response['msg'] = "Game already removed!";
                    echo json_encode($response);
                    return false;
                }
            
        }
    }
}