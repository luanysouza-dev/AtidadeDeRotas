<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\NomeController;

/** @var Haki\Haki $app */

$app->get('/', [HomeController::class, 'index']);
$app->get('/nomes', [NomeController::class, 'verDados']);
$app->post('/nomes', [NomeController::class, 'adicionarNome']);
