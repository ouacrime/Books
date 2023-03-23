<?php

session_start();

error_reporting(0) ;

include_once "config.php" ;

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if ( empty($_POST["email"]) ) {
        $emailErr = "This Field is required." ;
    } else {
        $email = test( $_POST["email"] ) ;
        if ( !filter_var( $email , FILTER_VALIDATE_EMAIL ) ) {
            $emailErr = "Syntax Error !" ; 
        }
    }

    if ( empty($_POST["password"]) ) {
        $passwordErr = "This Field is required." ;
    } else { 
            $password = test( $_POST["password"] ) ;
        }

}

function test($data) {
    $data = trim( $data );
    $data = htmlspecialchars( $data );
    $data = stripcslashes( $data );
    return $data;
}

if ( isset( $_POST["submit"] ) ) {
    if ( empty($emailErr) && empty($passwordErr) ) {
        $sql = "SELECT * FROM admin WHERE email = ?" ;
        $stmt = $db->prepare( $sql ) ;
        $stmt->execute(array($email)) ;

        if ( $stmt->rowCount() > 0 ) {
            $user = $stmt->fetch() ;
            if ( $password === $user["password"] ) {
                $password = password_hash($password , PASSWORD_DEFAULT ) ;
                $_SESSION["name"] = $user["username"] ;
                header("Location:home.php") ;
            } else {
                $Error = '<div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <div>
                                        Password is incorrect.
                                    </div>
                                </div>' ;
            }
        } else {
                $Error = '<div class="alert alert-danger d-flex align-items-center" role="alert">
                                <div>
                                    Email is incorrect.
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

    <link rel="stylesheet" type="text/css" href="cs.css">

    <title>Login Form - Pure Coding</title>

</head>
<body>
    <div class="container">
        <?php echo $Error ; ?>
        <form class="login-email" action="" method="post">
            <p class="login-text">Login with email</p>
            <div class="input-group">
                <span> <?php echo $emailErr ; ?></span>
                <input type="text" placeholder="Email" name="email" value="<?php echo $email ; ?>">
            </div>
            <div class="input-group">
                <span> <?php echo $passwordErr ; ?></span>
                <input type="password" placeholder="Password" name="password" value="<?php echo $password ; ?>">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary" name="submit">login</button>
            </div>
        </form>
        <p>Don't have an account?<a href="register.php">click here</a></p>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>