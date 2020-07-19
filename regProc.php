<?php
    include_once ("db.php");
    include_once ("lib.php");

    $id = $_POST['id'];
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $passck = $_POST['passck'];

    //아이디 중복검사
    $sql = "SELECT * FROM users WHERE id = ?";
    $user = fetch($db, $sql, [$id]);

    if($user != null){
        msgAndBack("중복된 아이디 입니다.", "/");
        exit;
    }

    //비밀번호 같지 않을때
    if($pass != $passck){
        msgAndBack("비밀번호와 비밀번호 확인은 일치해야 합니다.");
        exit;
    }

    $sql = "INSERT INTO users (id, name, password) VALUES (?, ?, PASSWORD(?))";
    execute($db, $sql, [$id, $name, $pass]);
    msgAndGo("성공적으로 회원가입 되었습니다.", "/");