<?php
/*
	Plugin Name: Simple Banners by MCODE
	Author: Sirotkina Aliona (e.sirotkina@mcode.su)
	Author URI: https://mcode.su/
*/

function mcode_simple_banner_styles()
{
    wp_register_style('mcode_simple_banner_style', plugins_url('/style.css', __FILE__), array(), date('His'));
    wp_enqueue_style('mcode_simple_banner_style');
}

add_action('wp_enqueue_scripts', 'mcode_simple_banner_styles');

class McodeSimpleIconBanners extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'mcode_simple_icon_banners', // Base ID
            __('Простой банер с иконкой', 'text_domain'), // Name
            array('description' => __('Создание простого банера с иконкой', 'text_domain'),) // Args
        );
    }

    public function widget($args, $instance)
    {

        $icon = $instance['icon'];
        $background = $instance['background'];
        $text = $instance['text'];
        $textColor = $instance['text_color'];
        $link = $instance['link'];
        $linkColor = $instance['link_color'];
        $url = $instance['url'];
        $width = $instance['width'];
        $height = $instance['height'];

        ?>
        <div class='mcode-simple-banner banner-icon' id="<?=$args['widget_id']?>">
            <div class="icon-container"><img src="<?=$icon?>" /></div>
            <h3><?=$text?></h3>
            <?php if($link != ''): ?>
                <a href="<?=$url?>" class="link" target="_blank"><?=$link?></a>
            <?php endif; ?>
        </div>
        <style type="text/css">
            #<?=$args['widget_id']?>
            {
                width: <?=$width?>;
                height: <?=$height?>;
                background: <?=$background?>;
            }

            #<?=$args['widget_id']?> h3 {
                color: <?=$textColor?>;
            }

            #<?=$args['widget_id']?> a {
                color: <?=$linkColor?>;
            }
        </style>
        <?php
    }

    public function form($instance)
    {

        if (isset($instance['icon'])) $icon = $instance['icon'];
        else $icon = plugins_url('icon.png', __FILE__);
        if (isset($instance['background'])) $background = $instance['background'];
        else $background = '#ffffff';
        if (isset($instance['text'])) $text = $instance['text'];
        else $text = '';
        if (isset($instance['text_color'])) $textColor = $instance['text_color'];
        else $textColor = '#333333';
        if (isset($instance['link'])) $link = $instance['link'];
        else $link = '';
        if (isset($instance['link_color'])) $linkColor = $instance['link_color'];
        else $linkColor = '#333333';
        if (isset($instance['url'])) $url = $instance['url'];
        else $url = '/';
        if (isset($instance['width'])) $width = $instance['width'];
        else $width = '100%';
        if (isset($instance['height'])) $height = $instance['height'];
        else $height = '300px';

        ?>
        <p><label>Иконка:</label></p>
        <p><input name="<?=$this->get_field_name('icon')?>" value="<?=$icon ?>" class="widefat"/></p>
        <p><label>Цвет фона:</label></p>
        <p><input name="<?=$this->get_field_name('background')?>" value="<?=$background ?>" placeholder="#ffffff"
                  class="widefat"/></p>
        <p><label>Текст:</label></p>
        <p><?=wp_editor( $text, $this->get_field_name('text'), ['textarea_name' => $this->get_field_name('text'), 'media_buttons' => 0] );?></p>
        <p><label>Цвет текста:</label></p>
        <p><input name="<?=$this->get_field_name('text_color')?>" value="<?=$textColor ?>" placeholder="#333333"
                  class="widefat"/></p>
        <p><label>Текст ссылки:</label></p>
        <p><input name="<?=$this->get_field_name('link')?>" value="<?=$link ?>" class="widefat"/></p>
        <p><label>Цвет ссылки:</label></p>
        <p><input name="<?=$this->get_field_name('link_color')?>" value="<?=$linkColor ?>" placeholder="#333333"
                  class="widefat"/></p>
        <p><label>Ссылка:</label></p>
        <p><input name="<?=$this->get_field_name('url')?>" value="<?=$url ?>" class="widefat"/></p>
        <p><label>Ширина:</label></p>
        <p><input name="<?=$this->get_field_name('width')?>" value="<?=$width ?>" class="widefat"/></p>
        <p><label>Высота:</label></p>
        <p><input name="<?=$this->get_field_name('height')?>" value="<?=$height ?>" class="widefat"/></p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['icon'] = (!empty($new_instance['icon'])) ? $new_instance['icon'] : plugins_url('icon.png', __FILE__);
        $instance['background'] = (!empty($new_instance['background'])) ? $new_instance['background'] : '#ffffff';
        $instance['text'] = (!empty($new_instance['text'])) ? $new_instance['text'] : '';
        $instance['text_color'] = (!empty($new_instance['text_color'])) ? $new_instance['text_color'] : '#333333';
        $instance['link'] = (!empty($new_instance['link'])) ? $new_instance['link'] : '';
        $instance['link_color'] = (!empty($new_instance['link_color'])) ? $new_instance['link_color'] : '#333333';
        $instance['url'] = (!empty($new_instance['url'])) ? $new_instance['url'] : '/';
        $instance['width'] = (!empty($new_instance['width'])) ? $new_instance['width'] : '100%';
        $instance['height'] = (!empty($new_instance['height'])) ? $new_instance['height'] : '300px';
        return $instance;
    }

}

class McodeSimpleBackgroundBanners extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'mcode_simple_background_banners', // Base ID
            __('Простой банер с картинкой', 'text_domain'), // Name
            array('description' => __('Создание простого банера с картинкой', 'text_domain'),) // Args
        );
    }

    public function widget($args, $instance)
    {
        $background = $instance['background'];
        $text = $instance['text'];
        $description = $instance['description'];
        $textColor = $instance['text_color'];
        $link = $instance['link'];
        $linkColor = $instance['link_color'];
        $linkColorHover = $instance['link_color_hover'];
        $url = $instance['url'];
        $width = $instance['width'];
        $height = $instance['height'];

        ?>
        <div class='mcode-simple-banner banner-background' id="<?=$args['widget_id']?>">
            <a href="<?=$url?>" title="<?=$text?>" target="_blank">
                <h3><?=$text?></h3>
                <h4><?=$description?></h4>
                <a href="<?=$url?>" title="<?=$text?>" class="link" target="_blank"><?=$link?></a>
            </a></div>
        <style type="text/css">
            #<?=$args['widget_id']?> {
                width: <?=$width?>;
                height: <?=$height?>;
                background-image: url('<?=$background?>');
            }

            #<?=$args['widget_id']?> h3 {
                color: <?=$textColor?>;
            }

            #<?=$args['widget_id']?> h4 {
                color: <?=$textColor?>;
            }

            #<?=$args['widget_id']?> .link {
                background: <?=$linkColor?>;
            }

            #<?=$args['widget_id']?> .link:hover {
                 background: <?=$linkColorHover?>;
            }
        </style>
        <?php
    }

    public function form($instance)
    {

        if (isset($instance['background'])) $background = $instance['background'];
        else $background = plugins_url('back.png', __FILE__);
        if (isset($instance['text'])) $text = $instance['text'];
        else $text = '';
        if (isset($instance['description'])) $description = $instance['description'];
        else $description = '';
        if (isset($instance['text_color'])) $textColor = $instance['text_color'];
        else $textColor = '#333333';
        if (isset($instance['link'])) $link = $instance['link'];
        else $link = '';
        if (isset($instance['link_color'])) $linkColor = $instance['link_color'];
        else $linkColor = '#333333';
        if (isset($instance['link_color_hover'])) $linkColorHover = $instance['link_color_hover'];
        else $linkColor = '#000000';
        if (isset($instance['url'])) $url = $instance['url'];
        else $url = '/';
        if (isset($instance['width'])) $width = $instance['width'];
        else $width = '100%';
        if (isset($instance['height'])) $height = $instance['height'];
        else $height = '300px';

        ?>
        <p><label>Картинка:</label></p>
        <p><input name="<?=$this->get_field_name('background') ?>" value="<?=$background ?>" placeholder="#ffffff"
                  class="widefat"/></p>
        <p><label>Текст:</label></p>
        <p><textarea name="<?=$this->get_field_name('text') ?>" placeholder="Мы строим цифровую Россию"
                     class="widefat"><?=$text ?></textarea></p>
        <p><label>Описание:</label></p>
        <p><textarea name="<?=$this->get_field_name('description') ?>" placeholder="Годовой отчет 2017"
                     class="widefat"><?=$description ?></textarea></p>
        <p><label>Цвет текста:</label></p>
        <p><input name="<?=$this->get_field_name('text_color') ?>" value="<?=$textColor ?>" placeholder="#333333"
                  class="widefat"/></p>
        <p><label>Текст ссылки:</label></p>
        <p><input name="<?=$this->get_field_name('link') ?>" value="<?=$link ?>" class="widefat"/></p>
        <p><label>Цвет ссылки:</label></p>
        <p><input name="<?=$this->get_field_name('link_color') ?>" value="<?=$linkColor ?>" placeholder="#333333"
                  class="widefat"/></p>
        <p><label>Цвет ссылки при наведении:</label></p>
        <p><input name="<?=$this->get_field_name('link_color_hover') ?>" value="<?=$linkColorHover ?>" placeholder="#000000"
                  class="widefat"/></p>
        <p><label>Ссылка:</label></p>
        <p><input name="<?=$this->get_field_name('url') ?>" value="<?=$url ?>" class="widefat"/></p>
        <p><label>Ширина:</label></p>
        <p><input name="<?=$this->get_field_name('width') ?>" value="<?=$width ?>" class="widefat"/></p>
        <p><label>Высота:</label></p>
        <p><input name="<?=$this->get_field_name('height') ?>" value="<?=$height ?>" class="widefat"/></p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['background'] = (!empty($new_instance['background'])) ? $new_instance['background'] : plugins_url('back.png', __FILE__);
        $instance['text'] = (!empty($new_instance['text'])) ? $new_instance['text'] : '';
        $instance['description'] = (!empty($new_instance['description'])) ? $new_instance['description'] : '';
        $instance['text_color'] = (!empty($new_instance['text_color'])) ? $new_instance['text_color'] : '#333333';
        $instance['link'] = (!empty($new_instance['link'])) ? $new_instance['link'] : '';
        $instance['link_color'] = (!empty($new_instance['link_color'])) ? $new_instance['link_color'] : '#333333';
        $instance['link_color_hover'] = (!empty($new_instance['link_color_hover'])) ? $new_instance['link_color_hover'] : '#000000';
        $instance['url'] = (!empty($new_instance['url'])) ? $new_instance['url'] : '/';
        $instance['width'] = (!empty($new_instance['width'])) ? $new_instance['width'] : '100%';
        $instance['height'] = (!empty($new_instance['height'])) ? $new_instance['height'] : '300px';
        return $instance;
    }

}

// конец класса Foo_Widget

// регистрация Foo_Widget в WordPress
function mcode_simple_banners_register()
{
    register_widget('McodeSimpleIconBanners');
    register_widget('McodeSimpleBackgroundBanners');
}

add_action('widgets_init', 'mcode_simple_banners_register');