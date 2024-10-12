<?php
/**
 * User モデル
 * ユーザーデータに関するデータベース操作を行う．
 * 
 * - ユーザー情報の取得（全件、個別）
 * - 新規ユーザーの作成
 * - ユーザー情報の更新
 * - ユーザーの削除
 * 
 * データベースとの直接的なやり取りを行い，コントローラーとデータベースの
 * 橋渡し役として機能．セキュリティ対策として．パスワードのハッシュ化も．
 */

namespace App\Models;
use App\Helpers\DatabaseHelper;
use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseHelper::getInstance()->getConnection();
    }

    /**
     * 全ユーザー情報を取得
     * @return array 全ユーザーの情報
     */
    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 指定されたIDのユーザー情報を取得
     * @param int $id ユーザーID
     * @return array|false ユーザー情報、存在しない場合はfalse
     */
    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 新規ユーザーを作成
     * @param string $name ユーザー名
     * @param string $user_id ユーザーID
     * @param string $password パスワード（平文）
     * @return bool 作成成功でtrue、失敗でfalse
     */
    public function createUser($name, $user_id, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, user_id, password) VALUES (:name, :user_id, :password)");
        return $stmt->execute([
            'name' => $name,
            'user_id' => $user_id,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    /**
     * ユーザー情報を更新
     * @param int $id 更新対象のユーザーID
     * @param string $name 新しいユーザー名
     * @param string $user_id 新しいユーザーID
     * @param string $password 新しいパスワード（平文）
     * @return bool 更新成功でtrue、失敗でfalse
     */
    public function updateUser($id, $name, $user_id, $password)
    {
        $stmt = $this->db->prepare("UPDATE users SET name = :name, user_id = :user_id, password = :password WHERE user_id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'user_id' => $user_id,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    /**
     * ユーザーを削除
     * @param int $id 削除対象のユーザーID
     * @return bool 削除成功でtrue、失敗でfalse
     */
    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE user_id = :id");
        return $stmt->execute(['id' => $id]);
    }
}