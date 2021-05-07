<?php

namespace App\Bundle\Framework;

use App\Bundle\RegisterInterface;


/*
Class to register wordpress actions
*/
class WordpressActions implements RegisterInterface
{
    public function register(): void
    {
        add_action('after_setup_theme', [$this, 'remove_admin_bar']);
        add_action('after_setup_theme', [$this, 'z1_load_theme_textdomain']);
    }


    function remove_admin_bar()
    {

        show_admin_bar(false);
    }

    
    function z1_load_theme_textdomain()
    {
        load_theme_textdomain('z1', get_template_directory() . '/lang');
    }
}
