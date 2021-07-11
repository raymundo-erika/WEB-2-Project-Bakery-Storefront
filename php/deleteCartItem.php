<?php
    session_start();
    date_default_timezone_set('Asia/Manila');

    // $username = $_SESSION["username"];
    $username = "erika_raymundo";

    $xml_cart = new DOMDocument();
    $xml_cart->load("../xml/carts.xml");

    if(isset($_POST)) {

        $cartItemID = $_POST["cartItemID"];
        echo "cart ITEM ID is $cartItemID";

        $cart = getCart();
        $cart_items = $cart->getElementsByTagName("cart_item");
        
        foreach($cart_items as $cart_item) {

            echo "eto ako e" . $cartItemID . "  ";
            if($cart_item->getAttribute("id") == $cartItemID) {
                echo"i am here";

                modifyStocks($cart_item->getElementsByTagName("productID")[0]->nodeValue, 
                $cart_item->getElementsByTagName("size")[0]->nodeValue, 
                $cart_item->getElementsByTagName("qty")[0]->nodeValue, 1);
                
                echo"nagbago na ang lahuuuut2222";

                $cart->removeChild($cart_item);
                $xml_cart->save("../xml/carts.xml");
                echo"nagbago na ang lahuuuut1111111111";
 
                break;
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