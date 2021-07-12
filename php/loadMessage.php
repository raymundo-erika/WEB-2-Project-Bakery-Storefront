<?php
    $otherUser = $_POST["otherUser"];
    $userName = "erika_raymundo"; // coconnect sa session

    $xml = new DOMDocument();
    $xml->load("../xml/messages.xml");
    
    $messages = $xml->getElementsByTagName("message");

    foreach($messages as $message){
        $receiver = $message->getElementsByTagName("receiver")[0]->nodeValue;
        $sender = $message->getElementsByTagName("sender")[0]->nodeValue;
        if(($sender==$otherUser&&$receiver==$userName)||
            ($sender==$userName&&$receiver==$otherUser)){
                $typeOfMessage = "";
                $msgContent = $message->getElementsByTagName("msgContent")[0]->nodeValue;
                $date = $message->getElementsByTagName("date")[0]->nodeValue;
                $time = $message->getElementsByTagName("time")[0]->nodeValue;

                if($sender==$userName){
                    $typeOfMessage = "receiver";
                }else{
                    $typeOfMessage = "sender";
                }

                echo "<div class='message-item $typeOfMessage'>
                    <div class='message-item-info'>
                        <div class='message-details'>
                            <label class='message'>$msgContent</label>
                            <label class='sent-date'>$date $time</label>
                        </div>
                        <div class='message-pic'></div>
                    </div>
                </div>";
        }
    }
?>