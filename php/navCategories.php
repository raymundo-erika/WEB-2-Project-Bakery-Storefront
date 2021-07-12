<?php

$xml = new DOMDocument();
$xml->load("../xml/categories.xml");

$categories = $xml->getElementsByTagName("category");
$count = 0;

foreach($categories as $category) {
    $count++;
    $id = $category->getAttribute("id");
    $title = $category->getElementsByTagName("title")[0]->nodeValue;
    $icon = $category->getElementsByTagName("icon")[0]->nodeValue;
    $description = $category->getElementsByTagName("description")[0]->nodeValue;

    if($count==1) {
        echo "<div id='".$id."' class='category category-clicked' onclick='showThreeProducts(this, \"".$id."\")'>
        <div class='image' style='background-image: url(\"".$icon."\")'></div>
        <p>".$title."</p>
        </div>";
    } else {
        echo "<div id='".$id."' class='category' onclick='showThreeProducts(this, \"".$id."\")'>
        <div class='image' style='background-image: url(\"".$icon."\")'></div>
        <p>".$title."</p>
        </div>";
    }
}



?>