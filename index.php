<?php
session_start();
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
                    <h1>Форма для добавления записи</h1>
                    <form action="check.php" method="post">
                        <input type="text" name="title" value="<?php if (!empty($_SESSION['title'])) {
                            echo $_SESSION['title'];
                        } ?>" placeholder="Введите название" class="form-control">
                        <div class="text-danger"><?php if (!empty($_SESSION)) {
                                echo $_SESSION['error_title'];
                            } ?></div>
                        <br>
                        <textarea name="message" rows="5" class="form-control" placeholder="Введите текст задания"><?php if (!empty($_SESSION['message'])) {
                                echo $_SESSION['message'];
                            } ?></textarea>
                        <div class="text-danger"><?php if (!empty($_SESSION)) {
                                echo $_SESSION['error_message'];
                            } ?></div>
                        <br>

                        <ul class="option-list">
                            <li class="option-item-head" id="head-option">
                                <span class="game-option">Выбор игрока</span>
                                <span class="points">Очки</span>
                                <div class="wrap-del-opt"></div>
                            </li>
                            <?php
                                if (!empty($_SESSION['options'])){
                                    foreach ($_SESSION['options'] as $key => $val){
                                            echo '<li class="option-item">';
                                            echo '<input type="text" name="option-'.$key.'" value="'.$val['option'].'" placeholder="Введите выбор игрока" class="form-control game-option">';
                                            echo '<input type="number" name="point-'.$key.'" class="form-control points" min="0" value="'.$val['point'].'">';
                                            echo '<div class="wrap-del-opt">
                                                    <a class="btn btn-danger delete-option"><i class="fas fa-times"></i></a>
                                                </div>
                                                <div class="break"></div>';

                                            echo '<div class="text-danger error-option">';
                                            if (!empty($_SESSION['error-option-'.$key]))
                                                echo $_SESSION['error-option-'.$key];
                                            echo '</div></li>';
                                    }
                                } else include "emptyList.php";
                            ?>
                        </ul>
                        <a class="btn btn-light form-control add-btn"><i class="fas fa-plus-circle"></i></a>
                        <br>
                        <br>
                        <a href="tasks.php" class="btn btn-info">Все записи</a>
                        <a href="destroy.php" class="btn btn-info">Очистить</a>
                        <button class="btn btn-success" type="submit">Сохранить</button>
                        <br>
                        <br>
                        <div class="text-success"><?php if (!empty($_SESSION)) {
                                echo $_SESSION['success_send'];
                            } ?></div>
                    </form>
                </div>
        </div>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>