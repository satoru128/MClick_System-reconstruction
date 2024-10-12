<?php
/**
 * ユーザー一覧表示
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー一覧</title>
    <link href="/../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>ユーザー一覧</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['user_id']) ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td>
                            <a href="/users/edit/<?= $user['user_id'] ?>" class="btn btn-sm btn-primary">編集</a>
                            <a href="/users/delete/<?= $user['user_id'] ?>" class="btn btn-sm btn-danger">削除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/users/create" class="btn btn-success">新規ユーザー作成</a>
    </div>
</body>
</html>