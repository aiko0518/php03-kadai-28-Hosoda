<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = implode("、", $_POST['kanri_flg']);
$life_flg = implode("、",$_POST['life_flg']);
$id = $_POST["id"];

var_dump($kanri_flg);
var_dump($life_flg);

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//3．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
$stmt = $pdo->prepare( "UPDATE gs_user_table SET 
name = :name, lid = :lid, lpw = :lpw, kanri_flg = :kanri_flg, life_flg = :life_flg, indate = sysdate() 
WHERE id = :id;" );

//4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT

//5. 実行
$status = $stmt->execute(); 

//6．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}