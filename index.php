<?php declare(strict_types = 1);
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <body>
        <?php 
        if (isset($_POST['login']) && !empty($_POST['username']) 
        && !empty($_POST['password'])) {
            
            if ($_POST['username'] == 'name' && 
            $_POST['password'] == 'password') {
                ob_get_clean();
                session_start();
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = 'name';
                
                header("Location: logic.php"); 
            } else {
                ob_clean();
                echo "
                <div class='warning'>Wrong username or password, try again</div>
                ";
            }
        }
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="css/login.css">
            <title>Sign in</title>
        </head>
        <main class="window">
            <div class="container">
                <h1>Sign in</h1>
                <div class="form">
                <form action="" method="post">
                    <input class="input" type="text" name="username" placeholder="*name">
                    <input class="input" type="password" name="password" placeholder="*password">
                    <input class="btn" type="submit" name="login" value="Login">
                </form>
                </div>
            </div>
        </main>
</body>
</html>