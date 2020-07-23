<?php declare(strict_types = 1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <link rel="stylesheet" href="css/f_e_styles.css">
    <title>File explorer</title>
</head>
<body>
    <main class="main">
        <?php 
        require_once('logout.php');
        require_once('upload.php');
        require_once('download.php');
        ?>
        <div class="container">
            <div class="head"></div>
            <?php 
                ob_start();
                # render directory ::
                $path = getcwd();
                $root_path = getcwd();

                function scan_dir(&$path) {
                    $getPath = $_GET['path'];
                    if (isset($getPath) && is_dir("$path/$getPath")) {
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
                            if (is_readable($files)) {
                                echo "
                                    <div class='filesAndFolders'>
                                        <form action='' method='get'>
                                            <input type='submit' value='$files''>
                                            <input type='hidden' name='path' value='$getPath/$files'>
                                        </form>
                                    </div>
                                    ";
                                echo "
                                    <div class='download'>
                                        <form action='' method='post'>
                                            <input type='submit' value='Download'>
                                            <input type='hidden' name='download' value='$getPath/$files'>
                                        </form>
                                    </div>
                                    ";
                            }
                        } else {
                            echo "
                                <div class='filesAndFolders'>
                                    <form action='' method='get'>
                                        <input type='submit' value='$files''>
                                        <input type='hidden' name='path' value='$getPath/$files'>
                                    </form>
                                </div>
                                ";
                        }
                    }
                }
                # Render directory END;
                # Render back && back to start
                $getPath = $_GET['path'];
                if (isset($_GET["path"])) {
                        scan_dir($path);
                        if (is_file($path.$getPath)) {
                            ob_clean();
                            read($path.$getPath);
                        } 
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
                                <input type='submit' value='Back'>
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
                # Render file content :: START ::
                function read($file) {
                    if (is_readable($file)) {
                        echo "<pre>".htmlspecialchars(file_get_contents($file));
                    } else {
                        return null;
                    }
                }
                # Render file content :: END :: ;
                # Call back to start :: START ::
                function un_set() {
                    unset($_GET["path"]);
                }
                if (isset($_GET['reset'])) {
                    un_set();
                }
                # Call back to start :: END :: ;
                // ---------------------------------------------------------
                # Create directory && render form ::
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
            # Create directory && render form :: END :: ;
            ?>
            <!-- Upload files :: -->
            <div class="uploads">
                <form action = "" method = "POST" enctype = "multipart/form-data">
                    <input type = "file" name = "image" />
                    <input type = "submit"/>
                </form>
            </div>
            <!-- Upload files :: END :: -->
        </div>
    </main>
</body>
</html>