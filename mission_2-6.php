<?php
//�e�L�X�g�t�@�C����ϐ��Ɋi�[
$filename='mission_2-6.txt';

//�ҏW�t�H�[���ŕҏW�ԍ��ƃp�X���[�h�����͂��ꂽ�Ƃ��݈̂ȉ��̃v���O���������s
if(!empty($_POST['edit']) && !empty($_POST['edipass'])){

//POST���M�ŕҏW�ԍ��𑗐M
$editNo=$_POST['edit'];

$edit=file($filename);

for ($k = 0; $k < count($edit) ; $k++){ 
 $data = explode("<>", $edit[$k]); 

//�ҏW�ԍ��Ɠ��e�ԍ��A�ҏW�p�X���[�h�Ɠ��e�p�X���[�h�̂��ꂼ�ꂪ�������Ƃ�
if($editNo==$data[0] && $_POST['edipass']==$data[4]){

//�ϐ��Ɋi�[
$edit_num=$data[0];//���e�ԍ�
$user=$data[1];//���O
$com=$data[2];//�R�����g
$edit_pass=$data[4];//�p�X���[�h

}
}
}
?>


<?php
//UNIX TIMESTAMP���擾���ĕϐ��Ɋi�[
$timestamp=time();

//�����ɕϊ����ĕϐ��Ɋi�[
$time=date("Y/m/d/G:i:s",$timestamp);

//hidden�̒l�ł���ҏW�ԍ������݂��A����hidden�̒l�̕ҏW�p�X���[�h�Ɠ��e���ꂽ�p�X���[�h��������
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

//���e���e�ƃp�X���[�h�����͂���Ă��Ahidden�̒l���Ȃ��Ƃ����s
if(!empty($_POST['toukou']) && empty($_POST['edit_num']) && !empty($_POST['pass'])){
//�e�L�X�g�t�@�C���ɔԍ����O���Ԃ���s���\�����ĕۑ�



//�����f�[�^��ϐ��ɑ��
$text1=$_POST['name'];
$text2=$_POST['comment'];


//fopen��a+���[�h�Ńt�@�C�����J��
$fp=fopen($filename,'a+');

//�z��Ƃ��ēǂݍ���ŕϐ��Ɋi�[
$array=file($filename);

//�z��̐����J�E���g���ĕϐ��Ɋi�[
$count=count($array)+1;

//�ϐ��̌���
$text=$count."<>".$text1."<>".$text2."<>".$time."<>".$_POST['pass']."<>"."\n";

//fopen�ŊJ�����e�L�X�g�t�@�C���ɂ����Ƃ��������f�[�^����������
fwrite($fp,$text);

//�e�L�X�g�t�@�C�������
fclose($fp);
}
?>

<?php
//if���ō폜�t�H�[���̒l�ƃp�X���[�h�����͂���Ă���ꍇ���������򂷂�悤�ɂ���
if(!empty($_POST['deleteNo']) && !empty($_POST['delepass'])){

//POST���M�ō폜�ԍ��𑗐M
$deleteNo=$_POST['deleteNo'];

$filename='mission_2-6.txt';

//�e�L�X�g�t�@�C����file�֐��œǂݍ���
$delete=file($filename);

//�V�K�e�L�X�g�t�@�C����w���[�h�ŊJ��
$fp=fopen($filename,'w');
$i=1;
//���[�v�֐����g���ē��e�ԍ����擾
for ($j = 0; $j < count($delete) ; $j++){ 
 $delline = explode("<>", $delete[$j]);
//var_dump($delline[4]); 
//var_dump($_POST['delepass']);

//$delline[0]�ɓ��e�ԍ��i�[��
//�폜�ԍ��ƒl�Ɠ��e�ԍ����������Ƃ��A�����e���̃p�X���[�h�Ɠ��͂����p�X���[�h���������Ƃ��Ȃɂ����Ȃ�
if($deleteNo == $delline[0] && $delline[4] == $_POST['delepass']){
//�폜�����
}else{
//���e��ϐ�$hairetu�Ɋi�[
$hairetu=$i."<>".$delline[1]."<>".$delline[2]."<>".$delline[3]."<>".$delline[4]."<>"."\n";

fwrite($fp,$hairetu);
$i++;
}
}
//�V�K�e�L�X�g�t�@�C�������
fclose($fp);


}
?>
<html>
<body>
<!-�^�C�g����\��->
<title>
�F�̏O���܂�
</title>

<!-���o���\��->
<h1>�݂�Ȃ̌f����</h1>
<p>���̋C�������ǂ���^^
<!-�t�H�[���̍쐬->
<form method="post" action="">
 <p>���O�F<br>
<input type="text" name="name" value="<?php echo $user;?>"></p>
<p>�R�����g�F<br>
<input type="text" name="comment" value="<?php echo $com;?>"></p>
<input type="hidden" name="edit_num" value="<?php echo $edit_num;?>">
<input type="hidden" name="edit_pass" value="<?php echo $edit_pass;?>">
<p>�p�X���[�h�F<br>
<input type="text" name="pass"></p>
 <input type="submit" name="toukou">
</form>

<!-�폜�ԍ��w��p�t�H�[���̍쐬->
<form method="post" action="">
 <p>�폜�Ώ۔ԍ��F<br>
<input type="text" name="deleteNo"></p>
<p>�p�X���[�h�F<br>
<input type="text" name="delepass"></p>
 <input type="submit" value="�폜">
</form>


<!-�ҏW�ԍ��w��p�t�H�[��->
<form method="post" action="">
 <p>�ҏW�Ώ۔ԍ��F<br>
<input type="text" name="edit"></p>
<p>�p�X���[�h�F<br>
<input type="text" name="edipass"></p>
 <input type="submit" value="�ҏW">
</form>
</body>
</html>


<?php
//�z��Ƃ��ēǂݍ���ŕϐ��Ɋi�[
$array1=file($filename);

//���[�v�֐�foreach���g���Ĕz��̗v�f����s���擾����&line1�Ɋi�[
foreach($array1 as $line1){

//�L���u<>�v�ŕ������Ă��ꂼ��̒l���擾
$line2=explode("<>",$line1);

//���ꂼ��̒l���o��
echo $line2[0].".";
echo $line2[1]."<br/>";
echo "********<br/>".$line2[2]."<br/>";
echo $line2[3]."<br/>";
echo "<hr>";
}
?>

