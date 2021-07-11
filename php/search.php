<?php
     $toBeSearch = $_GET["toBeSearch"];
     $toBeSearchCaps = strtoupper($toBeSearch);
 
     $xml = new DOMDocument();
     $xml->load("../xml/products.xml");
     
     $products = $xml->getElementsByTagName("product");

     $openSuggestion = 0;

     foreach($products as $product){
         $prodName = $product->getElementsByTagName("name")[0]->nodeValue;
         $prodNameCaps = strtoupper($prodName);
         $prodNameSplit = explode(' ',$prodNameCaps);
         $category = strtoupper($product->getAttribute("category"));
        //  for($i = 0; $i<count($prodNameSplit))
        foreach($prodNameSplit as $partOfTheName){
            if(strpos($partOfTheName,$toBeSearchCaps)===0||strpos($category,$toBeSearchCaps)===0){
                $prodImg = $product->getElementsByTagName("image")[0]->nodeValue;
                $prodId = $product->getAttribute("prodID");
                echo "<li onclick=openItemDisplay('$prodId')><img src='$prodImg'><span>$prodName</span></li>";
                $openSuggestion =1;
            }
        }
     }

     if($openSuggestion!=1){
         echo 0;
     }
?>