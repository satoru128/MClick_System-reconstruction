<?php
/**
 * 認証モデル 
 * 
 * このモデルは認証に関連するデータベース操作を担当．
 * - ユーザー認証（ログイン処理）
 * - データベースとの直接的なやり取り
 * 
 * セキュリティ上の理由から，パスワードの検証やユーザー情報の取得などの
 * 認証関連の操作をこのモデルで集中管理している．
 */

namespace App\Models;

use App\Helpers\DatabaseHelper;
use PDO;

class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseHelper::getInstance()->getConnection();
    }

    public function authenticate($user_id, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user["password"] === $password) {
            return $user;
        }

        return false;
    }
}