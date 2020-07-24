<?php 
    if (isset($_GET['logout'])) {
        session_start();
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
   
        echo 'You have cleaned session';
        header('Location: index.php');
    } else {
        echo "
        <div class='logout'>
            <form action='' method='get'>
                <input class='logout-btn' type='submit' name='logout' value='Log out'>
            </form>
        </div>
        ";
    }
?>