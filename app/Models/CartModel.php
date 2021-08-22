<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_cart';
	protected $primaryKey           = 'id_cart';
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

	public function checkCart()
	{
		$builder = $this->db->table('tbl_cart');
		$builder->where('id_customer', session()->get('customer_id'));
		if ($builder->get()->getRow()) {
			return true;
		} else {
			return false;
		}
	}

	public function create_or_update_cart()
	{
		$items = array_values(session('cart'));
		$total = 0;

		for ($i = 0; $i < count($items); $i++) {
			$total += $items[$i]['price']  * $items[$i]['quantite'];
		}

		$builder = $this->db->table('tbl_cart');
		$data = [
			'user_name' => session()->get('customer_name'),
			'customer_id' => session()->get('customer_id'),
			'amount_cart' => $total,
			'item_number' => count($items),
		];

		$builder->select('*');
		$builder->where('customer_id', session()->get('customer_id'));
		if (!$builder->get()->getRow()) {
			$builder->insert($data);
		} else {
			$builder->set($data)->update();
		}
	}


	public function create_items_cart()
	{
		$cartUser = $this->db->table('tbl_cart');
		$cartUser->select('id_cart');
		$cartUser->where('customer_id', session()->get('customer_id'));
		$idCart = $cartUser->get()->getRowArray();

		$builder = $this->db->table('tbl_cart_item');
		$builder->where('id_cart', $idCart['id_cart'])->delete();

		$items = array_values(session('cart'));
		for ($i = 0; $i < count($items); $i++) {
			$data = [
				'id_cart' => $idCart['id_cart'],
				'item_name' => $items[$i]['title'],
				'item_unit_price' => $items[$i]['price'],
				'item_quantite' => $items[$i]['quantite'],
				'item_total_price' => $items[$i]['price'] * $items[$i]['quantite']
			];
			$builder->insert($data);
		}
	}
}
