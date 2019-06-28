<?php
namespace Ebay;

use \GuzzleHttp\Client as GuzzleClient;
use \GuzzleHttp\Psr7;
use \GuzzleHttp\Exception\RequestException;
use \PEI\DbConnection;

class BaseClient
{
	protected $db;
	protected $client;
	protected $base64_credentials;
	protected $marketplace_id;

	public function __construct($marketplace_id='EBAY_US')
	{
		$this->db = new DbConnection;

		$this->client = new GuzzleClient([
			'base_url' => 'https://api.ebay.com/'
		]);
		$this->base64_credentials = base64_encode( EBAY_APP_ID . ':' . EBAY_CERT_ID );
		$this->marketplace_id = $marketplace_id;
	}

	protected function refreshAccessToken()
	{
		$token = $this->getToken('refresh_token');
		if(empty($token))
		{
			throw new \Exception("Refresh token is expired");
		}

		$response = $this->client->post('https://api.ebay.com/identity/v1/oauth2/token', [
			'headers' => [
				'Content-Type' => 'application/x-www-form-urlencoded',
				'Authorization' => "Basic " . $this->base64_credentials,
			],
			'body' => [
				'grant_type' => 'refresh_token',
				'refresh_token' => $token,
			],
		])->json();

		$this->storeToken('access_token', $response['access_token'], $response['expires_in']);
	}

	protected function getToken($type='access_token', $second_attempt=false)
	{
		$result = $this->db->find('vendio_ebay_auth', [
			'type' => $type,
			'expires' => ['>', date("Y-m-d H:i:s")],
		]);

		if(!empty($result))
		{
			return $result[0]['code'];
		}
		else if($second_attempt)
		{
			throw new \Exception("Error fetching token");
		}
		else
		{
			$this->refreshAccessToken();
			return $this->getToken($type, true);
		}
	}

	public function storeToken($type, $token, $token_expires_in)
	{
		$this->db->begin_transaction();
		$this->db->deleteWhere('vendio_ebay_auth', ['type' => $type]);

		$expires_datetime = date("Y-m-d H:i:s", strtotime("+$token_expires_in seconds"));

		$this->db->insert('vendio_ebay_auth', [
			'type' => $type,
			'code' => $token,
			'expires' => $expires_datetime,
		]);

		$this->db->commit();
	}

	public function fetchNewAccessToken($code)
	{
		return $this->client->post('https://api.ebay.com/identity/v1/oauth2/token', [
			'headers' => [
				'Content-Type' => 'application/x-www-form-urlencoded',
				'Authorization' => "Basic " . $this->base64_credentials,
			],
			'body' => [
				'grant_type' => 'authorization_code',
				'code' => $code,
				'redirect_uri' => EBAY_RU_NAME,
			],
		])->json();
	}

	protected function makeRequest($method, $uri, $options=[])
	{
		$method = strtolower($method);

		$options['headers']['Authorization'] = "Bearer " . $this->getToken();
		$options['headers']['Content-Language'] = 'en-US';
		if(in_array($method, ['put', 'post']))
		{
			$options['headers']['Content-Type'] = 'application/json';
		}

		try {
			$response = $this->client->$method($uri, $options);

			return [
				'Status' => $response->getStatusCode(),
				'Reason' => $response->getReasonPhrase(),
				'Body' => $response->json(),
			];
		} catch (RequestException $e) {
			$response = $e->getResponse();

			if(empty($response))
			{
				return $e;
			}

			return [
				'Status' => $response->getStatusCode(),
				'Reason' => $response->getReasonPhrase(),
				'Body' => $response->json(),
			];
		}
	}
}