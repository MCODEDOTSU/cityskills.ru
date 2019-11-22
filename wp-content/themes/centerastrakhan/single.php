<?php

$post = $wp_query->post;
setPostViews(get_the_ID());
if (in_category('stati')) {
    include(TEMPLATEPATH . '/single-article.php');
} elseif (in_category('ekspertnoe-mnenie')) {
    include(TEMPLATEPATH . '/single-expert.php');
} elseif (in_category('projects')) {
    include(TEMPLATEPATH . '/single-project.php');
} elseif (in_category('meropriyatiya')) {
    include(TEMPLATEPATH . '/single-meropriyatiya.php');
} elseif (in_category('infografika')) {
    include(TEMPLATEPATH . '/single-infografika.php');
} elseif (in_category('kolonka-tos')) {
    include(TEMPLATEPATH . '/single-kolonka-tos.php');
} elseif (in_category('rukovodstvo')) {
    include(TEMPLATEPATH . '/single-rukovodstvo.php');
} else {
    include(TEMPLATEPATH . '/single-default.php');
}

?>