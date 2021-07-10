<?php

session_start();
// $catID = $_SESSION["current_category"];
$catID = $_GET["category"];
$page = $_GET["pageNo"];

$default = 6;
$items = $default;

$xml = new DOMDocument();
$xml->load("../xml/products.xml");

$products = []; //products to be displayed

#get all the product ID of that category
foreach($xml->getElementsByTagName("product") as $product) {
    if($product->getAttribute("category") == $catID)
        array_push($products, $product);
}

#get the size or count
$size = sizeof($products);

#get the length of pages
$lengthOfPages = ceil($size/$items);

#check if the length of pages is equal to the currently selected page
#make sure that the items to be displayed is the remainder

if ($lengthOfPages == $page) {
    $items = ($lengthOfPages * $items)  - $size;
    $items = ($items == 0) ? 6 : $items;
}
#display the products by 6 items at a time
$startIndex = ($page * $default) - $default;
$lastIndex = $startIndex + $items;

for($i = $startIndex; $i < $lastIndex; $i++) {

    $id = $products[$i]->getAttribute("id");
    $name = $products[$i]->getElementsByTagName("name")[0]->nodeValue;
    $image = $products[$i]->getElementsByTagName("image")[0]->nodeValue;
    $description = $products[$i]->getElementsByTagName("description")[0]->nodeValue;
    $unit_price = $products[$i]->getElementsByTagName("unit_price")[0]->nodeValue;
    $description = $products[$i]->getElementsByTagName("description")[0]->nodeValue;
    
    echo "<div class='product' id='".$id."'>
            <div class='product-img'>
                <img src=\"" . $image . "\">
            </div>
            <div class='title'>" . $name . "</div>
            <div class='desc'> " . $description . " </div>";

    if ($unit_price != NULL) {
        echo "<div class='price'>&#8369;".$unit_price."</div>";
        echo "<div class='action-buttons'>
                <a href='#'><button class='btn-addToCart'><i class='icon fas fa-shopping-cart'></i>&nbsp;&nbsp;Add to cart</button></a>
                <button class='btn-wishList'><i class='far fa-heart'></i></button>
            </div>";
    } else {
        echo "<div class='action-buttons'>
                <button class='btn-addToCart'><i class='icon fas fa-shopping-cart'></i>&nbsp;&nbsp;Add to cart</button>
                <button class='btn-wishList'><i class='far fa-heart'></i></button>
            </div>";
    }
    
    echo "</div>";
}



?>