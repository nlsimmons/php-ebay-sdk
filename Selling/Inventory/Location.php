<?php
namespace Ebay\Selling\Inventory;

use \Ebay\BaseClient as Client;

class Location extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'sell/inventory/v1/location' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function createInventoryLocation($merchant_location_key, array $data)
	{
		return $this->makeRequest('post', "/$merchant_location_key", [
			'json' => $data,
		]);
	}

	public function deleteInventoryLocation($merchant_location_key)
	{
		return $this->makeRequest('delete', "/$merchant_location_key");
	}

	public function disableInventoryLocation($merchant_location_key)
	{
		//
	}

	public function enableInventoryLocation($merchant_location_key)
	{
		//
	}

	public function getInventoryLocation($merchant_location_key)
	{
		//
	}

	public function getInventoryLocations()
	{
		return $this->makeRequest('get');
	}

	public function updateInventoryLocation($merchant_location_key, array $data)
	{
		return $this->makeRequest('post', "/$merchant_location_key/update_location_details", [
			'json' => $data,
		]);
	}
}