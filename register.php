<?php

session_start();

include "config.php" ;

error_reporting(0) ;

if (isset($_SESSION['name'])) {
    header("Location: index.php");
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if ( empty($_POST['username']) ) {
        $usernameErr = "This Field is required." ;
    } else {
        $username = test( $_POST['username'] ) ;
        if ( !preg_match( "/^[a-zA-Z-' ]*$/", $username ) ) {
            $usernameErr = "Only letters and white space allowed." ; 
        }
    }

    if ( empty($_POST["email"]) ) {
        $emailErr = "This Field is required." ;
    } else {
        $email = test( $_POST["email"] ) ;
        if ( !filter_var( $email , FILTER_VALIDATE_EMAIL ) ) {
            $emailErr = "Syntax Error !" ; 
        } elseif ( strlen($email) > 100 ) {
            $emailErr = "Only 100 cars allowed." ;
        }
    }

    if ( empty($_POST["password"]) ) {
        $passwordErr = "This Field is required." ;
    } else { 
            $password = test( $_POST["password"] ) ;
            if ( strlen($password) < 8 ) {
                $passwordErr = "Password is weak." ;
            }  elseif ( strlen($password) > 50 ) {
                $passwordErr = "Only 10 cars allowed." ;
            }
        }

    if ( empty($_POST["Cpassword"]) ) {
        $CpasswordErr = "This Field is required." ;
    } else { 
            $Cpassword = test( $_POST["Cpassword"] ) ;
            if ( $password != $Cpassword ) {
                $CpasswordErr = "Password not match!" ;
            }
        }

}

function test($data) {
    $data = trim( $data );
    $data = htmlspecialchars( $data );
    $data = stripcslashes( $data );
    return $data;
}

if ( isset($_POST['submit']) ) {

    if ( empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($CpasswordErr) ) {
        $sql = "SELECT * FROM admin WHERE email = ?" ;
        $stmt = $db->prepare($sql) ;
        $stmt->execute(array( $email )) ;
        $email = strtolower( $email ) ;
        if ( $stmt->rowCount() > 0 ) {
            $status =  '<div class="alert alert-danger d-flex align-items-center" role="alert">
                                <div>
                                    Email is already registred.
                                </div>
                            </div>' ;
        } else {
                $sql = "INSERT INTO admin (username , email , password) VALUES (? , ? , ?)" ;
                $stmt = $db->prepare($sql) ;
                $stmt->execute(array($username, $email, $password)) ;
                $status =  '<div class="alert alert-primary d-flex align-items-center" role="alert">
                                <div>
                                    successfully registered.
                                </div>
                            </div>' ;

        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="cs.css">


    <title>Login Form - Pure Coding</title>

</head>
<body>
    <div class="container">
        <?php echo $status ; ?>
        <form class="login-email" action="" method="post">
            <p class="login-text">Login with email</p>
            <div class="input-group">
                <span> <?php echo $usernameErr ; ?></span>
                <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>"> <br>
            </div>
            <div class="input-group">
            <span> <?php echo $emailErr ; ?></span>
                <input type="text" placeholder="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
            <span> <?php echo $passwordErr ; ?></span>
                <input type="password" placeholder="Password" name="password" value="<?php echo $password; ?>">
            </div>
            <div class="input-group">
            <span> <?php echo $CpasswordErr ; ?></span>
                <input type="password" placeholder="Confirmer password" name="Cpassword" value="<?php echo $Cpassword; ?>">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary" name="submit">Register</button>
            </div>
        </form>
        <p>have an account?<a href="index.php">click here</a></p>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>