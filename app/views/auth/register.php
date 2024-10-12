<?php
/**
 * 新規ユーザー登録フォーム
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規ユーザー登録</title>
    <link href="/../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">新規ユーザー登録</h1>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>
                        <form action="/register" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">名前：</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="user_id" class="form-label">ユーザーID：</label>
                                <input type="text" class="form-control" id="user_id" name="user_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">パスワード：</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirm" class="form-label">パスワード（確認）：</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">登録</button>
                            </div>
                        </form>
                        <p class="mt-3 text-center">
                            <a href="/login" class="text-decoration-none">ログイン画面に戻る</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>