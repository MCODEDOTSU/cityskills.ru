<div class="region-title" id="map-region-title">Выберите федеральный округ, что бы перейти на страницу проектного офиса</div>

<?php get_template_part('inc/office/svg'); ?>

<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            // $('#BEL, #BRY, #VLA, #VOR, #IVA, #KLU, #KOS, #KRS, #LIP, #MOS, #ORL, #RYA, #SMO, #TAM, #TVE, #TUL, #YAR, #MOW').click(() => {
            //     window.location = '/proektnye-ofisy/cfo/';
            // });
            $('#YUFO').click(() => {
                window.location = '/proektnye-ofisy/yufo/';
            });
            $('#SKFO').click(() => {
                window.location = '/proektnye-ofisy/skfo/';
            });
            $('#CFO').click(() => {
                window.location = '/proektnye-ofisy/cfo/';
            });
            $('#SZFO').click(() => {
                window.location = '/proektnye-ofisy/szfo/';
            });
            $('#PFO').click(() => {
                window.location = '/proektnye-ofisy/pfo/';
            });
            $('#UFO').click(() => {
                window.location = '/proektnye-ofisy/ufo/';
            });
            $('#SFO').click(() => {
                window.location = '/proektnye-ofisy/sfo/';
            });
            $('#DVFO').click(() => {
                window.location = '/proektnye-ofisy/dvfo/';
            });
            // $('#KR, #KO, #ARK, #VLG, #KGD, #LEN, #MUR, #NGR, #PSK, #SPB, #NEN').click(() => {
            //     window.location = '/proektnye-ofisy/szfo/';
            // });
            // $('#AD, #KL, #KRM, #KDA, #AST, #VGG, #ROS, #SEV').click(() => {
            //     window.location = '/proektnye-ofisy/yufo/';
            // });
            // $('#DA, #IN, #KB, #KC, #SE, #CE, #STA').click(() => {
            //     window.location = '/proektnye-ofisy/skfo/';
            // });
            // $('#KGN, #SVE, #TYU, #CHE, #KHM, #YAN').click(() => {
            //     window.location = '/proektnye-ofisy/ufo/';
            // });
            // $('#BA, #ME, #MO, #TA, #UD, #CU, #PER, #KIR, #NIZ, #ORE, #PNZ, #SAM, #SAR, #ULY').click(() => {
            //     window.location = '/proektnye-ofisy/pfo/';
            // });
            // $('#AL, #TY, #KK, #ALT, #KYA, #IRK, #KEM, #NVS, #OMS, #TOM').click(() => {
            //     window.location = '/proektnye-ofisy/sfo/';
            // });
            // $('#ZB, #BU, #SA, #KAM, #PRI, #KHA, #AMU, #MAG, #SAH, #YEV, #CHU').click(() => {
            //     window.location = '/proektnye-ofisy/dvfo/';
            // });
            $('.cls-1-main, .cls-10-main, .cls-2-main, .cls-3-main, .cls-4-main, .cls-5-main, .cls-6-main, .cls-7-main, .cls-8-main, .cls-9-main').mouseover((event) => {
                // let title = $(event.target).attr('alt');
                // if($title.length === 0) {
                //     $title = $(event.target).parent().find('title');
                // }
                $('#map-region-title').html($(event.target).attr('alt'));
            });
            $('.cls-1-main, .cls-10-main, .cls-2-main, .cls-3-main, .cls-4-main, .cls-5-main, .cls-6-main, .cls-7-main, .cls-8-main, .cls-9-main').mouseout((event) => {
                $('#map-region-title').html('Выберите федеральный округ, что бы перейти на страницу проектного офиса');
            });
            // $('.cls-1, .cls-10, .cls-2, .cls-3, .cls-4, .cls-5, .cls-6, .cls-7, .cls-8, .cls-9').mouseover((event) => {
            //      $title = $(event.target).find('title');
            //      if($title.length === 0) {
            //          $title = $(event.target).parent().find('title');
            //      }
            //      $('#map-region-title').html($title.html());
            // });
            // $('.cls-1, .cls-10, .cls-2, .cls-3, .cls-4, .cls-5, .cls-6, .cls-7, .cls-8, .cls-9').mouseout((event) => {
            //      $('#map-region-title').html('Выберите регион, что бы перейти на страницу проектного офиса');
            // });
        });
    })(jQuery);
</script>
