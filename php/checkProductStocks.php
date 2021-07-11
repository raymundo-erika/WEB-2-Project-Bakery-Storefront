<?php
session_start();
date_default_timezone_set('Asia/Manila');

// $username = $_SESSION["username"];
$username = "erika_raymundo";

$xml_cart = new DOMDocument();
$xml_cart->load("../xml/carts.xml");

#CHECK GET

if(isset($_GET)) {
    $productID = $_GET["productID"];
    $size = $_GET["size"];
    $qty = $_GET["qty"];

    $current_stocks = getStocks($productID, $size);

    if ($current_stocks <= 0) { #no stocks
        echo "empty"; #medyo malabo madisplay
    } else if ($qty > $current_stocks) { #qty selected is greater than current quantity
        echo $current_stocks;
    } else if ($qty > 10) { #qty is more than 10
        echo "exceeded";
    } else if ($qty <= 0) { #qty is more than 0
        echo "invalid";
    } else {
        echo "ok";
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