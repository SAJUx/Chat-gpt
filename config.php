<?php
// Configuration
$telegramBotToken = getenv('TELEGRAM_BOT_TOKEN');
$openaiApiKey = getenv('OPENAI_API_KEY');
$baseUrl = getenv('RENDER_EXTERNAL_URL');

// Fallback if environment variables are not set
define('TELEGRAM_BOT_TOKEN', $telegramBotToken ?: 'YOUR_TELEGRAM_BOT_TOKEN_HERE');
define('OPENAI_API_KEY', $openaiApiKey ?: 'YOUR_OPENAI_API_KEY_HERE');
define('BASE_URL', $baseUrl ?: 'https://your-app-name.onrender.com');

// API endpoints
define('OPENAI_URL', 'https://api.openai.com/v1/chat/completions');
define('TELEGRAM_SEND_URL', 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/sendMessage');
define('TELEGRAM_SET_WEBHOOK_URL', 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/setWebhook');
define('TELEGRAM_GETME_URL', 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/getMe');

// Validate API keys
if (OPENAI_API_KEY === 'YOUR_OPENAI_API_KEY_HERE' || TELEGRAM_BOT_TOKEN === 'YOUR_TELEGRAM_BOT_TOKEN_HERE') {
    die("Please set your API keys in the Render environment variables!");
}

// Clean up API keys
function cleanApiKey($key) {
    $key = trim($key);
    $key = preg_replace('/\s+/', '', $key);
    return $key;
}
?>