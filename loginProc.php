<?php
    include_once ("db.php");
    include_once ("lib.php");

    $userid = $_POST['id'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE id = ? AND password = PASSWORD(?)";

    $user = fetch($db, $sql, [$userid, $pass]);

    if($user != null){
        //로그인 성공
        $_SESSION['user'] = $user;
        msgAndGo("성공적으로 로그인되었습니다", "/");
    }else{
        //실패
        msgAndBack("일치하는 회원정보가 없습니다.");
    }