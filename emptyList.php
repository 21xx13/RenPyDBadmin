<li class="option-item">
    <input type="text" name="option-1" value="" placeholder="Введите выбор игрока" class="form-control game-option text-field">
    <input type="number" name="point-1" class="form-control points text-field" min="0" value="0">
    <div class="wrap-del-opt">
        <a class="btn btn-danger delete-option btn-disable"><i class="fas fa-trash-alt"></i></a>
    </div>
    <div class="break"></div>
    <div class="text-danger error-option"><?php
        if (!empty($_SESSION['error-option-1']))
            echo $_SESSION['error-option-1'];?></div>
</li>