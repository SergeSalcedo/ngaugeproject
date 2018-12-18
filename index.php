<?php include('db_connector.php'); 
    session_start();
    
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
            $ucounty = $fetch['user_county'];
        }
    }
    
    $query = $db->prepare("SELECT * FROM county WHERE county_name = '".$ucounty."'");
    $query->execute();
    
    if($query->rowCount() > 0){
        while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $uprovince = $fetch['province'];
        }
    }

    $query = $db->prepare("
        SELECT * FROM user WHERE user_id IN(
        SELECT user_id FROM user_games WHERE user_id != '".$uid."' AND game_id IN (
        SELECT game_id FROM user_games WHERE user_id = '".$uid."'))"
    );
    $query->execute();
    
    
    $recommendedusers1 = array();
    $recommendedusers2 = array();
    $recommendedusers3 = array();
    if($query->rowCount() > 0){
        while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $id = $fetch['user_id'];
            $name = $fetch['username'];
            $rcounty = $fetch['user_county'];
            
            array_push($recommendedusers3, $id);
            if($ucounty == $rcounty){
                array_push($recommendedusers1, $id);
            }
            $rprovincequery = $db->prepare("SELECT * FROM county WHERE county_name = '".$rcounty."'");
            //$rprovincequery = $db->prepare("SELECT * FROM county");
            $rprovincequery->execute();
            while($fetch = $rprovincequery->fetch(PDO::FETCH_ASSOC)){
                $rprovince = $fetch['province'];
            }
            
            if($uprovince == $rprovince){
                array_push($recommendedusers2, $id);
            }
                //array_push($recommendedusers3, $id);
            
            
        }
        for($n = 0; $n<sizeof($recommendedusers3); $n++){
            for($o = 0; $o<sizeof($recommendedusers2); $o++){
                if($recommendedusers2[$o] == $recommendedusers3[$n]){
                    unset($recommendedusers3[$n]);
                }
            }
        }
        $recommendedusers3 = array_values($recommendedusers3);
        for($p = 0; $p<sizeof($recommendedusers3); $p++){
            for($q = 0; $q<sizeof($recommendedusers1); $q++){
                if($recommendedusers1[$q] == $recommendedusers3[$p]){
                    unset($recommendedusers3[$p]);
                }
            }
        }
        $recommendedusers3 = array_values($recommendedusers3);
        
        for($j = 0; $j<sizeof($recommendedusers2); $j++){
            for($k = 0; $k<sizeof($recommendedusers1); $k++){
                if($recommendedusers1[$k] == $recommendedusers2[$j]){
                    unset($recommendedusers2[$j]);
                    //array_values($recommendedusers2);
                }
            }
        }
        $recommendedusers2 = array_values($recommendedusers2);
    }
    
    $query = $db->query("SELECT username from user WHERE username = '".$_SESSION['username']."'");
    while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $currentuser = $fetch['username'];
        }
    
    /*$query = $db->prepare("
        SELECT * FROM user
        WHERE user_id IN(
        SELECT user_id FROM user_games 
        WHERE user_id != '".$uid."' AND game_id IN (
        SELECT game_id FROM user_games WHERE user_id = '".$uid."'))"
    );
    $query->execute();*/
    
    /*$recommendedusers2 = array();
    if($query->rowCount() > 0){
        while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $id = $fetch['user_id'];
            $name = $fetch['username'];
            $rcounty = $fetch['user_county'];
            //$rprovincequery = $db->prepare("SELECT * FROM county WHERE county_name = '".$rcounty."'");
            $rprovincequery = $db->prepare("SELECT * FROM county");
            while($fetch = $rprovincequery->fetch(PDO::FETCH_ASSOC)){
                $rprovince = $fetch['province'];
            }
            $uprovincequery = $db->prepare("SELECT * FROM county WHERE county_name = '".$ucounty."'");
            while($fetch = $uprovincequery->fetch(PDO::FETCH_ASSOC)){
                $uprovince = $fetch['province'];
            }
            if($uprovince == $rprovince){
                array_push($recommendedusers2, $id);
            }
        }
        for($j = 0; $j<sizeof($recommendedusers2); $j++){
            for($k = 0; k<sizeof($recommendedusers1); $k++){
                if($recommendedusers1[$k] == $recommendedusers2[$j]){
                    unset($recommendedusers2[$j]);
                }
            }
        }
    }*/
                    
    
?>
<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../HomePage/hpagestyle.css" />
    
    <head>
        <title>N-Gauge</title>
        <style>
            .hidden{
                display: none;
            }
        </style>
    </head>
    
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="searchbar">
                    <div class="col-sm-12">
                        <h2 class="imamargin">N-Gauge</h2>
                        <div class="homepbutton">
                            <button type="button" onclick="location.href='mypage.php'" class="btn btn-default btnhome">My Page</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if(isset($_SESSION['success'])): ?>
                <div class = "error success"></div>
                <h3>
                    <?php
                        echo $_SESSION['success'];
                        unset ($_SESSION['success']);
                    ?>
                </h3>
                <?php endif ?>
                
                <?php if(isset($_SESSION['username'])): ?>
                <div class="welcomenote">
                    <p class="imamargin">Welcome, <strong><?php echo $currentuser ?></strong>!
                    <a href = "index.php?logout='1'" method="post" class="button" name = "logout" style = "color: red;"> Logout</a></p>
                </div>
                <?php endif ?>
            </div>
        </div>
        
        <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="leftsidemenus">
                        <div class="profimgbox">
                            <img src="NG.png" alt="NGauge Logo" class="img-thumbnail">
                        </div>
                        <div class="friendrequests">
                                <div class="friendheader">
                                    Friend Requests
                                </div>
                                <div class="friendbody">
                                    <div class="sidescroll">
                                        <?php 
                                            require 'Classes/friends.php';
                                            $request = $db->prepare("SELECT * FROM friends WHERE user1 = '".$uid."' AND friendship_official='0'");
                                            $request->execute();
                                    
                                            if($request->rowCount() > 0){
                                                while($fetch = $request->fetch(PDO::FETCH_ASSOC)){
                                                $user2 = $fetch['user2'];
                                            
                                                $user = $db->prepare("SELECT * FROM user WHERE user_id = '".$user2."'");
                                                $user->execute();
                        
                                                $fetch_user = $user->fetch(PDO::FETCH_ASSOC);
                                                $username = $fetch_user['username'];
                                                
                                                ?>
                                                <div class = "request">
                                                <h4 style = "padding: 0; margin: 0;"><?php echo ucwords($username); ?></h4> has sent you a friend request!</h4>
                                                <button class = "friendBtn accept" data-uid='<?php echo $user2; ?>' data-type = 'accept' >Accept</button>
                                                <button class = "friendBtn ignore" data-uid='<?php echo $user2; ?>' data-type = 'ignore'>Ignore</button>
                                                </div>
                                                <?php
                                                }
                                            }else{
                                                echo "No Requests!";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-5 mx-auto ">
                            <div class="recommendusers">
                                <div class="recommendheader">
                                    Recommended Users
                                </div>
                                <div class="recommendbody">
                                    <div class="scrollmenu">
                                        <div class="recommendeduser">
                                            
                                        </div>
                                        
                                        <div class="recommendeduser">
                                            
                                        </div>
                                        
                                        <div class="recommendeduser">
                                            
                                        </div>
                                        
                                        <h3>In your County:</h3>
                                        <?php
                                        
                                        //require 'Classes/friends.php';
                                        for($i = 0; $i<sizeof($recommendedusers1); $i++ ){
                                            $query = $db->prepare("SELECT * FROM user WHERE user_id = '".$recommendedusers1[$i]."'");
                                            $query->execute();
                                            
                                            //echo $recommendedusers3[0];
                                            
                                            if($query->rowCount() > 0){
                                            while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
                                            $id = $fetch['user_id'];
                                            $username = $fetch['username'];
                                            ?>
                                            <div>
                                                <h4><?php echo $username; ?></h4>
                                                <?php
                                                $gamequery = $db->prepare("SELECT G_Name FROM game WHERE G_ID IN (
                                                                        SELECT game_id FROM user_games WHERE user_id = '".$id."' AND game_id IN (
                                                                        SELECT game_id FROM user_games WHERE user_id = '".$uid."'))");
                                                $gamequery->execute();
                                                ?>
                                                
                                                <p>Plays: <?php while($fetch = $gamequery->fetch(PDO::FETCH_ASSOC)){
                                                                    $sharedgame = $fetch['G_Name'];
                                                                    echo "'".$sharedgame."' ";
                                                                    
                                                                }
                                                            ?>
                                                </p>
                                                <div class="actions">
                                                    <?php
                                                    if($id != $uid){
                                                        if(friends::renderFriendShip($uid, $id, 'isThereRequestPending') == 1){
                                                        ?>
                                                        <button class = "request_pending" disabled>Request Pending</button>
                                                        <?php
                                                        }else{
                                                            if(friends::renderFriendShip($uid, $id, 'isThereFriendShip') == 0){
                                                            ?>
                                                            <button class='friendBtn add' data-uid = '<?php echo $id; ?>' data-type='addfriend'>Add as friend</button>
                                                            <button class = "request_pending hidden" disabled>Request Pending</button>
                                                            <?php
                                                            }else{
                                                                ?>
                                                                <button class='friendBtn unfriend' data-uid='<?php echo $id; ?>' data-type = 'unfriend'>Unfriend</button>
                                                                <button class='friendBtn add hidden' data-uid = '<?php echo $id; ?>' data-type='addfriend'>Add as friend</button>
                                                                <button class = "request_pending hidden" disabled>Request Pending</button>
                                                            <?php 
                                                            }
                                                        }
                                                    }else{
                                                        //Display requests
                                                        $request = $db->prepare("SELECT * FROM friends WHERE user1 = '".$uid."' AND friendship_official='0'");
                                                        $request->execute();
                                
                                                        if($request->rowCount() > 0){
                                                            while($fetch = $request->fetch(PDO::FETCH_ASSOC)){
                                                                $user2 = $fetch['user2'];
                                        
                                                                $user = $db->prepare("SELECT * FROM user WHERE user_id = '".$user2."'");
                                                                $user->execute();
                                        
                                                                $fetch_user = $user->fetch(PDO::FETCH_ASSOC);
                                                                $username = $fetch_user['username'];
                                                                ?>
                                                                <div class = "request">
                                                                <h4 style = "padding: 0; margin: 0;"><?php echo ucwords($username); ?></h4> has sent you a friend request!</h4>
                                                                <button class = "friendBtn accept" data-uid='<?php echo $user2; ?>' data-type = 'accept'>Accept</button>
                                                                <button class = "friendBtn ignore" data-uid='<?php echo $user2; ?>' data-type = 'ignore'>Ignore</button>
                                                                </div>
                                                                <?php
                                                            }
                                                        }else{
                                                            echo "No Requests!";
                                                        }
                                                    }
                            
                                                    ?>
                                                    </div>
                                                    </div>
                                                    <?php
                                                }
                                            }else{
                                                echo "No users to recommend!";
                                            }
                                        }
                                        ?>
                                        <h3>In your Province:</h3>
                                        
                                        <?php
                                        for($l = 0; $l<sizeof($recommendedusers2); $l++ ){
                                            $query = $db->prepare("SELECT * FROM user WHERE user_id = '".$recommendedusers2[$l]."'");
                                            $query->execute();
                                            
                                            //echo $recommendedusers2[0];
                                            
                                            if($query->rowCount() > 0){
                                            while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
                                            $id = $fetch['user_id'];
                                            $username = $fetch['username'];
                                            ?>
                                            <div>
                                                <h4><?php echo $username; ?></h4>
                                                <?php
                                                /*$query = $db->prepare("
                                                    SELECT * FROM user WHERE user_id IN(
                                                    SELECT user_id FROM user_games WHERE user_id != '".$uid."' AND game_id IN (
                                                    SELECT game_id FROM user_games WHERE user_id = '".$uid."'))"
                                                    );
                                                $query->execute();*/
                                                
                                                $gamequery = $db->prepare("
                                                                        SELECT * FROM game WHERE G_ID IN (
                                                                        SELECT game_id FROM user_games WHERE user_id = '".$id."' AND game_id IN (
                                                                        SELECT game_id FROM user_games WHERE user_id = '".$uid."'))"
                                                                    );
                                                $gamequery->execute();
                                                ?>
                                                
                                                <p>Plays: <?php while($fetch = $gamequery->fetch(PDO::FETCH_ASSOC)){
                                                                    $sharedgame = $fetch['G_Name'];
                                                                    echo "'".$sharedgame."' ";
                                                                    
                                                                }
                                                            ?>
                                                </p>
                                                <div class="actions">
                                                    <?php
                                                    if($id != $uid){
                                                        if(friends::renderFriendShip($uid, $id, 'isThereRequestPending') == 1){
                                                        ?>
                                                        <button class = "request_pending" disabled>Request Pending</button>
                                                        <?php
                                                        }else{
                                                            if(friends::renderFriendShip($uid, $id, 'isThereFriendShip') == 0){
                                                            ?>
                                                            <button class='friendBtn add' data-uid = '<?php echo $id; ?>' data-type='addfriend'>Add as friend</button>
                                                            <button class = "request_pending hidden" disabled>Request Pending</button>
                                                            <?php
                                                            }else{
                                                                ?>
                                                                <button class='friendBtn unfriend' data-uid='<?php echo $id; ?>' data-type = 'unfriend'>Unfriend</button>
                                                                <button class='friendBtn add hidden' data-uid = '<?php echo $id; ?>' data-type='addfriend'>Add as friend</button>
                                                                <button class = "request_pending hidden" disabled>Request Pending</button>
                                                            <?php 
                                                            }
                                                        }
                                                    }
                            
                                                    ?>
                                                    </div>
                                                    </div>
                                                    <?php
                                                }
                                            }else{
                                                echo "No users to recommend!";
                                            }
                                        }
                                        ?>
                                        <h3>In your Country:</h3>
                                        <?php
                                        for($m = 0; $m<sizeof($recommendedusers3); $m++ ){
                                            $query = $db->prepare("SELECT * FROM user WHERE user_id = '".$recommendedusers3[$m]."'");
                                            $query->execute();
                                            
                                            //echo $recommendedusers3[0];
                                            
                                            if($query->rowCount() > 0){
                                                while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
                                                $id = $fetch['user_id'];
                                                $username = $fetch['username'];
                                            ?>
                                            <div>
                                                <h4><?php echo $username; ?></h4>
                                                <?php
                                                $gamequery = $db->prepare("
                                                                        SELECT * FROM game WHERE G_ID IN (
                                                                        SELECT game_id FROM user_games WHERE user_id = '".$id."' AND game_id IN (
                                                                        SELECT game_id FROM user_games WHERE user_id = '".$uid."'))"
                                                                    );
                                                $gamequery->execute();
                                                ?>
                                                
                                                <p>Plays: <?php while($fetch = $gamequery->fetch(PDO::FETCH_ASSOC)){
                                                                    $sharedgame = $fetch['G_Name'];
                                                                    echo "'".$sharedgame."' ";
                                                                    
                                                                }
                                                            ?>
                                                </p>
                                                <div class="actions">
                                                    <?php
                                                    if($id != $uid){
                                                        if(friends::renderFriendShip($uid, $id, 'isThereRequestPending') == 1){
                                                        ?>
                                                        <button class = "request_pending" disabled>Request Pending</button>
                                                        <?php
                                                        }else{
                                                            if(friends::renderFriendShip($uid, $id, 'isThereFriendShip') == 0){
                                                            ?>
                                                            <button class='friendBtn add' data-uid = '<?php echo $id; ?>' data-type='addfriend'>Add as friend</button>
                                                            <button class = "request_pending hidden" disabled>Request Pending</button>
                                                            <?php
                                                            }else{
                                                                ?>
                                                                <button class='friendBtn unfriend' data-uid='<?php echo $id; ?>' data-type = 'unfriend'>Unfriend</button>
                                                                <button class='friendBtn add hidden' data-uid = '<?php echo $id; ?>' data-type='addfriend'>Add as friend</button>
                                                                <button class = "request_pending hidden" disabled>Request Pending</button>
                                                            <?php 
                                                            }
                                                        }
                                                    }
                            
                                                    ?>
                                                    </div>
                                                    </div>
                                                    <?php
                                                }
                                            }else{
                                                echo "No users to recommend!";
                                            }
                                        }
                                        /*$query = $db->prepare("SELECT * FROM user");
                                        $query->execute();
                            
                                        if($query->rowCount() > 0){
                                            while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
                                            $id = $fetch['user_id'];
                                            $username = $fetch['username'];
                                            ?>
                                            <div>
                                                <h3><?php echo $username; ?></h3>
                                                <div class="actions">
                                                    <?php
                                                    if($id != $uid){
                                                        if(friends::renderFriendShip($uid, $id, 'isThereRequestPending') == 1){
                                                        ?>
                                                        <button class = "request_pending" disabled>Request Pending</button>
                                                        <?php
                                                        }else{
                                                            if(friends::renderFriendShip($uid, $id, 'isThereFriendShip') == 0){
                                                            ?>
                                                            <button class='friendBtn add' data-uid = '<?php echo $id; ?>' data-type='addfriend'>Add as friend</button>
                                                            <button class = "request_pending hidden" disabled>Request Pending</button>
                                                            <?php
                                                            }else{
                                                                ?>
                                                                <button class='friendBtn unfriend' data-uid='<?php echo $id; ?>' data-type = 'unfriend'>Unfriend</button>
                                                                <button class='friendBtn add hidden' data-uid = '<?php echo $id; ?>' data-type='addfriend'>Add as friend</button>
                                                                <button class = "request_pending hidden" disabled>Request Pending</button>
                                                            <?php 
                                                            }
                                                        }
                                                    }
                            else{
                                //Display requests
                                $request = $db->prepare("SELECT * FROM friends WHERE user1 = '".$uid."' AND friendship_official='0'");
                                $request->execute();
                                
                                if($request->rowCount() > 0){
                                    while($fetch = $request->fetch(PDO::FETCH_ASSOC)){
                                        $user2 = $fetch['user2'];
                                        
                                        $user = $db->prepare("SELECT * FROM user WHERE user_id = '".$user2."'");
                                        $user->execute();
                                        
                                        $fetch_user = $user->fetch(PDO::FETCH_ASSOC);
                                        $username = $fetch_user['username'];
                                        ?>
                                        <div class = "request">
                                            <h4 style = "padding: 0; margin: 0;"><?php echo ucwords($username); ?></h4> has sent you a friend request!</h4>
                                            <button class = "friendBtn accept" data-uid='<?php echo $user2; ?>' data-type = 'accept'>Accept</button>
                                            <button class = "friendBtn ignore" data-uid='<?php echo $user2; ?>' data-type = 'ignore'>Ignore</button>
                                        </div>
                                        <?php
                                    }
                                }
                                else{
                                    echo "No Requests!";
                                }
                            }
                            
                        ?>
                    </div>
                </div>
                <?php
            }
        }else{
            echo "fuck";
        }*/
        ?>
                                        
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                    <div class="col-xs-4">
                            <div class="gamesbox">
                                <div class="gamesheader">
                                    Your Games
                                </div>
                                <div class="gamesearch">
                                    <form name="search" method="post" action="index.php" class="formsize">
                                        <input name="search" type="text" class="searchentry"/>
                                        <input name="submit" type="submit" value="Search" class="submitbox"/>
                                    </form>
                                </div>
                                <div class="gamesbody">
                                    <?php
                                        require 'Classes/addgames.php';
                                        $gamesearch = $db->prepare("SELECT * FROM game WHERE G_Name LIKE '%".$_POST['search']."%'");
                                        $gamesearch->execute();
    
                                        if($gamesearch->rowCount() > 0){
                                            while($fetch = $gamesearch->fetch(PDO::FETCH_ASSOC)){
                                                $g_id = $fetch['G_ID'];
                                                $gamename = $fetch['G_Name'];
                                                ?>
                                            <div>
                                                <h4><?php echo $gamename; ?></h4>
                                                <div class="actions">
                                                    <?php
                                                        if(addgames::renderPlayedGame($uid, $g_id, 'isGameAdded') == 0){
                                                            ?>
                                                                <button class='gameBtn addGame' data-gid = '<?php echo $g_id; ?>' data-type='addgame'>Add game</button>
                                                                <button class = "game_added hidden" disabled>Game Added!</button>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <button class='gameBtn remove' data-gid='<?php echo $g_id; ?>' data-type = 'remove'>Remove</button>
                                                                <button class='gameBtn addGame hidden' data-g_id = '<?php echo $g_id; ?>' data-type='addgame'>Add game</button>
                                                                <button class = "game_added hidden" disabled>Game Added!</button>
                                                            <?php 
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        }else{
                                            echo "No games found! error: 501";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                </div>
                
        </div>
        
        <!--<script>
            $(document).ready(function(){
                $('#search_text').keyup(function(){
                    var txt = $(this).val();
                    if(txt != ''){
                        
                    }
                    else{
                        $('#result').html('');
                        $.ajax({
                            url:"searchresults.php",
                            method:"post",
                            data:{search:txt},
                            dataType:"text",
                            success:function(data){
                                $('#result').html(data);
                            }
                        });
                    }
                });
            });
        </script>-->
        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src='js/friends.js'></script>
        <script src='js/addgames.js'></script>
    </body>
    <footer class="fixed-bottom">
        <div class="iamfooter">
            © Team Melon: Joshua Cassidy, Serge Salcedo, Gaile Orprecio, Ciaran Brady
        </div>
    </footer>
</html>