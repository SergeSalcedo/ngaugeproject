<?php include('db_connector.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
    </head>
    <body>
        <div id="frm">
            <form action="login.php" method="post">
                <?php include('errors.php'); ?>
                <p>
                    <label>Username:</label>
                    <input type="text" id="user" name="user" placeholder = "Username" />
                </p>
                <p>
                    <label>Password:</label>
                    <input type="password" id="pass" name="pass" placeholder = "Password" />
                </p>
                <p>
                    <input type="submit" class="btn" name="login"  />
                </p>
                <p>
                    Not a member yet? <a href="register.php">Sign up!</a>
                </p>
            </form>
        </div>
    </body>
</html>








