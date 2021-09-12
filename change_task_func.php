<?php
include "db_func.php";
session_start();

function redirect(){
    header('Location: change_task.php');
    exit();
}
$title = htmlspecialchars(trim($_POST['title']));
$message = htmlspecialchars(trim($_POST['message']));
$id = $_POST['task_id'];
$options = [];

$_SESSION['title'] = $title;
$_SESSION['message'] = $message;
$_SESSION['id_task'] = $id;


foreach($_POST as $key => $val) {
    if (str_contains($key, 'option-') || str_contains($key, 'point-')){
        $keyNumber = explode('-', $key)[1];
        if (empty($options[$keyNumber]))
            $options[$keyNumber] = [];
        if(str_contains($key, 'option-')) {
            $options[$keyNumber]['option'] = $val;
        }
        else if(str_contains($key, 'point-')) {
            $options[$keyNumber]['point'] = intval($val);
        }
    }
}

$_SESSION['options'] = $options;

if (strlen($title) <= 1){
    $_SESSION['error_title_change'] ="Введите корректное имя";
    redirect();
}

else if ($message == ""){
    $_SESSION['error_message_change'] = "Пустое сообщение";
    redirect();
}

foreach($options as $key => $val){
    if ($val['option'] == ''){
        $_SESSION['error-option-'.$key] = 'Выбор игрока не может быть пустым';
        redirect();
    }
}

    connect_db('localhost', 'root', '21stopium', 'test_php');
    DBi::$conn->query("UPDATE `users` SET `bio` = '$message', `name` = '$title' WHERE `id` = $id");
    DBi::$conn->query("DROP TABLE `task_$id`");
    DBi::$conn->query("CREATE TABLE `task_$id` (
        id INT NOT NULL AUTO_INCREMENT,
        gameoption VARCHAR(300) NOT NULL,
        points INT NOT NULL,
        PRIMARY KEY(id)
    )");
    foreach ($options as $key => $val){
        $opt = $val['option'];
        $point = $val['point'];
        DBi::$conn->query("INSERT INTO `task_$id` (`gameoption`, `points`) VALUES ('$opt', '$point')");
    }
    close_db();
    $_SESSION['success_send_change'] = "Успешно отправлено!";
    redirect();

