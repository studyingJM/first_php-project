<?php
    include_once ("db.php");
    include_once ("lib.php");
    checkLogin();
    
    //dump($_FILES);
    $pic = $_FILES['pic'];
    $id = uniqid();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $writer = $_SESSION['user']->id;

    
    $pic_tmp = HOME . "/uploads/" . $id . $pic['name'];
    move_uploaded_file($pic['tmp_name'],$pic_tmp);

    if(mb_strlen($title) == 0 || mb_strlen($content) == 0 ) {
        msgAndBack("둘중 하나를 작성 안하셨는데요?");
        exit;
    }else {
        msgAndGo("작성 완료","/index.php");
    }
    
    $sql = "INSERT INTO boards (`title`,`content`,`writer`,`upload`) VALUES (?,?,?,?)";
    if($pic['name'] == "") {
        execute($db,$sql,[$title,$content,$writer,""]);
    }else {
        execute($db,$sql,[$title,$content,$writer,$pic_tmp]);
    }

    msgAndGo("성공적으로 작성 되었습니다.", "/index.php");