<!--Demo spotify auth by https://javacrawler.lol/ -->

<?php
session_start();

$clientId = 'clientID';
$clientSecret = 'clientSecret';
$redirectUri = 'https://Ваша-ссылка-которую-вы-добавляете-в-настройках-приложения-на-developer.spotify.com/callback.php';

$authUrl = "https://accounts.spotify.com/authorize?response_type=code&client_id={$clientId}&redirect_uri=" . urlencode($redirectUri) . "&scope=user-top-read";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>SpotifyStats</title>
    <style>
        body {
            background-color: #121212;
            color: #FFFFFF;
        }
        .container {
            margin-top: 100px;
            text-align: center;
        }
        .button {
            background-color: #1DB954;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2rem;
            transition: background 0.3s, transform 0.3s;
        }
        .button:hover {
            background-color: #1ed760;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="display-4">SpotifyStats</h1>
        <h2 class="mt-4">Авторизация через Spotify</h2>
        <p class="lead">Чтобы продолжить, войдите через свой аккаунт Spotify.</p>
        <a class="button btn" href="<?php echo $authUrl; ?>">Войти через Spotify</a>
    </div>
    <footer class="text-center mt-5">
        <p>&copy; <?php echo date("Y"); ?> SpotifyStats. Все права защищены.</p>
    </footer>
</body>
</html>
