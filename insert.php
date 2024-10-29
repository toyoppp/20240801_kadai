<?php

session_start();
require_once 'functions.php';
loginCheck();

//1. POSTつぶやき取得
$content = $_POST['content'];

$user_id = $_SESSION['user_id'];

// 画像アップロードの処理

$image_path = '';

if(isset($_FILES['image'])){

    $upload_file = $_FILES['image']['tmp_name'];

    $dir_name = 'img/';

    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    $file_name = uniqid() . '.' . $extension;

    $image_path = $dir_name . $file_name;

    if(!move_uploaded_file($upload_file, $image_path)){
        exit('ファイルの保存に失敗しました');
    }

}

//2. DB接続します
$pdo = db_conn();

//３．つぶやき登録SQL作成
$stmt = $pdo->prepare('INSERT INTO contents(user_id, content, image, created_at) VALUES(:user_id, :content, :image, NOW());');
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':image', $image_path, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．つぶやき登録処理後
if (!$status) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
