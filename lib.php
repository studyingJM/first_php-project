<?php

//값 확인
function dump($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function msgAndBack($msg)
{
    $_SESSION['msg'] = $msg;
    echo "<script>";
    echo "history.back()";
    echo "</script>";
}

function msgAndGo($msg, $url)
{
    $_SESSION['msg'] = $msg;
    header("Location: " . $url);
}

//로그인 체크
function checkLogin()
{
    if (!isset($_SESSION['user'])) {
        msgAndBack("로그인 후 접근 가능");
        exit;
    }
}

//경로 줄여줌
function sub_str($filename) {
    $home_len = strlen(HOME);
    $filename = substr($filename,$home_len);
    return $filename;
}