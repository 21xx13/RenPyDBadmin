<?php
include "db_func.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <?php
    include "links.php";
    ?>
    <title>Главная</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php
        include "navbar.php"
        ?>
        <div class="col-md-9 col-lg-10 content-container">
            <div class="features">
                <h1>Все задания</h1>

                <div class="task-wrap">
                <?php
                    $res = get_tasks();
                    $id_modal = 0;
                    while ($row = $res->fetch_assoc())
                    {
                        $task_opt = get_task($row['id']);
                        echo '<div class="task-block">';
                        $id_input = '<input style="display: none;" name="task_id" value="'.$row['id'].'">';
                        echo '<div class="task-block-header">';
                        echo '<h3 class="task-title">'.$row['name'].'</h3>';
                        echo '<div class="btn-block">';
                        echo '<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal_'.$id_modal.'"><i class="fas fa-trash-alt"></i></button>
                <div id="myModal_'.$id_modal. '" class="my-modal modal fade" tabindex="-1">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 style="color: black;">Подтверждение</h4>
                                <button class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="modal-body" style="color: black;">
                                <p style="text-align: start !important;">Вы действительно хотите удалить запись "' .$row['name'].'"?</p>
                                <div class="buttons-modal" style="text-align: end !important;">
                                    <button class="btn btn-info btn-sm " data-dismiss="modal">Отмена</button>
                                    <form action="delete_task.php" method="post" class="form-btn">'.$id_input.'<button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                        echo '<form class="form-btn" action="change_task.php" method="post">';
                        echo $id_input;
                        echo '<input style="display: none;" name="change_title" value="'.$row['name'].'">';
                        echo '<input style="display: none;" name="change_task_text" value="'.$row['bio'].'">';
                        echo '<button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></button></form>';
                        echo '</div>';
                        echo '</div>';
                        echo '<p>'.$row['bio'].'</p>';
                        echo '<button class="btn btn-link opt-show" data-toggle="collapse" data-target="#options_'.$id_modal.'"><i class="fas fa-caret-down"></i> Выборы игрока</button>';
                        echo '<div class="collapse" id="options_'.$id_modal.'">';
                        if (gettype($task_opt) == "string"){
                            echo '<input style="display: none;" name="empty_opt" value="empty">';
                            echo '<p style="margin-bottom: 10px">'.$task_opt.'</p>';
                        }

                        else{
                            echo '<ul class="list-options-hide">';
                            $opt_count = 1;
                            while ($opt = $task_opt->fetch_assoc()){
                                echo '<li>'.$opt_count.". ".$opt['gameoption'].' (+'.$opt['points'].')'.'</li>';
                                $opt_count++;
                            }
                            echo '</ul>';
                        }
                        echo '</div>';
                        echo '</div>';
                        $id_modal++;
                    }
                    close_db();
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
