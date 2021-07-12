<?php
    session_start();
    date_default_timezone_set('Asia/Manila');

    // $username = $_SESSION["username"];
    include_once "getProductFunctions.php";

    $username = "erika_raymundo";

    $xml = new DOMDocument();
    $xml->load("../xml/wishes.xml");

    if(isset($_POST)) {

        $wish_id = $_POST["wish_id"];
        $wishes = $xml->getElementsByTagName("wish");

        foreach($wishes as $wish) {
    
            if ($wish->getAttribute("id") == $wish_id) {
                $xml->getElementsByTagName("wishes")[0]->removeChild($wish);
                $xml->save("../xml/wishes.xml");
            }
        }
    }
  

?>