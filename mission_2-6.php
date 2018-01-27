<?php
//テキストファイルを変数に格納
$filename='mission_2-6.txt';

//編集フォームで編集番号とパスワードが入力されたときのみ以下のプログラムを実行
if(!empty($_POST['edit']) && !empty($_POST['edipass'])){

//POST送信で編集番号を送信
$editNo=$_POST['edit'];

$edit=file($filename);

for ($k = 0; $k < count($edit) ; $k++){ 
 $data = explode("<>", $edit[$k]); 

//編集番号と投稿番号、編集パスワードと投稿パスワードのそれぞれが等しいとき
if($editNo==$data[0] && $_POST['edipass']==$data[4]){

//変数に格納
$edit_num=$data[0];//投稿番号
$user=$data[1];//名前
$com=$data[2];//コメント
$edit_pass=$data[4];//パスワード

}
}
}
?>


<?php
//UNIX TIMESTAMPを取得して変数に格納
$timestamp=time();

//日時に変換して変数に格納
$time=date("Y/m/d/G:i:s",$timestamp);

//hiddenの値である編集番号が存在し、かつhiddenの値の編集パスワードと投稿されたパスワードが等しい
if(!empty($_POST['edit_num']) && $_POST['edit_pass']==$_POST['pass']){

$edinum=$_POST['edit_num'];


$hensyu=file($filename);

$fp=fopen($filename,'w');
$m=1;
for ($h = 0; $h < count($hensyu) ; $h++){ 
 $D = explode("<>", $hensyu[$h]); 

//
if($edinum == $D[0] && $D[4] == $_POST['pass']){
$edit_text=$m."<>".$_POST['name']."<>".$_POST['comment']."<>".$time."<>".$D[4]."<>"."\n";

fwrite($fp,$edit_text);


$m++;
}

else{
fwrite($fp,$hensyu[$h]);
$m++;
}
}
fclose($fp);
}
?>




<?php

//投稿内容とパスワードが入力されてかつ、hiddenの値がないとき実行
if(!empty($_POST['toukou']) && empty($_POST['edit_num']) && !empty($_POST['pass'])){
//テキストファイルに番号名前時間を一行ずつ表示して保存



//文字データを変数に代入
$text1=$_POST['name'];
$text2=$_POST['comment'];


//fopenのa+モードでファイルを開く
$fp=fopen($filename,'a+');

//配列として読み込んで変数に格納
$array=file($filename);

//配列の数をカウントして変数に格納
$count=count($array)+1;

//変数の結合
$text=$count."<>".$text1."<>".$text2."<>".$time."<>".$_POST['pass']."<>"."\n";

//fopenで開いたテキストファイルにうけとった文字データを書き込む
fwrite($fp,$text);

//テキストファイルを閉じる
fclose($fp);
}
?>

<?php
//if文で削除フォームの値とパスワードが入力されている場合処理が分岐するようにする
if(!empty($_POST['deleteNo']) && !empty($_POST['delepass'])){

//POST送信で削除番号を送信
$deleteNo=$_POST['deleteNo'];

$filename='mission_2-6.txt';

//テキストファイルをfile関数で読み込む
$delete=file($filename);

//新規テキストファイルをwモードで開く
$fp=fopen($filename,'w');
$i=1;
//ループ関数を使って投稿番号を取得
for ($j = 0; $j < count($delete) ; $j++){ 
 $delline = explode("<>", $delete[$j]);
//var_dump($delline[4]); 
//var_dump($_POST['delepass']);

//$delline[0]に投稿番号格納中
//削除番号と値と投稿番号が等しいとき、かつ投稿文のパスワードと入力したパスワードが等しいときなにもしない
if($deleteNo == $delline[0] && $delline[4] == $_POST['delepass']){
//削除される
}else{
//投稿を変数$hairetuに格納
$hairetu=$i."<>".$delline[1]."<>".$delline[2]."<>".$delline[3]."<>".$delline[4]."<>"."\n";

fwrite($fp,$hairetu);
$i++;
}
}
//新規テキストファイルを閉じる
fclose($fp);


}
?>
<html>
<body>
<!-タイトルを表示->
<title>
皆の衆あつまれ
</title>

<!-見出し表示->
<h1>みんなの掲示板</h1>
<p>今の気持ちをどうぞ^^
<!-フォームの作成->
<form method="post" action="">
 <p>名前：<br>
<input type="text" name="name" value="<?php echo $user;?>"></p>
<p>コメント：<br>
<input type="text" name="comment" value="<?php echo $com;?>"></p>
<input type="hidden" name="edit_num" value="<?php echo $edit_num;?>">
<input type="hidden" name="edit_pass" value="<?php echo $edit_pass;?>">
<p>パスワード：<br>
<input type="text" name="pass"></p>
 <input type="submit" name="toukou">
</form>

<!-削除番号指定用フォームの作成->
<form method="post" action="">
 <p>削除対象番号：<br>
<input type="text" name="deleteNo"></p>
<p>パスワード：<br>
<input type="text" name="delepass"></p>
 <input type="submit" value="削除">
</form>


<!-編集番号指定用フォーム->
<form method="post" action="">
 <p>編集対象番号：<br>
<input type="text" name="edit"></p>
<p>パスワード：<br>
<input type="text" name="edipass"></p>
 <input type="submit" value="編集">
</form>
</body>
</html>


<?php
//配列として読み込んで変数に格納
$array1=file($filename);

//ループ関数foreachを使って配列の要素を一行ずつ取得して&line1に格納
foreach($array1 as $line1){

//記号「<>」で分割してそれぞれの値を取得
$line2=explode("<>",$line1);

//それぞれの値を出力
echo $line2[0].".";
echo $line2[1]."<br/>";
echo "********<br/>".$line2[2]."<br/>";
echo $line2[3]."<br/>";
echo "<hr>";
}
?>

