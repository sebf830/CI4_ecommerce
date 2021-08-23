<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_articles';
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


	public function getArticles()
	{
		$builder = $this->db->table('tbl_articles');
		$builder->select('*');
		$builder->join('tbl_articles_category', 'tbl_articles_category.id_article_category = tbl_articles.id_category');
		$builder->orderBY('created_at', 'DESC');
		$data = $builder->get()->getResult('array');
		return $data;
	}
	public function getLastArticles($nombre)
	{
		$builder = $this->db->table('tbl_articles');
		$builder->select('*');
		$builder->orderBY('created_at', 'DESC');
		$builder->limit($nombre);
		$data = $builder->get()->getResultArray();
		return $data;
	}
	public function getCategories()
	{
		$builder = $this->db->table('tbl_articles_category');
		$builder->select('*');
		$data = $builder->get()->getResultArray();
		return $data;
	}
	public function getCategoriesById($id)
	{
		$builder = $this->db->table('tbl_articles_category');
		$builder->select('*');
		$builder->where('id_article_category', $id);
		$data = $builder->get()->getRowArray();
		return $data;
	}

	public function getArticleById($id)
	{
		$builder = $this->db->table('tbl_articles');
		$builder->select('*');
		$builder->where('id_article', $id);
		$data = $builder->get()->getRowArray();
		return $data;
	}
	public function getArticleByIdCategory($id)
	{
		$builder = $this->db->table('tbl_articles');
		$builder->select('*');
		$builder->join('tbl_articles_category', 'tbl_articles_category.id_article_category = tbl_articles.id_category');
		$builder->where('tbl_articles.id_category', $id);
		$builder->orderBY('created_at', 'DESC');
		$data = $builder->get()->getResultArray();
		return $data;
	}

	public function update_article($data)
	{
		$builder = $this->db->table('tbl_articles');
		$builder->where('id_article', $data['id_article']);
		$builder->set($data)->update();
	}

	public function create_article($data)
	{
		$builder = $this->db->table('tbl_articles');
		$builder->set($data)->insert();
	}

	public function delete_article($id)
	{
		$builder = $this->db->table('tbl_articles');
		$builder->where('id_article', $id);
		$builder->delete();
	}

	public function search_article($search)
	{
		$builder = $this->db->table('tbl_articles');
		$builder->select('*');
		$builder->join('tbl_articles_category', 'tbl_articles_category.id_article_category = tbl_articles.id_category');
		$builder->like('tbl_articles.title_article', $search);
		$builder->orLike('tbl_articles.text_article', $search);
		$builder->orLike('tbl_articles_category.title_category', $search);
		$builder->orLike('tbl_articles.author_article', $search);
		$builder->orLike('tbl_articles.created_at', $search);
		$searches = $builder->get()->getResultArray();
		return $searches;
	}
}
