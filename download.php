<?php 
// file download logic
if(isset($_POST['download'])){
    // if ($_POST['download']
    $root = getcwd();
    $getPath = $_GET['path'];
    // print('Path to download: ' . './' . $_GET["path"] . $_POST['download']);
    $file='./' . $_GET["path"] . $_POST['download'];
    // a&nbsp;b.txt
    // a b.txt
    $fileToDownloadEscaped = str_replace("&nbsp;", " ", htmlentities($file, null, 'utf-8'));
    ob_clean();
    ob_start();
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf'); // mime type → ši forma turėtų veikti daugumai failų, su šiuo mime type. Jei neveiktų reiktų daryti sudėtingesnę logiką
    header('Content-Disposition: attachment; filename=' . basename($fileToDownloadEscaped));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fileToDownloadEscaped)); // kiek baitų browseriui laukti, jei 0 - failas neveiks nors bus sukurtas
    ob_end_flush();
    if (is_file($fileToDownloadEscaped)) {
        readfile($fileToDownloadEscaped);
    } else {
        echo "WTF??";
    }
    // readfile($fileToDownloadEscaped);
    exit;
}
echo "AHAHAHAHA: $fileToDownloadEscaped";
?>