<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <?php
    include "links.php";
    ?>
    <title>Контакты</title>
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
                            <a class="nav-link active-nav" href="contacts.php"><i class="fas fa-address-book"></i> Контакты</a>
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
                <h1 class="add-form-title">Остались вопросы?</h1>
                <div class="main-contact-text">Тогда свяжитесь с нами!</div>
                <div class="main-contact-text"><a class="contact-link-text" href="mailto:FiveRaccoonsRTF@gmail.com">FiveRaccoonsRTF@gmail.com</a></div>
                <ul class="icons">
                    <li><a href="https://vk.com/financialcalculator" target="_blank"><img src="img/vk.png" class="contact-img"></a> </li>
                    <li><a href="https://t.me/FinancialCalculator" target="_blank"><img src="img/tel.png" class="contact-img"></a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>
