<?php
// php// File download logic
if(isset($_POST['download'])){
    $root_path = getcwd();
    $dl = $_POST['download'];
    $path = $root_path.$dl;
    $fixedPath = str_replace('/', '\\', $path);

    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename=' . basename($fixedPath));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fixedPath));
    header('Content-Type: image/jpeg');
    
    ob_clean();
    flush();
    readfile($fixedPath);
    exit;
}
?>