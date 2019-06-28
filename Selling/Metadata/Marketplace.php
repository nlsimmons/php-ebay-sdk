<?php
namespace Ebay\Selling\Metadata;

use \Ebay\BaseClient as Client;

class Marketplace extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'sell/metadata/v1/marketplace' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function getAutomotivePartsCompatibilityPolicies()
	{
		//
	}

	public function getItemConditionPolicies($category_id)
	{
		if(is_array($category_id))
		{
			$filter = '{' . implode('|', $category_id) . '}';
		}
		else
		{
			$filter = '{' . intval($category_id) . '}';
		}

		return $this->makeRequest('get', '/' . $this->marketplace_id . '/get_item_condition_policies', [
			'query' => [
				'filter' => 'categoryIds:' . $filter,
				'marketplace_id' => $this->marketplace_id,
			]
		]);
	}

	public function getListingStructurePolicies()
	{
		//
	}

	public function getNegotiatedPricePolicies()
	{
		//
	}

	public function getProductAdoptionPolicies()
	{
		//
	}

	public function getReturnPolicies()
	{
		//
	}
}