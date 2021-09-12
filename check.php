<?php
include "db_func.php";
    session_start();
    $_SESSION['error_title'] = "";
    $_SESSION['error_message'] = "";
    $_SESSION['success_send'] = "";

    foreach($_SESSION as $key => $val) {
    if (str_contains($key, 'error-option-'))
        $_SESSION[$key] = "";
    }

    function redirect(){
        header('Location: index.php');
        exit();
    }
    $title = htmlspecialchars(trim($_POST['title']));
    $message = htmlspecialchars(trim($_POST['message']));
    $options = [];

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

    $_SESSION['title'] = $title;
    $_SESSION['message'] = $message;
    $_SESSION['options'] = $options;
    if (strlen($title) <= 1){
        $_SESSION['error_title'] ="Введите корректное имя";
        redirect();
    }

    else if ($message == ""){
        $_SESSION['error_message'] = "Пустое сообщение";
        redirect();
    }

    foreach($options as $key => $val){
        if ($val['option'] == ''){
            $_SESSION['error-option-'.$key] = 'Выбор игрока не может быть пустым';
            redirect();
        }
    }

    $_SESSION['success_send'] = "Успешно отправлено!";
    connect_db('localhost', 'root', '21stopium', 'test_php');
    DBi::$conn->query("INSERT INTO `users` (`name`, `bio`) VALUES ('$title', '$message')");
    $table_id = @DBi::$conn->insert_id;
    DBi::$conn->query("CREATE TABLE `task_$table_id` (
    id INT NOT NULL AUTO_INCREMENT,
    gameoption VARCHAR(300) NOT NULL,
    points INT NOT NULL,
    PRIMARY KEY(id)
)");
    foreach ($options as $key => $val){
        $opt = $val['option'];
        $point = $val['point'];
        DBi::$conn->query("INSERT INTO `task_$table_id` (`gameoption`, `points`) VALUES ('$opt', '$point')");
    }
    close_db();
    redirect();
