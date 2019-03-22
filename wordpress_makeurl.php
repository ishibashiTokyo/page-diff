<?php
/**
 * WordPress用のURL生成外部プログラム
 */
include("/var/www/html/wp-load.php");

$args = [
    'post_type' => 'any',
    'post_pre_page' => -1,
    'post_status' => 'publish',
];

$posts = new WP_Query($args);

$posts = $posts->posts;

foreach ($posts as $post) {
    switch ($post->post_type) {
        case 'revision':
        case 'nav_menu_item':
            break;
        case 'page':
            $permalink = get_page_link($post->ID);
            break;
        case 'post':
            $permalink = get_permalink($post->ID);
            break;
        case 'attachment':
            $permalink = get_attachment_link($post->ID);
            break;
        default:
            $permalink = get_post_permalink($post->ID);
            break;
    }
    echo $permalink . PHP_EOL;
}
