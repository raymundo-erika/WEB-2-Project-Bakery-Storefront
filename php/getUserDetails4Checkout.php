<?php 


    $username = "sheen"; // kunin sa session
    $xml = new DOMDocument();
    $xml->load("../xml/users.xml");
    

    $users = $xml->getElementsByTagName("user");

    foreach($users as $user){
        if($user->getAttribute("username")==$username){
            $fullName = $user->getElementsByTagName("fullName")[0]->nodeValue;
            $email = $user->getElementsByTagName("email")[0]->nodeValue;
            $image = $user->getElementsByTagName("profilePic")[0]->nodeValue;
           echo " <tr><td rowspan='2'>
           <div id='img-rounded'><img width='50' src='$image' alt='profile-picture'></div>
           </td>
           <td class='account-info'>
            $fullName ($email)
           </td></tr>";
        }
    }
?> 