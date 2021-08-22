<?php

namespace App\Models;

use CodeIgniter\Model;

class WebModel extends Model
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


	public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

	public function get_popular_products()
	{
		$builder = $this->db->table('tbl_product');
		$builder->where('publication_status', 1);
		$builder->limit(4);
		$info = $builder->get()->getResultArray();
		return $info;
	}
	public function get_slider_products()
	{
		$builder = $this->db->table('tbl_slider');
		$builder->where('publication_status', 1);
		$slides = $builder->get()->getResultArray();
		return $slides;
	}

	public function get_all_featured_product()
	{
		$builder = $this->db->table('tbl_product as tb');
		$builder->select('*,tb.publication_status as pstatus');
		$builder->join('tbl_category as tc', 'tc.id = tb.product_category');
		$builder->join('tbl_brand as tbr', 'tbr.brand_id = tb.product_brand');
		$builder->orderBy('tb.product_id', 'DESC');
		$builder->where('tb.publication_status', 1);
		$builder->where('product_feature', 1);
		$builder->limit(4);
		$products = $builder->get()->getResult('array');
		return $products;
	}

	public function get_all_new_product()
	{
		$builder = $this->db->table('tbl_product as tb');
		$builder->select('*,tb.publication_status as pstatus');
		$builder->join('tbl_category as tc', 'tc.id = tb.product_category');
		$builder->join('tbl_brand as tbr', 'tbr.brand_id = tb.product_brand');
		$builder->orderBy('tb.product_id', 'DESC');
		$builder->where('tb.publication_status', 1);
		$builder->limit(4);
		$products = $builder->get()->getResult('array');;
		return $products;
	}

	public function getProductById($id)
	{
		$builder = $this->db->table('tbl_product as tb');
		$builder->select('*');
		$builder->join('tbl_category as tc', 'tc.id = tb.product_category');
		$builder->join('tbl_brand as tbr', 'tbr.brand_id = tb.product_brand');
		$builder->where('tb.product_id', $id);
		$singleProduct = $builder->get()->getRowArray();
		return $singleProduct;
	}

	public function getCategoryById($id)
	{
		$builder = $this->db->table('tbl_category');
		$builder->where('id', $id);
		$category = $builder->get()->getRowArray();
		return $category;
	}

	public function getAllCategory()
	{
		$builder = $this->db->table('tbl_category');
		$builder->where('publication_status', 1);
		$category = $builder->get()->getResult('array');
		return $category;
	}

	public function get_all_product()
	{
		$builder = $this->db->table('tbl_product');
		$builder->select('*');
		$products = $builder->get()->getResult();
		return $products;
	}

	public function get_contact_options()
	{
		$builder = $this->db->table('tbl_option');
		$builder->select('*');
		$builder->where('option_id', 1);
		$options = $builder->get()->getRowArray();
		return $options;
	}
	public function get_all_product_by_cat($id)
	{
		$builder = $this->db->table('tbl_product as tb');
		$builder->select('*');
		$builder->join('tbl_category as tc', 'tc.id = tb.product_category');
		$builder->join('tbl_brand as tbr', 'tbr.brand_id = tb.product_brand');
		$builder->orderBy('tb.product_id', 'DESC');
		$builder->where('tb.publication_status', 1);
		$builder->where('tc.id', $id);
		$ProductsByCategory = $builder->get()->getResult('array');
		return $ProductsByCategory;
	}
	public function get_product_by_category_limt($id)
	{
		$builder = $this->db->table('tbl_product as tb');
		$builder->select('*');
		$builder->join('tbl_category as tc', 'tc.id = tb.product_category');
		$builder->join('tbl_brand as tbr', 'tbr.brand_id = tb.product_brand');
		$builder->orderBy('tb.product_id', 'DESC');
		$builder->limit(4);
		$builder->where('tb.publication_status', 1);
		$builder->where('tc.id', $id);
		$ProductsByCategory = $builder->get()->getResult('array');
		return $ProductsByCategory;
	}

	public function get_all_search_product($search)
	{
		$builder = $this->db->table('tbl_product');
		$builder->select('*');
		$builder->join('tbl_category', 'tbl_category.id = tbl_product.product_category');
		$builder->join('tbl_brand', 'tbl_brand.brand_id = tbl_product.product_brand');
		//syntax 1
		// $builder->where("(tbl_product.product_title LIKE '%" . $search . "%' OR tbl_category.category_name  LIKE '%" . $search . "%'
		// OR tbl_product.short_description LIKE '%" . $search . "%' OR tbl_brand.brand_name LIKE '%" . $search . "%')");
		$builder->orderBy('tbl_product.product_id', 'DESC');
		$builder->like('tbl_product.product_title', $search);
		$builder->orLike('tbl_product.short_description', $search);
		$builder->orLike('tbl_category.category_name', $search);
		$builder->orLike('tbl_brand.brand_name', $search);
		$searches = $builder->get()->getResultArray();
		return $searches;
	}

	public function save_email_customer($data)
	{
		$builder = $this->db->table('tbl_email_customer');
		$builder->select('*');
		$builder->where('sender_name', $data['sender_name']);
		$builder->where('msg_email', $data['msg_email']);
		$builder->where('object_email', $data['object_email']);

		if (!$builder->get()->getRow()) {
			$insertArray = [
				'sender_name' => $data['sender_name'],
				'sender_email' => $data['sender_email'],
				'object_email' => $data['object_email'],
				'msg_email' => $data['msg_email'],
				'is_customer' => $data['is_customer'],
				'id_customer' => $data['id_customer'],
			];
			$builder->set($insertArray)->insert();
			return true;
		} else {
			return false;
		}
	}

	public function randCategory()
	{
		$builder = $this->db->table('tbl_category');
		$builder->select('id');
		$data = $builder->get()->getResultArray();
		return $data;
	}
}
