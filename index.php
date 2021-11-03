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
    <title>Добавление записи</title>
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
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="main.php"><i class="fas fa-home"></i> Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="tasks.php"><i class="fas fa-file-alt"></i> Все записи</a>
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
                        <li class="nav-item">
                            <a href="index.php" class="btn btn-info my-blue-btn nav-btn-active"><span class="nav-btn-text"><i class="fas fa-plus-circle"></i> Новая запись</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-9 col-lg-10 content-container">
                <div class="features">
                    <h1 class="add-form-title">Форма для добавления записи</h1>
                    <form action="check.php" method="post">
                        <input  type="text" name="title" value="<?php if (!empty($_SESSION['title'])) {
                            echo $_SESSION['title'];
                        } ?>" placeholder="Введите название" class="form-control text-field">
                        <div class="text-danger"><?php if (!empty($_SESSION)) {
                                echo $_SESSION['error_title'];
                            } ?></div>
                        <br>
                        <input  type="text" name="label" value="<?php if (!empty($_SESSION['label'])) {
                            echo $_SESSION['label'];
                        } ?>" placeholder="Введите label для RenPy" class="form-control text-field">
                        <div class="text-danger"><?php if (!empty($_SESSION)) {
                                echo $_SESSION['error_label'];
                            } ?></div>
                        <br>
                        <textarea name="message" rows="5" class="form-control text-field" placeholder="Введите текст задания"><?php if (!empty($_SESSION['message'])) {
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
                                            echo '<input type="text" name="option-'.$key.'" value="'.$val['option'].'" placeholder="Введите выбор игрока" class="form-control text-field game-option">';
                                            echo '<input type="number" name="point-'.$key.'" class="form-control points text-field" min="0" value="'.$val['point'].'">';
                                            echo '<div class="wrap-del-opt">
                                                    <a class="btn btn-danger delete-option"><i class="fas fa-trash-alt"></i></a>
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
                <div class="wrap-btn-settings">
                        <a href="tasks.php" class="btn btn-info my-blue-btn btn-shrink">Все записи</a>
                        <a href="destroy.php" class="btn btn-danger my-red-btn btn-shrink">Очистить</a>
                        <button class="btn btn-info my-blue-btn btn-shrink" type="submit">Сохранить</button>
                </div>
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