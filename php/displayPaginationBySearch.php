<?php


$toBeSearch = $_GET["toBeSearch"];
$toBeSearchCaps = strtoupper($toBeSearch);
$current_page = $_GET["current_page"];
$clicked_page = $_GET["clicked_page"];
$default = 6;
$items = $default;

$xml = new DOMDocument();
$xml->load("../xml/products.xml");

$size = 0;

$products = $xml->getElementsByTagName("product");
foreach($products as $product){
    $prodName = $product->getElementsByTagName("name")[0]->nodeValue;
    $prodNameCaps = strtoupper($prodName);
    $prodNameSplit = explode(' ',$prodNameCaps);
    $category = $product->getAttribute("category");$categoryCaps = strtoupper($category);
   //  for($i = 0; $i<count($prodNameSplit))
   foreach($prodNameSplit as $partOfTheName){
       if(strpos($partOfTheName,$toBeSearchCaps)===0||strpos($categoryCaps,$toBeSearchCaps)===0){
           $size++;
           break; //lagay lang to
       }
   }
}


#get the length of pages
$lengthOfPages = ceil($size/$items);

if($lengthOfPages > 1) {


    $prev = $clicked_page-1;
    $prev_status = ($prev <= 0) ? "disabled" : "";

    echo "<button class='$prev_status' onclick='viewPageBySearch($prev)' $prev_status><i class='fas fa-chevron-left'></i>";
    
    #pages
    for($i = 1; $i <= $lengthOfPages; $i++) {

        if($i == $clicked_page) {
            echo "<button class='page-active' onclick='viewPageBySearch($i)' value=$i>$i</button>";
        } else {
            echo "<button onclick='viewPageBySearch($i)' value=$i>$i</button>";
        }
    }
    
    $next = $clicked_page+1;
    $next_status = ($next > $lengthOfPages) ? "disabled" : "";
    echo "<button class='$next_status' onclick='viewPageBySearch($next)' $next_status><i class='fas fa-chevron-right'></i>";
}
?>