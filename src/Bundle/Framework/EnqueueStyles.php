<?php


namespace App\Bundle\Framework;

use App\Bundle\RegisterInterface;

/*
Class to register css scripts
*/


class EnqueueStyles implements RegisterInterface
{
  public function register(): void
  {
    add_action('wp_enqueue_scripts', [$this, 'setStyles']);
  }

  function setStyles()
  {
    wp_register_style( 'style',get_template_directory_uri() .'/public/css/front.css' );
    wp_enqueue_style( 'style' );
  }
}
