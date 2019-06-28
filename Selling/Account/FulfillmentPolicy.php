<?php
namespace Ebay\Selling\Account;

use \Ebay\BaseClient as Client;

class FulfillmentPolicy extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'account/v1/fulfillment_policy' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function createFulfillmentPolicy()
	{
		//
	}

	public function deleteFulfillmentPolicy()
	{
		//
	}

	public function getFulfillmentPolicies()
	{
		return $this->makeRequest('get', '', [
			'query' => [ 'marketplace_id' => $this->marketplace_id ]
		]);
	}

	public function getFulfillmentPolicy()
	{
		//
	}

	public function getFulfillmentPolicyByName()
	{
		//
	}

	public function updateFulfillmentPolicy()
	{
		//
	}
}