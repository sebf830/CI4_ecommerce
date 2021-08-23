<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class CategoryModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tbl_category';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    //protected $useSoftDeletes       = false;
    protected $protectFields        = false;
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
    protected $beforeInsert         = ['beforeInsert'];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];


    public function getProductCategory()
    {
        $builder = $this->db->table('tbl_category');
        $data = $builder->get()->getResult('array');
        return $data;
    }

    public function getCategoriesDetails()
    {
        $builder = $this->db->table('tbl_category');
        // $builder->selectCount('tbl_product.product_id');
        $builder->select('tbl_category.id, tbl_category.category_name, tbl_category.category_description, tbl_category.category_img');
        // $builder->join('tbl_product', 'tbl_category.id = tbl_product.product_category');
        $builder->groupBy('tbl_category.id');

        $data = $builder->get()->getResultArray();
        return $data;
    }

    public function get_category_detail_byId($id)
    {
        $builder = $this->db->table('tbl_category');
        $builder->selectCount('tbl_product.product_id');
        $builder->select('tbl_category.id, tbl_category.category_name, tbl_category.category_description, tbl_category.category_img');
        $builder->join('tbl_product', 'tbl_category.id = tbl_product.product_category');
        $builder->where('tbl_category.id', $id);
        $data = $builder->get()->getRowArray();
        return $data;
    }

    public function create_category($data)
    {
        $builder = $this->db->table('tbl_category');
        $builder->set($data)->insert();
    }
    public function update_category($data)
    {
        $builder = $this->db->table('tbl_category');
        $builder->where('id', $data['id']);
        $builder->set($data)->update();
    }
    public function deleteCategory($id)
    {
        $builder = $this->db->table('tbl_category');
        $builder->where('id', $id);
        $builder->delete();
    }
}
