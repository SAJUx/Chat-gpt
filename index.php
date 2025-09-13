<?php
require_once 'config.php';
require_once 'bot.php';

// যদি webhook setup করতে চান
if (isset($_GET['setup'])) {
    $result = setWebhook();
    $resultData = json_decode($result, true);
    
    if ($resultData['ok']) {
        $setupMessage = "✅ Webhook successfully set!";
    } else {
        $setupMessage = "❌ Error: " . $resultData['description'];
    }
}

// বট information পাওয়া
$botInfo = getBotInfo();
$botUsername = $botInfo['ok'] ? $botInfo['result']['username'] : 'Unknown';
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram ChatGPT Bot</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; 
               background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        header { text-align: center; margin-bottom: 30px; }
        header h1 { color: #667eea; margin-bottom: 10px; }
        .dashboard { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .card { background: #f9f9f9; padding: 25px; border-radius: 10px; border-left: 4px solid #667eea; }
        .card h2 { color: #667eea; margin-bottom: 15px; }
        button { background: #667eea; color: white; border: none; padding: 12px 25px; border-radius: 8px; 
                 cursor: pointer; font-size: 16px; margin-top: 15px; transition: background 0.3s; }
        button:hover { background: #5a67d8; }
        .success { color: #38a169; margin-top: 15px; padding: 10px; background: #f0fff4; border-radius: 5px; }
        .error { color: #e53e3e; margin-top: 15px; padding: 10px; background: #fff5f5; border-radius: 5px; }
        .info { margin: 10px 0; padding: 10px; background: #ebf8ff; border-radius: 5px; }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🤖 Telegram ChatGPT Bot</h1>
            <p>আপনার টেলিগ্রাম গ্রুপের জন্য AI চ্যাটবট</p>
        </header>
        
        <div class="dashboard">
            <div class="card">
                <h2>বট সেটআপ</h2>
                <p>আপনার বট কনফিগার করতে নিচের বাটন ক্লিক করুন:</p>
                <a href="?setup=true"><button>Webhook সেটআপ করুন</button></a>
                <?php if(isset($setupMessage)): ?>
                    <div class="<?php echo $resultData['ok'] ? 'success' : 'error'; ?>">
                        <?php echo $setupMessage; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="card">
                <h2>বট ইনফরমেশন</h2>
                <div class="info"><strong>বট ইউজারনেম:</strong> @<?php echo $botUsername; ?></div>
                <div class="info"><strong>Webhook URL:</strong> <br><?php echo BASE_URL . '/webhook.php'; ?></div>
                <p>আপনার বটটি টেলিগ্রামে @BotFather থেকে তৈরি করুন এবং উপরের টোকেনটি সেট করুন।</p>
            </div>
        </div>
    </div>
</body>
</html>