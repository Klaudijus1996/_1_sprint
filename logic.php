<?php declare(strict_types = 1);
require_once('logout.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <link rel="stylesheet" href="nuPazvengiam.css">
    <title>File explorer</title>
</head>
<body>
    <?php 
        ob_start();
        # render directory ::
        $path = getcwd();
        $root_path = getcwd();
        function scan_dir(&$path) {
            $getPath = $_GET['path'];
            if (isset($getPath)) {
                chdir("$path/$getPath");
            } else {
                chdir($path);
            }
            $path = getcwd();
            $dirContent = scandir(getcwd());
            foreach($dirContent as $files) {
                if ($files == '.' || $files == '..' || $files == '.git' || $files == "index.php" || $files == "logic.php") {
                    continue;
                } else if (!is_dir($files)) {
                    if (is_readable($files)) {
                        echo "
                        <form action='' method='get'>
                            <input type='submit' value='$files''>
                            <input type='hidden' name='path' value='$getPath/$files'>
                        </form>
                        ";
                    }
                    // echo "$files<br>";
                    // if (is_readable($files)) {
                    //     $readable = fopen("$getPath/$files", 'r');
                    //         // $line = fgets("$readable");
                    //         // echo $line. "<br>";
                    //         echo "$readable";
                          
                          
                    //     //   fclose($readable);
                    //     echo "$getPath/$files<br><br>";
                    // } else {
                    //     echo $files;
                    // };
                } else {
                    echo "
                        <form action='' method='get'>
                            <input type='submit' value='$files''>
                            <input type='hidden' name='path' value='$getPath/$files'>
                        </form>
                        ";
                }
            }
        }
        # Render directory END;
        # Render back && back to start
        $getPath = $_GET['path'];
        if (isset($_GET["path"])) {
                scan_dir($path);
                $str = substr($getPath, stripos($getPath, '/'), strripos($getPath, '/'));
                if ($str == "") {
                    echo "
                    <form action='' method='get'>
                        <input type='submit' name='reset' value='Back to Start'>
                    </form>
                    "; 
                } else {
                echo "
                    <form action='' method='get'>
                        <input type='submit' value='Previous folder'>
                        <input type='hidden' name='path' value='$str'>
                    </form>
                    "; 
                    echo "
                    <form action='' method='get'>
                        <input type='submit' name='reset' value='Back to Start'>
                    </form>
                    "; 
                }
            } else {
                scan_dir($root_path);
        }
        # Render back && back to start END;
        // reader
        function reading($files) {
            // TODO change files to .txt :: !!
            if (is_readable($files)) {
                $file = fopen($files, 'r');
                $lines = "<div>";
                // echo fgets($file);
                while(! feof($file)) {
                    $lines = $lines.fgets($file);
                }
                echo $lines. "<br>";
            } else {
                echo "failas<br>";
            }
            fclose($file);
        }
        
        // reading('text.txt');
        reading('index.txt');echo "<br>";
        # Call back to start
        function un_set() {
            unset($_GET["path"]);
        }
        if (isset($_GET['reset'])) {
            un_set();
        }
        # Call back to start END;
        // ---------------------------------------------------------
        # Create directory && render form
        function createDirectory() { 
            $add = $_POST["add"]; 
            mkdir($add); 
        }
        ?>
        <?php if(!isset($_POST['submit'])) { ?>
            <form action="" method="post">
                <input type="text" name="add" placeholder="Name your folder">
                <input type="submit" name ='submit'>
            </form>
        <?php } else {
            createDirectory();
            ob_get_clean();
            scan_dir($root_path);
        ?>
        <form action="" method="post">
            <input type="text" name="add" placeholder="Name your folder">
            <input type="submit" name ='submit'>
        </form>
        <?php } 
                # Create directory && render form END;
        ?>
        <!-- <form action="" method="get">
            <input type="submit" name="logout" value="logout">
        </form> -->
</body>
</html>