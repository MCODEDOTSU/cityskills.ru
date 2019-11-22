<div id="sliderItems" class="sliders-page" style="display: none;">

    <h1 class="wp-heading-inline">Страницы слайдера</h1>

    <a href="#newItem" onclick="addItemForm()" class="add-new-h2">Добавить новый элемент слайдера</a>

    <div id="slider-items-list"></div>
    <input type="hidden" id="slider-items-slider-id"/>
    <div class="align-right">
        <button class="btn btn-success" onclick="updateAllItems();deleteAllItems()">Сохранить</button>
        <button class="btn" onclick="setPage('#sliders')">Отменить</button>
    </div>

</div>