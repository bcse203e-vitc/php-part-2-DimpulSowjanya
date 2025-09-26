<?php
$logfile = "access.log";

// To simulate a user and action, you can use a form or set values directly:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $action = trim($_POST['action']);
    if ($username && $action) {
        $entry = $username . " – " . date("Y-m-d H:i:s") . " – " . $action . PHP_EOL;
        file_put_contents($logfile, $entry, FILE_APPEND);
        echo "<span style='color:green;'>Log entry added!</span><br><br>";
    } else {
        echo "<span style='color:red;'>Please enter both username and action.</span><br><br>";
    }
}

// Read and display the last 5 log entries
if (file_exists($logfile)) {
    $lines = file($logfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $last5 = array_slice($lines, -5);

    echo "<b>Last 5 Log Entries:</b><br><pre>";
    foreach ($last5 as $line) {
        echo htmlspecialchars($line) . "\n";
    }
    echo "</pre>";
} else {
    echo "No log entries yet.<br>";
}
?>

<form method="post">
    Username: <input type="text" name="username" required>
    Action: <input type="text" name="action" required>
    <input type="submit" value="Add Log Entry">
</form>
