<?php
    /*$username = $POST['username'];
    $password = $POST['password'];
    
    //to prevent mysql injection
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysql_real_escape_string($username);
    $password = mysql_real_escape_string($password);
    
    // connect to the server and select database
    mysql_connect("127.0.0.1", "3306", "");
    mysql_select_db("login");*/
    
    
        
    
    $host = "127.0.0.1";
    $user = "amaterixen";
    $pass = "";
    $db = "ngauge";
    $port = 3306;
    
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
    
    $username = $_POST['user'];
    $password = $_POST['pass'];
    
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    //Query the database for user
    $query = "SELECT * FROM user";
    //$query = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($connection, $query)
        or die("Failed to query database ".mysql_error());

    while($row = mysqli_fetch_assoc($result)){
        if($row['username'] == $username && $row['password'] == $password ){
        echo "Login success! Welcome ".$row['username'];
    } else {
        echo "Failed to login.";
    }
    
    //echo "The ID is: " . $row['user_id'] . " and the Username is: " . $row['username'];
    }
    
    
    /*$result = mysql_query("SELECT * FROM user WHERE username = '$username' and password = '$password'")
        or die("Failed to query database ".mysql_error());
    $row = mysql_fetch_array($result);
    if($row['username'] == $username && $row['password'] == $password ){
        echo "Login success! Welcome ".$row['username'];
    } else {
        echo "Failed to login.";
    }*/
    
    /*require ('db_connector.php');
    
    if (isset($_POST['submit'])){
        $username=mysql_escape_string($_POST['usernamefield']);
        $password=mysql_escape_string($_POST['passwordfield']);
        
        if(!$_POST['usernamefield'] | !$_POST['passwordfield']){
            echo ("<SCRIPT LANGUAGE = 'JavaScript'>
            window.alert('You did not complete all of the required fields')
            window.location.href='login.html'
            </SCRIPT>");
            
            exit();
        }
        
        $sql= mysql_query("SELECT * FROM `login_users` WHERE `username` = '$username' AND `password` = '$password'");
        if(mysqli_num_rows($sql) > 0){
            echo ("<SCRIPT LANGUAGE = 'JavaScript'>
            window.alert('Login successful')
            window.location.href='login.html'
            </SCRIPT>");
            exit();
        }
        
        else{
            echo ("<SCRIPT LANGUAGE = 'JavaScript'>
            window.alert('Please check your username/password')
            window.location.href = login.html'
            </SCRIPT>");
            exit();
        }
    }*/

?>