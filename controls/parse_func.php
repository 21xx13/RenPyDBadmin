<?php
function default_script($label, $task_text, $options): string
{
    $script = "label ".$label.":

    \"".$task_text."\"

    menu:

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
