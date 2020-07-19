<?php
    session_start();
    
    $host = "gondr.asuscomm.com";
    $dbname = "kjimin2123";
    $charset = "utf8mb4";
    $user = "kjimin2123";
    $pass = "12345678";

    $str = "mysql:host={$host}; dbname={$dbname}; charset={$charset}";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_OBJ
    ];

    $db = new PDO($str, $user, $pass, $options);

    function execute($db, $sql, $param = []){
        $q = $db->prepare($sql);
        return $q->execute($param);  //1 또는 0으로 삽입이나 삭제의 성공여부를 알 수 있다.
    }

    function fetchAll($db, $sql, $param = []){
        $q = $db->prepare($sql);
        $q->execute($param);
        return $q->fetchAll();
    }

    function fetch($db, $sql, $param = []){
        $q = $db->prepare($sql);
        $q->execute($param);
        return $q->fetch();
    }

    //
    define("HOME", __DIR__);