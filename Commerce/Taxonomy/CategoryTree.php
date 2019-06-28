<?php
namespace Ebay\Commerce\Taxonomy;

use \Ebay\BaseClient as Client;

class CategoryTree extends Client
{
	protected function makeRequest($method, $uri='', $data=[])
	{
		$uri = 'commerce/taxonomy/v1_beta' . $uri;
		return parent::makeRequest($method, $uri, $data);
	}

	public function getDefaultCategoryTreeId()
	{
		return $this->makeRequest('get', '/get_default_category_tree_id', [
			'query' => [ 'marketplace_id' => $this->marketplace_id ]
		]);
	}

	public function getCategoryTree()
	{
		//
	}

	public function getCategorySubtree()
	{
		//
	}

	public function getCategorySuggestions($query, $category_tree_id='0')
	{
		return $this->makeRequest('get', '/category_tree/' . $category_tree_id . '/get_category_suggestions', [
			'query' => [ 'q' => $query ]
		]);
	}

	public function getItemAspectsForCategory($category_id, $category_tree_id='0')
	{
		return $this->makeRequest('get', '/category_tree/' . $category_tree_id . '/get_item_aspects_for_category', [
			'query' => [ 'category_id' => $category_id ]
		]);
	}
}