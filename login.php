<?php include('db_connector.php'); ?>
<!DOCTYPE html>
<html>
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../HomePage/hpagestyle.css" />
        
    <title>Login Page</title>
    </head>
    <body class="backgroundimg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="headtop">
                        <div class="logoplace">
                            <img src="NGhalf.png" alt="NGauge Logo" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                        
                </div>
                <div class="col-md-4">
                    <div class="formbackground">
                        <div class="form">
                            <h2><font color="white">Log-In</font></h2>
                            <form action="login.php" method="post" "form-inline justify-content-center">
                                <?php include('errors.php'); ?>
                                    <p>
                                        <input type="text" id="user" name="user" placeholder = "Username" />
                                    </p>
                                    <p>
                                        <input type="password" id="pass" name="pass" placeholder = "Password" />
                                    </p>
                                    <p class="buttonsignup">
                                        <input type="submit" class="btn" name="login"  />
                                    </p>
                                    <p>
                                        <font color="white">Not a member yet? </font> <a href="register.php">Sign up!</a>
                                    </p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                        
                </div>
            </div>
        </div>
    </body>
</html>