<?php

$xml_prod = new DOMDocument();
$xml_prod->load("../xml/products.xml");
$products = $xml_prod->getElementsByTagName("product");

function getProductName($productID) {

    foreach($GLOBALS['products'] as $product) {
        if ($product->getAttribute("prodID") == $productID) {
            return $product->getElementsByTagName("name")[0]->nodeValue;
            break;
        }
    }
    
}

function getProductPrice($productID, $size) {

    foreach($GLOBALS['products'] as $product) {
        if ($product->getAttribute("prodID") == $productID) {
            $sizes_prices = $product->getElementsByTagName("size_price");
    
            foreach($sizes_prices as $size_price) {
    
                if($size_price->getAttribute("id") == $size) {
                    return $size_price->getElementsByTagName("price")[0]->nodeValue;
                }
            }
    
            break;
        }
    }
}

function getProductItemSize($productID, $size) {

    foreach($GLOBALS['products'] as $product) {
        if ($product->getAttribute("prodID") == $productID) {
            $sizes_prices = $product->getElementsByTagName("size_price");
    
            foreach($sizes_prices as $size_price) {
    
                if ($size_price->getAttribute("id")==$size) {
                    return $size_price->getElementsByTagName("size")[0]->nodeValue;
                }
            }
    
        }
    }
}

function getProductSize($productID) {

    foreach($GLOBALS['products'] as $product) {
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
    
                return "<label class='container'><b>&#8369;".number_format((float)$price, 2, '.', '')."</b> - $size
                        <input type='radio' $status name='size_price' value=\"$size_price_id\" onclick='checkAvailability(\"$size_price_id\")'>
                        <span class='checkmark'></span>
                    </label>";
            }
    
            break;
        }
    }
}

function getProductDescription($productID) {

    foreach($GLOBALS['products'] as $product) {
        if ($product->getAttribute("prodID") == $productID) {
            return $product->getElementsByTagName("description")[0]->nodeValue;
            break;
        }
    }
}

function getProductImage($productID) {
    foreach($GLOBALS['products'] as $product) {
        if ($product->getAttribute("prodID") == $productID) {
            return $product->getElementsByTagName("image")[0]->nodeValue;
            break;
        }
    }
}


?>