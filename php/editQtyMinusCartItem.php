<?php
    session_start();
    date_default_timezone_set('Asia/Manila');

    // $username = $_SESSION["username"];
    $username = "erika_raymundo";

    $xml_cart = new DOMDocument();
    $xml_cart->load("../xml/carts.xml");

    if(isset($_POST)) {
        $cart = getCart();
        $cart_item_id = $_POST["cartItemID"];
        $qty = $_POST["qty"];
        $totalPrice = 0;

        $cart_item = getCartItem($cart, $cart_item_id);
        $productID = $cart_item->getElementsByTagName("productID")[0]->nodeValue;
        $size = $cart_item->getElementsByTagName("size")[0]->nodeValue;

        #foremost, CHECK IF there is still stocks
        $currentStocks = getStocks($productID, $size);


            $new_cart_item = $xml_cart->createElement("cart_item");
            $new_cart_item->setAttribute("id", $cart_item_id);
            $new_cart_item->appendChild($xml_cart->createElement("productID", $productID));

            $size = $cart_item->getElementsByTagName("size")[0]->nodeValue;
            $newQty = $cart_item->getElementsByTagName("qty")[0]->nodeValue - $qty;

            if($newQty <=0) {
                echo 1;
                exit();
            } else {
    
            $totalPrice = getTotalPrice($productID, $size, $newQty);

            $new_cart_item->appendChild($xml_cart->createElement("size", $size));
            $new_cart_item->appendChild($xml_cart->createElement("qty", $newQty));
            $new_cart_item->appendChild($xml_cart->createElement("totalPrice", $totalPrice));
                        
            $cart->replaceChild($new_cart_item, $cart_item);
            
            $cart_total = getCartTotal($cart);
            // echo "CARTTOTAL $cart_total";

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

            modifyStocks($productID, $size, $qty, 1);

            echo 0;
        }
    }

    function getCartItem($cart, $cartItemID) {
        $cartItems = $cart->getElementsByTagName("cart_item");

        foreach($cartItems as $cartItem) {
            if($cartItem->getAttribute("id") == $cartItemID) {
                return $cartItem;
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

    function getTotalPrice($productID, $sizeID, $qty) {

        $xml_prod = new DOMDocument();
        $xml_prod->load("../xml/products.xml");
        $products = $xml_prod->getElementsByTagName("product");

        foreach($products as $product) {
            if($product->getAttribute("prodID") == $productID) {

                $sizes_prices = $product->getElementsByTagName("size_price");
                foreach($sizes_prices as $size_price) {
                    if($size_price->getAttribute("id") == $sizeID) {

                        $price = $size_price->getElementsByTagName("price")[0]->nodeValue;

                        $total_price = $price * $qty;
                        return $total_price;
                    }
                }


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

    function getStocks($productID, $size) {

        $xml_prod = new DOMDocument();
        $xml_prod->load("../xml/products.xml");
        $products = $xml_prod->getElementsByTagName("product");
        
        foreach($products as $product) {
            if($product->getAttribute("prodID") == $productID) {
                
                $sizes_prices = $product->getElementsByTagName("size_price");
                foreach($sizes_prices as $size_price) {
                    if($size_price->getAttribute("id") == $size) {
                        $stocks = $size_price->getElementsByTagName("stocks")[0]->nodeValue;
                        return $stocks;
                    }
                }
            }
        }
    }

    function modifyStocks($productID, $size, $qty, $operation) {

        $xml_prod = new DOMDocument();
        $xml_prod->load("../xml/products.xml");
        $products = $xml_prod->getElementsByTagName("product");
        
        foreach($products as $product) {
            if($product->getAttribute("prodID") == $productID) {
                

                $name = $product->getElementsByTagName("name")[0]->nodeValue;
                $desc = $product->getElementsByTagName("description")[0]->nodeValue;
                $image = $product->getElementsByTagName("image")[0]->nodeValue;
                $sizes_prices = $product->getElementsByTagName("size_price");

                $new_sizes_prices = $xml_prod->createElement("sizes_prices");

                foreach($sizes_prices as $size_price) {

                    $stocks = $size_price->getElementsByTagName("stocks")[0]->nodeValue;

                    if($size_price->getAttribute("id") == $size) {
                        $newStocks = $stocks;
                
                        if($operation == 0) {//minus
                            $newStocks-=$qty;
                        } else if ($operation == 1) { //add
                            $newStocks+=$qty;
                        }

                        $stocks = $newStocks;

                    }

                    $new_size_price = $xml_prod->createElement("size_price");
                    $new_size_price->setAttribute("id", $size_price->getAttribute("id"));

                    $new_size = $xml_prod->createElement("size", $size_price->getElementsByTagName("size")[0]->nodeValue);
                    $new_price = $xml_prod->createElement("price", $size_price->getElementsByTagName("price")[0]->nodeValue);

                    $new_size_price->appendChild($new_size);
                    $new_size_price->appendChild($new_price);
                    $new_size_price->appendChild($xml_prod->createElement("stocks", $stocks));
                    $new_sizes_prices->appendChild($new_size_price);
                    
                }   

                $newNode = $xml_prod->createElement("product");
                $newNode->setAttribute("prodID", $productID);
                $newNode->setAttribute("category", $product->getAttribute("category"));
                $newNode->setAttribute("featured", $product->getAttribute("featured"));
                $newNode->appendChild($xml_prod->createElement("name", $name));
                $newNode->appendChild($xml_prod->createElement("description", $desc));
                $newNode->appendChild($new_sizes_prices);
                $newNode->appendChild($xml_prod->createElement("image", $image));

                $currentNode = $product;
                $xml_prod->getElementsByTagName("products")[0]->replaceChild($newNode, $currentNode);
    
                $xml_prod->save("../xml/products.xml");
                break;
            }
        }
    }

?>