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
            $_SESSION['uid'] = 15;
            
            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
            
            require 'Classes/addgames.php';
            $query = $db->prepare("SELECT * FROM game");
            $query->execute();
    
            if($query->rowCount() > 0){
                while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
                    $g_id = $fetch['G_ID'];
                    $gamename = $fetch['G_Name'];
                    ?>
                <div>
                    <h3><?php echo $gamename; ?></h3>
                    <div class="actions">
                        <?php
                            if(addgames::renderPlayedGame($_SESSION['uid'], $g_id, 'isGameAdded') == 0){
                                ?>
                                    <button class='gameBtn addGame' data-gid = '<?php echo $g_id; ?>' data-type='addgame'>Add game</button>
                                    <button class = "game_added hidden" disabled>Game Added!</button>
                                <?php
                            }else{
                                ?>
                                    <button class='gameBtn remove' data-gid='<?php echo $g_id; ?>' data-type = 'remove'>Remove</button>
                                    <button class='gameBtn addGame hidden' data-g_id = '<?php echo $g_id; ?>' data-type='addgame'>Add as friend</button>
                                    <button class = "game_added hidden" disabled>Game Added!</button>
                                <?php 
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
        <script src='js/addgames.js'></script>
    </body>
</html>