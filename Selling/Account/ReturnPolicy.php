<?php
namespace Ebay\Selling\Account;

use \Ebay\BaseClient as Client;

class ReturnPolicy extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'account/v1/return_policy' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function createReturnPolicy()
	{
		//
	}

	public function deleteReturnPolicy()
	{
		//
	}

	public function getReturnPolicies()
	{
		return $this->makeRequest('get', '', [
			'query' => [ 'marketplace_id' => $this->marketplace_id ]
		]);
	}

	public function getReturnPolicy()
	{
		//
	}

	public function getReturnPolicyByName()
	{
		//
	}

	public function updateReturnPolicy()
	{
		//
	}
}