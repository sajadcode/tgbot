<?php
$botToken = "6741432305:AAE-kjnUf6S9WyVh_rpfQjNjstO-BqTV54c";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents("php://input");
$updateArray = json_decode($update, TRUE);

$chatId = $updateArray["message"]["chat"]["id"];
$message = $updateArray["message"]["text"];

if ($message == "/start") {
    sendMessage($chatId, "Welcome to the PHP Bot. Send me any PHP code to execute.");
} else {
    // This is a very basic and unsafe way to execute PHP code.
    // In a real-world scenario, you must handle this with extreme caution.
    ob_start();
    eval($message);
    $output = ob_get_clean();
    sendMessage($chatId, $output);
}

function sendMessage($chatId, $message) {
    global $website;
    $url = $website."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
    file_get_contents($url);
}
?>
