<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// Pinterest API
class PinterestApi
{
	public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {
		$url = 'https://api.pinterest.com/v1/oauth/token';

		$data_post = 'client_id='. $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$response = wp_remote_post($url, $data_post);
		$data = wp_remote_retrieve_body($response);
		$data = json_decode($data);
		$http_code = wp_remote_retrieve_response_code($response);
		if($http_code != '200')
			throw new Exception(esc_html_e('Error : Failed to receieve access token'));

		return $data['access_token'];
	}
	// Get user access Token
	public function GetUserProfileInfo($access_token) {
		$url = 'https://api.pinterest.com/v1/me/?access_token=' . $access_token . '&fields=id,username,first_name,last_name,image';
		$response = wp_remote_get($url);
		$data = wp_remote_retrieve_body($response);
		$data = json_decode($data);
		$http_code = wp_remote_retrieve_response_code($response);
		if($http_code != 200)
			throw new Exception(esc_html_e('Error : Failed to get user information'));
		return $data['data'];
	}
}

?>
