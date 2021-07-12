<?php

session_start();

if(isset($_GET)) {


    $xml = new DOMDocument();
    $xml->load("../xml/products.xml");
    
    $products = $xml->getElementsByTagName("product");

    $category = $_GET["category"];

    $max = 3;
    $count = 0;
    
    foreach($products as $product) {
        if($product->getAttribute("category") ==$category) {
            $count++;
            $productID = $product->getAttribute("prodID");
            $category = $product->getAttribute("category");
            $productName = $product->getElementsByTagName("name")[0]->nodeValue;
            $productDesc = $product->getElementsByTagName("description")[0]->nodeValue;
            $productImage = $product->getElementsByTagName("image")[0]->nodeValue;
            $firstSizePrice = getFirstSizePrice($productID);
            $firstSizePriceID = $firstSizePrice->getAttribute("id");
            $firstPrice = $firstSizePrice->getElementsByTagName("price")[0]->nodeValue;
    
            echo "<div class='product' id='".$productID."' onmouseover='displayActionButtons(this)' onmouseout='hideActionButtons(this)'>
                    <div class='product-img'>
                        <a href='product.html?category=$category&id=$productID'><img src=\"" . $productImage . "\"></a>
                    </div>
                    <div class='title'>" . $productName . "</div>
                    <div class='desc'> " . $productDesc . " </div>";
                
            echo "<div class='price'>
                    <label>Price starts</label>&#8369;".number_format((float)$firstPrice, 2, '.', '')."</div>";
            echo "<div class='action-buttons'>
                    <button class='btn-addToCart' onclick='addToCart(".$productID.", \"".$firstSizePriceID."\", 1)'><i class='icon fas fa-shopping-cart'></i>&nbsp;&nbsp;Add to cart</button>
                    <button class='btn-wishList' onclick='addToWishlist(".$productID.", \"".$firstSizePriceID."\")'><i class='far fa-heart'></i></button>
                </div>";
            echo "</div>";
    
            if($count == $max) {
                break;
            }
        }
    }
    

    echo "<div id='showMore'>
        <a href='menu?category=$category'><button>Show More</button></a>
    </div>";
}


function getFirstSizePrice($prodID) {

    $products = $GLOBALS['xml']->getElementsByTagName("product");

    foreach($products as $product) {
        if ($product->getAttribute("prodID") == $prodID) {
            return $product->getElementsByTagName("size_price")[0];
        }
    }
}


?>