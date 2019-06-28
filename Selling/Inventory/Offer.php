<?php
namespace Ebay\Selling\Inventory;

use \Ebay\BaseClient as Client;

class Offer extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'sell/inventory/v1/offer' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function createOffer(array $offer)
	{
		return $this->makeRequest('post', '', [
			'json' => $offer,
		]);
	}

	public function updateOffer($offer_id, array $offer)
	{
		return $this->makeRequest('put', '/' . $offer_id, [
			'json' => $offer
		]);
	}

	public function getOffers($sku)
	{
		return $this->makeRequest('get', '', [
			'query' => [ 'sku' => $sku ]
		]);
	}

	public function getOffer($offer_id)
	{
		return $this->makeRequest('get', '/' . $offer_id);
	}

	public function deleteOffer($offer_id)
	{
		return $this->makeRequest('delete', '/' . $offer_id);
	}

	public function publishOffer($offer_id)
	{
		return $this->makeRequest('post', "/$offer_id/publish");
	}

	public function publishOfferByInventoryItemGroup()
	{
		//
	}

	public function withdrawOfferByInventoryItemGroup()
	{
		//
	}

	public function getListingFees()
	{
		//
	}

	public function bulkCreateOffer()
	{
		//
	}

	public function bulkPublishOffer()
	{
		//
	}

	public function withdrawOffer($offer_id)
	{
		return $this->makeRequest('post', "/$offer_id/withdraw");
	}
}