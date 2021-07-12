<?php

$xml = new DOMDocument();
$xml->load("../xml/categories.xml");

if(isset($_GET["category"])) {
    $categoryID = $_GET["category"];
    $categories = $xml->getElementsByTagName("category");
    
    foreach($categories as $category) {

        if ($category->getAttribute("id") == $categoryID) {
            $title = $category->getElementsByTagName("title")[0]->nodeValue;
            $description = $category->getElementsByTagName("description")[0]->nodeValue;


            echo "<h1 class='title'>Patisserie’s $title</h1>
                <p class='title-sub'>$description</p>";

            break;
        }
        
    }
    
}




?>