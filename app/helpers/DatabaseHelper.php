<?php

namespace App\Helpers;

use PDO;
use PDOException;

class DatabaseHelper
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $config = require_once __DIR__ . '/../../config/database.php';

        $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";

        try {
            $this->connection = new PDO($dsn, $config['username'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            die('データベース接続エラー: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}