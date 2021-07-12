<?php 
      session_start();
      $username = $_SESSION["username"]; // kunin sa session

    $xml = new DOMDocument();
    $xml->load("../xml/carts.xml");

    $carts = $xml->getElementsByTagName("cart");

    foreach($carts as $cart){
        if($cart->getAttribute("username")==$username&&$cart->getAttribute("status")==0){
            $cart->removeAttribute("status");
            $cart->setAttribute("status",1);
            $xml->save("../xml/carts.xml");
            break;
        }
    }

?>