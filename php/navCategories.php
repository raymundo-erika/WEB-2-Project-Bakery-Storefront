<?php

$xml = new DOMDocument();
$xml->load("../xml/categories.xml");

$categories = $xml->getElementsByTagName("category");
$count = 0;

foreach($categories as $category) {
    $id = $category->getAttribute("id");
    $title = $category->getElementsByTagName("title")[0]->nodeValue;

    echo "<li class='category'><a href='menu.html?category=$id'>$title</a></li>";
}



?>