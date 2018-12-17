<?php
    session_start();
    
    $host = "127.0.0.1";
    $user = "amaterixen";
    $pass = "";
    $db = "ngauge";
    $port = 3306;
    
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
    
    $username = "";
    $email = "";
    $firstname = "";
    $lastname = "";
    $errors = array();
    
    if (isset($_POST['register'])){
        
        if (empty($_POST['user'])){
            array_push($errors, "Username is required");
        }
        if (empty($_POST['email'])){
            array_push($errors, "Email is required");
        }
        if (empty($_POST['fname'])){
            array_push($errors, "First Name is required");
        }
        if (empty($_POST['lname'])){
            array_push($errors, "Last Name is required");
        }
        if (empty($_POST['county'])){
            array_push($errors, "Last Name is required");
        }
        if (empty($_POST['pass1'])){
            array_push($errors, "Password is required");
        }
        if ($_POST['pass1'] != $_POST['pass2']){
            array_push($errors, "The passwords do not match!");
        }
        
        //Checks to make sure no errors are flagged
        if(count($errors) == 0){
            //Enforces encryption on password
            $password = password_hash($password1, PASSWORD_DEFAULT);
            
            //Inserts user info into database
            $sql = "INSERT INTO user (username, email, Fname, Lname, password, user_county) 
                VALUES (?, ?, ?, ?, ?, ?)";
                
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL Error";
                }
                else{
                    mysqli_stmt_bind_param($stmt, "ssssss", $_POST['user'], $_POST['email'], $_POST['fname'], $_POST['lname'], (password_hash($_POST['pass1'], PASSWORD_DEFAULT)), $_POST['county']);
                    mysqli_stmt_execute($stmt);
                    
                    //session_start();
                    //$_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $_POST['user'];
                    $_SESSION['success'] = "You are now logged in";
                    header('location: index.php');
                }
                
        }
    }
    
    //User login
    if (isset($_POST['login'])){
        
        if (empty($_POST['user'])){
            array_push($errors, "Username is required");
        }
        if (empty($_POST['pass'])){
            array_push($errors, "Password is required");
        }
        if (count($errors) == 0){
            
            $query = "SELECT * FROM user WHERE username = ?";
            $stmt = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt, $query)){
                echo "SQL statement failed";
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $_POST['user']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                while($row = mysqli_fetch_assoc($result)){
                $accountPass = $row['password'];
                $isCorrect=password_verify($_POST['pass'], $accountPass);
                    if ($isCorrect == 1){
                        //session_start();
                        //$_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $_POST['user'];
                        $_SESSION['success'] = "You are now logged in";
                        header('location: index.php');
                    }
                    else{
                        array_push($errors, "We don't recognise that user or password.");
                    }
                }
            }
        }
    }
    
    //logout
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        //$_SESSION['loggedin'] = false;
        header('location: login.php');
    }
    
    
?>