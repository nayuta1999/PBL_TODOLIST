<?php
    require_once('DataBase.php');
    $test = new Database();
    $test->User_insert($_POST['user'],$_POST['table'],$_POST['pass']);
    echo $_POST['User'].'を作成しました';
?>