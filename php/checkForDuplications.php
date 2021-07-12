<?php
    $xml = new DOMDocument();
    $xml->load("../xml/users.xml");

    if($_POST["username"] && $_POST["email"]) {
        $un = $_POST["username"];
        $email = $_POST["email"];
        $users = $xml->getElementsByTagName("user");

        foreach($users as $user) {
            $username = $user->getAttribute("username");
            $emailAd = $user->getElementsByTagName("email")[0]->nodeValue;

            if(strtolower($un) == strtolower($username) && strtolower($email) == strtolower($emailAd)) {
                echo "0";
                break;
            } else if(strtolower($un) == strtolower($username)) {
                echo "1";
                break;
            } else if(strtolower($email) == strtolower($emailAd)) {
                echo "2";
                break;
            }
        }
    }


?>