<?php
include_once("db.php");
include_once("lib.php");

unset($_SESSION['user']);
msgAndGo("로그아웃 완료", "/");