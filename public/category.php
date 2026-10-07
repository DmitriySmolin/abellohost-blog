<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;

$smarty = require __DIR__ . '/../config/smarty.php';

$connection = Database::getConnection();

$categoryRepository = new CategoryRepository($connection);
$articleRepository = new ArticleRepository($connection);

$categoryId = (int) ($_GET['id'] ?? 0);

$category = $categoryRepository->getById($categoryId);

if ($category === null) {
    http_response_code(404);

    exit('Category not found');
}

$sort = $_GET['sort'] ?? 'date';

if (!in_array($sort, ['date', 'views'], true)) {
    $sort = 'date';
}

$page = max(1, (int) ($_GET['page'] ?? 1));

$perPage = 5;

$totalArticles = $articleRepository->countByCategory($categoryId);

$totalPages = max(1, (int) ceil($totalArticles / $perPage));

$page = min($page, $totalPages);

$offset = ($page - 1) * $perPage;

$articles = $articleRepository->getByCategory(
    $categoryId,
    $sort,
    $perPage,
    $offset
);

$smarty->assign('title', $category['name']);
$smarty->assign('category', $category);
$smarty->assign('articles', $articles);
$smarty->assign('sort', $sort);
$smarty->assign('page', $page);
$smarty->assign('totalPages', $totalPages);

$smarty->display('category.tpl');