<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        function reading($files) {
            // TODO change files to .txt :: !!
            if (is_readable($files)) {
                $file = fopen($files, 'r');
                $lines = "<div>";
                // echo fgets($file);
                while(! feof($file)) {
                    $lines = $lines.fgets($file);
                }
                // echo $lines. "<br>";
                // echo htmlspecialchars($lines);
                echo htmlspecialchars_decode($lines);
            } else {
                echo "failas<br>";
            }
            fclose($file);
        }
        
        // reading('text.txt');
        // reading('index.txt');echo "<br>";
        reading('styles.css');
    ?>
</body>
</html>