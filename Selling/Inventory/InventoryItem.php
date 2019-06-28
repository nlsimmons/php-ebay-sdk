<?php
namespace Ebay\Selling\Inventory;

use \Ebay\BaseClient as Client;

class InventoryItem extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'sell/inventory/v1/inventory_item' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function createOrReplaceInventoryItem($sku, array $item)
	{
		return $this->makeRequest('put', '/' . $sku, [
			'json' => $item
		]);
	}

	public function getInventoryItem($sku)
	{
		return $this->makeRequest('get', '/' . $sku);
	}

	public function getInventoryItems()
	{
		return $this->makeRequest('get');
	}

	public function deleteInventoryItem($sku)
	{
		return $this->makeRequest('delete', '/' . $sku);
	}

	public function bulkUpdatePriceQuantity()
	{
		//
	}

	public function bulkCreateOrReplaceInventoryItem()
	{
		//
	}

	public function bulkGetInventoryItem()
	{
		//
	}
}