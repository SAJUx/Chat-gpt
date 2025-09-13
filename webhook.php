<?php
require_once 'bot.php';

// টেলিগ্রাম থেকে ডেটা পড়ুন
$input = file_get_contents('php://input');
$update = json_decode($input, true);

if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $messageText = $update['message']['text'];
    $firstName = isset($update['message']['from']['first_name']) ? $update['message']['from']['first_name'] : 'User';
    
    // কমান্ড হ্যান্ডলিং
    if (strpos($messageText, '/start') === 0) {
        $response = "Hello $firstName! 👋 Im ChatGPT-powered Error Team।\n\n";
        $response .= "How Can I Help You Today \n\n";
        $response .= "Need Help/Write Help";
        sendTelegramMessage($chatId, $response);
    } 
    elseif (strpos($messageText, '/help') === 0) {
        $helpText = "💡 <b>Available Commands:</b>\n\n";
        $helpText .= "/start - Start Bot\n";
        $helpText .= "/help - Help\n\n";
        $helpText .= "send to chat";
        sendTelegramMessage($chatId, $helpText);
    }
    else {
        // ChatGPT কে কল করুন
        $aiResponse = callChatGPT($messageText);
        sendTelegramMessage($chatId, $aiResponse);
    }
}

http_response_code(200);
echo 'OK';
?>