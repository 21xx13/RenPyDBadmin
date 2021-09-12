<?php
include "db_func.php";

connect_db('localhost', 'root', '21stopium', 'test_php');
$offset_task = rand(1, read_count()) - 1;
$task = get_n_row($offset_task);
$options = get_options_by_id($task['id']);
close_db();


echo "<pre>
label random_task:

    \"".$task['bio']."\"
    
    menu:
    
";
while ($row = $options->fetch_assoc())
    echo '        "'.$row['gameoption']."\"".':
            $points+='.$row['points']."

";
echo "    return";
echo "</pre>";