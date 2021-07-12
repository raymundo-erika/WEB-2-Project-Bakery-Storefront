<?php
session_start();
$xml_cart = new DOMDocument();
$xml_cart->load("../xml/carts.xml");
$username = $_SESSION["username"];

    $cart = getCart();
    $total = getCartTotal($cart);

    echo "Total: <b>&#8369;$total</b>";

    function getCart() {
        $carts = $GLOBALS['xml_cart']->getElementsByTagName("cart");
        foreach($carts as $cart) {
            if($cart->getAttribute("status") == 0 && $cart->getAttribute("username") == $GLOBALS['username']) {
                return $cart;
            }
        }

        //create one
        
        $cartID = generateCartID();
        $status = 0;
        $transaction_date = date("Y-m-d h:i:s a"); //temporary

        $newNode = $GLOBALS['xml_cart']->createElement("cart");
        $newNode->setAttribute("id", $cartID);
        $newNode->setAttribute("status", $status);
        $newNode->setAttribute("username", $GLOBALS['username']);
        $newNode->appendChild($GLOBALS['xml_cart']->createElement("transaction_date", $transaction_date));
        $newNode->appendChild($GLOBALS['xml_cart']->createElement("total", 0));

        $GLOBALS['xml_cart']->getElementsByTagName("carts")[0]->appendChild($newNode);
        $GLOBALS['xml_cart']->save("../xml/carts.xml");

        return $newNode;
    }

    function getCartTotal($cart) {
        $carts = $GLOBALS['xml_cart']->getElementsByTagName("cart");
        $cart_items = $cart->getElementsByTagName("cart_item");
        $total = 0;
        
        foreach($cart_items as $cart_item) {
            $total+=$cart_item->getElementsByTagName("totalPrice")[0]->nodeValue;
        }

        return $total;
    }


?>