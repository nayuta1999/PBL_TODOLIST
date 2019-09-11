<?php
    require_once('../DataBase.php');
    $db = new Database();
    $db->TODO_insert($_POST['TODO'],$_POST['Need_Period'],$_POST['Priority_Number']);
?>