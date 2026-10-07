<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;
use App\Repository\ArticleRepository;

$smarty = require __DIR__ . '/../config/smarty.php';

$connection = Database::getConnection();

$articleRepository = new ArticleRepository($connection);

$articleId = (int) ($_GET['id'] ?? 0);

$article = $articleRepository->getById($articleId);

if ($article === null) {
    http_response_code(404);

    exit('Article not found');
}

$categoryId = $articleRepository->getCategoryId($articleId);

$articleRepository->incrementViews($articleId);

$article['views']++;

$relatedArticles = $articleRepository->getRelated(
    $articleId,
    $categoryId
);

$smarty->assign('title', $article['title']);
$smarty->assign('article', $article);
$smarty->assign('relatedArticles', $relatedArticles);

$smarty->display('article.tpl');