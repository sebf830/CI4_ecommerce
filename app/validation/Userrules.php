<?php

namespace App\Validation;

use App\Models\CustomerModel;
use App\Models\AdminModel;


class Userrules
{

	public function validateUser(string $str, string $fields, array $data)
	{
		$model = new CustomerModel();
		$user = $model->where('customer_email', $data['customer_email'])->first();

		if (!$user || $user['customer_active'] == 0)
			return false;
		return password_verify($data['customer_password'], $user['customer_password']);
	}

	public function validateUserAdmin(string $str, string $fields, array $data)
	{
		$model = new AdminModel();
		$user = $model->where('user_email', $data['user_email'])->first();

		if (!$user)
			return false;
		return password_verify($data['user_password'], $user['user_password']);
	}
}
