<?php declare(strict_types = 1);
    ob_start();
    // if (isset($_GET['logout'])) {
    //     session_start();
    //     unset($_SESSION["username"]);
    //     unset($_SESSION["password"]);
   
    //     echo 'You have cleaned session';
    //     // header('Refresh: 2; URL = login.php');
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
</head>
<body>
    <?php 
        $msg = '';
            
        if (isset($_POST['login']) && !empty($_POST['username']) 
           && !empty($_POST['password'])) {
            
           if ($_POST['username'] == 'kekw' && 
              $_POST['password'] == 'password') {
                  ob_get_clean();
                  session_start();
              $_SESSION['valid'] = true;
              $_SESSION['timeout'] = time();
              $_SESSION['username'] = 'kekw';
              
              echo 'You have entered valid use name and password';
              echo "
                <form action='' method='get'>
                    <input type='submit' value='Sign out'>
                    <input type='hidden' name='logout'>
                </form>
              ";
              header("Location: logic.php");

           }else {
              $msg = 'Wrong username or password';
              ob_get_clean();
              echo $msg;
            }
        }
    ?>
    <main class="window">
        <div class="container">
            <h1>Sign in</h1>
            <div class="form">
            <form action="" method="post">
                <input type="text" name="username">
                <input type="password" name="password">
                <input type="submit" name="login">
            </form>
            </div>
        </div>
    </main>
</body>
</html>