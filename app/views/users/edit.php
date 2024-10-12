<?php
/**
 * ユーザー編集フォーム
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー編集</title>
    <link href="/../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>ユーザー編集</h1>
        <form action="/users/update/<?= $user['user_id'] ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">名前：</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">ユーザーID：</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">新しいパスワード（変更する場合のみ）：</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
        <a href="/users" class="btn btn-secondary mt-3">ユーザー一覧に戻る</a>
    </div>
</body>
</html>