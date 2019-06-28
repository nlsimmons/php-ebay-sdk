<?php
namespace Ebay\Commerce\Catalog;

use \Ebay\BaseClient as Client;

class ProductMetadata extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = '' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}
}