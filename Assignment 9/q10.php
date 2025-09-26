<?php
$infile = "students.txt";
$errorfile = "errors.log";
if (!file_exists($infile)) die("students.txt not found!");
$lines = file($infile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$valid = [];
$invalid = [];
$email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
foreach ($lines as $line) {
    $parts = array_map('trim', explode(",", $line));
    if (count($parts) != 3) {
        $invalid[] = $line . " - Missing fields";
        continue;
    }
    list($name, $email, $dob) = $parts;
    if (!preg_match($email_pattern, $email)) {
        $invalid[] = $line . " - Invalid email";
        continue;
    }
    $age = (int)date_diff(date_create($dob), date_create('today'))->y;
    $valid[] = ['name'=>$name, 'email'=>$email, 'age'=>$age];
}
if ($invalid) file_put_contents($errorfile, implode(PHP_EOL, $invalid) . PHP_EOL, FILE_APPEND);
echo "<table border='1' cellpadding='5'><tr><th>Name</th><th>Email</th><th>Age</th></tr>";
foreach ($valid as $record) {
    echo "<tr><td>{$record['name']}</td><td>{$record['email']}</td><td>{$record['age']}</td></tr>";
}
echo "</table>";
?>
