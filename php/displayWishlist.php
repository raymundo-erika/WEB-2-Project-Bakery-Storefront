<?php
    session_start();
    date_default_timezone_set('Asia/Manila');

    // $username = $_SESSION["username"];
    include_once "getProductFunctions.php";

    $username = "erika_raymundo";

    $xml = new DOMDocument();
    $xml->load("../xml/wishes.xml");

    if(isset($_POST)) {

        $wishes = $xml->getElementsByTagName("wish");

        foreach($wishes as $wish) {
            if($wish->getAttribute("username") == $username) {
                $wishID = $wish->getAttribute("id");
                $productID = $wish->getElementsByTagName("productID")[0]->nodeValue;
                $size = $wish->getElementsByTagName("size")[0]->nodeValue;
                $sizeName = getProductItemSize($productID, $size);
                $name = getProductName($productID);
                $price = getProductPrice($productID, $size);
                $image = getProductImage($productID);
                $desc = getProductDescription($productID);
    
                echo "<div class='wish_item'>
                    <div class='wish_left'>
                        <img src=" ."$image".   ">
                    </div>
                    <div class='wish_center'>
                        <div class='wish_name'>$name</div>
                        <div class='wish_desc'>$desc</div>
                        <div class='wish_size'><b>Size:</b> $sizeName</div>
                        <div class='wish_price'>&#8369; $price</div>
                    </div>
                    <div class='wish_right'>
                        <button class='btn-addToCart' onclick='addToCart(".$productID.", \"".$size."\", 1)'><i class='icon fas fa-shopping-cart'></i>&nbsp;&nbsp;Add to cart</button>
                        <button class='btn-wishList' onclick='deleteFromWishlist(".$wishID.")'>Remove from list</button>
            
                    </div>
                </div>";
            }
            
        }
    }
  

?>