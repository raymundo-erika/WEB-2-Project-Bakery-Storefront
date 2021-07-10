<?php
    session_start();
    date_default_timezone_set('Asia/Manila');

    // $username = $_SESSION["username"];
    $username = "erika_raymundo";

    $xml_cart = new DOMDocument();
    $xml_cart->load("../xml/carts.xml");

    if(isset($_POST)) {
        $cart = getCart();
        $cart_item_id = getCartSize($cart->getAttribute("prodID")) + 1;

        $productID = $_POST["productID"];
        $qty = $_POST["qty"];
        $size = "";
        $totalPrice = 0;
        

        if (isset($_POST["size"])) {
            // $size = $_POST["size"];
            // $total_price = getTotalPrice($productID, $size, $qty);
        } else {
            $totalPrice = getTotalPrice($productID, $qty);
            echo "<h1>TOTAL PRICE Is $totalPrice</h1>";
        }

        #append the new item
        $cart_item = $xml_cart->createElement("cart_item");
        $cart_item->appendChild($xml_cart->createElement("productID", $productID));
        $cart_item->appendChild($xml_cart->createElement("size", $size));
        $cart_item->appendChild($xml_cart->createElement("qty", $qty));
        $cart_item->appendChild($xml_cart->createElement("totalPrice", $totalPrice));

        $cart->appendChild($cart_item);

        
        $cart_total = getCartTotal($cart);
        echo "CARTTOTAL $cart_total";

        #now, let us edit the cart

        $newNode = $xml_cart->createElement("cart");
        $newNode->setAttribute("id", $cart->getAttribute("id"));
        $newNode->setAttribute("status", $cart->getAttribute("status"));
        $newNode->setAttribute("username", $cart->getAttribute("username"));
        $newNode->appendChild($xml_cart->createElement("transaction_date", $cart->getElementsByTagName("transaction_date")[0]->nodeValue));
        $newNode->appendChild($xml_cart->createElement("total", $cart_total));

        $cart_items = $cart->getElementsByTagName("cart_item");

        foreach($cart_items as $cart_item) {
            $newNodeItem = $xml_cart->createElement("cart_item");

            $newProdID = $xml_cart->createElement("productID", $cart_item->getElementsByTagName("productID")[0]->nodeValue);
            $newSize = $xml_cart->createElement("size", $cart_item->getElementsByTagName("size")[0]->nodeValue);
            $newQty = $xml_cart->createElement("qty", $cart_item->getElementsByTagName("qty")[0]->nodeValue);
            $newTotalPrice = $xml_cart->createElement("totalPrice", $cart_item->getElementsByTagName("totalPrice")[0]->nodeValue);

            $newNodeItem->setAttribute("id", $cart_item->getAttribute("id"));
            $newNodeItem->appendChild($newProdID);
            $newNodeItem->appendChild($newSize);
            $newNodeItem->appendChild($newQty);
            $newNodeItem->appendChild($newTotalPrice);

            $newNode->appendChild($newNodeItem);
        }

        
       

        $currentNode = $cart;
        $xml_cart->getElementsByTagName("carts")[0]->replaceChild($newNode, $currentNode);

        $xml_cart->save("../xml/carts.xml");

        echo "<h1>1</h1>";

    }

    function generateCartID() {
		$carts = $GLOBALS['xml_cart']->getElementsByTagName("cart");
		$cartIDs = [];

        $chars = "0123456789";
        $size = 4;
        $cartID = date("Ymd");

		foreach($carts as $cart) {
			array_push($cartIDs, $cart->getAttribute("id"));
		}

        while(true) {
            for($i = 0; $i < $size; $i++) {
                $cartID .= $chars[rand(0, strlen($chars)-1)];
            }

            if(!in_array($cartID, $cartIDs))  {
                return $cartID;
            }
        }
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

    function getCartSize($cartID) {

        $count = 0;

        $carts = $GLOBALS['xml_cart']->getElementsByTagName("cart");
        foreach($carts as $cart) {
            if($cart->getAttribute("id") == $cartID) {
                $cart_items = $cart->getElementsByTagName("cart_items");
                return sizeof($cart_items);
            }
        }
    }

    function getTotalPrice($productID, $qty) {

        $xml_prod = new DOMDocument();
        $xml_prod->load("../xml/carts.xml");
        
        $xml_prod->load("../xml/products.xml");
        $products = $xml_prod->getElementsByTagName("product");

        echo "LOL1!";
        foreach($products as $product) {
            echo "LOL2!";
            if($product->getAttribute("prodID") == $productID) {
                echo "LOL!";
                $total_price = $product->getElementsByTagName("unit_price")[0]->nodeValue * $qty;
                return $total_price;
            }
        }

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

    function checkForDuplicate($productID) {
        
    }

    // function getTotalPrice($productID, $size, $qty) {
    //     $products = $GLOBALS['xml_cart']->getElementsByTagName("product");

    //     foreach($products as $product) {
    //         if($product->getAttribute("id") == $productID) {

    //             $sizes_prices = $product->getElementsByTagName("size_price");
    //             if($sizes_prices!=NULL) {
    //                 foreach($sizes_prices as $size_price) {
    //                     if($size_price->getElementsByTagName("size")[0]->nodeValue == $size) {
    //                         return $size_price->getElementsByTagName("price")[0]->nodeValue * $qty;
    //                     }
    //                 }
    //             }

    //             $total_price = $product->getElementsByTagName("unit_price")[0]->nodeValue * $qty;
    //             return $total_price;
    //         }
    //     }
    // }

?>