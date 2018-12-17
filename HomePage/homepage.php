<?php /*include('db_connector.php'); 
    session_start();
    
    if(!isset($_SESSION['username'])){
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
  	    session_destroy();
  	    unset($_SESSION['username']);
  	    header("location: login.php");
    }*/
    
    
?>
<!DOCTYPE html>
<html lang="en">
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="hpagestyle.css" />
    
    <head>
        <title>N-Gauge</title>
    </head>
    
    <body>
        <div class="searchbar">
            <div class="container-fluid">
                    <div class="col-md-12">
                        <h2> Hello, I am the searchbar </h2>
                    </div>
            </div>
        </div>
        
        <div class="container-fluid">
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
                <p>Welcome, <strong><?php echo $_SESSION['username']; ?></strong>!</p>
                <p><a href = "index.php?logout='1'" method="post" class="button" name = "logout" style = "color: red;">Logout</a></p>
                <?php endif ?>
            </div>
        </div>
        
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <div class="profimgbox">
                        
                        </div>
                    </div>
                    
                    <div class="col-md-6 ">
                            <div class="recommendusers">
                                <div class="recommendheader">
                                    Recommended Users
                                </div>
                                <div class="recommendbody">
                                    <div class="scrollmenu">
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Here is user </br>
                                        Send Noods - Also stupid Chrome has bug with scrollbar >.<
                                        
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="profbuttonbody">
                            <div class="profbutton" class="button1";>
                        
                            </div>
                            <div class="profbutton";>
                        
                            </div>
                            <div class="profbutton";>
                        
                            </div>
                        </div>
                    </div>
                    
                </div>
               
        </div>
        
        <script src="src="https://code.jquery.com/jquery-1.12.4.js""></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>