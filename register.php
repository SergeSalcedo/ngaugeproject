<?php include('db_connector.php'); ?>
<!DOCTYPE html>
<html>
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../HomePage/hpagestyle.css" />
    
    <head>
        <title>Register</title>
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
        
        <div class="container h-80">
            <div class="row align-items-center h-80">
                <div class="col-6 mx-auto">
                    <div class="formbackground">
                        <div class="form">
                            <div>
                                <h2><font color="white">Register</font></h2>
                                <form method="post" action="register.php">
                                <?php include('errors.php'); ?>
                                    <p>
                                        <!--<label>Username</label>-->
                                        <input type="text" name="user" placeholder = "Username" />
                                    </p>
                                    <p>
                                        <!--<label>Email</label>-->
                                        <input type="text" name="email" placeholder = "Email" />
                                    </p>
                                    <p>
                                        <!--<label>First Name</label>-->
                                        <input type="text" name="fname" placeholder = "First Name" />
                                    </p>
                                    <p>
                                        <!--<label>Last Name</label>-->
                                        <input type="text" name="lname" placeholder = "Last Name" />
                                    </p>
                                    <p>
                                        <!--<label>County</label>-->
                                        <!--<input type="text" name="county" placeholder = "County" />-->
                                        <?php
                                            $db = new PDO('mysql:host=127.0.0.1;dbname=ngauge', 'amaterixen', '');
                                            $query = $db->query("SELECT county_name FROM county");
                                            
                                            
                                            echo '<select name="county">';
                                                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                                                    echo '<option value="'.$row['county_name'].'">'.$row['county_name'].'</option>';
                                                }
                                            echo '</select>';
                                            
                                        
                                        ?>
                                    </p>
                                    <p>
                                        <!--<label>Password</label>-->
                                        <input type="password" name="pass1" placeholder = "Password" />
                                    </p>
                                    <p>
                                        <!--<label>Confirm Password</label>-->
                                        <input type="password" name="pass2" placeholder = "Confirm Password" />
                                    </p>
                                    <p>
                                        <button type="password" name="register" class="btn">Register</button>
                                    </p>
                                    <p>
                                        <font color="white">Already a member? </font> <a href="login.php">Sign in</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer">
                        
                    </div>
                </div>
            </div>
        </div>    
    </body>
</html>