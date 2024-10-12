<?php
/**
 * アプリケーションのエントリーポイント
 * このファイルはすべてのリクエストを処理し適切なコントローラーにルーティングする
 */

// オートローダーの読み込み（Composerを使用している場合）
// require_once __DIR__ . '/../vendor/autoload.php';

// 必要なファイルの読み込み
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

// リクエストURIの取得
$request_uri = $_SERVER['REQUEST_URI'];

// ルーティング
switch ($request_uri) {
    case '/':
        // ホームページまたはダッシュボード
        // 適切なコントローラーとメソッドを呼び出す
        break;

    case '/login':
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLoginForm();
        }
        break;

    case '/register':
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->showRegisterForm();
        }
        break;

    case '/users':
        $controller = new UserController();
        $controller->index();
        break;

    case '/users/create':
        $controller = new UserController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store();
        } else {
            $controller->create();
        }
        break;

    default:
        // 404 Not Found
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
        break;
}