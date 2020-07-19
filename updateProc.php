<?php
include_once ("lib.php");
include_once ("db.php");
checkLogin();

$id = $_POST['id'];
$pic = $_FILES['pic'];
$tmp_id = uniqid();
$title = $_POST['title'];
$content = $_POST['content'];

$sql = "SELECT * FROM boards WHERE id = ?";
$board = fetch($db, $sql,[$id]);

if($_SESSION['user']->id != $board->writer) {
    msgAndBack("너 아니잖아!!!! 돌아가!!!!");
    exit;
}

$upload = sub_str($board->upload);

$sql = "UPDATE boards SET title = ?,content = ?, upload= ? WHERE id = ?";


/*
    그디어 만들었다 미친거 4시간 소요.... 씹.
    설명

    -db에있는 파일경로와 내파일에 파일경로가 같으면 실행
    -파일 선택이 비워져있으면 sql에 있는 경로 그대로 씀
    -아니라면 파일 위치 정하고 원래있던 이미지 삭제후에
    -파일을 업로드
    -db에있는 파일경로와 내파일 경로가 같지 않다면
    -파일이 추가 되있지않으면 db에 공백
    -파일이 추가 되있다면 파일 업로드

    ------------------------------------------------
    is_file(true) || is_file(false)
*/
dump($pic);
if(is_file("./".$upload) == $upload) {
    // dump(is_file("./".$upload) == $upload);
    if($pic['name'] == "") {
        $pic_tmp = HOME . $upload;
        execute($db,$sql,[$title,$content,$pic_tmp,$id]);
    }else {
        $pic_tmp = HOME . "/uploads/" . $tmp_id . "_" . $pic['name'];
        unlink("." . $upload );
        move_uploaded_file($pic['tmp_name'],$pic_tmp);
        execute($db,$sql,[$title,$content,$pic_tmp,$id]);
    }
}else {
    if($pic['name'] != "") {
        $pic_tmp = HOME . "/uploads/" . $tmp_id . "_" . $pic['name'];
        move_uploaded_file($pic['tmp_name'],$pic_tmp);
        execute($db,$sql,[$title,$content,$pic_tmp,$id]);
    }else {
        execute($db,$sql,[$title,$content,"",$id]);
    }
}

msgAndGo("성공적으로 수정됨", "/");
