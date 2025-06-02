<?php
require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$httpClient = new Client();
$apiKey = '52ac2799';
$searchQuery = 'transformers';

$response = $httpClient->get('http://www.omdbapi.com', [
    'query' => [
        'apikey' => $apiKey,
        's' => $searchQuery
    ]
]);

$bodyContent = $response->getBody()->getContents();
$movies = json_decode($bodyContent, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Movie List</title>
</head>
<body>

<?php if (!empty($movies['Search'])): ?>
  <?php foreach ($movies['Search'] as $item): ?>
    <ul>
      <li>Title: <?= htmlspecialchars($item['Title']); ?></li>
      <li>Year: <?= htmlspecialchars($item['Year']); ?></li>
      <li><img src="<?= htmlspecialchars($item['Poster']); ?>" alt="Poster" width="100"></li>
    </ul>
  <?php endforeach; ?>
<?php else: ?>
  <p>No movies found.</p>
<?php endif; ?>

</body>
</html>
