jQuery(document).ready(function () {
    getAllSliders();
});

/**
 * Переключаем страницы
 */
function setPage(id) {
    jQuery('.sliders-page').hide();
    jQuery(id).show();
}

/**
 * Получить все слайдеры
 */
function getAllSliders() {
    jQuery.post(
        ajaxurl, {action: 'mcode_slider_block_select'},
        function (result) {
            jQuery('#slider-sliders-list').html('');
            jQuery.each(result.result, function (i, value) {
                jQuery('#slider-sliders-list').append(
                    `<tr><td>
                            <strong>${value.title}</strong><div class="row-actions">
                                <button class="edit" onclick="getSlider('${value.title}', '${value.height}', '${value.speed}', ${value.id});setPage('#editSlider')">Изменить</button> | 
                                <button class="items" onclick="getAllItems(${value.id});setPage('#sliderItems');">Страницы слайдера</button> | 
                                <button class="delete" onclick="deleteSlider(${value.id})">Удалить</button>
                            </div></td>
                        <td>[slider id="${value.id}"]</td></tr>`
                );
            });
        }, 'json'
    );
}

/**
 * Создать новый слайдер
 */
function createSlider() {
    let data = {
        title: jQuery('#slider-add-title').val(),
        height: 0,
        speed: jQuery('#slider-add-speed').val(),
        action: 'mcode_slider_block_create',
    };
    jQuery.post(
        ajaxurl, data,
        function (result) {
            getAllSliders();
        }, 'json'
    );
    jQuery('#slider-add-title').val('');
    setPage('#sliders');
}

/**
 * Получить данные слайдера
 */
function getSlider(title, height, speed, id) {
    jQuery('#slider-edit-title').val(title);
    jQuery('#slider-edit-height').val(height);
    jQuery('#slider-edit-speed').val(speed);
    jQuery('#slider-edit-id').val(id);
}

/**
 * Сохранить изменения слайдера
 */
function updateSlide() {
    let data = {
        title: jQuery('#slider-edit-title').val(),
        height: 0,
        speed: jQuery('#slider-edit-speed').val(),
        id: jQuery('#slider-edit-id').val(),
        action: 'mcode_slider_block_update',
    };
    jQuery.post(
        ajaxurl, data,
        function (result) {
            getAllSliders();
        }, 'json'
    );
    jQuery('#slider-edit-title').val('');
    jQuery('#slider-edit-id').val('');
    setPage('#sliders');
}

/**
 * Удалить слайдер
 */
function deleteSlider(id) {
    let data = {
        id: id,
        action: 'mcode_slider_block_delete',
    };
    jQuery.post(
        ajaxurl, data,
        function (result) {
            getAllSliders();
        }, 'json'
    );
}

/**
 * Получить элементы слайдера
 */
function getAllItems(sliderId) {

    let data = {
        slider_id: sliderId,
        action: 'mcode_slider_item_select',
    };
    jQuery.post(
        ajaxurl, data,
        function (result) {

            let html = '';
            jQuery.each(result.result, function (i, value) {

                let image = '';
                if(value.image == '') {
                    let src = jQuery('#plugin-dir-path').val() + 'images/image.png';
                    image = `<div class="image-container image empty">
                            <button class="select-image btn" title="Выбрать изображение" onclick="selectImage(jQuery(this))">
                                <img src="${src}" alt="" class="item-image"/>
                            </button>
                        </div>`;
                } else {
                    image = `<div class="image-container image">
                            <button class="select-image btn" title="Выбрать изображение" onclick="selectImage(jQuery(this))">
                                <img src="${value.image}" alt="" class="item-image"/>
                            </button>
                            <button class="delete-image btn" onclick="deleteImage(jQuery(this))">Удалить</button>
                        </div>`;
                }

                html += `<div class="slider-item item-update">
                        ${image}
                        <div class="fields-container">
                            <label class="field-title">Заголовок</label>
                            <div class="field"><textarea class="item-title">${value.title}</textarea></div>
                            <label class="field-title">Описание</label>
                            <div class="field"><textarea class="item-description">${value.description}</textarea></div>
                            <label class="field-title">Порядок слайда</label>
                            <div class="field"><input type="number" class="item-sort" value="${value.sort}"/></div>
                            <label class="field-title">Текст кнопки</label>
                            <div class="field"><input type="text" class="item-button" value="${value.button}"/></div>
                            <label class="field-title">Ссылка</label>
                            <div class="field"><input type="text" class="item-link" value="${value.link}"/></div>
                            <label class="field-title">Цвет</label>
                            <div class="field"><input type="text" class="item-color" value="${value.color}" /></div>
                            <input type="hidden" value="${value.id}" class="item-id"/>
                        </div>
                        <button onclick="deleteItem(jQuery(this))" class="btn">Удалить</button>
                    </div>`;
            });
            jQuery('#slider-items-list').html(html);
            addItemForm();
        },
        'json'
    );
    jQuery('#slider-items-slider-id').val(sliderId);
}

/**
 * Форма для нового элемента
 */
function addItemForm() {
    let src = jQuery('#plugin-dir-path').val() + 'images/image.png';

    let html = `<div class="slider-item item-update">
                        <div class="image-container image empty">
                            <button class="select-image btn" title="Выбрать изображение" onclick="selectImage(jQuery(this))">
                                <img src="${src}" alt="" class="item-image"/>
                            </button>
                        </div>
                        <div class="fields-container">  
                            <label class="field-title">Заголовок</label>                         
                            <div class="field"><textarea class="item-title" placeholder="Заголовок"></textarea></div>
                            <label class="field-title">Описание</label>
                            <div class="field"><textarea class="item-description" placeholder="Описание"></textarea></div>
                            <label class="field-title">Порядок слайда</label>
                            <div class="field"><input type="number" class="item-sort" placeholder="Порядок сортировки" value=""/></div>
                            <label class="field-title">Текст кнопки</label>
                            <div class="field"><input type="text" class="item-button" value="" placeholder="Кнопка"/></div>
                            <label class="field-title">Ссылка</label>
                            <div class="field"><input type="text" class="item-link" value="" placeholder="Ссылка на страницу"/></div>
                            <label class="field-title">Цвет</label>
                            <div class="field"><input type="text" class="item-color" value="" placeholder="#dedede"/></div>
                            <input type="hidden" value="0" class="item-id"/>
                         </div>
                    </div>`;

    jQuery('#slider-items-list').append(html);
}

/**
 * Сохранить или создать новый элемент слайдера
 */
function updateAllItems() {
    jQuery('#slider-items-list .slider-item').each(function () {

        if(jQuery(this).hasClass('item-delete')) return 1;

        let id = jQuery('.item-id', jQuery(this)).val();

        let data = {
            id: id,
            slider_id: jQuery('#slider-items-slider-id').val(),
            sort: jQuery('.item-sort', jQuery(this)).val(),
            image: jQuery('.image-container.image', jQuery(this)).hasClass('empty') ? '' : jQuery('.image-container.image img', jQuery(this)).attr('src'),
            title: jQuery('.item-title', jQuery(this)).val(),
            description: jQuery('.item-description', jQuery(this)).val(),
            button: jQuery('.item-button', jQuery(this)).val(),
            link: jQuery('.item-link', jQuery(this)).val(),
            color: jQuery('.item-color', jQuery(this)).val(),
        };
        if(data['title'] == '' && id == 0) return 1;
        data['action'] = id == 0 ? 'mcode_slider_item_create' : 'mcode_slider_item_update';
        jQuery.post(
            ajaxurl, data,
            function (result) {
                location.reload();
            }, 'json'
        );
    });
}

/**
 * Пометить элемент слайдера на удаление
 */
function deleteItem($element) {
    $element = $element.parent();
    if($element.hasClass('item-create')) {
        $element.detach();
        if(jQuery('#slider-items-list .item-create').length == 0) {
            addItemForm();
        }
    } else {
        $element.removeClass('item-update').addClass('item-delete');
    }
}

/**
 * Удалить помеченные элементы слайдера
 */
function deleteAllItems() {
    jQuery('#slider-items-list .slider-item.item-delete').each(function () {
        let id = jQuery('.item-id', jQuery(this)).val();
        if(id == 0) return 1;
        let data = {
            id: id,
            action: 'mcode_slider_item_delete'
        };
        jQuery.post(
            ajaxurl, data,
            function (result) {
                getAllItems(jQuery('#slider-items-block-id').val());
            }, 'json'
        );
    });
}

/**
 * Выбрать изображение
 */
function selectImage($element) {

    $element = $element.parent();

    var image_frame;
    if(image_frame) image_frame.open();

    image_frame = wp.media({
        title: 'Select Media',
        multiple : false,
        library : {
            type : 'image',
        }
    });

    image_frame.on('close', function() {
        var selection =  image_frame.state().get('selection').first();
        let image = selection['attributes']['url'];
        jQuery('img', $element).attr('src', image);
        if($element.hasClass('empty')) {
            $element.append(`<button class="delete-image btn" onclick="deleteImage(jQuery(this))">Удалить</button>`).removeClass('empty');
        }
    });

    image_frame.open();
}

/**
 * Удалить изображение
 * @param $element
 */
function deleteImage($element) {
    $element = $element.parent('.image-container');
    let src = jQuery('#plugin-dir-path').val() + 'images/image.png';
    jQuery('img', $element).attr('src', src);
    jQuery('.delete-image', $element).detach();
    $element.addClass('empty');
}