function MaxItem(){
    let items = [];
        document.querySelectorAll('[name^="option-"]')
            .forEach(e => items.push(+e.getAttribute('name')?.split('-')[1]));
        return Math.max.apply(null, items);
}
let optionId = MaxItem() + 1;

function DeleteChild(childList, element){
    let link = element.querySelector('.delete-option');
    link.addEventListener('click', ()=> {
        if (childList.childElementCount > 2){
            childList.removeChild(element);
            if (childList.childElementCount === 2)
                childList.querySelector('.delete-option').classList.add('btn-disable');
        }
    })
}

let optList = document.querySelector('.option-list');
let allLi = document.querySelectorAll('.option-item');
if (optList.childElementCount === 2)
    optList.querySelector('.delete-option').classList.add('btn-disable');
for(let i = 0; i < allLi.length; i++){
    DeleteChild(optList, allLi[i]);
}

document.querySelector(".add-btn").addEventListener('click', () => {
    let optionList = document.querySelector('.option-list');
    let newItem = document.createElement('li');
    newItem.classList.add("option-item");
    newItem.innerHTML = `<input type="text" name="option-${optionId}" value="" placeholder="Введите выбор игрока" class="form-control game-option">
                                <input type="number" name="point-${optionId}" class="form-control points" min="0" value="0">
                                <div class="wrap-del-opt">
                                    <a class="btn btn-danger delete-option"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="break"></div>
                                <div class="text-danger error-option"><?php if (!empty($_SESSION)) {
                                        echo $_SESSION['error-option-${optionId}'];;
                                    } ?></div>`;
    let disBtn = optionList.querySelector('.btn-disable');
    disBtn?.classList.remove('btn-disable');
    optionList.appendChild(newItem);
    DeleteChild(optionList, newItem);
    optionId++;
});


