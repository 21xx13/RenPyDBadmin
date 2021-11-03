<?php
session_start();
include "db_func.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <?php
    include "links.php";
    ?>
    <title>Редактирование записи</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php
        include "navbar.php"
        ?>
        <div class="col-md-9 col-lg-10 content-container">
            <div class="features">
                <h1>Изменение записи</h1>
                <form action="change_task_func.php" method="post">
                    <input style="display: none;" name="task_id" value="<?php if (!empty($_POST['task_id'])) {
                        $_SESSION['id_task'] = $_POST['task_id'];
                    }
                    if (!empty($_SESSION['id_task'])){
                        echo $_SESSION['id_task'];
                    }?>">
                    <input type="text" name="title" value="<?php if (!empty($_POST['change_title'])) {
                        $_SESSION['title'] = $_POST['change_title'];
                    }
                    if (!empty($_SESSION['title'])){
                        echo $_SESSION['title'];
                    }?>" placeholder="Введите название" class="form-control text-field">
                    <div class="text-danger"><?php if (!empty($_SESSION['error_title_change'])) {
                            echo $_SESSION['error_title_change'];
                        } ?></div>
                    <br>
                    <input type="text" name="label" value="<?php if (!empty($_POST['change_label'])) {
                        $_SESSION['label'] = $_POST['change_label'];
                    }
                    if (!empty($_SESSION['label'])){
                        echo $_SESSION['label'];
                    }?>" placeholder="Введите label для RenPy" class="form-control text-field">
                    <div class="text-danger"><?php if (!empty($_SESSION['error_label_change'])) {
                            echo $_SESSION['error_label_change'];
                        } ?></div>
                    <br>
                    <textarea name="message" rows="5" class="form-control text-field" placeholder="Введите текст задания"><?php if (!empty($_POST['change_task_text'])) {
                            $_SESSION['message'] = $_POST['change_task_text'];
                        }
                        if (!empty($_SESSION['message'])){
                            echo $_SESSION['message'];
                        }?></textarea>
                    <div class="text-danger"><?php if (!empty($_SESSION['error_message_change'])) {
                            echo $_SESSION['error_message_change'];
                        } ?></div>
                    <br>
                    <ul class="option-list">
                        <li class="option-item-head" id="head-option">
                            <span class="game-option">Выбор игрока</span>
                            <span class="points">Очки</span>
                            <div class="wrap-del-opt"></div>
                        </li>
                        <?php
                        if (empty($_SESSION['options'])){
                            global $PASS;
                            connect_db('localhost', 'root', $PASS, 'test_php');
                            $task_opt = get_task($_SESSION['id_task']);
                            close_db();
                            if (gettype($task_opt) != "string"){
                                $opt_count = 1;
                                while ($opt = $task_opt->fetch_assoc()){
                                    if (empty($_SESSION['options'][$opt_count]))
                                        $_SESSION['options'][$opt_count] = [];
                                    $_SESSION['options'][$opt_count]['option'] = $opt['gameoption'];
                                    $_SESSION['options'][$opt_count]['point'] = intval($opt['points']);
                                    $opt_count++;
                                }
                            }
                            else include "emptyList.php";
                        }

                        foreach ($_SESSION['options'] as $key => $val){
                            echo '<li class="option-item">';
                            echo '<input type="text" name="option-'.$key.'" value="'.$val['option'].'" placeholder="Введите выбор игрока" class="form-control text-field game-option">';
                            echo '<input type="number" name="point-'.$key.'" class="form-control text-field points" min="0" value="'.$val['point'].'">';
                            echo '<div class="wrap-del-opt">
                                                    <a class="btn btn-danger delete-option"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                                <div class="break"></div>';

                            echo '<div class="text-danger error-option">';
                            if (!empty($_SESSION['error-option-'.$key]))
                                echo $_SESSION['error-option-'.$key];
                            echo '</div></li>';
                        }

                        ?>
                    </ul>
                    <a class="btn btn-light form-control add-btn"><i class="fas fa-plus-circle"></i></a>
                    <br>
                    <br>
                    <div class="wrap-btn-settings">
                    <a href="tasks.php" class="btn btn-info btn-shrink my-blue-btn">Все записи</a>
                        <a href="" class="btn btn-danger my-red-btn btn-shrink">Очистить</a>
                    <button class="btn btn-info my-blue-btn btn-shrink" type="submit">Сохранить</button>
                    </div>
                    <div class="text-success"><?php if (!empty($_SESSION['success_send_change']))
                            echo $_SESSION['success_send_change'];?></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/script.js"></script>
<?php session_destroy();?>
</body>
</html>