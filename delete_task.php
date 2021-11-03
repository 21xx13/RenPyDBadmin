<?php

include "db_func.php";

function redirect(){
    header('Location: tasks.php');
    exit();
}
global $PASS;
$id = $_POST['task_id'];
connect_db('localhost', 'root', $PASS, 'test_php');
DBi::$conn->query("DELETE FROM `task_info` WHERE `id` = $id");
DBi::$conn->query("DROP TABLE `task_$id`");
close_db();
redirect();
