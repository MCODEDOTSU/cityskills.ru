<div id="newSlide" class="sliders-page" style="display: none;">
    <h1 class="wp-heading-inline">Создание нового слайдера</h1>

    <label for="slider-add-title">Заголовок слайдера</label>
    <input type="text" id="slider-add-title" spellcheck="true" autocomplete="true"
           placeholder="Введите заголовок">

    <label for="slider-add-speed">Скорость автопрокрутки, сек.</label>
    <input type="number" id="slider-add-speed" spellcheck="true" autocomplete="true"
           min="0" max="300" step="1"
           placeholder="30">

    <div class="align-right">
        <button class="btn btn-success" onclick="createSlider()">Сохранить</button>
        <button class="btn" onclick="setPage('#sliders')">Отменить</button>
    </div>
</div>