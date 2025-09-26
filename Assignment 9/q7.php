<?php
function average($arr) {
    if (empty($arr)) {
        throw new Exception("No numbers provided");
    }
    return array_sum($arr) / count($arr);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = trim($_POST['numbers'] ?? '');
    if ($input === '') {
        echo "<span style='color:red;'>Please enter at least one number.</span><br>";
    } else {
        // Split input by comma, filter empty, and convert to numbers
        $numbers = array_filter(array_map('trim', explode(',', $input)), fn($n) => $n !== '');
        $numbers = array_map('floatval', $numbers);

        try {
            $avg = average($numbers);
            echo "<span style='color:green;'>Average: " . $avg . "</span>";
        } catch (Exception $e) {
            echo "<span style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</span>";
        }
    }
}
?>

<form method="post">
    Enter numbers (comma-separated): <input type="text" name="numbers" placeholder="e.g. 10, 20, 30" required>
    <input type="submit" value="Calculate Average">
</form>
