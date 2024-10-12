<?php
/**
 * ログインビュー
 * 
 * このビューはログイン画面のユーザーインターフェースを提供
 * 
 * - ログインフォームの表示
 * - エラーメッセージの表示（該当する場合）
 * - 新規登録ページへのリンク提供
 * 
 * Bootstrapを使用してレスポンシブなデザインを実現し
 * ユーザーフレンドリーなインターフェースを提供しています．
 */
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <!-- Bootstrap CSSの読み込み -->
    <link href="/../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">ログイン</h1>

                        <?php if (isset($error) && $error): ?>
                            <p class='text-danger'><?= htmlspecialchars($error) ?></p>
                        <?php endif; ?>

                        <form action="/login" method="post">
                            <div class="mx-auto" style="max-width: 400px;">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">ID：</label>
                                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="例）1111" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">パスワード：</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="例）2222" required>
                                </div>
                                <div class="mb-3">
                                    <label for="videoSelection" class="form-label">視聴したい動画を選択してください：</label>
                                    <select class="form-select" id="videoSelection" name="video_id">
                                        <option value="n0tt3meYVkU">動画1</option>
                                        <option value="dwk2DTGHjc4">動画2</option>
                                    </select>
                                </div>
                                <div class="d-grid">
                                    <input type="submit" class="btn btn-primary" value="ログイン">
                                </div>
                            </div>
                        </form>
                        <p class="mt-3 text-center">
                            <a href="/register" class="text-decoration-none">新規登録</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>