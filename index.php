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
        $path = getcwd();
        // function scan_dir($path) {
        //     $dir = scandir($path);
        //     foreach($dir as $file) {
        //         if (is_dir($file)) {
        //             echo "
                    // <form action='' method='get'>
                    // <input type='submit' name='path' value='$file'>
                    // </form>
        //             ";
        //         } else {
        //             echo $file."<br>";
        //         }
        //     }
        // }
        // function get_path() {
        //     $getter = $_GET['path'];
        //     STATIC $path;
        //     $path = getcwd();
        //     return $path.'/'.$getter;
        // }
        // echo get_path();
        // scan_dir(get_path());
            function pasholNaxuj($dir) {
                $files = scandir($dir);
                echo "<ul>";
                foreach($files as $file) {
                    if ( substr($file, 0, 1) != '.' ) {
                        echo '<li>';
                        if (is_dir($dir.'/'.$file)) {
                            echo "
                            <form action='' method='get'>
                            <input type='submit' name='path' value='$file'>
                            </form>
                            ";
                            if ($_GET['path'] == $file) {
                                pasholNaxuj($dir.'/'.$file);
                            }
                        } else {
                            echo '<a href="'.$dir.'/'.$file.'">'.$file.'</a>';
                        }
                        echo '</li>';
                    }
                }
                echo "</ul>";
            }
            pasholNaxuj($path);










        // $dir = scandir(getcwd());
        // $path = getcwd();
        // $path;
        // $root_path = getcwd();
        // chroot(chdir('js/'));
        // echo "<br><br>$path<br>";
        // $getPath = $_GET['path'];
        // echo $path.'<br>'."<br>";
        // echo "<br>".$_GET['path']."<br><br>";
        // // echo $path."<br><br>";
        // echo "$path/$getPath";
        // chdir("$path/$getPath");
        // echo getcwd();
        // function get_path() {

        // }
        // if (isset($_GET["path"])) {
        //     scan_dir($path);
        //     echo "
        //         <form action='' method='get'>
        //             <input type='submit' name='reset' value='Back'>
        //         </form>
        //         "; 
        // } else {
        //     scan_dir($root_path);
        // }
        // function scan_dir($path) {
        //     $getPath = $_GET['path'];
        //     if (isset($getPath)) {
        //         chdir("$path/$getPath");
        //     } else {
        //         chdir($path);
        //     }
        //     echo "<br>".getcwd()."<br>";
        //     $path = getcwd();
        //     $dirContent = scandir(getcwd());
        //     foreach($dirContent as $files) {
        //         if ($files == '.' || $files == '..' || $files == '.git') {
        //             continue;
        //         } else if (!is_dir($files)) {
        //             echo "$files<br>";
        //         } else {
        //             echo "
        //                 <form action='' method='get'>
        //                     <input type='submit' name='path' value='$files'>
        //                 </form>
        //                 ";
        //                 scan_dir($path);
        //         }
        //     }
        // }

        // scan_dir($path);

        // if (isset($_GET["path"])) {
        //     scan_dir($path);
        //     echo "
        //         <form action='' method='get'>
        //             <input type='submit' name='reset' value='Back'>
        //         </form>
        //         "; 
        // } else {
        //     scan_dir($root_path);
        // }
        // echo "<br><br><br>$path<br>";
        // for ($i=0;$i<count($dir);$i++) {
        //     $failai = $dir[$i];
        //     if ($failai == "." || $failai == ".." || $failai == '.git') {
        //         continue;
        //     } else if ( !is_dir($failai)) {
        //         echo "$failai<br>";
        //     } else {
        //         echo "
        //             <form action='' method='get'>
        //                 <input type='submit' name='click' value='$failai'>
        //             </form>
        //             ";
        //     };
        // }
        // // Panaudoti by referecnce function runMyFunction(&$path);
        // function scan_dir() {
        //     // echo $_GET['click'];
        //     // echo getcwd()."'\'".$_GET['click'];
        //     echo getcwd()."<br>";
        //     chdir($_GET['click']);
        //     echo getcwd()."<br>";
        //     echo "<br>".$_GET['click']."<br>";
        //     // chdir('js/');
        //     $dir = scandir(getcwd());
        //     foreach($dir as $file) {
        //         if ($file == '.' || $file == '..') {
        //             continue;
        //         } else if ( !is_dir($file)) {
        //             echo "<br>$file";
        //         } else {
        //             echo "
        //                 <form action='' method='get'>
        //                     <input type='submit' name='click' value='$file'>
        //                 </form>
        //                 ";
        //         };
        //     }
        // }
        // function un_set() {
        //     unset($_GET["path"]);
        // }
        // if (isset($_GET["click"])) {
        //     scan_dir($path);
        //     echo "
        //         <form action='' method='get'>
        //             <input type='submit' name='reset' value='Back'>
        //         </form>
        //         "; 
        // }
        // if (isset($_GET['reset'])) {
        //     un_set();
        //     // scan_dir($path);
        // }
        ?>


        <!-- <a href='index.php?kebabas'>Run PHP Function</a> -->

</body>
</html>