<?php
namespace Ebay\Selling\Inventory;

use \Ebay\BaseClient as Client;

class Listing extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'sell/inventory/v1' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function bulkMigrateListing(array $ebay_ids)
	{
		if(count($ebay_ids) > 5)
		{
			throw new \Exception("Call supports up to five listing ids");
		}

		$data = [
			'requests' => [],
		];

		foreach($ebay_ids as $id)
		{
			$data['requests'][] = [
				'listingId' => (string) $id
			];
		}

		return $this->makeRequest('post', '/bulk_migrate_listing', [
			'json' => $data,
		]);
	}
}