<?php
   require_once('../DATABASE.php');
   $test = new Database();
   //var_dump($_POST);die;
   if($test->CheckUser($_POST['user'],$_POST['pass'])){
        echo 'ログイン成功';
   }else{
        echo 'パスワードかユーザー名が違います．';
   }

?>