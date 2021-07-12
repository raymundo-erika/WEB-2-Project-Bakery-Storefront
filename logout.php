<?php
    session_start();

    $xml = new DOMDocument();
    $xml->load("../xml/users.xml");

        $users = $xml->getElementsByTagName("user");

        foreach($users as $user) {
            
            //will be used for checking
            $username = $user->getAttribute("username");
    
            if(strtolower($_SESSION['username']) == strtolower($username)) {


                //we will update the node
                $fullName = $user->getElementsByTagName("fullName")[0]->nodeValue;
                $email = $user->getElementsByTagName("email")[0]->nodeValue;
                $birthdate = $user->getElementsByTagName("birthdate")[0]->nodeValue;
                $address = $user->getElementsByTagName("address")[0]->nodeValue;
                $password = $user->getElementsByTagName("password")[0]->nodeValue;
                $profilePic = $user->getElementsByTagName("profilePic")[0]->nodeValue;

                $newNode = $xml->createElement("user");
                $newNode->setAttribute("username", $username);
                $newNode->setAttribute("status", 0);
                $newNode->appendChild($xml->createElement("fullName", $fullName));
                $newNode->appendChild($xml->createElement("email", $email));
                $newNode->appendChild($xml->createElement("birthdate", $birthdate));
                $newNode->appendChild($xml->createElement("address", $address));
                $newNode->appendChild($xml->createElement("password", $password));
                $newNode->appendChild($xml->createElement("profilePic", $profilePic));

                $currentNode = $user;
                $xml->getElementsByTagName("users")[0]->replaceChild($newNode, $currentNode);
                $xml->save("../xml/users.xml");
                break;
            } 
        }
    
    session_destroy();
    header("Location: loginRegister.html");

?>