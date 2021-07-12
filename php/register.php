<?php

    $xml = new DOMDocument();
    $xml->load("../xml/users.xml");

    if(isset($_POST)) {

        $xml->formatOutput = true;
        $xml->preserveWhiteSpace = false;
        $username = $_POST["username"];
        $status = 0;

        $user = $xml->createElement("user");
        $password = $xml->createElement("password", $_POST["password"]);
        $fullName = $xml->createElement("fullName", $_POST["fullName"]);
        $email = $xml->createElement("email", $_POST["email"]);
        $birthdate = $xml->createElement("birthdate", $_POST["birthdate"]);
        $address = $xml->createElement("address", $_POST["address"]);
        $password = $xml->createElement("password", $_POST["password"]);
        $profilePic = $xml->createElement("profilePic", "images/users/sample.jpeg");
        
        $user->setAttribute("username", $username);
        $user->setAttribute("status", $status);
        $user->appendChild($fullName);
        $user->appendChild($email);
        $user->appendChild($birthdate);
        $user->appendChild($address);
        $user->appendChild($password);
        $user->appendChild($profilePic);

        $xml->getElementsByTagName("users")->item(0)->appendChild($user);
        $xml->save("../xml/users.xml");
    }

?>