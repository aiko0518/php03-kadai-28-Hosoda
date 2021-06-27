<?php
require_once('funcs.php');
// 1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$naiyou = $_POST["naiyou"];


// 2. DB接続します
$pdo = db_conn();

// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
    "INSERT INTO gs_bm_table( id, name, url, naiyou, indate )
  VALUES( NULL, :name, :url, :naiyou, sysdate() )"
);

// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect('index.php');
}

