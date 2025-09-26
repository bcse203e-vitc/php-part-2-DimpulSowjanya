<?php
$emails = [
    "john@example.com",
    "wrong-email@",
    "me@site",
    "user123@gmail.com",
    "valid.user@domain.co"
];
$pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
echo "Valid Emails:<br>";
foreach ($emails as $email) {
    if (preg_match($pattern, $email)) {
        echo $email . "<br>";
    }
}
?>
