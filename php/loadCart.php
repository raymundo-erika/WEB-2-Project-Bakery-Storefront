<?php
    session_start();
    date_default_timezone_set('Asia/Manila');

    // $username = $_SESSION["username"];
    $username = "erika_raymundo";

    $xml_cart = new DOMDocument();
    $xml_cart->load("../xml/carts.xml");

    $cart = getCart();

    $cart_items = $cart->getElementsByTagName("cart_item");

    foreach($cart_items as $cart_item) {

        $cartItemID = $cart_item->getAttribute("id");
        $prodID = $cart_item->getElementsByTagName("productID")[0]->nodeValue;
        $name = getProductName($prodID);
        $unit_price = getProductPrice($prodID);
        $image = getProductImage($prodID);
        $size = $cart_item->getElementsByTagName("size")[0]->nodeValue;            
        $qty = $cart_item->getElementsByTagName("qty")[0]->nodeValue;
        $totalPrice = $cart_item->getElementsByTagName("totalPrice")[0]->nodeValue;
        
        echo "<div class='cart-item'>
                <div class='icon close' onclick='deleteCartItem(\"".$cartItemID."\")'>&times;</div>
                <div class='cart-item-image-left'>
                    <img src='" . $image . "'>
                </div>
                <div class='cart-item-right'>

                    <div class='cart-item-title'>
                        $name
                    </div>
                    <div class='cart-item-desc'>
                        Price: <b>&#8369;$unit_price</b>
                    </div>
                    <div class='cart-item-qty-price'>
                        <div class='cart-item-qty'>
                            <button>+</button>
                            <input type='text' value=$qty readonly>
                            <button>-</button>
                        </div>
                        <div class='cart-item-price'>&#8369;$totalPrice</div>

                    </div>

                </div></div>";
    }

    function getCart() {
        $carts = $GLOBALS['xml_cart']->getElementsByTagName("cart");
        foreach($carts as $cart) {
            if($cart->getAttribute("status") == 0) {
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

    
    function getProductName($productID) {

        $xml_prod = new DOMDocument();
        $xml_prod->load("../xml/products.xml");
        $products = $xml_prod->getElementsByTagName("product");

        foreach($products as $product) {
            if($product->getAttribute("prodID") == $productID) {
                return $product->getElementsByTagName("name")[0]->nodeValue;
            }
        }

    }

    function getProductPrice($productID) {

        $xml_prod = new DOMDocument();
        $xml_prod->load("../xml/products.xml");
        $products = $xml_prod->getElementsByTagName("product");

        foreach($products as $product) {
            if($product->getAttribute("prodID") == $productID) {
                return $product->getElementsByTagName("unit_price")[0]->nodeValue;
            }
        }

    }

    function getProductImage($productID) {

        $xml_prod = new DOMDocument();
        $xml_prod->load("../xml/products.xml");
        $products = $xml_prod->getElementsByTagName("product");

        foreach($products as $product) {
            if($product->getAttribute("prodID") == $productID) {
                return $product->getElementsByTagName("image")[0]->nodeValue;
            }
        }

    }
?>