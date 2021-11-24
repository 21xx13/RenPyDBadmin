<?php
include "db_func.php";
include "parse_func.php";
session_start();

function redirect(){
    header('Location: ../change_task.php');
    exit();
}

global $PASS;
connect_db('localhost', 'root', $PASS, 'test_php');
$title = htmlspecialchars(trim($_POST['title']));
$label = htmlspecialchars($_POST['label']);
$message = htmlspecialchars(trim($_POST['message']));
$id = $_POST['task_id'];
$special_labels = ["start", "quit", "after_load", "splashscreen", "before_main_menu", "main_menu", "after_warp"];
$options = parse_options();
$script_db = get_task_by_id($id)['game_script'];
$script_parsed = parse_script($script_db);

$_SESSION['title'] = $title;
$_SESSION['label'] = $label;
$_SESSION['message'] = $message;
$_SESSION['id_task'] = $id;
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

$replace_count = 1;
$script_db=str_replace($script_parsed['label'], $label, $script_db, $replace_count);
$script_db=str_replace($script_parsed['task'], $message, $script_db, $replace_count);

function replace_opt($script, $new_options, $old_options){
    $script_arr = explode("\n", $script);
    $options_count = 0;
    $rep_str = [];
    for($i=0; $i < count($script_arr); $i++){
        if(preg_match('/^[\s]{8}".+":/', $script_arr[$i]) > 0){
            $new_str = str_replace($old_options[$options_count]['option'],
                strval($new_options[strval($options_count+1)]['option']), $script_arr[$i]);
            array_push($rep_str, ['line'=>$i, 'new'=>$new_str]);
        }
        if(preg_match('/^[\s]{12}\$ *points *\+= */', $script_arr[$i]) > 0){
            $new_str = str_replace($old_options[$options_count]['point'],
                strval($new_options[strval($options_count+1)]['point']), $script_arr[$i]);
            array_push($rep_str, ['line'=>$i, 'new'=>$new_str]);
            $options_count++;
        }
    }
    for($i=0; $i < count($script_arr); $i++){
        for($j=0; $j < count($rep_str); $j++){
            if ($i == $rep_str[$j]['line'])
                $script_arr[$i] = $rep_str[$j]['new'];
        }
    }

    return join("\n", $script_arr);
}

function delete_options($script){
    $script_arr = explode("\n", $script);
    $arr_del = [];
    $to_delete = false;
    for($i=0; $i < count($script_arr); $i++){
        if(preg_match('/^[\s]{8}"":/', $script_arr[$i]) > 0){
            array_push($arr_del, ['line'=>$i]);
            $to_delete = true;
        }
        else if($to_delete && preg_match('/^[\s]{12,}.+/', $script_arr[$i]) > 0){
            array_push($arr_del, ['line'=>$i]);
        }
        else if (preg_match('/^[\s]{4,11}[^\s]+/', $script_arr[$i]) > 0){
            $to_delete = false;
        }
    }
    for($j=0; $j < count($arr_del); $j++)
        unset($script_arr[$arr_del[$j]['line']]);

    return join("\n", $script_arr);
}

function create_options($script, $old_count, $new_options){
    $script_arr = explode("\n", $script);
    $options_count = 0;
    $last_index = 0;
    $new_str = [];
    for($i=0; $i < count($script_arr); $i++){
        if(preg_match('/^[\s]{8}".+":/', $script_arr[$i]) > 0){
            $options_count++;
        }
        else if ($options_count == $old_count){
            if(preg_match('/^[\s]{12,}.+/', $script_arr[$i]) > 0)
                continue;
            else if (preg_match('/^[\s]{4,11}[^\s]+/', $script_arr[$i]) > 0){
                $last_index = $i;
                break;
            }
        }
    }
    for($i=$old_count; $i < count($new_options); $i++){
         array_push($new_str, '        "'.$new_options[strval($i+1)]['option']."\"".':');
         array_push($new_str, "            $ points+=".$new_options[strval($i+1)]['point']);
         array_push($new_str, "");
    }

    array_splice( $script_arr, $last_index, 0, $new_str);

    return join("\n", $script_arr);
}


if (count($options) <= count($script_parsed['options']))
    $script_db = replace_opt($script_db, $options, $script_parsed['options']);


if (count($options) < count($script_parsed['options'])){
    $script_db = delete_options($script_db);
}


if (count($options) > count($script_parsed['options'])){
    $script_db = replace_opt($script_db, $options, $script_parsed['options']);
    $script_db = create_options($script_db, count($script_parsed['options']), $options);
}


    DBi::$conn->query("UPDATE `task_info` SET `task_text` = '$message', `task_name` = '$title', `label` = '$label', `game_script` = '$script_db' WHERE `id` = $id");
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

