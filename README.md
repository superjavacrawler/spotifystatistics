# Spotify Statistics View

🌐 Простой демо-сайт на PHP для просмотра статистики Spotify через OAuth 2. Этот проект позволяет пользователям подключать свои учетные записи Spotify и получать доступ к информации о своих любимых треках, исполнителях и плейлистах.

### Демо версия: [SpotifyStats](https://javacrawler.lol/demo/spotifystats/)

🚀 Для работы отредактируйте следующие данные в файлах `index.php` и `callback.php`:
```php
$clientId = 'clientID';
$clientSecret = 'clientSecret';
$redirectUri = 'https://Ваша-ссылка-которую-вы-добавляете-в-настройках-приложения-на-developer.spotify.com/callback.php';
```

Это демонстрационная версия, которая иллюстрирует работу OAuth 2. Для удобства настройки, параметры можно вынести в отдельный файл, избегая дублирования.
