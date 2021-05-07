<?php
namespace App\Bundle\Framework;

use App\Bundle\RegisterInterface;

/*
Class to register js scripts
*/

class EnqueueScripts implements RegisterInterface
{
  public function register(): void
  {
    add_action('wp_enqueue_scripts', [$this, 'setScripts']);
  }

  function setScripts()
  {
    wp_deregister_script('jquery');
    
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
   
    wp_register_script("main_scripts", get_template_directory_uri() . '/public/js/vue.js', array('jquery'),1,true);
    wp_enqueue_script('main_scripts');
  }
}
