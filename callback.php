<!--Demo spotify auth by https://javacrawler.lol/ -->

<?php
session_start();

$clientId = 'clientID';
$clientSecret = 'clientSecret';
$redirectUri = 'https://Ваша-ссылка-которую-вы-добавляете-в-настройках-приложения-на-developer.spotify.com/callback.php';
$code = $_GET['code'];

$tokenUrl = 'https://accounts.spotify.com/api/token';
$data = [
    'grant_type' => 'authorization_code',
    'code' => $code,
    'redirect_uri' => $redirectUri,
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
];

$options = [
    'http' => [
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($tokenUrl, false, $context);
$responseData = json_decode($response, true);
$_SESSION['access_token'] = $responseData['access_token'];

header('Location: /demo/spotifystats/view/');
exit;
