<?php

$xml = new DOMDocument();
$xml->load("../xml/products.xml");

$productID = $_GET["productID"];

$products = $xml->getElementsByTagName("product");

foreach($products as $product) {
    if ($product->getAttribute("prodID") == $productID) {
        echo $product->getElementsByTagName("name")[0]->nodeValue;
        break;
    }
}
?>