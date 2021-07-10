<?php
    start_session();
    date_default_timezone_set('Asia/Manila');

    // $username = $_SESSION["username"];
    $username = "erika_raymundo";

    $xml = new DOMDocument();
    $xml->load("xml/carts.xml");

    if(isset($_POST)) {
        $productID = $_POST["productID"];
        $qty = $_POST["qty"];
        $size = $_POST["size"];

        // <cart id="" status="" username="">
        // <total></total>
        // <transaction_date></transaction_date>
        // <cart_item id="">
        //     <productID></productID>
        //     <size></size>
        //     <qty></qty>
        //     <total_item_price></total_item_price>
        // </cart_item>

        $cartID = getCart();
        $cart_item_id = 


        foreach($users as $user) {
            
            //will be used for checking
            $username = $user->getAttribute("username");
            $password = $user->getElementsByTagName("password")[0]->nodeValue;
    
            if(strtolower($un) == strtolower($username) && $pass == $password) {

                //we will update the node
                $firstName = $user->getElementsByTagName("firstName")[0]->nodeValue;
                $lastName = $user->getElementsByTagName("lastName")[0]->nodeValue;
                $profilePic = $user->getElementsByTagName("profilePic")[0]->nodeValue;

                $newNode = $xml->createElement("user");
                $newNode->setAttribute("username", $username);
                $newNode->appendChild($xml->createElement("password", $password));
                $newNode->appendChild($xml->createElement("firstName", $firstName));
                $newNode->appendChild($xml->createElement("lastName", $lastName));
                $newNode->appendChild($xml->createElement("profilePic", $profilePic));
                $newNode->appendChild($xml->createElement("status", 1));

                $currentNode = $user;
                $xml->getElementsByTagName("users")[0]->replaceChild($newNode, $currentNode);
                $xml->save("../xml/users.xml");

                session_start();
                $_SESSION['username'] = $username;

                echo 1;
                break;
            } 
        }
    }

    function generateCartID() {
		$carts = $GLOBALS['xml']->getElementsByTagName("cart");
		$cartIDs = [];

        $chars = "0123456789";
        $size = 4;
        $cartID = date("Ymd");

		foreach($carts as $cart) {
			array_push($cartIDs, $movie->getAttribute("id"));
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
        $carts = $GLOBALS['xml']->getElementsByTagName("cart");
        foreach($carts as $cart) {
            if($cart->getAttribute(status) == 0) {
                return $cart->getAttribute(id);
            }
        }

        //create one
        
        $cartID = generateCartID();
        $status = 0;
        $transaction_date = date("Y-m-d h:i:s a"); //temporary

        $newNode = $xml->createElement("cart");
        $newNode->setAttribute("id", $cartID);
        $newNode->setAttribute("status", $status);
        $newNode->setAttribute("username", $GLOBALS['username']);
        $newNode->appendChild($xml->createElement("transaction_date", $transaction_date));
        $newNode->appendChild($xml->createElement("total", 0));

        $xml->getElementsByTagName("carts")[0]->appendChild($newNode);
        $xml->save("xml/carts.xml");

        return $cartID;
    }

    function getCartSize(cartID) {

        $count = 0;

        $carts = $GLOBALS['xml']->getElementsByTagName("cart");
        foreach($carts as $cart) {
            if($cart->getAttribute("id") == cartID) {
                $cart_items = $cart->getElementsByTagName("cart_items");
                return sizeof($cart_items);
            }
        }
    }

?>