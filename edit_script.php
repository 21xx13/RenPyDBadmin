<?php
session_start();
include "controls/db_func.php";
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
                <form class="form-script" action="controls/edit_script_func.php" method="post">
                    <input style="display: none;" name="task_id" value="<?php if (!empty($_POST['task_id'])) {
                        $_SESSION['id_task'] = $_POST['task_id'];
                    }
                    if (!empty($_SESSION['id_task'])){
                        echo $_SESSION['id_task'];
                        $script_db = get_task_by_id($_SESSION['id_task'])['game_script'];
                    }?>">
                    <input type="text" name="title" value="<?php if (!empty($_POST['edit_script_title'])) {
                        $_SESSION['title'] = $_POST['edit_script_title'];
                    }
                    if (!empty($_SESSION['title'])){
                        echo $_SESSION['title'];
                    }?>" placeholder="Введите название" class="form-control text-field">
                    <div class="text-danger"><?php if (!empty($_SESSION['error_title_edit_script'])) {
                            echo $_SESSION['error_title_edit_script'];
                        } ?></div>
                    <br>
                    <textarea id="code" name="code"><?php if (!empty($script_db)) {
                            $_SESSION['script'] = $script_db;
                        }
                        if (!empty($_SESSION['script'])){
                            echo $_SESSION['script'];
                        }?></textarea>
                    <div class="text-danger"><?php if (!empty($_SESSION['error_script'])) {
                            echo $_SESSION['error_script'];
                        } ?></div>
                    <br>
                    <div class="wrap-btn-settings">
                        <a href="tasks.php" class="btn btn-info my-blue-btn btn-shrink">Все записи</a>
                        <a href="" class="btn btn-danger my-red-btn btn-shrink">Очистить</a>
                        <button class="btn btn-info my-blue-btn btn-shrink" type="submit">Сохранить</button>
                    </div>
                    <div class="text-success"><?php if (!empty($_SESSION['success_send_edit'])) {
                            echo $_SESSION['success_send_edit'];
                        } ?></div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php session_destroy();?>
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
