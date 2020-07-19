<?php
    include ("lib.php");
    include ("db.php");
    checkLogin();
    
    $id = $_GET['id'];

    $sql = "SELECT * FROM boards WHERE id = ?";
    $board = fetch($db,$sql,[$id]);

    $user = $_SESSION['user'];

    if($user->id != $board->writer) {
        msgAndBack("너 아니잖아 삭제 하려하지마!!!!!");
        exit;
    }
    

    $upload = sub_str($board->upload);

    if(is_file("./".$upload)) {
        unlink("." . $upload);
    }
    
    $sql = "DELETE FROM boards WHERE id = ?";
    execute($db, $sql, [$id]);

    msgAndGo("삭제되었습니다","/index.php");