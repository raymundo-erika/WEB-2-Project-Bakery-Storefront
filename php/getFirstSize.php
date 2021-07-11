<?php

$xml = new DOMDocument();
$xml->load("../xml/products.xml");

$productID = $_GET["productID"];

    $products = $xml->getElementsByTagName("product");

    foreach($products as $product) {
        if ($product->getAttribute("prodID") ==$productID) {
            $size_price = $product->getElementsByTagName("size_price")[0];
            // echo "echo mo ako " . $size_price->getAttribute("id");
            echo $size_price->getAttribute("id");
            break;
        }
    }


?>