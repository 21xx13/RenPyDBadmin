<?php
include "db_func.php";
session_start();

function redirect(){
    header('Location: ../change_task.php');
    exit();
}
$title = htmlspecialchars(trim($_POST['title']));
$label = htmlspecialchars($_POST['label']);
$message = htmlspecialchars(trim($_POST['message']));
$id = $_POST['task_id'];
$special_labels = ["start", "quit", "after_load", "splashscreen", "before_main_menu", "main_menu", "after_warp"];
$options = [];

$_SESSION['title'] = $title;
$_SESSION['label'] = $label;
$_SESSION['message'] = $message;
$_SESSION['id_task'] = $id;


foreach($_POST as $key => $val) {
    if (strpos($key, 'option-') !== false || strpos($key, 'point-') !== false){
        $keyNumber = explode('-', $key)[1];
        if (empty($options[$keyNumber]))
            $options[$keyNumber] = [];
        if(strpos($key, 'option-') !== false) {
            $options[$keyNumber]['option'] = $val;
        }
        else if(strpos($key, 'point-') !== false) {
            $options[$keyNumber]['point'] = intval($val);
        }
    }
}

$_SESSION['options'] = $options;

if (strlen($title) <= 1){
    $_SESSION['error_title_change'] ="Введите корректное имя";
    redirect();
}
else if(preg_match('/^[a-zA-Z0-9_]+$/', $label) < 1)
{
    $_SESSION['error_label_change'] = "label не должен содержать пробелов, спец. символов, кириллицу";
    redirect();
}

else if(in_array($label, $special_labels))
{
    $_SESSION['error_label_change'] = "Уже существует специальная метка с таким названием";
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
    global $PASS;
    connect_db('localhost', 'root', $PASS, 'test_php');
    DBi::$conn->query("UPDATE `task_info` SET `task_text` = '$message', `task_name` = '$title', `label` = '$label' WHERE `id` = $id");
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

