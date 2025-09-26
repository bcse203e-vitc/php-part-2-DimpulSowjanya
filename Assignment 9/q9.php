<?php
$original = "data.txt"; // Change filename as needed
if (!file_exists($original)) die("File not found!");
$datetime = date("Y-m-d_H-i");
$path_parts = pathinfo($original);
$backup = $path_parts['filename'] . "_" . $datetime . "." . $path_parts['extension'];
copy($original, $backup);
echo "Backup file created: <b>$backup</b>";
?>
