<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;

$connection = Database::getConnection();

$smarty = require __DIR__ . '/../config/smarty.php';

$categoryRepository = new CategoryRepository($connection);
$articleRepository = new ArticleRepository($connection);

$categories = $categoryRepository->getWithArticles();

$homepageCategories = [];

foreach ($categories as $category) {
    $categoryId = (int) $category['id'];

    $homepageCategories[] = [
        'category' => $category,
        'articles' => $articleRepository->getLatestByCategory(
            $categoryId
        ),
    ];
}

$smarty->assign('categories', $homepageCategories);

$smarty->display('home.tpl');