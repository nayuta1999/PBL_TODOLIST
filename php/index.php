<?php
   require_once('TODOLIST/DATABASE.php');
   $test = new DataBase();
   //phpinfo();die;
   $test->init();
   $test->TODO_insert('ご飯を食べる',1,1);
?>