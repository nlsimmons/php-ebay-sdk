<?php
namespace Ebay\Selling\Account;

use \Ebay\BaseClient as Client;

class PaymentPolicy extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'account/v1/payment_policy' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function createPaymentPolicy(array $policy)
	{
		return $this->makeRequest('post', '', [
			'json' => $policy
		]);
	}

	public function deletePaymentPolicy($policy_id)
	{
		return $this->makeRequest('delete', '/' . $policy_id);
	}

	public function getPaymentPolicies()
	{
		return $this->makeRequest('get', '', [
			'query' => [ 'marketplace_id' => $this->marketplace_id ]
		]);
	}

	public function getPaymentPolicy($policy_id)
	{
		return $this->makeRequest('get', '/' . $policy_id);
	}

	public function getPaymentPolicyByName($policy_name)
	{
		return $this->makeRequest('get', '/get_by_policy_name', [
			'query' => [
				'marketplace_id' => $this->marketplace_id,
				'name' => $policy_name,
			]
		]);
	}

	public function updatePaymentPolicy($policy_id, array $policy)
	{
		return $this->makeRequest('put', '/' . $policy_id, [
			'json' => $policy
		]);
	}
}