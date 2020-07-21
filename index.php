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
        $changeDir = chdir('.');

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
                if ($files == '.' || $files == '..' || $files == '.git') {
                    continue;
                } else if (!is_dir($files)) {
                    echo "$files<br>";
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
        // Back to Start
        function un_set() {
            unset($_GET["path"]);
        }

        $getPath = $_GET['path'];
        // Render back && back to start
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
        // Call back to start
        if (isset($_GET['reset'])) {
            un_set();
        }
        ?>
</body>
</html>