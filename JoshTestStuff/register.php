<?php include('db_connector.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <div>
            <h2>Register</h2>
            <form method="post" action="register.php">
                
                <?php include('errors.php'); ?>
                <p>
                    <label>Username</label>
                    <input type="text" name="user" />
                </p>
                <p>
                    <label>Email</label>
                    <input type="text" name="email" />
                </p>
                <p>
                    <label>First Name</label>
                    <input type="text" name="fname" />
                </p>
                <p>
                    <label>Last Name</label>
                    <input type="text" name="lname" />
                </p>
                <p>
                    <label>Password</label>
                    <input type="password" name="pass1" />
                </p>
                <p>
                    <label>Confirm Password</label>
                    <input type="password" name="pass2" />
                </p>
                <p>
                    <button type="password" name="register" class="btn">Register</button>
                </p>
                <p>
                    Already a member? <a href="login.php">Sign in</a>
                </p>
        </form>
        </div>
    </body>
</html>