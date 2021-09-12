<?php

include "db_func.php";

function redirect(){
    header('Location: tasks.php');
    exit();
}

$id = $_POST['task_id'];
connect_db('localhost', 'root', '21stopium', 'test_php');
DBi::$conn->query("DELETE FROM `users` WHERE `id` = $id");
DBi::$conn->query("DROP TABLE `task_$id`");
close_db();
redirect();
