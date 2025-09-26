<?php
date_default_timezone_set('Asia/Kolkata');
echo "Current Date & Time: " . date("d-m-Y H:i:s") . "<br>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dob = $_POST['dob'];
    $today = new DateTime();
    $birthday = DateTime::createFromFormat('Y-m-d', $dob);
    $next = clone $birthday;
    $next->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));
    if ($next < $today) $next->modify('+1 year');
    $interval = $today->diff($next);
    echo "Days left until next birthday: " . $interval->days;
} else {
    echo '<form method="post">
        Enter your Date of Birth (YYYY-MM-DD): <input type="date" name="dob" required>
        <input type="submit" value="Calculate">
    </form>';
}
?>
