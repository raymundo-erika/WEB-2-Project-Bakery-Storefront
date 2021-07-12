<?php
    session_start();
    date_default_timezone_set('Asia/Manila');

    // $username = $_SESSION["username"];
    $username = "erika_raymundo";

    $xml_cart = new DOMDocument();
    $xml_cart->load("../xml/carts.xml");

    if(isset($_POST)) {
        $cart = getCart();
        $cart_item_id = getCartSize($cart->getAttribute("id")) + 1;

        $productID = $_POST["productID"];
        $qty = $_POST["qty"];
        $size = $_POST["size"];
        $totalPrice = 0;


        #foremost, CHECK IF there is still stocks
        $currentStocks = getStocks($productID, $size, $qty);

        if($qty > 10) {
            echo 1;
            exit();
        } else if ($currentStocks <=0) {
            echo 2;   
        }else {
            #first! CHECK IF THE productID IS already there
            $duplicate_item = checkForDuplicate($cart, $productID);
            $cart_item = $xml_cart->createElement("cart_item");
            $cart_item->appendChild($xml_cart->createElement("productID", $productID));

            if($duplicate_item != NULL) {
                $size = $duplicate_item->getElementsByTagName("size")[0]->nodeValue;
                $newQty = $duplicate_item->getElementsByTagName("qty")[0]->nodeValue + $qty;


                $currentStocks = getStocks($productID, $size, $qty);

                if($newQty>10) {    
                    echo 1;
                    exit();
                } else {
                    if ($qty > $currentStocks) {
                        echo $currentStocks;
                        exit();
                    } else {
                        $totalPrice = getTotalPrice($productID, $size, $newQty);

                        $cart_item->setAttribute("id", $duplicate_item->getAttribute("id"));
                        $cart_item->appendChild($xml_cart->createElement("size", $size));
                        $cart_item->appendChild($xml_cart->createElement("qty", $newQty));
                        $cart_item->appendChild($xml_cart->createElement("totalPrice", $totalPrice));
                        
                        $cart->replaceChild($cart_item, $duplicate_item);
                        // echo "nagreplace na ako!";
                    }
                }

            } else {

                if ($qty > $currentStocks) {
                    echo $currentStocks;
                    exit();
                } else {

                    $totalPrice = getTotalPrice($productID, $size, $qty);

                    $cart_item->setAttribute("id", $cart_item_id);
                    $cart_item->appendChild($xml_cart->createElement("size", $size));
                    $cart_item->appendChild($xml_cart->createElement("qty", $qty));
                    $cart_item->appendChild($xml_cart->createElement("totalPrice", $totalPrice));
                    $cart->appendChild($cart_item);
                    // echo "nag-add lang ako!";


                }

            }
            
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

            modifyStocks($productID, $size, $qty, 0);

            echo 0;
        }



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
                $cart_items = $cart->getElementsByTagName("cart_item");
                return sizeof($cart_items);
            }
        }
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

    function checkForDuplicate($cart, $productID) {
        $cart_items = $cart->getElementsByTagName("cart_item");

        foreach($cart_items as $cart_item) {
            if($cart_item->getElementsByTagName("productID")[0]->nodeValue == $productID) {
                return $cart_item;
            }
        }

        return NULL;
    }

    function getStocks($productID, $size, $qty) {

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