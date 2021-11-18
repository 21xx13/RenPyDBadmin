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
    <link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <script src="codemirror/lib/codemirror.js"></script>
    <script src="codemirror/addon/edit/matchbrackets.js"></script>
    <script src="codemirror/mode/python/python.js"></script>
    <title>Редактирование скрипта</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php
        include "navbar.php"
        ?>
        <div class="col-md-9 col-lg-10 content-container">
            <div class="features">
                <h1 class="add-form-title">Форма редактирования скрипта</h1>
                <form action="controls/check.php" method="post">
                    <input  type="text" name="title" value="<?php if (!empty($_SESSION['title'])) {
                        echo $_SESSION['title'];
                    } ?>" placeholder="Введите название" class="form-control text-field">
                    <div class="text-danger"><?php if (!empty($_SESSION)) {
                            echo $_SESSION['error_title'];
                        } ?></div>
                    <br>
                    <textarea id="code" name="code"></textarea>
                    <div class="text-danger"><?php if (!empty($_SESSION)) {
                            echo $_SESSION['error_message'];
                        } ?></div>
                    <br>
                    <div class="wrap-btn-settings">
                        <a href="tasks.php" class="btn btn-info my-blue-btn btn-shrink">Все записи</a>
                        <a href="" class="btn btn-danger my-red-btn btn-shrink">Очистить</a>
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

<script>
    let editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        mode: {name: "python",
            version: 3,
            singleLineStringErrors: false},
        lineNumbers: true,
        indentUnit: 4,
        matchBrackets: true
    });
</script>
</body>
</html>
