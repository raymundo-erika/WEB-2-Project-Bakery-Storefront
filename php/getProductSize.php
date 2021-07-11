<?php

$xml = new DOMDocument();
$xml->load("../xml/products.xml");

$productID = $_GET["productID"];

$products = $xml->getElementsByTagName("product");

foreach($products as $product) {
    if ($product->getAttribute("prodID") == $productID) {
        $sizes_prices = $product->getElementsByTagName("size_price");

        $count = 0;
        foreach($sizes_prices as $size_price) {

            $count++;
            $status = "";

            $size_price_id = $size_price->getAttribute("id");
            $size = $size_price->getElementsByTagName("size")[0]->nodeValue;
            $price = $size_price->getElementsByTagName("price")[0]->nodeValue;


            if ($count==1) {
                $status = "checked";
            }

            echo "<label class='container' id='s1'><b>&#8369;".number_format((float)$price, 2, '.', '')."</b> - $size
                    <input type='radio' $status name='size_price'>
                    <span class='checkmark'></span>
                </label>";
        }

        break;
    }
}
?>