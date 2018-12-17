<html>
    <head>
        <style>
            .hidden{
                display: none;
            }
        </style>
    </head>
    <body>
        <?php
            //Make the session
            session_start();
            $_SESSION['uid'] = 16;
            
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            require 'Classes/friends.php';
            $query = $db->prepare("SELECT * FROM user");
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
                            if($id != $_SESSION['uid']){
                                if(friends::renderFriendShip($_SESSION['uid'], $id, 'isThereRequestPending') == 1){
                                 ?>
                                     <button class = "request_pending" disabled>Request Pending</button>
                                 <?php
                                }else{
                                    if(friends::renderFriendShip($_SESSION['uid'], $id, 'isThereFriendShip') == 0){
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
                                $request = $db->prepare("SELECT * FROM friends WHERE user1 = '".$_SESSION['uid']."' AND friendship_official='0'");
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
        }
        ?>
        
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src='/js/friends.js'></script>
    </body>
</html>