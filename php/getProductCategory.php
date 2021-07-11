<?php

$xml = new DOMDocument();
$xml->load("../xml/products.xml");

$categoryID = $_GET["category"];
$productID = $_GET["productID"];

$products = $xml->getElementsByTagName("product");


foreach($products as $product) {
    if ($product->getAttribute("prodID") == $productID) {
        echo "<a href='menu.php?category=$categoryID'><i class='fas fa-chevron-left'></i> Back to <b>".getCategoryName($categoryID)."</b> Menu</a>";
        break;
    }
}

// $product->getAttribute("category")
function getCategoryName($id) {
    $xml = new DOMDocument();
    $xml->load("../xml/categories.xml");
    $categories = $xml->getElementsByTagName("category");
    foreach($categories as $category) {
        if($category->getAttribute("id") == $id) {
            return $category->getElementsByTagName("title")[0]->nodeValue;
        }
    }
}
?>