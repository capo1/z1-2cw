<?php


namespace App\Bundle\Framework;

use App\Bundle\RegisterInterface;

/*
Class to clean all unnecessary wordpress stuff
*/
class ClearWordpress implements RegisterInterface
{
    public function register(): void
    {
        add_filter('emoji_svg_url', '__return_false');
        add_action(
            'wp_footer',
            static function () {
                wp_dequeue_script('wp-embed');
            }
        );
        add_action(
            'wp_print_styles',
            static function () {
                wp_dequeue_style('wp-block-library');
                wp_dequeue_style('wp-block-library-theme');
                wp_dequeue_style('wc-block-style');
                wp_dequeue_style('storefront-gutenberg-blocks');
            }
        );

        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');

        remove_action('wp_print_styles', 'print_emoji_styles');

        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'rest_output_link_wp_head');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action('wp_head', 'rel_canonical');
    }
}
