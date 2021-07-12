<?php

session_start();

$xml = new DOMDocument();
$xml->load("../xml/products.xml");

$products = $xml->getElementsByTagName("product");

$max = 3;
$count = 0;

foreach($products as $product) {
    if($product->getAttribute("featured") == 1) {
        $count++;
        $productID = $product->getAttribute("prodID");
        $category = $product->getAttribute("category");
        $productName = $product->getElementsByTagName("name")[0]->nodeValue;
        $productDesc = $product->getElementsByTagName("description")[0]->nodeValue;
        $productImage = $product->getElementsByTagName("image")[0]->nodeValue;

        echo "<div class='slide'>
                <div class='title-text'>
                    <h1>$productName</h1>
                    <p>$productDesc</p>
                    <a href='product.php?category=$category&id=$productID'><button>Buy now</button></a>
                </div>

                <div class='image-container'>
                        <img src=" ."$productImage".   ">

                </div>
            </div>";

        if($count == $max) {
            break;
        }
    }
}

?>