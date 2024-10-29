<?php
session_start();
require_once 'functions.php';
loginCheck();

//２．つぶやき登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT
    contents.id as id,
    contents.content as content,
    users.name as name
FROM contents JOIN users ON contents.user_id = users.id ');
$status = $stmt->execute();

//３．つぶやき表示
$view = '';
if (!$status) {
    sql_error($stmt);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>フリーアンケート表示</title>
    <link rel="stylesheet" href="css/style.css" />


</head>

<body id="main">
    <nav class="navbar">
        <a class="navbar-brand" href="index.php">データ登録</a>
        <div class="navbar-header user-name">
            <p><?= $_SESSION['user_name'] ?></p>
        </div>
        <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
            <button type="submit" class="logout-button">ログアウト</button>
        </form>
    </nav>

    <div class="container">
        <h1>フリーアンケート一覧</h1>
        <div class="card-container">
            <?php while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="card">
                    <div class="card-content">
                        <p><?= h($r['content']). "@" . $r['name'] ?></p>
                    </div>
                    <div class="card-actions">
                        <a class="btn btn-primary" href="detail.php?id=<?= $r['id'] ?>">詳細</a>

                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <input type="submit" value="削除" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>