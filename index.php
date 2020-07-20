<?php declare(strict_types = 1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>File explorer</title>
</head>
<body>
    <?php 
        $dir = scandir(getcwd());
        echo "<br>".getcwd()."<br>";
        print_r($dir);
        for ($i=0;$i<count($dir);$i++) {
            $failai = $dir[$i];
            if ($failai == "." || $failai == ".." || $failai == '.git') {
                continue;
            } else if ( !is_dir($failai)) {
                echo "$failai<br>";
            } else {
                echo "
                    <form action='' method='get'>
                        <input type='submit' name='click' value='$failai'>
                    </form>
                    ";
            };
        }
        // // Panaudoti by referecnce function runMyFunction(&$path);
        function scan_dir() {
            // echo $_GET['click'];
            // echo getcwd()."'\'".$_GET['click'];
            echo getcwd()."<br>";
            chdir($_GET['click']);
            echo getcwd()."<br>";
            echo "<br>".$_GET['click']."<br>";
            // chdir('js/');
            $dir = scandir(getcwd());
            foreach($dir as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                } else if ( !is_dir($file)) {
                    echo "<br>$file";
                } else {
                    echo "
                        <form action='' method='get'>
                            <input type='submit' name='click' value='$file'>
                        </form>
                        ";
                };
            }
        }
        // function un_set() {
        //     unset($_GET["click"]);
        // }
        if (isset($_GET["click"])) {
            scan_dir();
            echo "
                <form action='' method='get'>
                    <input type='submit' name='reset' value='Back'>
                </form>
                "; 
        }
        // if (isset($_GET['reset'])) {
        //     un_set();
        // }
        ?>


        <!-- <a href='index.php?kebabas'>Run PHP Function</a> -->

</body>
</html>