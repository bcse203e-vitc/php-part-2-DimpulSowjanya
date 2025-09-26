<?php
$source = "data.txt";
$dest = "numbers.txt";
if (!file_exists($source)) die("data.txt not found!");
$text = file_get_contents($source);
preg_match_all('/\b\d{10}\b/', $text, $matches);
file_put_contents($dest, implode(PHP_EOL, $matches[0]));
echo "Extracted numbers saved to <b>numbers.txt</b>:<br>";
foreach ($matches[0] as $num) echo $num . "<br>";
?>
