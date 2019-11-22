<?php
/*
	Plugin Name: Persons by MCODE
	Author: Sirotkina Aliona (e.sirotkina@mcode.su)
	Author URI: https://mcode.su/
*/

global $wpdb;
$wpdb->mcode_persons = $wpdb->prefix . 'persons';
global $mcode_persons_version_persons;
$mcode_persons_version_persons = '1.1';

function mcode_persons_install() {

    global $wpdb;
    global $mcode_persons_version_persons;

    if(@is_file(ABSPATH.'/wp-admin/includes/upgrade.php')) {

        include_once(ABSPATH.'/wp-admin/includes/upgrade.php');

    } elseif(@is_file(ABSPATH.'/wp-admin/upgrade-functions.php')) {

        include_once(ABSPATH.'/wp-admin/upgrade-functions.php');

    } else {

        die('We have problem finding your \'/wp-admin/upgrade-functions.php\' and \'/wp-admin/includes/upgrade.php\'');

    }

    if($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->mcode_persons}'") != $wpdb->mcode_persons) {

        $sql = 	"CREATE TABLE `{$wpdb->mcode_persons}` (
				`id` INT NOT NULL AUTO_INCREMENT, 
				`firstname` VARCHAR(255) NOT NULL, 
				`lastname` VARCHAR(255) NOT NULL,
				`middlename` VARCHAR(255),
				`post` VARCHAR(255),
				`description` TEXT,
				`photo` INT,
				PRIMARY KEY (`id`)
				) ENGINE = MYISAM DEFAULT CHARSET=utf8_general_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        add_option("mcode_persons_version_persons", $mcode_persons_version_persons);
    }

}
register_activation_hook(__FILE__, 'mcode_persons_install');

if (is_admin()) {

    add_action('admin_menu', 'centerastrakhan_persons_admin');

    wp_register_style('mcode_persons_style', plugins_url('/style.css', __FILE__), array(), date('His'));
    wp_enqueue_style('mcode_persons_style');

    wp_register_script('mcode-person-script', plugins_url('/inc/js/script.js', __FILE__), array('jquery'));
    wp_enqueue_script('mcode-person-script');

}
function centerastrakhan_persons_admin()
{
    add_menu_page('Персоны', 'Персоны', 'manage_options', 'centerastrakhan_persons', 'centerastrakhan_persons', 'dashicons-admin-users');
}

function centerastrakhan_persons()
{
    wp_enqueue_media();

    $persons = mcode_get_persons();
    require_once plugin_dir_path(__FILE__) . 'settings/persons.php';
}

if ( ! class_exists( '_WP_Editors', false ) ) {
    require( ABSPATH . WPINC . '/class-wp-editor.php' );
}
add_action( 'admin_print_footer_scripts', array( '_WP_Editors', 'print_default_editor_scripts' ) );

/***
 * Запросы
 */

/// Получить список персон
function mcode_get_persons() {

    global $wpdb;

    $sql = "SELECT * FROM " . $wpdb->mcode_persons;

    return $wpdb->get_results($sql, ARRAY_A);

}

/// Сохранить персону
function mcode_person_save()
{
    global $wpdb;

    $id = $_POST['id'];

    $data = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'middlename' => $_POST['middlename'],
        'post' => $_POST['post'],
        'description' => $_POST['description'],
        'photo' => $_POST['photo'],
    ];

    if($wpdb->update( $wpdb->mcode_persons, $data, [ 'id' => $id ], [ '%s', '%s', '%s', '%s', '%s', '%d' ], [ '%d' ] ) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_query ];
    } else {
        $result = [ 'status' => 'success', 'result' => $id ];
    }

    echo json_encode($result);

    wp_die();
}

add_action('wp_ajax_mcode_person_save', 'mcode_person_save');

/// Добавить персону
function mcode_person_add()
{
    global $wpdb;

    $data = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname']
    ];

    if($wpdb->insert( $wpdb->mcode_persons, $data, [ '%s', '%s' ] ) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_query ];
    } else {
        $result = [ 'status' => 'success', 'result' => $wpdb->insert_id ];
    }

    echo json_encode($result);

    wp_die();
}

add_action('wp_ajax_mcode_person_add', 'mcode_person_add');

/// Удалить
function mcode_person_delete()
{
    global $wpdb;

    $id = $_POST['id'];

    if ($wpdb->delete( $wpdb->mcode_persons, [ 'id' => $id ], [ '%d'] ) === false ) {
        $result = ['status' => 'error', 'result' => $wpdb->last_query];
    } else {
        $result = ['status' => 'success', 'result' => $id];
    }

    echo json_encode($result);

    wp_die();
}

add_action('wp_ajax_mcode_person_delete', 'mcode_person_delete');

/***
 * Дополнительные поля для записи
 */

add_action('add_meta_boxes', 'centerastrakhan_persons_extra_fields', 1);
function centerastrakhan_persons_extra_fields()
{
    add_meta_box('extra_fields', 'Персона', 'centerastrakhan_persons_extra_fields_function', 'post', 'normal', 'high');
    add_meta_box('extra_fields', 'Персона', 'centerastrakhan_persons_extra_fields_function', 'page', 'normal', 'high');
}

function centerastrakhan_persons_extra_fields_function($post)
{
    $persons = mcode_get_persons();
    $selected = get_post_meta($post->ID, 'centerastrakhan_post_person', 1);

    ?>

    <p>
        <select name="extra[centerastrakhan_post_person]">
            <?php foreach ($persons as $person): ?>
                <option value="<?= $person['id'] ?>" <?php selected($selected, $person['id']) ?> ><?= $person['firstname'] ?> <?= $person['lastname'] ?></option>
            <?php endforeach; ?>
        </select>
    </p>

    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>"/>

<?php }

add_action('save_post', 'centerastrakhan_persons_extra_fields_update', 0);
add_action('save_page', 'centerastrakhan_persons_extra_fields_update', 0);
function centerastrakhan_persons_extra_fields_update($post_id)
{

    if (empty($_POST['extra']) || !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) || wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
        return false;
    }

    $extra = array_map('sanitize_text_field', $_POST['extra']);
    foreach ($extra as $key => $value) {
        if (empty($value)) {
            delete_post_meta($post_id, $key);
            continue;
        }
        update_post_meta($post_id, $key, $value);
    }

    return $post_id;
}

function get_centerastrakhan_person($post_id)
{
    $personId = get_post_meta($post_id, 'centerastrakhan_post_person', true);
    $persons = mcode_get_persons();
    $filter = array_filter($persons, function($item) use ($personId) {
        return ($item['id'] == $personId);
    });
    return (count($filter) ? reset($filter) : false);
}
