<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//https://developers.facebook.com/docs/reference/php/facebook-getLoginUrl/
$config['facebook_login_parameters'] = array(
											'scope' => 'publish_stream, publish_actions, email, user_birthday, user_photos, user_likes, friends_likes',
											'display' => 'page'
											);