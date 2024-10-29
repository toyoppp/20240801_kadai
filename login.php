<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/style.css" />

    <title>ログイン</title>
</head>

<body>
    <nav class="navbar">
        <a href="index.php">データ登録</a>
        <span>ログイン</span>
    </nav>
    <div class="container">
        <h1>ログイン</h1>
        <form name="form1" action="login_act.php" method="post">
            <div class="form-group">
                <label for="lid">ID</label>
                <input type="text" id="lid" name="lid" required placeholder="ユーザーID">
            </div>
            <div class="form-group">
                <label for="lpw">パスワード</label>
                <input type="password" id="lpw" name="lpw" required placeholder="パスワード">
            </div>
            <input type="submit" value="ログイン">
        </form>
    </div>
</body>

</html>