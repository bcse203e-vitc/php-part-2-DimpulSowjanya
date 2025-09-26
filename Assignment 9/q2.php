<?php
$filename = "products.txt";

if (!file_exists($filename)) {
    die("File not found!");
}

$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$products = array();

foreach ($lines as $line) {
    list($name, $price) = explode(",", $line);
    $products[] = array(
        "name"  => trim($name),
        "price" => (float) trim($price)
    );
}
usort($products, function ($a, $b) {
    return $a["price"] <=> $b["price"];
});
echo "<h2>Product List (Sorted by Price)</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr><th>Product Name</th><th>Price</th></tr>";

foreach ($products as $product) {
    echo "<tr><td>{$product['name']}</td><td>{$product['price']}</td></tr>";
}

echo "</table>";
?>
