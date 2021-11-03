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
                <a href="main.php" class="navbar-brand">
                    <b>RenPyMyAdmin</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active-nav" href="main.php"><i class="fas fa-home"></i> Главная</a>
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
                            <a href="index.php" class=" btn btn-info my-blue-btn "><i class="fas fa-plus-circle"></i> Новая запись</a>
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

                    </div>
                    <div class="main-hello-text">
                        Локальная БД: В данном случае ваша БД будет храниться в файлах, сопутствующих игре. Вся внесенная вами информация будет скачиваться вместе с новеллой. Этот вариант хранения увеличит объем игры (в зависимости от размера БД). Задания из БД будут обновляться только с полным обновлением вашей новеллы.
                         </div>
                </div>
                <div class="btn-wrap">
                    <a href="references.php" class="btn btn-info my-blue-btn btn-bigger">Инструкция</a>
                </div>

        </div>
    </div>
</div>

</body>
</html>