<?php


$catID = $_GET["category"];
$current_page = $_GET["current_page"];
$clicked_page = $_GET["clicked_page"];
$default = 6;
$items = $default;

$xml = new DOMDocument();
$xml->load("../xml/products.xml");

$size = 0;

foreach($xml->getElementsByTagName("product") as $product) {
    if($product->getAttribute("category") == $catID)
        $size++;
}

#get the length of pages
$lengthOfPages = ceil($size/$items);

if($lengthOfPages > 1) {


    $prev = $clicked_page-1;
    $prev_status = ($prev <= 0) ? "disabled" : "";

    echo "<button class='$prev_status' onclick='viewPage($prev)' $prev_status><i class='fas fa-chevron-left'></i>";
    
    #pages
    for($i = 1; $i <= $lengthOfPages; $i++) {

        if($i == $clicked_page) {
            echo "<button class='page-active' onclick='viewPage($i)' value=$i>$i</button>";
        } else {
            echo "<button onclick='viewPage($i)' value=$i>$i</button>";
        }
    }
    
    
    $next = $clicked_page+1;
    $next_status = ($next > $lengthOfPages) ? "disabled" : "";
    echo "<button class='$next_status' onclick='viewPage($next)' $next_status><i class='fas fa-chevron-right'></i>";
}
?>