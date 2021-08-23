<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_product';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	//protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['*'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function getProducts()
	{
		$builder = $this->db->table('tbl_product');
		$data = $builder->get()->getResult('array');
		return $data;
	}

	public function getProductsWithDetails()
	{
		$builder = $this->db->table('tbl_product');
		$builder->join('tbl_brand', 'tbl_product.product_brand = tbl_brand.brand_id');
		$builder->join('tbl_category', 'tbl_category.id = tbl_product.product_category');
		$data = $builder->get()->getResult('array');
		return $data;
	}
	public function getProductByIdWithDetails($id)
	{
		$builder = $this->db->table('tbl_product');
		$builder->join('tbl_brand', 'tbl_product.product_brand = tbl_brand.brand_id');
		$builder->join('tbl_category', 'tbl_category.id = tbl_product.product_category');
		$builder->where('product_id', $id);
		$data = $builder->get()->getRowArray();
		return $data;
	}

	public function createWishlist($id)
	{
		$builder = $this->db->table('tbl_wishlist');
		$builder->select('*');
		$builder->where('id_customer', $id);
		$datas = $builder->get()->getRowArray();
		if (!isset($datas['id_customer'])) {
			$insert = ['id_customer' => $id];
			$builder->set($insert)->insert();
		}
	}

	public function getWishlist($id)
	{
		$builder = $this->db->table('tbl_wishlist');
		$builder->select('id_wishlist');
		$builder->where('id_customer', $id);
		$data = $builder->get()->getRowArray();
		return $data;
	}

	public function check_wishlist_item($id, $id_wishlist)
	{
		$builder = $this->db->table('tbl_wishlist_item');
		$builder->select('*');
		$builder->where('product_id', $id);
		$builder->where('id_wishlist', $id_wishlist);
		$result = $builder->get()->getRowArray();
		return $result;
	}

	public function addToWishlist($data)
	{
		$builder = $this->db->table('tbl_wishlist_item');
		$builder->set($data)->insert();
	}
	public function removeFromWishlist($id, $id_wishlist)
	{
		$builder = $this->db->table('tbl_wishlist_item');
		$builder->where('product_id', $id);
		$builder->where('id_wishlist', $id_wishlist);
		$builder->delete();
	}

	public function getWishListAllItems($id)
	{
		$builder = $this->db->table('tbl_product');
		$builder->select('*');
		$builder->join('tbl_wishlist_item', 'tbl_product.product_id = tbl_wishlist_item.product_id');
		$builder->join('tbl_wishlist', 'tbl_wishlist_item.id_wishlist = tbl_wishlist.id_wishlist');
		$builder->where('tbl_wishlist.id_customer', $id);
		$datas = $builder->get()->getResultArray();
		return $datas;
	}

	public function search_products($search)
	{
		$builder = $this->db->table('tbl_product');
		$builder->select('*');
		$builder->join('tbl_brand', 'tbl_product.product_brand = tbl_brand.brand_id');
		$builder->join('tbl_category', 'tbl_category.id = tbl_product.product_category');
		$builder->like('product_title', $search);
		$builder->orLike('product_category', $search);
		$builder->orLike('product_brand', $search);
		$builder->orLike('product_price', $search);
		$results = $builder->get()->getResultArray();
		return $results;
	}

	public function updateImage($id_produit, $name)
	{
		$builder = $this->db->table('tbl_product');
		$builder->where('product_id', $id_produit);
		$builder->set('product_image', $name)->update();
	}
	public function updateInfosProduct($id_produit, $datas)
	{
		$builder = $this->db->table('tbl_product');
		$builder->where('product_id', $id_produit);
		$builder->set($datas)->update();
	}
	public function deleteProduct($id_produit)
	{
		$builder = $this->db->table('tbl_product');
		$builder->where('product_id', $id_produit);
		$builder->delete();
	}

	public function getBrandsDetails()
	{
		$builder = $this->db->table('tbl_brand');
		$builder->selectCount('tbl_product.product_id');
		$builder->select('tbl_brand.brand_id, tbl_brand.brand_name, tbl_brand.brand_image, tbl_brand.brand_description,');
		$builder->join('tbl_product', 'tbl_product.product_brand = tbl_brand.brand_id');
		$builder->groupBy('tbl_brand.brand_id');
		$data = $builder->get()->getResult('array');
		return $data;
	}

	public function createCustomerRanking($datas)
	{
		$builder = $this->db->table('tbl_product_rank');
		$builder->select('*');
		$builder->where('customer_id', $datas['customer_id']);
		$builder->where('product_id', $datas['product_id']);
		$fetch = $builder->get()->getResultArray();
		if (!$fetch) {
			$builder->set($datas)->insert();
			return true;
		}
		return false;
	}

	public function hasRank($id_customer, $id_product)
	{
		$builder = $this->db->table('tbl_product_rank');
		$builder->select('*');
		$builder->where('customer_id', $id_customer);
		$builder->where('product_id', $id_product);
		$fetch = $builder->get()->getResultArray();
		return $fetch;
	}

	public function getComments($id_product)
	{
		$builder = $this->db->table('tbl_product_rank');
		$builder->select('*');
		$builder->join('tbl_customer', 'tbl_customer.customer_id = tbl_product_rank.customer_id');
		$builder->where('tbl_product_rank.product_id', $id_product);
		$fetch = $builder->get()->getResultArray();
		return $fetch;
	}

	public function averageRank($id)
	{
		$builder = $this->db->table('tbl_product_rank');
		$builder->selectAvg('rank');
		$builder->selectCount('id_ranking');
		$builder->where('product_id', $id);
		$datas = $builder->get()->getRowArray();
		return $datas;
	}

	public function getEvaluationsByRank($number, $id)
	{
		$builder = $this->db->table('tbl_product_rank');
		$builder->selectCount('id_ranking');
		$builder->where('rank', $number);
		$builder->where('product_id', $id);
		$datas = $builder->get()->getRowArray();
		return $datas;
	}

	public function getTotalVote($id)
	{
		$builder = $this->db->table('tbl_product_rank');
		$builder->selectCount('id_ranking');
		$builder->where('product_id', $id);
		$datas = $builder->get()->getRowArray();
		return $datas;
	}

	public function getRankPercentByProduct($rank, $total_vote)
	{
		return ($rank / $total_vote) * 100;
	}
}
