<?php
include "db_func.php";
global $PASS;
connect_db('localhost', 'root', $PASS, 'test_php');
//$offset_task = rand(1, read_count()) - 1;
//$task = get_n_row($offset_task);
$label = $_GET['label'];
$offset_task = rand(1, read_count_by_label($label)) - 1;
$task = get_n_row_by_label($offset_task, $label);
$options = get_options_by_id($task['id']);
close_db();


echo "label ".$task['label'].":

    \"".$task['task_text']."\"
    
    menu:
    
";
while ($row = $options->fetch_assoc())
    echo '        "'.$row['gameoption']."\"".':
            $ points+='.$row['points']."

";
echo "    return";