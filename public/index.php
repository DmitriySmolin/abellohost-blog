<?php

declare(strict_types=1);

$smarty = require __DIR__ . '/../config/smarty.php';

$smarty->assign('title', 'Working Smarty!');

$smarty->display('home.tpl');