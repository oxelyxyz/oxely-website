<?php
/*
 * Oxely waitlist / contact handler.
 * Saves each entry as one JSON line in a folder OUTSIDE the public web root.
 * Set OXELY_STORE_DIR on the server, or it defaults to ../contact-messages.
 */
$storeDir = getenv('OXELY_STORE_DIR') ?: dirname(__DIR__) . '/contact-messages';

header('Content-Type: application/json');
function reply($ok, $error = '', $code = 200) {
    http_response_code($code);
    echo json_encode($ok ? ['ok' => true] : ['ok' => false, 'error' => $error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') reply(false, 'Method not allowed.', 405);
if (!empty($_POST['fax'])) reply(true); // honeypot: bots fill hidden fields

$clean = function ($key, $max) {
    $v = isset($_POST[$key]) ? trim((string)$_POST[$key]) : '';
    $v = str_replace(["\r", "\0"], '', $v);
    return mb_substr($v, 0, $max);
};
$name    = $clean('name', 120);
$email   = $clean('email', 160);
$company = $clean('company', 120);
$message = $clean('message', 5000);

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    reply(false, 'Please fill in your name and a valid email.', 422);
}

// Simple rate limit: one entry per IP every 30 seconds.
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if (!is_dir($storeDir)) @mkdir($storeDir, 0700, true);
$rl = $storeDir . '/.rl_' . md5($ip);
if (is_file($rl) && time() - filemtime($rl) < 30) reply(false, 'You just signed up. Please wait a moment.', 429);
@touch($rl);

$entry = ['time' => gmdate('c'), 'ip' => $ip, 'name' => $name, 'email' => $email, 'team' => $company, 'message' => $message];
if (@file_put_contents($storeDir . '/waitlist.jsonl', json_encode($entry, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND | LOCK_EX) === false) {
    reply(false, 'Could not save your entry.', 500);
}
reply(true);
