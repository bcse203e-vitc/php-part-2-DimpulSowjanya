<?php
class PasswordException extends Exception {}

function validatePassword($password) {
    if (strlen($password) < 8)
        throw new PasswordException("Password must be at least 8 characters long");
    if (!preg_match('/[A-Z]/', $password))
        throw new PasswordException("Password must contain at least one uppercase letter");
    if (!preg_match('/\d/', $password))
        throw new PasswordException("Password must contain at least one digit");
    if (!preg_match('/[@#$%]/', $password))
        throw new PasswordException("Password must contain at least one special character (@, #, \$, %)");
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'] ?? '';
    try {
        validatePassword($password);
        echo "<span style='color:green;'>Password is valid.</span>";
    } catch (PasswordException $e) {
        echo "<span style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</span>";
    }
}
?>

<form method="post">
    Enter Password: <input type="password" name="password" required>
    <input type="submit" value="Validate">
</form>
