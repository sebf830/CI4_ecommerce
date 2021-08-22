<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_order';
	protected $primaryKey           = 'order_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
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

	public function getTotal()
	{
		$builder = $this->db->table('tbl_order');
		$builder->selectSum('order_total');
		$data = $builder->get()->getRow();
		return $data;
	}

	public function get_all_orders()
	{
		$builder = $this->db->table('tbl_order');
		$builder->select('*');
		$data = $builder->get()->getResultArray();
		return $data;
	}

	public function createOrder($data)
	{
		$builder = $this->db->table('tbl_order');
		$insert = [
			'order_ref' => $data['order_ref'],
			'customer_id' => $data['customer_id'],
			'payment_mode' => $data['payment_mode'],
			'order_total' => $data['order_total']
		];
		$builder->set($insert)->insert();
	}

	public function getOrderById($id_customer)
	{
		$builder = $this->db->table('tbl_order');
		$builder->select('order_id');
		$builder->where('customer_id', $id_customer);
		$builder->limit(1);
		$builder->orderBy('created_at', 'DESC');
		$data = $builder->get()->getRowArray();
		return $data;
	}

	public function getOrderByIdOrder($id_order)
	{
		$builder = $this->db->table('tbl_order');
		$builder->select('*');
		$builder->where('order_id', $id_order);
		$data = $builder->get()->getRowArray();
		return $data;
	}

	public function updateInfo($id_customer, $id)
	{
		$builder = $this->db->table('tbl_shipping');
		$builder->where('customer_id', $id_customer);
		$update_info = ['order_id' => $id];
		$builder->set($update_info)->update();
	}

	//affichage des orders page history
	public function getAllOrdersById($id_customer)
	{
		$builder = $this->db->table('tbl_order');
		$builder->select('*');
		$builder->where('customer_id', $id_customer);
		$builder->orderBy('created_at', 'DESC');
		$data = $builder->get()->getResultArray();
		return $data;
	}

	//affichage des orders page index
	public function getLastOrdersById($id_customer)
	{
		$builder = $this->db->table('tbl_order');
		$builder->select('*');
		$builder->where('customer_id', $id_customer);
		$builder->orderBy('created_at', 'DESC');
		$builder->limit(3);
		$data = $builder->get()->getResultArray();
		return $data;
	}

	//affichage des produits pour une order
	public function getItemsOrdersById($id_order)
	{
		$builder = $this->db->table('tbl_order_details');
		$builder->select('*, tbl_order.order_ref, tbl_order.created_at');
		$builder->join('tbl_order', 'tbl_order.order_id = tbl_order_details.order_id');
		$builder->where('tbl_order.order_id', $id_order);
		$data = $builder->get()->getResultArray();
		return $data;
	}


	public function createOrderItems($id_order, $datas)
	{
		$builder = $this->db->table('tbl_order_details');
		$insert = [
			'order_id' => $datas['order_id'],
			'product_id' => $datas['product_id'],
			'product_name' => $datas['product_name'],
			'product_price' => $datas['product_price'],
			'product_sales_quantity' => $datas['product_sales_quantity'],
			'product_image' => $datas['product_image']
		];
		$builder->set($insert)->insert();
	}

	public function createOrUpdateShipping($datas)
	{
		$builder = $this->db->table('tbl_shipping');
		$builder->select('*');
		$builder->where('customer_id', $datas['customer_id']);
		$insert = [
			'customer_id' => $datas['customer_id'],
			'shipping_name' => $datas['shipping_name'],
			'shipping_address' => $datas['shipping_address'],
			'shipping_city' => $datas['shipping_city'],
			'shipping_zipcode' => $datas['shipping_zipcode']
		];
		if ($builder->get()->getRow()) {
			$builder->set($insert)->update();
		} else {
			$builder->set($insert)->insert();
		}
	}

	public function getShippingById($id)
	{
		$builder = $this->db->table('tbl_shipping');
		$builder->select('*');
		$builder->where('customer_id', $id);
		$shipping = $builder->get()->getRowArray();
		return $shipping;
	}

	//arrondi à la dizaine superieure
	//attribue 10 points par dizaine entamée ( 84.70€ = 90 points, 11€ = 20 points)
	public function calculate_points_from_order_price($price)
	{
		$p = pow(10, 1);
		return ceil($price / $p) * $p;
	}

	public function get_customer_points($id)
	{
		$builder = $this->db->table('tbl_customer');
		$builder->select('points');
		$builder->where('customer_id', $id);
		$data = $builder->get()->getRowArray();
		return $data;
	}
	public function update_customer_points($id, $points)
	{
		$builder = $this->db->table('tbl_customer');
		$builder->where('customer_id', $id);
		$insert = ['points' => $points];
		$builder->set($insert)->update();
	}

	public function orderDetailsAdmin()
	{
		$builder = $this->db->table('tbl_order');
		$builder->selectCount('tbl_order_details.order_details_id');
		$builder->select('tbl_order.order_ref, tbl_order.order_id, tbl_order.payment_mode, tbl_order.order_total, tbl_order.created_at, tbl_customer.customer_name');
		$builder->join('tbl_order_details', 'tbl_order_details.order_id = tbl_order.order_id');
		$builder->join('tbl_customer', 'tbl_order.customer_id = tbl_customer.customer_id');
		$builder->groupBy('tbl_order.order_id');
		$data = $builder->get()->getResult('array');
		return $data;
	}
}
