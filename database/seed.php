<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;

$pdo = Database::getConnection();

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE article_category');
$pdo->exec('TRUNCATE articles');
$pdo->exec('TRUNCATE categories');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$categories = [
    [
        'name' => 'Technology',
        'description' => 'Technology news and articles',
    ],
    [
        'name' => 'Business',
        'description' => 'Business and finance articles',
    ],
    [
        'name' => 'Travel',
        'description' => 'Travel guides and experiences',
    ],
    [
        'name' => 'Health',
        'description' => 'Health and lifestyle articles',
    ],
];

$categoryIds = [];

$categoryQuery = $pdo->prepare(
    'INSERT INTO categories (name, description)
     VALUES (:name, :description)'
);

foreach ($categories as $category) {
    $categoryQuery->execute($category);

    $categoryIds[] = (int) $pdo->lastInsertId();
}

$articleQuery = $pdo->prepare(
    'INSERT INTO articles (
        title,
        description,
        content,
        image,
        views,
        published_at
    ) VALUES (
        :title,
        :description,
        :content,
        :image,
        :views,
        :published_at
    )'
);

$relationQuery = $pdo->prepare(
    'INSERT INTO article_category (
        article_id,
        category_id
    ) VALUES (
        :article_id,
        :category_id
    )'
);

for ($i = 1; $i <= 15; $i++) {
    $articleQuery->execute([
        'title' => "Article {$i}",
        'description' => "Short description for article {$i}",
        'content' => "Full content of article {$i}",
        'image' => "https://picsum.photos/800/400?random={$i}",
        'views' => random_int(50, 1000),
        'published_at' => date(
            'Y-m-d H:i:s',
            strtotime("-{$i} days")
        ),
    ]);

    $articleId = (int) $pdo->lastInsertId();

    $relationQuery->execute([
        'article_id' => $articleId,
        'category_id' => $categoryIds[array_rand($categoryIds)],
    ]);
}

echo "Seed completed\n";