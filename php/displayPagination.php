<?php

// $catID = $_GET["category"];
// $page = $_GET["page"];

$catID = "cheese_cake";
$page = 1;
$default = 6;
$items = $default;

$xml = new DOMDocument();
$xml->load("../xml/products.xml");

$size = 0;

#get all the product ID of that category
foreach($xml->getElementsByTagName("product") as $product) {
    if($product->getAttribute("category") == $catID)
        $size++;
}

#get the length of pages
$lengthOfPages = ceil($size/$items);

if($lengthOfPages > 1) {
    echo "<button id='btnPrev' onclick='viewPrevPage(this)'><i class='fas fa-chevron-left'></i>";
    
    for($i = 1; $i <= $lengthOfPages; $i++) {

        if($i == 1) {
            echo "<button class='page-active' onclick='viewPage(this)' value=$i>$i</button>";
        } else {
            echo "<button onclick='viewPage(this) value=$i'>$i</button>";
        }
    }

        
    echo "<button id='btnNext' onclick='viewNextPage(this)'><i class='fas fa-chevron-right'></i></a>";
}
?>