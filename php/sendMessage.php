<?php



$xml = new DOMDocument();
$xml->load("../xml/messages.xml");

if(isset($_POST)) {

    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;
    $sender = "erika_raymundo"; // connect sa session;

    $receiver = $_POST["receiver"];
    $msgContent = $_POST["msgContent"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $messages = $xml->getElementsByTagName("messages")[0];
    $message = $xml->createElement("message");
    $message->appendChild($xml->createElement("receiver", $receiver));
    $message->appendChild($xml->createElement("sender", $sender));
    $message->appendChild($xml->createElement("msgContent", $msgContent));
    $message->appendChild($xml->createElement("date", $date));
    $message->appendChild($xml->createElement("time", $time));
    $messages->appendChild($message);

    $xml->save("../xml/messages.xml");
    echo 1;

}


?>