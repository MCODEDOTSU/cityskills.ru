<?php
$month = empty($_GET['m']) ? 0 : (int)$_GET['m'];
$year = empty($_GET['y']) ? date('Y') : (int)$_GET['y'];
$monthArray = [ 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь',  'Декабрь' ];
$date = mktime(0, 0, 0, $month, 1, $year);
$filterText = $month == 0 ? "Фильтр по дате" : "{$monthArray[$month - 1]}, $year";
?>

<div class="category-list-setting">
    <div class="setting-view">
        <button class="btn large fa fa-th-large"></button><button class="btn list fa fa-th-list"></button>
    </div>
    <div class="setting-date">
        <button class="btn"><?=$filterText?><i class="fa fa-angle-down"></i></button>
        <div class="calendar">
            <div class="year">
                <button class="fa fa-angle-left prev"></button>
                <label class="item"><?=$year?></label>
                <button class="fa fa-angle-right next"></button>
            </div>
            <div class="month">
                <div class="item"><button class="btn" data-item="1">Январь</button></div><div class="item"><button class="btn" data-item="2">Февраль</button></div>
                <div class="item"><button class="btn" data-item="3">Март</button></div><div class="item"><button class="btn" data-item="4">Апрель</button></div>
                <div class="item"><button class="btn" data-item="5">Май</button></div><div class="item"><button class="btn" data-item="6">Июнь</button></div>
                <div class="item"><button class="btn" data-item="7">Июль</button></div><div class="item"><button class="btn" data-item="8">Август</button></div>
                <div class="item"><button class="btn" data-item="9">Сентябрь</button></div><div class="item"><button class="btn" data-item="10">Октябрь</button></div>
                <div class="item"><button class="btn" data-item="11">Ноябрь</button></div><div class="item"><button class="btn" data-item="12">Декабрь</button></div>
            </div>
            <button class="btn clean">Сбросить фильтр</button>
            <input type="hidden" class="current-month" value="<?=$month?>" />
            <input type="hidden" class="get-year" value="<?=$year?>" />
            <input type="hidden" class="current-year" value="<?=$year?>" />
        </div>
    </div>
</div>