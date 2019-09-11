<?php
   require_once('../DATABASE.php');
   $test = new Database();
   //var_dump($_POST);die;
   $stmt = $test->CheckUser($_POST['user'],$_POST['pass']);
   if(!$stmt){
        echo 'パスワードかユーザー名が違います．';
   }else{
        $array=[
            'user_id' => $stmt[0]['user_id'],
            'user_name' => $stmt[0]['user_name'],
            'user_table' => $stmt[0]['user_table']
        ];
        header("Access-Control-Allow-Origin: *");
        echo json_encode($array);
   }

?>