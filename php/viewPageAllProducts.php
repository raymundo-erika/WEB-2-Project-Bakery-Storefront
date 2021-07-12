<?php

session_start();

if(isset($_GET)) {

    $page = $_GET["pageNo"];

    $default = 6;
    $items = $default;

    $xml = new DOMDocument();
    $xml->load("../xml/products.xml");

    $products = []; //products to be displayed

    #get all the product of that category
    foreach($xml->getElementsByTagName("product") as $product) {
        array_push($products, $product);
    }

    #get the size or count
    $size = sizeof($products);

    #get the length of pages
    $lengthOfPages = ceil($size/$items);

    #check if the length of pages is equal to the currently selected page
    if ($lengthOfPages == $page) {
        $items = $size;

        for($i=0;$i<$lengthOfPages-1;$i++) {
            $items-=6;
        }
    }

    #display the products by 6 items at a time
    $startIndex = ($page * $default) - $default;
    $lastIndex = $startIndex + $items;

    for($i = $startIndex; $i < $lastIndex; $i++) {

        $id = $products[$i]->getAttribute("prodID");
        $name = $products[$i]->getElementsByTagName("name")[0]->nodeValue;
        $image = $products[$i]->getElementsByTagName("image")[0]->nodeValue;
        $description = $products[$i]->getElementsByTagName("description")[0]->nodeValue;
        $category = getProductCategoryID($id);
        $firstSizePrice = getFirstSizePrice($id);
        $firstSizePriceID = $firstSizePrice->getAttribute("id");


        $firstPrice = $firstSizePrice->getElementsByTagName("price")[0]->nodeValue;

        $description = $products[$i]->getElementsByTagName("description")[0]->nodeValue;
        
        echo "<div class='product' id='".$id."' onmouseover='displayActionButtons(this)' onmouseout='hideActionButtons(this)'>
                <div class='product-img'>
                    <a href='product.php?category=$category&id=$id'><img src=\"" . $image . "\"></a>
                </div>
                <div class='title'>" . $name . "</div>
                <div class='desc'> " . $description . " </div>";
            
        echo "<div class='price'>
                <label>Price starts</label>&#8369;".number_format((float)$firstPrice, 2, '.', '')."</div>";
        echo "<div class='action-buttons'>
                <button class='btn-addToCart' onclick='addToCart(".$id.", \"".$firstSizePriceID."\", 1)'><i class='icon fas fa-shopping-cart'></i>&nbsp;&nbsp;Add to cart</button>
                <button class='btn-wishList' onclick='addToWishlist(".$id.", \"".$firstSizePriceID."\")'><i class='far fa-heart'></i></button>
            </div>";
        echo "</div>";
    }
}

function getFirstSizePrice($prodID) {

    $products = $GLOBALS['xml']->getElementsByTagName("product");

    foreach($products as $product) {
        if ($product->getAttribute("prodID") == $prodID) {
            return $product->getElementsByTagName("size_price")[0];
        }
    }
}

function getProductCategoryID($productID){
    $xml_prod = new DOMDocument();
    $xml_prod->load("../xml/products.xml");
    $products = $xml_prod->getElementsByTagName("product");

    foreach($products as $product) {
        if($product->getAttribute("prodID") == $productID) {
            return $product->getAttribute("category");
        }
    }
}

?>