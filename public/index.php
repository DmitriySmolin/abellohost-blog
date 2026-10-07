<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;

Database::getConnection();

$smarty = require __DIR__ . '/../config/smarty.php';

$smarty->assign('title', 'Working Smarty!');

$smarty->display('home.tpl');