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
    $prevPage = $page-1;
    echo "<button onclick='viewPage($prevPage)'><i class='fas fa-chevron-left'></i>";
}

for($i = 1; $i <= $lengthOfPages; $i++) {

    if($i == 1) {
        echo "<button class='active' onclick='viewPage($i)'>$i</button>";
    } else {
        echo "<button onclick='viewPage($i)'>$i</button>";
    }
}

if($lengthOfPages > 1 && $lengthOfPages != $page) {
    echo "<a href='#'><i class='fas fa-chevron-right'></i></a>";
}

?>