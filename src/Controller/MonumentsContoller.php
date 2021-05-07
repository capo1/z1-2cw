<?php


namespace App\Controller;

use WP_REST_Server;
use Nahid\JsonQ\Jsonq;

class MonumentsContoller
{

  private $mainUrl = 'zadanie/v1';

  private $object;

  function __construct($url)
  {

    $object = wp_remote_get($url);

    $this->monuments = new Jsonq($object['body']);
    $this->cities = new Jsonq($object['body']);

    add_action('rest_api_init', [$this, 'prefix_register_monuments_routes']);
  }

  /* function to get monuments and cieties by monuments name
  
  @param $request
  
  return rest response
  */

  function prefix_get_endpoint_monuments($request)
  {

    $search_phrase = filter_var($request->get_param('name'), FILTER_SANITIZE_STRING);

    $monuments_results =  $this->get_monuments($search_phrase);
    $cities_ids = [];

    foreach ($monuments_results as  $res) {
      $cities_ids[] = $res['city'];
    }

    return rest_ensure_response(
      [
        'monuments' => json_decode($monuments_results, true),
        'cities' => json_decode($this->get_cities($cities_ids), true),
        'lang' => [
          'monumentName' => __("Monument name", 'z1'),
          'city' => __('City', 'z1'),
          'price' => __('Price', 'z1')
        ]
      ]
    );
  }

  /*
    Function to serach monument by name
    @param $search_phrase

    retun Jsonq object
  */
  function get_monuments($search_phrase)
  {
    return $this->monuments->from('monuments')
      ->where('name', 'contains', urldecode($search_phrase))
      ->orWhere('name', 'contains', ucfirst(urldecode($search_phrase)))
      ->sortBy('city',  "ASC")
      ->get();
  }

  /*
    Function to serach cieties 
    @param $search_array_id

    retun Jsonq object
  */
  function get_cities($search_array_id)
  {
    return $this->cities->from('cities')->whereIn('id', $search_array_id)->sortBy('id',  "ASC")->get();
  }

  /*
    Function to register route in wordpress
  */
  function prefix_register_monuments_routes()
  {
    register_rest_route($this->mainUrl, '/search/(?P<name>[\S-]+)', array(
      'methods' => WP_REST_Server::READABLE,
      'callback' => [$this, 'prefix_get_endpoint_monuments'],
      'args' => array(
        'name' => array(
          'required' => true,
        )
      ),
    ));
  }
}
