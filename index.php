<?php declare(strict_types = 1); ?>
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
        $path = getcwd();
        $root_path = getcwd();
        // echo $root_path;
        function scan_dir(&$path) {
            // $root = ""
            // echo "$path<br>";
            $getPath = $_GET['path'];
            // echo "<br>GET PATH = $getPath<br>";
            if (isset($getPath)) {
                chdir("$path/$getPath");
            } else {
                chdir($path);
            }
            // echo "<br>".getcwd()."<br>";
            $path = getcwd();
            // echo "<br>TAS KURI GAVAU IS URLO: $path<br>";
            $dirContent = scandir(getcwd());
            foreach($dirContent as $files) {
                if ($files == '.' || $files == '..' || $files == '.git') {
                    continue;
                } else if (!is_dir($files)) {
                    echo "$files<br>";
                } else {
                        // echo "<br>Server URI: ---> ".$_SERVER['REQUEST_URI']."<br>";
                        // echo "PHP SERVER $ --> ".$_SERVER['PHP_SELF']."<br>";
                        // echo "PHP NAME $ --> ".$_SERVER['SERVER_NAME']."<br>";
                        $serverName = $_SERVER['SERVER_NAME'];
                        $serverURI = $_SERVER['REQUEST_URI'];
                        $getGood = $serverName.$serverURI;


                    echo "
                        <form action='' method='get'>
                            <input type='submit' value='$files''>
                            <input type='hidden' name='path' value='$getPath/$files'>
                        </form>
                        ";
                        // scan_dir($path);
                }
            }
        }

        function un_set() {
            unset($_GET["path"]);
        }
        if (isset($_GET["path"])) {
                scan_dir($path);
                echo "
                <form action='' method='get'>
                    <input type='submit' name='reset' value='Back'>
                </form>
                "; 
            } else {
                scan_dir($root_path);
            // echo "
            //     <form action='' method='get'>
            //         <input type='submit' name='reset' value='Back'>
            //     </form>
            //     "; 
        }
        if (isset($_GET['reset'])) {
            un_set();
            // scan_dir($path);
        }
        ?>
</body>
</html>