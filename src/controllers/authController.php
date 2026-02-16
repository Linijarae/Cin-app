<?php

require_once __DIR__ . '/../models/cineModel.php';

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . $path)) {
    return false;
}
switch ($path) {
    case '/':
        $moviesModel = new MoviesModel();
        $movies = $moviesModel->getAllMovies();
        require 'views/index.php';
        break;
    default:
        http_response_code(404);
        require 'views/404.php';
        break;
}