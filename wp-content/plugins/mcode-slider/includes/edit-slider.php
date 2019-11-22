<div id="editSlider" class="sliders-page" style="display: none;">
    <h1 class="wp-heading-inline">Редактирование слайдера</h1>

    <label for="slider-edit-title">Заголовок слайдера</label>
    <input type="text" id="slider-edit-title" spellcheck="true" autocomplete="true"
           placeholder="Введите заголовок">

    <label for="slider-edit-speed">Скорость автопрокрутки, сек.</label>
    <input type="number" id="slider-edit-speed" spellcheck="true" autocomplete="true"
           min="0" max="300" step="1"
           placeholder="30">

    <input type="hidden" id="slider-edit-id">

    <div class="align-right">
        <button class="btn btn-success" onclick="updateSlide()">Сохранить</button>
        <button class="btn" onclick="setPage('#sliders')">Отменить</button>
    </div>
</div>