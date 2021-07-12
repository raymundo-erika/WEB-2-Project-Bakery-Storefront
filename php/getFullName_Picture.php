<?php
     $otherUser = $_GET["otherUser"];
 
     $xml = new DOMDocument();
     $xml->load("../xml/users.xml");
     $userProfilePic = "images/users/girl-try.jpg"; // kunin sa sesson ung img ni user

     $users = $xml->getElementsByTagName("user");

     foreach($users as $user){
        if($user->getAttribute("username")==$otherUser){
            echo $user->getElementsByTagName("fullName")[0]->nodeValue;
            $otherUserImage = $user->getElementsByTagName("profilePic")[0]->nodeValue;
            echo "<p id='otherUserImage' style='display:none'>$otherUserImage</p>";
            echo "<p id='userProfilePic' style='display:none'>$userProfilePic</p>";
        }
     }
?>