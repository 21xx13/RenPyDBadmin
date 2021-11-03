<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <?php
    include "links.php";
    ?>
    <title>Отчёты</title>
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
                            <a class="nav-link active-nav" href="statistics.php"><i class="fas fa-chart-line"></i> Отчёты</a>
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
                <h1 class="add-form-title">Отчёты игроков</h1>
                <div class="main-hello-text">
                    На этой странице вы можете ознакомиться со статистикой прохождения новеллы вашими игроками.
                    В инструкции указано, как выгрузить результаты прохождения игры. Если вы подключили данный скрипт,
                    то ниже будет представлена таблица с результатами в формате csv. После скачивания файл можно открыть как блокноте,
                    так и для более удобного отображения - в таблицах Excel.
                </div>
                <div class="btn-wrap">
                    <a href="statistics.php" class="btn btn-info my-blue-btn btn-bigger">Обновить</a>
                </div>
                <div class="table-wrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Имя файла</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $dir    = './game_scores';
                        $files1 = scandir($dir);

                        for($i=2; $i < count($files1); $i++){
                            echo "<tr><td>";
                            echo '<a href="game_scores/'.$files1[$i].'" download="" class="score-link">';
                            echo $files1[$i];
                            echo '</a></td></tr>';
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
