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
        <div class="col-md-3 col-lg-2 navbar-container">
            <nav class="navbar navbar-expand-md navbar-dark fixed-top">
                <a href="index.php" class="navbar-brand">
                    <b>RenPyMyAdmin</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active-nav" href="index.php"><i class="fas fa-home"></i> Главная</a>
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
                        <li class="nav-item btn-nav-link">
                            <a href="add_task.php" class=" btn btn-info my-blue-btn "><i class="fas fa-plus-circle"></i> Новая запись</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-9 col-lg-10 content-container">
            <div class="features body-main">
                <h1 class="add-form-title">Главная</h1>
                <div class="main-hello-text">
                    Добро пожаловать в RenPyMyAdmin. Здесь вы можете с легкостью заполнить базу данных для своей визуальной новеллы. Сервис не требует знаний SQL-запросов, ввод данных происходит через графический интерфейс. Если в вашей игре присутствует множество однотипных выборов (например, для создания образовательного контента), то необязательно прописывать их вручную, мы вам поможем. Для того, чтобы вы легко разобрались в функционале нашего сервиса, мы предлагаем ознакомиться вам с подробной инструкцией. Существует два варианта хранения данных: в удаленной БД и локальной.
                </div>
                <div class="wrap-main">
                    <div class="main-hello-text">
                        Удаленная БД: При использовании данного варианта хранения, ваша новелла будет обращаться к БД, расположенной на нашем сервере. Вся внесенная вами информация будет находиться вне игры. Вам не придется скачивать архив, содержащий все задания, но если у вашего игрока не будет доступа в Интернет - обновленные задания он не увидит.
                        <div class="btn-wrap-center">
                            <a href="game_scripts/get_task.rpy" download="" class="btn btn-info my-blue-btn btn-bigger">Скачать скрипты</a>
                        </div>
                    </div>
                    <div class="main-hello-text">
                        Локальная БД: В данном случае ваша БД будет храниться в файлах, сопутствующих игре. Вся внесенная вами информация будет скачиваться вместе с новеллой. Этот вариант хранения увеличит объем игры (в зависимости от размера БД). Задания из БД будут обновляться только с полным обновлением вашей новеллы.
                        <div class="btn-wrap-center">
                            <?php
                            include "controls/db_func.php";
                            global $PASS;
                            connect_db('localhost', 'root', $PASS, 'test_php');
                            $res = DBi::$conn->query("SELECT * FROM `task_info` ORDER BY `label`");
                            $DIR = "game_scripts/local.zip";
                            if ($res->num_rows > 0) {
                                if(file_exists($DIR))
                                    unlink($DIR);
                                $zip = new ZipArchive();
                                $prev_label = "";
                                $count  = 1;
                                $zip->open($DIR, ZipArchive::CREATE|ZipArchive::OVERWRITE);
                                while ($row = $res->fetch_assoc()) {
                                    if ($prev_label == $row['label'])
                                        $count++;
                                    else $count = 1;

                                    $label = $row['label'];
                                    $zip->addFromString("tasks/$label/$count.rpy", $row['game_script']);

                                    $prev_label = $row['label'];
                                }
                                $zip->addFile("game_scripts/get_task.rpy", 'get_task.rpy');
                                $zip->close();
                            }
                            close_db();
                            ?>
                            <a href="game_scripts/local.zip" download="" class="btn btn-info my-blue-btn btn-bigger">Скачать архив</a>

                        </div>
                    </div>
                </div>
                <div class="btn-wrap">
                    <a href="references.php" class="btn btn-danger my-red-btn btn-bigger">Инструкция</a>
                </div>

        </div>
    </div>
</div>

</body>
</html>