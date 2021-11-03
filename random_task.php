<?php
include "db_func.php";
global $PASS;
connect_db('localhost', 'root', $PASS, 'test_php');
$offset_task = rand(1, read_count()) - 1;
$task = get_n_row($offset_task);
$options = get_options_by_id($task['id']);
close_db();


echo "label random_task:

    \"".$task['task_text']."\"
    
    menu:
    
";
while ($row = $options->fetch_assoc())
    echo '        "'.$row['gameoption']."\"".':
            $ points+='.$row['points']."

";
echo "    return";