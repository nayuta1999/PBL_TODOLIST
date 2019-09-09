<?php
    require_once('DataBase.php');
    $test = new DataBase();
    $test->User_create_table();
    echo 'データベースの初期設定が完了しました';
?>