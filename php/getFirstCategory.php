<?php

$xml = new DOMDocument();
$xml->load("../xml/categories.xml");

$categories = $xml->getElementsByTagName("category");

if($categories!=NULL) {
    echo $categories[0]->getAttribute("id");
}

?>