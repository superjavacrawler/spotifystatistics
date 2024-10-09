<!--Demo spotify auth by https://javacrawler.lol/ -->

<?php
session_start();

if (!isset($_SESSION['access_token'])) {
    header('Location: /'); # Кидаем в корневой каталог (у вас он может быть другим)
    exit;
}

$accessToken = $_SESSION['access_token'];

$userUrl = 'https://api.spotify.com/v1/me';
$options = [
    'http' => [
        'header' => "Authorization: Bearer $accessToken\r\n",
        'method' => 'GET',
    ],
];

$context = stream_context_create($options);
$userData = json_decode(file_get_contents($userUrl, false, $context), true);

$topTracksUrl = 'https://api.spotify.com/v1/me/top/tracks?limit=10';
$topTracksData = json_decode(file_get_contents($topTracksUrl, false, $context), true);

$topArtistsUrl = 'https://api.spotify.com/v1/me/top/artists?limit=10';
$topArtistsData = json_decode(file_get_contents($topArtistsUrl, false, $context), true);

$playlistsUrl = 'https://api.spotify.com/v1/me/playlists';
$playlistsData = json_decode(file_get_contents($playlistsUrl, false, $context), true);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Профиль пользователя</title>
    <style>
        body {
            background-color: #121212;
            color: #FFFFFF;
        }
        .card {
            background-color: #282828;
            border: none;
        }
        .card-title {
            color: #1DB954;
			font-size: 22px;
        }
        .list-group-item {
            background: #3A3A3A;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-image {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin-right: 20px;
        }
		.backurl {
			color: #1DB954; font-size: 22px;
		}
		a:hover {
			color: #1DB954;
			text-decoration: none;
		}
    </style>
</head>
<body>
    <header class="text-center">
	<br>
        <h1>Привет, <?php echo htmlspecialchars($userData['display_name']); ?>! <a href="/" class="backurl"><i class="fas fa-user"></i> Назад</a></h1>
		<br>
    </header>
    <main class="container">
        <div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="card profile-header">
					<div class="card-body">
						<div class="d-flex align-items-start">
							<?php if (!empty($userData['images'])): ?>
								<img src="<?php echo htmlspecialchars($userData['images'][0]['url']); ?>" alt="Avatar" class="profile-image me-3">
							<?php endif; ?>
							<div>
								<h2 class="card-title"><i class="fas fa-user"></i> Информация о пользователе</h2>
								<p><strong>Имя:</strong> <?php echo htmlspecialchars($userData['display_name']); ?></p>
								<p><strong>ID:</strong> <?php echo htmlspecialchars($userData['id']); ?></p>
								<p><strong>Подписчики:</strong> <?php echo htmlspecialchars($userData['followers']['total']); ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h2 class="card-title"><i class="fas fa-music"></i> Ваши плейлисты</h2>
						<ul class="list-group">
							<?php if (!empty($playlistsData['items'])): ?>
								<?php foreach ($playlistsData['items'] as $playlist): ?>
									<li class="list-group-item">
										<strong><?php echo htmlspecialchars($playlist['name']); ?></strong>
										<br><small>Количество треков: <?php echo htmlspecialchars($playlist['tracks']['total']); ?></small>
									</li>
								<?php endforeach; ?>
							<?php else: ?>
								<li class="list-group-item">Нет доступных плейлистов.</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title"><i class="fas fa-star"></i> Ваши топ треки</h2>
                        <ul class="list-group">
                            <?php if (!empty($topTracksData['items'])): ?>
                                <?php foreach ($topTracksData['items'] as $track): ?>
                                    <li class="list-group-item">
                                        <strong><?php echo htmlspecialchars($track['name']); ?></strong> - <?php echo htmlspecialchars($track['artists'][0]['name']); ?>
                                        <br><small>Популярность: <?php echo htmlspecialchars($track['popularity']); ?></small>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item">Нет доступных топ треков.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h2 class="card-title"><i class="fas fa-user-circle"></i> Ваши топ исполнители</h2>
                        <ul class="list-group">
                            <?php if (!empty($topArtistsData['items'])): ?>
                                <?php foreach ($topArtistsData['items'] as $artist): ?>
                                    <li class="list-group-item">
                                        <strong><?php echo htmlspecialchars($artist['name']); ?></strong>
                                        <br><small>Подписчики: <?php echo htmlspecialchars($artist['followers']['total']); ?></small>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item">Нет доступных топ исполнителей.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
