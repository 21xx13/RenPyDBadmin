<?php
include "db_func.php";
include "parse_func.php";
session_start();

function redirect(){
    header('Location: ../edit_script.php');
    exit();
}
$title = htmlspecialchars(trim($_POST['title']));
$script = $_POST['code'];
$id = $_POST['task_id'];
$special_labels = ["start", "quit", "after_load", "splashscreen", "before_main_menu", "main_menu", "after_warp"];

$_SESSION['title'] = $title;
$_SESSION['script'] = $script;
$_SESSION['id_task'] = $id;



if (strlen($title) <= 1){
    $_SESSION['error_title_edit_script'] ="Введите корректное имя";
    redirect();
}

else if (strlen($script) <= 1){
    $_SESSION['error_script'] ="Скрипт слишком короткий";
    redirect();
}
//else if(preg_match('/^[a-zA-Z0-9_]+$/', $label) < 1)
//{
//    $_SESSION['error_label_change'] = "label не должен содержать пробелов, спец. символов, кириллицу";
//    redirect();
//}
//
//else if(in_array($label, $special_labels))
//{
//    $_SESSION['error_label_change'] = "Уже существует специальная метка с таким названием";
//    redirect();
//}


global $PASS;
connect_db('localhost', 'root', $PASS, 'test_php');
DBi::$conn->query("UPDATE `task_info` SET `game_script` = '$script', `task_name` = '$title' WHERE `id` = $id");
//DBi::$conn->query("DROP TABLE `task_$id`");
//DBi::$conn->query("CREATE TABLE `task_$id` (
//        id INT NOT NULL AUTO_INCREMENT,
//        gameoption VARCHAR(300) NOT NULL,
//        points INT NOT NULL,
//        PRIMARY KEY(id)
//    )");
//foreach ($options as $key => $val){
//    $opt = $val['option'];
//    $point = $val['point'];
//    DBi::$conn->query("INSERT INTO `task_$id` (`gameoption`, `points`) VALUES ('$opt', '$point')");
//}
close_db();
$_SESSION['success_send_edit'] = "Успешно отправлено!";
redirect();

