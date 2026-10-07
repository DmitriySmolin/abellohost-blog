<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;
use App\Repository\CategoryRepository;

$connection = Database::getConnection();

$smarty = require __DIR__ . '/../config/smarty.php';

$smarty->assign('title', 'Working Smarty!');

$smarty->display('home.tpl');

$repository = new CategoryRepository($connection);

echo '<pre>';
print_r($repository->getAll());
echo '</pre>';