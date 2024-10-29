<?php
session_start();
require_once 'functions.php';
loginCheck();

$id = $_GET['id']; //?id~**を受け取る
$pdo = db_conn();

//２．つぶやき登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM contents WHERE id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．つぶやき表示
if (!$status) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>つぶやき更新</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
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
        <h1>編集</h1>

        <form method="POST" action="update.php" enctype="multipart/form-data">
            <div class="jumbotron">
                <fieldset>
                    <legend>[編集]</legend>
                    <label for="content">内容：<textarea id="content" name="content" rows="4" cols="40"><?= h($row['content']) ?>
                    </textarea></label>

                    <?php if (!empty($row['image'])) {
                        echo '<img src="' . h($row['image']) . '" class="image-class">';
                    }
                    ?>

                    <input type="submit" value="更新">
                    <input type="hidden" name="id" value="<?= $id ?>">

                </fieldset>
            </div>
        </form>
    </div>

</body>

</html>