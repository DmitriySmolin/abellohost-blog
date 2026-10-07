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

$articleRepository->incrementViews($articleId);

$article['views']++;

$categories = $articleRepository->getCategories($articleId);

$relatedArticles = $articleRepository->getRelated($articleId);

$smarty->assign('title', $article['title']);
$smarty->assign('article', $article);
$smarty->assign('relatedArticles', $relatedArticles);
$smarty->assign('categories', $categories);

$smarty->display('article.tpl');