<?php
session_start();
date_default_timezone_set('Asia/Manila');

$username = $_SESSION["username"];
// $username = "erika_raymundo";

$xml_cart = new DOMDocument();
$xml_cart->load("../xml/carts.xml");

$empty = 0;

#CHECK POST

if(isset($_POST)) {
    $productID = $_POST["productID"];
    $size = $_POST["size"];

    $current_stocks = getStocks($productID, $size);

    if ($current_stocks <= 0) {
        echo $empty; #medyo malabo madisplay
    } else {
        echo "goods";
    }
}

function getStocks($productID, $size) {

    $xml_prod = new DOMDocument();
    $xml_prod->load("../xml/products.xml");
    $products = $xml_prod->getElementsByTagName("product");
    
    foreach($products as $product) {
        if($product->getAttribute("prodID") == $productID) {
            
            $sizes_prices = $product->getElementsByTagName("size_price");
            foreach($sizes_prices as $size_price) {
                if($size_price->getAttribute("id") == $size) {
                    $stocks = $size_price->getElementsByTagName("stocks")[0]->nodeValue;
                    return $stocks;
                }
            }
        }
    }
}

?>