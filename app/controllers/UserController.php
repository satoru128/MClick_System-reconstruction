<?php

/**
 * UserController
 * このクラスは，ユーザー関連の操作を制御する．
 * - ユーザー一覧の表示
 * - 新規ユーザーの作成
 * - ユーザー情報の編集
 * - ユーザーの削除
 * - ユーザー認証（ログイン処理）
 * 
 * UserモデルとViewの橋渡し役として機能し，
 * HTTPリクエストを受け取り，適切なレスポンスを返す．
 */

namespace App\Controllers;
use App\Models\User;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * ユーザー一覧を表示
     */
    public function index()
    {
        $users = $this->userModel->getAllUsers();
        // ビューファイルを読み込み、ユーザー一覧を表示
        require_once __DIR__ . '/../views/users/index.php';
    }

    /**
     * 新規ユーザー作成フォームを表示
     */
    public function create()
    {
        require_once __DIR__ . '/../views/users/create.php';
    }

    /**
     * 新規ユーザーを保存
     */
    public function store()
    {
        $name = $_POST['name'] ?? '';
        $user_id = $_POST['user_id'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->userModel->createUser($name, $user_id, $password)) {
            header('Location: /users');
        } else {
            // エラー処理
            require_once __DIR__ . '/../views/users/create.php';
        }
    }

    /**
     * ユーザー編集フォームを表示
     */
    public function edit($id)
    {
        $user = $this->userModel->getUserById($id);
        require_once __DIR__ . '/../views/users/edit.php';
    }

    /**
     * ユーザー情報を更新
     */
    public function update($id)
    {
        $name = $_POST['name'] ?? '';
        $user_id = $_POST['user_id'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->userModel->updateUser($id, $name, $user_id, $password)) {
            header('Location: /users');
        } else {
            // エラー処理
            $user = $this->userModel->getUserById($id);
            require_once __DIR__ . '/../views/users/edit.php';
        }
    }

    /**
     * ユーザー削除確認画面を表示
     */
    public function delete($id)
    {
        $user = $this->userModel->getUserById($id);
        require_once __DIR__ . '/../views/users/delete.php';
    }

    /**
     * ユーザーを削除
     */
    public function destroy($id)
    {
        if ($this->userModel->deleteUser($id)) {
            header('Location: /users');
        } else {
            // エラー処理
            $user = $this->userModel->getUserById($id);
            require_once __DIR__ . '/../views/users/delete.php';
        }
    }
}