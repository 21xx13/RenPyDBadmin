<?php
include "db_func.php";
    session_start();
    $_SESSION['error_title'] = "";
    $_SESSION['error_message'] = "";
    $_SESSION['success_send'] = "";
    $_SESSION['error_label'] = "";
    $special_labels = ["start", "quit", "after_load", "splashscreen", "before_main_menu", "main_menu", "after_warp"];

    foreach($_SESSION as $key => $val) {
    if (strpos($key, 'error-option-') !== false)
        $_SESSION[$key] = "";
    }

    function redirect(){
        header('Location: index.php');
        exit();
    }
    $title = htmlspecialchars(trim($_POST['title']));
    $message = htmlspecialchars(trim($_POST['message']));
    $label = htmlspecialchars($_POST['label']);
    $options = [];

    foreach($_POST as $key => $val) {
        if (strpos($key, 'option-') !== false || strpos($key, 'point-') !==false){
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

    $_SESSION['title'] = $title;
    $_SESSION['message'] = $message;
    $_SESSION['label'] = $label;
    $_SESSION['options'] = $options;

    if (strlen($title) <= 1){
        $_SESSION['error_title'] ="Введите корректное имя";
        redirect();
    }

    else if(preg_match('/^[a-zA-Z0-9_]+$/', $label) < 1)
    {
        $_SESSION['error_label'] = "label не должен содержать пробелов, спец. символов, кириллицу";
        redirect();
    }

    else if(in_array($label, $special_labels))
    {
        $_SESSION['error_label'] = "Уже существует специальная метка с таким названием";
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
    global $PASS;
    $_SESSION['success_send'] = "Успешно отправлено!";
    connect_db('localhost', 'root', $PASS, 'test_php');
    DBi::$conn->query("INSERT INTO `task_info` (`task_name`, `task_text`, `label`, `create_date`) VALUES ('$title', '$message', '$label', NOW())");
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
