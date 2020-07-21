<?php declare(strict_types = 1);
    ob_start();
    if (isset($_GET['logout'])) {
        session_start();
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
   
        echo 'You have cleaned session';
        header('Location: index.php');
    } else {
        echo "
        <form action='' method='get'>
            <input type='submit' name='logout' value='logout'>
        </form>
        ";
    }



?>