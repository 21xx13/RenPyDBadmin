<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <?php
    include "links.php";
    ?>
    <title>Инструкция</title>
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
                            <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="tasks.php"><i class="fas fa-file-alt"></i> Все записи</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="statistics.php"><i class="fas fa-chart-line"></i> Отчёты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  active-nav" href="references.php"><i class="fas fa-info-circle"></i> Справка</a>
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
                <h1 class="add-form-title">Инструкция</h1>
                <div class="main-title">Навигация по сервису</div>
                <div class="main-text">
                    <p class="ref-text">Пункт <a class="text-link" href="tasks.php">“Все записи”</a> содержит все внесенные задания в БД. Каждая запись вынесена в отдельную карточку,
                    которая содержит основную информацию: название, внутриигровой текст задания, выборы игрока, дату создания.
                    Также для каждого задания указывается своя метка (Подробнее прочитать о label
                    можно <a href="http://ru.renpypedia.shoutwiki.com/wiki/%D0%9C%D0%B5%D1%82%D0%BA%D0%B8_%D0%B8_%D0%BF%D0%BE%D1%82%D0%BE%D0%BA_%D1%83%D0%BF%D1%80%D0%B0%D0%B2%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F_(Labels_%26_Control_Flow)" class="text-link">здесь</a>)
                    для потока в скрипте RenPy. Задания одного типа (вызываемые из одного и того же места в игре) требуется
                        помечать одинаковыми метками. Карточки можно удалять, редактировать и раскрывать выборы игрока.</p>
                    <div class="ref-img-wrap"><img src="img/tasks.jpg" class="ref-img"></div>
                    <p class="ref-text">При нажатии на кнопку “Редактировать” карточка раскрывается в “Изменение записи”, где вы можете внести все необходимые
                    дополнения. Кнопка “Очистить” не удалит запись из БД, но полностью очистит поля формы. После внесения правок не забудьте
                        нажать на кнопку “Сохранить”.</p>
                    <div class="ref-img-wrap"><img src="img/change_form.jpg" class="ref-img"></div>
                    <p class="ref-text">
                        Удаление записи происходит только после подтверждения во всплывающем окне.</p>
                    <div class="ref-img-wrap"><img src="img/delete_task.jpg" class="ref-img"></div>
                    <p class="ref-text">В разделе <a class="text-link" href="statistics.php">“Отчёты”</a> имеется возможность скачать статистику прохождения по каждому игроку, при подключенной
                    выгрузке из вашей игры. Статистика скачивается в виде файла .csv (его можно открыть в Блокноте или в Excel).
                    Файл хранит в себе очки, набранные игроком во время прохождения новеллы. Для функционирования игры подключение
                        выгрузки не обязательно.</p>
                    <div class="ref-img-wrap"><img src="img/statistics.jpg" class="ref-img"></div>
                    <p class="ref-text">
                        Раздел <a class="text-link" href="references.php">“Справка”</a> приведет вас на эту страницу.</p>
                    <p class="ref-text">
                    Страница <a class="text-link" href="contacts.php">“Контакты”</a> поможет связаться с разработчиками приложения. Вы можете написать нам на почту,
                        в сообщениях группы Вконтакте или подписаться на наш Телеграм-канал.</p>
                    <div class="ref-img-wrap"><img src="img/contacts.jpg" class="ref-img"></div>
                    <p class="ref-text">
                    Кнопка <a class="text-link" href="add_task.php">“Новая запись”</a> направит к форме, которую вы сможете заполнить и внести в вашу БД.
                        А теперь поговорим о том, как ее нужно заполнять.</p>
                    <div class="ref-img-wrap"><img src="img/input_form.jpg" class="ref-img"></div>

                </div>
                <div class="main-title">Заполнение формы записи в БД (Черновик)</div>
                <div class="main-text">
                    После заполнения БД вы можете выбрать наиболее удобный для вас формат работы: с удаленной БД или с локальной БД. Разница между этими вариантами подробно указана на Главной странице сервиса.
                </div>
                <div class="main-title">Выгрузка скриптов для работы с удаленной БД (Черновик)</div>
                <div class="main-text">
                    Для работы с удаленной БД необходимо файл get_task.rpy поместить в корневую папку новеллы (название_новеллы/game/) В основном скрипте RenPy (script.rpy) необходимо вызвать функцию get_task, передав ей в качестве аргумента название метки (label) (может быть любым, в соответствии с синтаксисом Python) там, где необходимо использовать задание из БД. После вызова функции можно переходить к полученному заданию, для этого пропишите в скрипте оператор call, переходящий к заданию.
                    Пример вызова функции и переход к заданию
                    <br>$ get_task(“label_for_email_task”)
                    <br>call label_for_email
                </div>
                <div class="main-title">Выгрузка скриптов для работы с локальной БД (Заглушка)</div>
                <div class="main-text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque earum nam obcaecati provident vero. Amet, aut dolorum earum eius ex facere illum libero magnam modi nulla quia quis rem repudiandae! Aliquam atque beatae consequuntur cupiditate dolores, ea et excepturi hic incidunt itaque maxime molestias nam nihil numquam perferendis quam quis quo sapiente similique totam? Ab debitis eius explicabo fuga saepe!
                </div>
                <div class="main-title">Скачивание и установка локальной БД (Заглушка)</div>
                <div class="main-text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque earum nam obcaecati provident vero. Amet, aut dolorum earum eius ex facere illum libero magnam modi nulla quia quis rem repudiandae! Aliquam atque beatae consequuntur cupiditate dolores, ea et excepturi hic incidunt itaque maxime molestias nam nihil numquam perferendis quam quis quo sapiente similique totam? Ab debitis eius explicabo fuga saepe!
                </div>
                <div class="main-title">Подключение выгрузки статистики игроков (Черновик)</div>
                <div class="main-text">
                    Для отправления статистики необходимо файл save_result.rpy поместить в корневую папку новеллы (название_новеллы/game/) В основном скрипте RenPy (script.rpy) необходимо вызвать функцию save_result(user_name), передав ей в качестве аргумента переменную с именем игрока. Для того, чтобы вы могли различать отчеты своих игроков необходимо прописать в скрипте запрос на ввод имени игрока. Ввод имени игрока осуществляется следующим образом:
                    <br>$ user_name = renpy.input("Введите имя")
                    <br>Запросите ввод имени в любом удобном для вас месте (до начала игры/после завершения игры).
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
