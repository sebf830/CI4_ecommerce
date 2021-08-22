<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_history';
	protected $primaryKey           = 'id_history';
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

	public function getAllHistory()
	{
		$builder = $this->db->table('tbl_history');
		$builder->select('*, tbl_user.user_name');
		$builder->join('tbl_user', 'tbl_user.user_id = tbl_history.id_admin');
		$builder->orderBy('tbl_history.created_at', 'DESC');
		$data = $builder->get()->getResult('array');
		return $data;
	}
	public function getTenLastHistory()
	{
		$builder = $this->db->table('tbl_history');
		$builder->select('*, tbl_user.user_name');
		$builder->join('tbl_user', 'tbl_user.user_id = tbl_history.id_admin');
		$builder->orderBy('tbl_history.created_at', 'DESC');
		$builder->limit(10);
		$data = $builder->get()->getResult('array');
		return $data;
	}

	public function addHistory($title, $id_admin,  $table)
	{
		$builder = $this->db->table('tbl_history');
		$data = [
			'title_history' => $title,
			'id_admin' => $id_admin,
			'table_history' => $table
		];
		$builder->insert($data);
	}
}
