<?php
   /*
      テスト用に使ってる
   */
   require_once('TODOLIST/DATABASE.php');
   $test = new DataBase();
   //$test->User_create_table();
   //phpinfo();die;
   //$test->TODO_create_table();
   //$test->TODO_insert('ご飯を食べる',1,1);
   //$test->TODO_insert('授業を受ける',1,1);
   //var_dump($test->TODO_serch('priority_number' ,1));die;
   var_dump($test->TODO_serch('priority_number',1));die;
?>