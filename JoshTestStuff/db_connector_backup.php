<?php
    session_start();
    
    $host = "127.0.0.1";
    $user = "amaterixen";
    $pass = "";
    $db = "ngauge";
    $port = 3306;
    
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
    
    /*
    //For testing to make sure the connection works
    $query = "SELECT * FROM user";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "The ID is: " . $row['user_id'] . " and the Username is: " . $row['username'];
    }*/
    
    $username = "";
    $email = "";
    $firstname = "";
    $lastname = "";
    $errors = array();
    
    if (isset($_POST['register'])){
        $username = mysqli_real_escape_string($connection, $_POST['user']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $firstname = mysqli_real_escape_string($connection, $_POST['fname']); 
        $lastname = mysqli_real_escape_string($connection, $_POST['lname']); 
        //$password1 = mysqli_real_escape_string($connection, $_POST['pass1']);
        //$password2 = mysqli_real_escape_string($connection, $_POST['pass2']);
        $password1 = htmlspecialchars_decode(trim($_POST['pass1']));
        $password2 = htmlspecialchars_decode(trim($_POST['pass2']));
        
        if (empty($username)){
            array_push($errors, "Username is required");
        }
        if (empty($email)){
            array_push($errors, "Email is required");
        }
        if (empty($firstname)){
            array_push($errors, "First Name is required");
        }
        if (empty($lastname)){
            array_push($errors, "Last Name is required");
        }
        if (empty($password1)){
            array_push($errors, "Password is required");
        }
        if ($password1 != $password2){
            array_push($errors, "The passwords do not match!");
        }
        
        //Checks to make sure no errors are flagged
        if(count($errors) == 0){
            //Enforces encryption on password
            $password = password_hash($password1, PASSWORD_DEFAULT);
            //Inserts user info into database
            $sql = "INSERT INTO user (username, email, Fname, Lname, password) 
                VALUES ('$username', '$email', '$firstname', '$lastname', '$password')";
                
                mysqli_query($connection, $sql);
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
        }
    }
    
    //User login
    if (isset($_POST['login'])){
        $username = mysqli_real_escape_string($connection, $_POST['user']);
        $password = mysqli_real_escape_string($connection, $_POST['pass']);
        //$password = htmlspecialchars_decode(trim($_POST['pass']));
        
        //echo $username;
        echo $password;
        
        if (empty($username)){
            array_push($errors, "Username is required");
        }
        if (empty($password)){
            array_push($errors, "Password is required");
        }
        if (count($errors) == 0){
            //$password = password_hash($password, PASSWORD_DEFAULT); //encrypts the password before comparing it with that from the database
            //...stops the password from leaking through in cache or whatever
            //$query = "SELECT * FROM user WHERE username = '$username' AND password = 'password_verify($password)'";
            $query = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($connection, $query);
                
            while($row = mysqli_fetch_assoc($result)){
                $accountPass = $row['password'];
                //$accountPass = password_hash('fair', PASSWORD_DEFAULT);
                //echo $password;
                echo $accountPass;
                //echo password_verify($password, $accountPass);
                $isCorrect=password_verify($password, $accountPass);
                //echo $isCorrect;
                echo $isCorrect ? 'true' : 'false';
                //if (mysqli_num_rows($result) == 1 && $isCorrect){
                if ($isCorrect == 1){
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "You are now logged in";
                    header('location: index.php');
                }
            else{
                array_push($errors, "We don't recognise that user or password.");
                }
            }
            //$result = mysqli_query($connection, $query);
            /*if (mysqli_num_rows($result) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            }
            else{
                array_push($errors, "We don't recognise that user or password.");
            }*/
        }
    }
    
    //logout
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
    
    
?>