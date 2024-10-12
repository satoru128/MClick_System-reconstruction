<?php
/**
 * 認証コントローラー
 * 
 * このコントローラーは認証関連の操作を制御
 * 
 * - ログインフォームの表示
 * - ログイン処理の実行
 * - ログアウト処理の実行
 * - ユーザー登録フォームの表示
 * - ユーザー登録処理の実行
 */

namespace App\Controllers;

use App\Models\Auth;
use App\Models\User;
use App\Helpers\SessionHelper;

class AuthController
{
    private $authModel;
    private $userModel;

    public function __construct()
    {
        $this->authModel = new Auth();
        $this->userModel = new User();
    }

    public function showLoginForm()
    {
        $error = $_GET['error'] ?? '';
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function login()
    {
        $user_id = $_POST['user_id'] ?? '';
        $password = $_POST['password'] ?? '';
        $video_id = $_POST['video_id'] ?? '';

        $user = $this->authModel->authenticate($user_id, $password);

        if ($user) {
            SessionHelper::start();
            SessionHelper::set('user_id', $user_id);
            SessionHelper::set('name', $user['name']);
            SessionHelper::set('video_id', $video_id);
            header("Location: /");
            exit();
        } else {
            header("Location: /login?error=" . urlencode("IDまたはパスワードが間違っています"));
            exit();
        }
    }

    public function logout()
    {
        SessionHelper::destroy();
        header("Location: /login?message=" . urlencode("ログアウトしました"));
        exit();
    }

    public function showRegisterForm()
    {
        $error = $_GET['error'] ?? '';
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function register()
    {
        $name = $_POST['name'] ?? '';
        $user_id = $_POST['user_id'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        $error = $this->userModel->validateInput($name, $user_id, $password, $password_confirm);
        if ($error) {
            header("Location: /register?error=" . urlencode($error));
            exit();
        }

        if ($this->userModel->userExists($user_id)) {
            header("Location: /register?error=" . urlencode("すでに使用されているIDです"));
            exit();
        }

        if ($this->userModel->createUser($name, $user_id, $password)) {
            header("Location: /login?message=" . urlencode("登録が完了しました。ログインしてください。"));
            exit();
        } else {
            header("Location: /register?error=" . urlencode("登録に失敗しました"));
            exit();
        }
    }
}