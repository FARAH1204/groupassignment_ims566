<?php
function sendMailgunEmail($to, $subject, $message) {
    $apiKey = 'YOUR_MAILGUN_API_KEY'; // ❗ Ganti dengan API key kamu
    $domain = 'YOUR_SANDBOX_DOMAIN'; // ❗ Contoh: sandbox12345abcde.mailgun.org

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $apiKey);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, "https://api.mailgun.net/v3/$domain/messages");
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'from'    => 'InternMatch UiTM <noreply@' . $domain . '>',
        'to'      => $to,
        'subject' => $subject,
        'html'    => $message
    ]);

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('Mailgun Error: ' . curl_error($ch));
    }

    curl_close($ch);
}
?>
