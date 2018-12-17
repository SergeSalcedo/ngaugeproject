<?php include('db_connector.php'); 
    session_start();
    
    if(!isset($_SESSION['username'])){
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
  	    session_destroy();
  	    unset($_SESSION['username']);
  	    //unset($_SESSION['uid']);
  	    header("location: login.php");
    }
    
    $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
    $query = $db->prepare("SELECT * FROM user WHERE username = '".$_SESSION['username']."'");
    $query->execute();
    
    if($query->rowCount() > 0){
        while($fetch = $query->fetch(PDO::FETCH_ASSOC)){
            $id = $fetch['user_id'];
        }
    }
    
    
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <head>
        <title>N-Gauge</title>
    </head>
    
    <body>
        <div class = "header">
            <h1>Welcome to N-Gauge</h1>
            <h2>Home page</h2>
        </div>
        
        <div class = "content">
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
                <p>Welcome, <strong><?php echo $_SESSION['username']; ?></strong>!</p>
                <p><a href = "index.php?logout='1'" method="post" class="button" name = "logout" style = "color: red;">Logout</a></p>
                <?php echo $_SESSION['uid']; ?>
            <?php endif ?>
        </div>
        
        
        <!-- Jquery link -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- JS-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
