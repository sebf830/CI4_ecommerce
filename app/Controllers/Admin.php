<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;




class Admin extends BaseController
{

    public function login($page = 'Admin')
    {

        $data = array('title' => $page);

        if ($this->request->getMethod() == 'post') {
            $values = $this->request->getVar();


            $rules = [
                'user_email' => 'required|min_length[2]|max_length[30]',
                'user_password' => 'required|validateUserAdmin[user_email,user_password]',
            ];

            $errors = [
                'user_email' => [
                    'required' => 'Le champs password est vide',
                ],
                'user_password' => [
                    'required' => 'Le champs email est vide',
                    'validateUserAdmin' => "Nom ou mot de passe incorrect",
                ]
            ];

            if (!$this->validate($rules, $errors)) {

                return view('admin/pages/login', [
                    "validation" => $this->validator,
                    'data' => $data,
                    'values' => $values
                ]);
            } else {
                $model = new AdminModel();
                $user = $model->where('user_email', $this->request->getVar('user_email'))->first();
                $this->setAdminSession($user);
                return redirect()->to(base_url('/admin/dashboard'));
            }
        }
        return view('admin/pages/login', ['data' => $data]);
    }

    private function setAdminSession($user)
    {
        $data = [
            'user_email' => $user['user_email'],
            'user_id' => $user['user_id'],
            'user_name' => $user['user_name'],
            'isLoggedAdmin' => true,
            'online' => true
        ];
        session()->set($data);
        return true;
    }

    public function admin_logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/admin/login'));
    }
}
