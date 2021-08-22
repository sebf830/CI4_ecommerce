<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_user';
	protected $primaryKey           = 'user_id';
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
	protected $beforeInsert         = ['beforeInsert'];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];


	protected function beforeInsert(array $data)
	{
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function passwordHash(array $data)
	{
		if (isset($data['data']['password'])) {
			$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
		}
		return $data;
	}

	public function getEmails()
	{
		$builder = $this->db->table('tbl_email_customer');
		$builder->select('*');
		$emails = $builder->get()->getResultArray();
		return $emails;
	}

	public function getEmailByLimit()
	{
		$builder = $this->db->table('tbl_email_customer');
		$builder->select('*');
		$builder->limit(10);
		$emails = $builder->get()->getResultArray();
		return $emails;
	}

	public function getEmailById($id_email)
	{
		$builder = $this->db->table('tbl_email_customer');
		$builder->select('*');
		$builder->where('id_email', $id_email);
		$email = $builder->get()->getRowArray();
		return $email;
	}

	public function updateEmailStatus($id_email)
	{
		$builder = $this->db->table('tbl_email_customer');
		$builder->where('id_email', $id_email);
		$data = [
			'consulte' => 1
		];
		$builder->set($data)->update();
	}
}
