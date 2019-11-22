<?php
$day = $_POST['date'];
get_header();
?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

    <div class="page simple-page category-page meropriyatiya">
        <div class="container">

            <div class="content">

                <h1 style="display: none;"><?php single_cat_title(); ?></h1>

                <?php
                $option = [
                    'category_name' => 'meropriyatiya',
                    'posts_per_page' => -1,
                    'paged' => 0,
                    'post_status' => 'publish',
                    'orderby' => 'meta_value',
                    'meta_key' => 'event_datetime',
                    'order' => 'ASC'
                ];
                if (!empty($day)) {
                    $option['meta_query'] = [
                        'key' => 'event_datetime',
                        'value' => $day,
                        'type' => 'DATE'
                    ];
                }
                $query = new WP_Query($option);
                ?>

                <?php if ($query->have_posts()) : ?>

                    <div class="post-list-meropriyatiya">

                        <?php while ($query->have_posts()): $query->the_post(); ?>

                            <?php
                            $url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                            $type = get_post_meta(get_the_ID(), 'event_type', true);
                            $type = $type == 'lecture' ? 'Лекция' : ($type == 'seminar' ? 'Семинар' : 'Курсы');
                            $datetime = strtotime(get_post_meta(get_the_ID(), 'event_datetime', true));
                            ?>

                            <div class="post-item" id="meropriyatiya-<?= get_the_ID() ?>">

                                <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>" class="post"
                                   style="background-image:url(<?= $url ?>)">

                                    <label class="post-type"><?= $type ?></label>

                                    <label class="post-date"><?= date('d.m.Y · H:i', $datetime) ?></label>

                                    <div class="post-title">
                                        <h2><?= get_the_title() ?></h2>
                                        <p><?= get_post_meta(get_the_ID(), 'event_description', true) ?></p>
                                    </div>

                                    <div class="post-meta">
                                        <div>
                                            <label class="meta-date">
                                                <?= date('d.m.Y · H:i', $datetime) ?>
                                            </label>
                                            |
                                            <label class="meta-views">
                                                <i class="fa fa-eye"></i>
                                                <?= get_post_meta(get_the_ID(), 'post_views', true) ?>
                                            </label>
                                        </div>
                                    </div>

                                </a>

                            </div>

                        <?php endwhile; ?>

                    </div>

                <?php endif; ?>

            </div><!--

            --><div class="sidebar">
                <?php dynamic_sidebar( 'meropriyatiya-sidebar' ); ?>
            </div>

            <?php the_posts_pagination(['screen_reader_text' => '']); ?>

        </div>
    </div>

<?php get_footer(); ?>