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
    <title>Все записи</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 navbar-container">
            <nav class="navbar navbar-expand-md navbar-dark fixed-top">
                <a href="main.php" class="navbar-brand">
                    <b>RenPyMyAdmin</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <!-- Пункты вертикального меню -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="main.php"><i class="fas fa-home"></i> Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  active-nav" href="tasks.php"><i class="fas fa-file-alt"></i> Все записи</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="statistics.php"><i class="fas fa-chart-line"></i> Отчёты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="references.php"><i class="fas fa-info-circle"></i> Справка</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacts.php"><i class="fas fa-address-book"></i> Контакты</a>
                        </li>
                        <br>

                        <li class="nav-item btn-nav-link">
                            <a href="index.php" class=" btn btn-info my-blue-btn "><i class="fas fa-plus-circle"></i> Новая запись</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-9 col-lg-10 content-container">
            <div class="features">
                <h1>Все записи</h1>

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
                        echo '<h3 class="task-title">'.$row['task_name'].'</h3>';

                        echo '<div class="btn-block">';
                        echo '<button class="btn btn-sm btn-danger my-red-btn" data-toggle="modal" data-target="#myModal_'.$id_modal.'"><i class="fas fa-trash-alt"></i></button>
                <div id="myModal_'.$id_modal. '" class="my-modal modal fade" tabindex="-1">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 style="color: black;">Подтверждение</h4>
                                <button class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="modal-body" style="color: black;">
                                <p style="text-align: start !important; color: black;">Вы действительно хотите удалить запись "' .$row['task_name'].'"?</p>
                                <br>
                                <div class="buttons-modal" style="text-align: end !important;">
                                    <button class="btn btn-info btn-sm my-blue-btn " data-dismiss="modal">Отмена</button>
                                    <form action="delete_task.php" method="post" class="form-btn">'.$id_input.'<button type="submit" class="btn btn-sm btn-danger my-red-btn">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                        echo '<form class="form-btn" action="change_task.php" method="post">';
                        echo $id_input;
                        echo '<input style="display: none;" name="change_title" value="'.$row['task_name'].'">';
                        echo '<input style="display: none;" name="change_label" value="'.$row['label'].'">';
                        echo '<input style="display: none;" name="change_task_text" value="'.$row['task_text'].'">';
                        echo '<button type="submit" class="btn btn-sm btn-primary redactor-btn"><i class="fas fa-pencil-alt"></i></button></form>';
                        echo '</div>';
                        echo '</div>';

                        echo '<p class="label">Label: '.$row['label'].'</p>';

                        echo '<p class="main-text-block">'.$row['task_text'].'</p>';

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
                                echo '<li class="option-text">'.$opt_count.". ".$opt['gameoption'].' (+'.$opt['points'].')'.'</li>';
                                $opt_count++;
                            }
                            echo '</ul>';
                        }
                        echo '</div>';
                        echo '<div class="date-task">Дата создания: '.date('d.m.Y H:i', strtotime( $row['create_date'])).'</div>';
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
