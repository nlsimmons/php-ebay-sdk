<?php
namespace Ebay\Commerce\Catalog;

use \Ebay\BaseClient as Client;

class ProductSummary extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'commerce/catalog/v1_beta' . $uri;

		return parent::makeRequest($method, $uri, $data);
	}

	public function search($query)
	{
		if(is_array($query))
		{
			$params = $query;
		}
		else
		{
			$params = [ 'q' => $query ];
		}

		$uri = '/product_summary/search?';

		$query_strings = [];
		foreach($params as $k => $v)
		{
			$query_strings[] = $k . '=' . $v;
		}

		$uri .= implode('&', $query_strings);

		return $this->makeRequest('get', $uri);
	}
}