<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_customer';
	protected $primaryKey           = 'customer_id';
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

	public function activate_account($key)
	{
		$builder = $this->db->table('tbl_customer');
		$dataActivation = array('customer_active' => 1);
		$builder->where(['valid_key' => $key])->set($dataActivation)->update();
	}

	public function getUserByEmail($email)
	{
		$builder = $this->db->table('tbl_customer');
		$builder->select('*');
		$builder->where('customer_email', $email);
		$data = $builder->get()->getRowArray();
		return $data;
	}

	public function getCustomers()
	{
		$builder = $this->db->table('tbl_customer');
		$data = $builder->get()->getResult('array');
		return $data;
	}

	public function getCustomerById($id_customer)
	{
		$builder = $this->db->table('tbl_customer');
		$builder->select('*');
		$builder->where('customer_id', $id_customer);
		$data = $builder->get()->getRowArray();
		return $data;
	}

	public function getLastCustomers()
	{
		$builder = $this->db->table('tbl_customer');
		$builder->orderBy('created_at', 'DESC');
		$builder->limit(10);
		$data = $builder->get()->getResult('array');
		return $data;
	}

	public function bestCustomers()
	{
		$builder = $this->db->table('tbl_customer as tc');
		$builder->select('(SELECT tc.customer_name, SUM(tbl_order.order_total) FROM tbl_order GROUP BY tc.customer_name ORDER BY SUM(tbl_order.order_total) DESC)', false);
		$query = $builder->get();
		return $query;
	}

	public function getCustomerInfosBySession($id)
	{
		$builder = $this->db->table('tbl_customer');
		$builder->select('*');
		$infos = $builder->where('customer_id', $id)->get()->getRowArray();
		return $infos;
	}

	public function getWishlist($id)
	{
		$builder = $this->db->table('tbl_wishlist_item');
		$builder->select('*');
		$builder->join('tbl_wishlist', 'tbl_wishlist_item.id_wishlist = tbl_wishlist.id_wishlist');
		$wishlist = $builder->where('tbl_wishlist.id_customer', $id)->get()->getResultArray();
		return $wishlist;
	}

	//points venus shop
	public function getVenusPoints($id)
	{
		$builder = $this->db->table('tbl_customer');
		$builder->select('points');
		$points = $builder->where('customer_id', $id)->get()->getRowArray();
		return $points;
	}

	public function getCustomerRank($points)
	{
		$builder = $this->db->table('tbl_rang');
		$builder->select('*');
		$builder->where("start_points <= '$points' AND  end_points >= '$points'");
		$data = $builder->get()->getRowArray();
		return $data;
	}
	//coupons
	public function getAllcoupons($id)
	{
		$builder = $this->db->table('tbl_coupons');
		$builder->select('*');
		$builder->where('id_customer', $id);
		$builder->where('ending_date > ', date('Y-m-d'));
		$builder->where('status_used', 0);
		$coupon = $builder->get()->getResultArray();
		return $coupon;
	}


	/***************************************/
	/********* Messagerie Profile **********/
	/***************************************/


	public function createNewMessage($data)
	{
		$builder = $this->db->table('tbl_message_inbox');
		$insert = [
			'id_conversation' => $data['id_conversation'],
			'message_status_read' => $data['message_status_read'],
			'text_msg' => $data['text_msg'],
			'id_user' => $data['id_user'],
		];
		$builder->set($insert)->insert();
	}


	public function getConversationInbox($id)
	{
		$builder = $this->db->table('tbl_conversation_inbox');
		$builder->select('*, tbl_message_inbox.text_msg');
		$builder->join('tbl_message_inbox', 'tbl_message_inbox.id_conversation = tbl_conversation_inbox.id_conversation');
		$builder->join('tbl_user', 'tbl_user.user_id = tbl_conversation_inbox.id_user2');
		$builder->join('tbl_customer', 'tbl_customer.customer_id = tbl_conversation_inbox.id_user1');
		$builder->where("tbl_conversation_inbox.id_user1", $id);
		$builder->orderBy('tbl_message_inbox.created_at', 'ASC');
		$builder->limit(1);
		$data = $builder->get()->getResultArray();
		return $data;
	}
	public function getMessagesFromConversationInbox($id_user, $id_conversation)
	{
		$builder = $this->db->table('tbl_conversation_inbox');
		$builder->select('*, tbl_message_inbox.text_msg');
		$builder->join('tbl_message_inbox', 'tbl_message_inbox.id_conversation = tbl_conversation_inbox.id_conversation');
		$builder->join('tbl_user', 'tbl_user.user_id = tbl_conversation_inbox.id_user2');
		$builder->join('tbl_customer', 'tbl_customer.customer_id = tbl_conversation_inbox.id_user1');
		$builder->where("tbl_conversation_inbox.id_user1", $id_user);
		$builder->where("tbl_conversation_inbox.id_conversation", $id_conversation);
		$builder->orderBy('tbl_message_inbox.created_at', 'ASC');
		$data = $builder->get()->getResultArray();
		return $data;
	}
	public function updateMessageReadStatus($id, $id_conversation)
	{
		$builder = $this->db->table('tbl_message_inbox');
		$builder->where("id_user", $id);
		$builder->where('id_conversation', $id_conversation);
		$builder->set('message_status_read',  1)->update();
	}
	public function updateConversationReadStatus($id, $id_conversation, $value)
	{
		$builder = $this->db->table('tbl_conversation_inbox');
		$builder->where("id_user1", $id);
		$builder->where('id_conversation', $id_conversation);
		$builder->set('conversation_status_read',  $value)->update();
	}

	//affichage des conversations
	public function get_conversations($id)
	{
		$builder = $this->db->table('tbl_messages_chat');
		$builder->select('tbl_messages_users.text_msg_user, 
							  tbl_messages_users.id_user,
							  tbl_messages_users.created_at,
							 ');

		$builder->join('tbl_messages_users', 'tbl_messages_chat.id_msg_chat = tbl_messages_users.id_msg_chat');
		$builder->where('tbl_messages_users.id_msg_chat', $id);
		$builder->orderBy('tbl_messages_users.created_at', 'DESC');
		$message = $builder->get()->getResultArray();
		return $message;
	}

	public function getConversationById($id)
	{
		$builder = $this->db->table('tbl_messages_chat');
		$builder->select('tbl_messages_chat.id_msg_chat');
		$builder->join('tbl_messages_users', 'tbl_messages_users.id_msg_chat = tbl_messages_chat.id_msg_chat');
		$builder->where('tbl_messages_users.id_user', $id);
		$conversation = $builder->get()->getRowArray();
		return $conversation;
	}

	public function insert_msg_customer($data)
	{
		$builder = $this->db->table('tbl_messages_users');
		$insert = [
			'id_user' => $data['id_customer'],
			'id_msg_chat' => $data['id_msg_chat'],
			'text_msg_user' => $data['text_msg_customer'],
		];
		$builder->set($insert)->insert();
	}

	public function update_profile_informations($data, $id)
	{
		$builder = $this->db->table('tbl_customer');
		$builder->where('customer_id', $id);
		$builder->set($data)->update();
	}

	public function getConversationsUnread($id)
	{
		$builder = $this->db->table('tbl_conversation_inbox');
		$builder->select('*');
		$builder->where('id_user1', $id);
		$builder->where('conversation_status_read', 0);
		$conversation = $builder->get()->getResultArray();
		return $conversation;
	}

	public function search_users($search)
	{
		$builder = $this->db->table('tbl_customer');
		$builder->select('*');
		$builder->like('customer_name', $search);
		$builder->orLike('customer_email', $search);
		$builder->orLike('customer_city', $search);
		$builder->orLike('created_at', $search);
		$results = $builder->get()->getResultArray();
		return $results;
	}
}
