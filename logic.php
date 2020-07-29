<?php declare(strict_types = 1);
function _sort_entries($a, $b)
{
    if ($a->type!=$b->type)
        return strcmp($a->type,$b->type);

    return strcmp($a->entry,$b->entry);
}
?>
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
        require_once('upload.php');
        require_once('download.php');
        ?>
        <div class="bg-img"></div>
        <div class="container">
            <div class="head"></div>
            <?php require_once('logout.php'); ?>
            <?php 
                ob_start();
                # Render Files/Folders :: START ::
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
                        } else if (is_dir($files)) {
                            echo "
                                <div class='filesAndFolders'>
                                    <form action='' method='get'>
                                        <input class='folders' type='submit' value='$files''>
                                        <input type='hidden' name='path' value='$getPath/$files'>
                                    </form>
                                </div>
                                ";
                                echo "
                                <div class='delete'>
                                    <form action='' method='post'>
                                        <input class='dlt-btn' type='submit' value='Delete''>
                                        <input type='hidden' name='delete' value='$getPath/$files'>
                                    </form>
                                </div>
                                ";
                        } else if (is_readable($files)) {
                            echo "
                                <div class='filesAndFolders'>
                                    <form action='' method='get'>
                                        <input class='files' type='submit' value='$files''>
                                        <input type='hidden' name='path' value='$getPath/$files'>
                                    </form>
                                </div>
                                ";
                            echo "
                                <div class='downloads'>
                                    <form action='' method='post'>
                                        <input class='download' type='submit' value='download'>
                                        <input type='hidden' name='download' value='$getPath\\$files'>
                                    </form>
                                </div>
                                ";
                        }
                    }
                }
                # Render Files/Folders :: END :: ;
                # Render back && back to start :: START ::
                $getPath = $_GET['path'];
                if (isset($_GET["path"])) { ?> 
                <div class='files-container scrollbar' id="style-13"> <?php
                    scan_dir($path); ?>
                </div> <?php
                    // echo usort(scan_dir($path), "_sort_entries");
                    $str = substr($getPath, stripos($getPath, '/'), strripos($getPath, '/'));
                    if (is_file($path.$getPath)) {
                        ob_clean();
                        $fullPath = $path.$getPath;
                        // $fileToDownloadEscaped = str_replace("&nbsp;", " ", htmlentities($fullPath, null, 'utf-8'));
                        read($fullPath);
                        } 
                        if (is_file($path.$_GET['path'])) {
                            echo "
                                <form class='exit' action='' method='get'>
                                    <input class='exit-btn' type='submit' value='&#215;'>
                                    <input type='hidden' name='path' value='$str'>
                                </form>
                                ";
                        } else
                        if ($str == "") {
                            echo "
                            <form class='back-to-start' action='' method='get'>
                                <input class='bst-btn' type='submit' name='reset' value='&#171;'>
                            </form>
                            "; 
                        } else {
                        echo "
                            <form class='back' action='' method='get'>
                                <input class='back-btn' type='submit' value='&#8249;'>
                                <input type='hidden' name='path' value='$str'>
                            </form>
                            "; 
                            echo "
                            <form class='back-to-start' action='' method='get'>
                                <input class='bst-btn' type='submit' name='reset' value='&#171;'>
                            </form>
                            "; 
                        }
                    } else {
                        ?>
                    <div class="files-container scrollbar" id="style-13"> <?php
                        scan_dir($root_path); ?>
                    </div> <?php
                }
                # Render back && back to start :: END :: ;
                # Render file content :: START ::
                function read($file) {
                    $fix2 = substr($_GET['path'], stripos($_GET['path'], '/')+1, strlen($_GET['path'])-1);
                    if (exif_imagetype($file) == IMAGETYPE_JPEG || exif_imagetype($file) == IMAGETYPE_PNG
                    ) {
                        echo "<img src='$fix2'>";
                        exit;
                    };
                    if (is_readable($file)) {
                        echo "<div class='renderFile' id=''style-13'>
                                <div class='scrollbar' id='style-13'>
                                    <pre><div class='renderText'>".htmlspecialchars(file_get_contents($file))."</div></pre>
                                </div>
                            </div>";
                            
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
                # Delete dir :: START ::
                if (isset($_POST['delete'])) {
                    deleteDir($root_path.'/'.$_POST['delete']);
                    ob_get_clean();
                    scan_dir($path);
                    $del = $_POST['delete'];
                    $str = substr($del, strripos($del, '/'), strlen($del)-1);
                    echo "
                            <form class='back' action='' method='get'>
                                <input class='back-btn' type='submit' value='&#8249;'>
                                <input type='hidden' name='path' value=''>
                            </form>
                            "; 
                }
                function deleteDir($dir) {
                    if (is_dir($dir)) {
                        rmdir($dir);
                    }
                } 
                # Delete dir :: END :: ;
                // ---------------------------------------------------------
                # Create directory && render form ::
                function createDirectory() { 
                    $add = $_POST["add"]; 

                    mkdir($add); 
                }
                ?>
                 <?php if(!isset($_POST['submit'])) { ?>
                    <div class="createDir">
                        <form class="create-folder" action="" method="post">
                            <input class="input-text" type="text" name="add" placeholder="Folder">
                            <input class="input-btn" type="submit" value="&#43;">
                            <input type="hidden" name ='submit'>
                        </form>
                    </div>
                <?php } else {
                    createDirectory();
                    ob_get_clean();
                    scan_dir($root_path);
                ?>
                    <div class="createDir">
                        <form class="create-folder" action="" method="post">
                            <input class="input-text" type="text" name="add" placeholder="Folder">
                            <input class="input-btn" type="submit" value="&#43;">
                            <input type="hidden" name ='submit'>
                        </form>
                    </div>
                <?php } 
                # Create directory && render form :: END :: ;
                ?>
                <!-- Upload files :: -->
                <div class="uploads">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="image" id="img" style="display:none;"/>
                        <button class="ch-btn" type="button">
                            <label class="btn-label" for="img">Choose file</label>
                        </button>
                        <button class="up-btn" type="submit">Upload file</button>
                    </form>
                </div>
            <!-- Upload files :: END :: -->
        </div>
    </main>
</body>
</html>