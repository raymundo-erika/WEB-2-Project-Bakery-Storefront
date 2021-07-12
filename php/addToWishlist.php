<?php
    session_start();
    date_default_timezone_set('Asia/Manila');

    // $username = $_SESSION["username"];
    $username = "erika_raymundo";

    $xml = new DOMDocument();
    $xml->load("../xml/wishes.xml");

    if(isset($_POST)) {

        $productID = $_POST["productID"];
        $size = $_POST["size"];

        $hasDuplicate = checkForDuplicate($productID, $size);
        if($hasDuplicate) {
            echo "duplicated";
        } else {

            $wishes_item_id = getWishSize() + 1;

            $wish = $xml->createElement("wish");
            $wish->setAttribute("id", $wishes_item_id);
            $wish->setAttribute("username", $username);
            $wish->appendChild($xml->createElement("productID", $productID));
            $wish->appendChild($xml->createElement("size", $size));

            $xml->getElementsByTagName("wishes")[0]->appendChild($wish);
            $xml->save("../xml/wishes.xml");

            echo "ok";
        }
    }
  
    function getWishSize() {
        $wishes = $GLOBALS['xml']->getElementsByTagName("wish");
        return sizeof($wishes);
    }
    
    function checkForDuplicate($productID, $size) {
        $wishes = $GLOBALS['xml']->getElementsByTagName("wish");

        foreach($wishes as $wish) {
            if(($wish->getElementsByTagName("productID")[0]->nodeValue == $productID) && 
                ($wish->getElementsByTagName("size")[0]->nodeValue == $size)) {
                return $wish;
            }
        }

        return NULL;
    }

?>