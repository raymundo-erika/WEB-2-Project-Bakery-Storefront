<?php

session_start();
date_default_timezone_set('Asia/Manila');

// $username = $_SESSION["username"];
$username = "erika_raymundo";

if(isset($_GET)) {
    $productID = $_GET["productID"];
    $sizeID = $_GET["size"];
    $qty = $_GET["qty"];

    $total = getTotalPrice($productID, $sizeID, $qty);
    echo "&#8369;".number_format($total, 2, '.', '');
}

function getTotalPrice($productID, $sizeID, $qty) {

    $xml_prod = new DOMDocument();
    $xml_prod->load("../xml/products.xml");
    $products = $xml_prod->getElementsByTagName("product");

    foreach($products as $product) {
        if($product->getAttribute("prodID") == $productID) {

            $sizes_prices = $product->getElementsByTagName("size_price");
            foreach($sizes_prices as $size_price) {
                if($size_price->getAttribute("id") == $sizeID) {

                    $price = $size_price->getElementsByTagName("price")[0]->nodeValue;

                    $total_price = $price * $qty;
                    return $total_price;
                }
            }


        }
    }

}


?>