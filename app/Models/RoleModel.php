<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'user_role';
	protected $primaryKey           = 'role_id';
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

	public function getRole()
	{
		$builder = $this->db->table('user_role');
		$builder->select('user_role.role_name');
		$builder->join('tbl_user', 'tbl_user.user_role = user_role.role_id');
		$role = $builder->where('tbl_user.user_id', session()->get('user_id'))->get()->getRow();
		return $role;
	}

	public function getAdmins()
	{
		$builder = $this->db->table('user_role');
		$builder->select('user_role.role_name, tbl_user.user_name');
		$builder->join('tbl_user', 'tbl_user.user_role = user_role.role_id');
		$role = $builder->get()->getResultArray();
		return $role;
	}
}
