<?php 
    $xml = new DOMDocument();
    $xml->load("../xml/users.xml");

    session_start();
    $username = $_SESSION["username"]; // coconect sa session
    
    $users = $xml->getElementsByTagName("user");

    $activeUsersOutput = "";
    $activeUsersCounter = 0;

    foreach($users as $user){
        if($user->getAttribute("status")=="1"&&$user->getAttribute("username")!=$username){
            $profilePic = $user->getElementsByTagName("profilePic")[0]->nodeValue;
            $fullName = $user->getElementsByTagName("fullName")[0]->nodeValue;
            $usernameInXML = $user->getAttribute("username");
            echo "<li onclick = showChat('$usernameInXML') class='user clearfix'>
                    <div class='user-img' style='background-image: url($profilePic)'></div>
                    <div class='user-fullname'>$fullName</div>
                 </li>";
            $activeUsersCounter++;
        }
    }
    echo "<p id='activeUsersCounter' style='display:none'>$activeUsersCounter</p>";
?>