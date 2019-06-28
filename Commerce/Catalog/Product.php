<?php
namespace Ebay\Commerce\Catalog;

use \Ebay\BaseClient as Client;

class Product extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'commerce/catalog/v1_beta' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function getProduct($epid)
	{
		return $this->makeRequest('get', '/product/' . $epid);
	}
}