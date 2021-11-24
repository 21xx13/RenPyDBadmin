<?php
function default_script($label, $task_text, $options): string
{
    $script = "label ".$label.":

    menu:

        \"".$task_text."\"

";
    foreach ($options as $key => $val){
        $script = $script.'        "'.$val['option']."\"".':
            $ points+='.$val['point']."

";
    }
    return $script."    return";
}

function parse_options(): array
{
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
    return $options;
}

function parse_script($script){
    $script_arr = explode("\n", $script);
    $is_found_body = false;
    $options = [];
    $options_count = 0;
    if(preg_match('/^label [a-zA-Z0-9_]+:/', $script_arr[0]) < 1)
        return "Скрипт не начинается с указания метки";
    $label = substr($script_arr[0], 6, strlen($script_arr[0]) - 8);
    $task_text = "";
    foreach ($script_arr as $item){
        if(preg_match('/^[\s]{8}".+"[^:]/', $item) > 0 && !$is_found_body){
            $task_text = substr($item, 9, strlen($item) - 11);
            $is_found_body = true;
        }
        if(preg_match('/^[\s]{8}".+":/', $item) > 0){
            $options[$options_count] = ['option' => substr($item, 9, strlen($item) - 12),'point' => 0];
        }
        if(preg_match('/^[\s]{12}\$ *points *\+= */', $item) > 0){
            $options[$options_count]['point'] = substr($item, 22);
            $options_count++;
        }
    }
    return ['label' => $label, 'task' => $task_text, 'options' => $options];
}
