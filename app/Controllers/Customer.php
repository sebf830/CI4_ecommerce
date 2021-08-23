<?php

namespace App\Controllers;

use DateTime;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\HistoryModel;
use App\Models\ProductModel;

use App\Models\CustomerModel;
use App\Controllers\BaseController;


class Customer extends BaseController
{
    public function client_login($page = 'Connexion')
    {
        $data = array('title' => $page);

        if ($this->request->getMethod() == 'post') {
            $values = $this->request->getVar();


            $rules = [
                'customer_email' => 'required|min_length[2]|max_length[30]',
                'customer_password' => 'required|validateUser[customer_email,customer_password]',
            ];

            $errors = [
                'customer_password' => [
                    'required' => 'Le champs password est vide',
                    'validateUser' => "Nom ou mot de passe incorrect",
                ],
                'customer_email' => [
                    'required' => 'Le champs email est vide'
                ]
            ];

            if (!$this->validate($rules, $errors)) {

                return view('web/pages/login_client', [
                    "validation" => $this->validator,
                    'data' => $data,
                    'values' => $values
                ]);
            } else {
                $model = new CustomerModel();
                $user = $model->where('customer_email', $this->request->getVar('customer_email'))->first();
                $this->setUserSession($user);
                //return redirect()->to(base_url($previous));
                echo '<script>window.history.go(-2)</script>';
            }
        }
        return view('web/pages/login_client', ['data' => $data]);
    }

    public function send_password($page = 'reinitialiser')
    {
        $data = ['title' => $page];
        if ($this->request->getMethod() == 'post') {
            $email = $this->request->getVar('customer_email');
            if (!empty($email)) {
                $model = new CustomerModel();
                $pass = ucfirst(substr(md5(microtime(true)), 0, 8));

                $check = $model->getUserByEmail($email);
                $name = $check['customer_name'];
                if (!empty($name)) {
                    Email::send_password($name, $pass, $email);
                    $password = ['customer_password' => password_hash($pass, PASSWORD_DEFAULT)];
                    $model->update_profile_informations($password, $check['customer_id']);
                    $password_success = 'Nous avons envoyé un mail à ' . $email;
                    return view('web/pages/send_password', ['data' => $data, 'password_success' => $password_success]);
                }
            }
        }
        return view('web/pages/send_password', ['data' => $data]);
    }


    private function setUserSession($user)
    {
        $data = [
            'customer_email' => $user['customer_email'],
            'customer_id' => $user['customer_id'],
            'customer_name' => $user['customer_name'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }


    public function profile_page($page = 'Profile')
    {
        $dataCustomer = [];
        $data = ['title' => $page];
        $session_user = session()->get();


        $model = new CustomerModel();
        $order = new OrderModel();

        $orders = $order->getAllOrdersById(session()->get('customer_id'));
        $lastOrders = $order->getLastOrdersById(session()->get('customer_id'));
        $wishlist = $model->getWishlist(session()->get('customer_id'));
        $points = $model->getVenusPoints(session()->get('customer_id'));
        $coupons = $model->getAllcoupons(session()->get('customer_id'));
        $msg_unread = $model->getConversationsUnread(session()->get('customer_id'));

        if ($this->request->getMethod() == 'post') {
            $value = $this->request->getVar('mesg_chat') ??  '';
            if ($value != '') {
                $data_insert = [
                    'id_customer' => session()->get('customer_id'),
                    'id_msg_chat' => session()->get('conversation'),
                    'text_msg_customer' => $value,
                ];
                $model->insert_msg_customer($data_insert);
            }
        }

        $idChat = $model->getConversationById(session()->get('customer_id'));
        session()->set('conversation', $idChat['id_msg_chat']);
        $allPosts = $model->get_conversations(session()->get('conversation'));
        $dataCustomer['customer'] = $model->where('customer_id', session()->get('customer_id'))->first();

        return view('web/pages/profile', [
            'data' => $data,
            'orders' => $orders,
            'lastOrders' => $lastOrders,
            'dataCustomer' => $dataCustomer,
            'wishlist' => $wishlist,
            'points' => $points,
            'coupons' => $coupons,
            'allPosts' => $allPosts,
            'msg_unread' => $msg_unread
        ]);
    }

    public function profile_informations($page = 'Mes informations')
    {
        $data = array('title' => $page);
        $model = new CustomerModel();
        $data_customer = $model->getCustomerById(session()->get('customer_id'));

        if ($this->request->getMethod() == 'post') {
            $values = $this->request->getVar();
            if (in_array('informations', $this->request->getVar())) {
                $rules = [
                    'customer_city' => 'required|min_length[2]|max_length[50]',
                    'customer_phone' => 'required|min_length[10]|max_length[10]',
                    'customer_email' => 'trim|required|valid_email',
                    'customer_address' => 'trim|required|min_length[10]|max_length[300]',
                    'customer_zipcode' => 'trim|required|min_length[5]|max_length[5]',
                ];

                $errors = [
                    'customer_city' => [
                        'required' => 'Le champs Ville est vide',
                        'min_length' => 'Votre ville est trop courte',
                        'max_length' => 'Votre ville ne doit pas dépasser 50 caractères'
                    ],
                    'customer_email' => [
                        'required' => 'Le champs email est vide',
                        'valid_email' => 'l\'adresse doit respecter le format : adresse@operateur.fr'
                    ],
                    'customer_phone' => [
                        'required' => 'Le téléphone est requis',
                        'min_length' => 'Votre téléphone doit comporter 10 caractères',
                        'max_length' => 'Votre téléphone doit comporter 10 caractères'
                    ],
                    'customer_address' => [
                        'required' => 'L\'adresse est requise',
                        'min_length' => 'Votre adresse doit comporter au moins 10 caractères',
                        'max_length' => 'Votre adresse doit comporter au maximum 300 caractères'
                    ],
                    'customer_zipcode' => [
                        'required' => 'Le code postal est requis',
                        'min_length' => 'Votre code postal  doit comporter 5 caractères',
                        'max_length' => 'Votre code postal  doit comporter 5 caractères'
                    ],
                ];

                if (!$this->validate($rules, $errors)) {

                    return view('web/pages/informations', [
                        "validation" => $this->validator,
                        'data' => $data,
                        'values' => $values,
                        'data_customer' => $data_customer
                    ]);
                } else {
                    $informations = [
                        'customer_email' =>  $values['customer_email'],
                        'customer_address' => $values['customer_address'],
                        'customer_city' => $values['customer_city'],
                        'customer_zipcode' => $values['customer_zipcode'],
                        'customer_phone' => $values['customer_phone'],
                    ];
                    $model->update_profile_informations($informations, session()->get('customer_id'));
                    $confirm = 'Informations modifiées avec succès';
                    return view('web/pages/informations', ['data' => $data, 'data_customer' => $data_customer, 'confirm' => $confirm]);
                }
            }
            if (in_array('password', $this->request->getVar())) {
                if ($this->request->getMethod() == 'post') {
                    $values = $this->request->getVar();
                    if (in_array('password', $this->request->getVar())) {
                        $rules = [
                            'last_pass' => 'required|min_length[8]|max_length[50]',
                            'new_pass' => 'required|min_length[8]|max_length[50]',
                        ];

                        $errors = [
                            'last_pass' => [
                                'required' => 'Le champs password est vide',
                                'min_length' => 'Le mot de passe doit comporter au moins 8 caractères',
                                'max_length' => 'Le mot de passe ne doit pas dépasser 50 caractères',
                            ],
                            'new_pass' => [
                                'required' => 'Le champs password est vide',
                                'min_length' => 'Le mot de passe doit comporter au moins 8 caractères',
                                'max_length' => 'Le mot de passe ne doit pas dépasser 50 caractères'
                            ],
                        ];
                        if (!$this->validate($rules, $errors)) {
                            return view('web/pages/informations', [
                                "validation" => $this->validator,
                                'data' => $data,
                                'values' => $values,
                                'data_customer' => $data_customer
                            ]);
                        } else {
                            if (!password_verify($this->request->getVar('last_pass'), $data_customer['customer_password'])) {
                                $validPassword = 'Mot de passe non reconnu';
                                return view('web/pages/informations', ['data' => $data, 'data_customer' => $data_customer, 'values' => $values, 'validPassword' => $validPassword]);
                            } else {
                                $informations = [
                                    'customer_password' =>  password_hash($this->request->getVar('new_pass'), PASSWORD_DEFAULT)
                                ];
                                $model->update_profile_informations($informations, session()->get('customer_id'));
                                $password_success = "Mot de passe modifié avec succès";
                                return view('web/pages/informations', ['data' => $data, 'values' => $values, 'data_customer' => $data_customer, 'password_success' => $password_success]);
                            }
                        }
                    }
                }
            }
        }
        return view('web/pages/informations', ['data' => $data, 'data_customer' => $data_customer]);
    }


    public function profile_history()
    {

        $id = isset($id) ? $id : '';
        $data = array('title' => 'Historique');
        $order = new OrderModel();

        $order->where('customer_id', session()->get('customer_id'));
        $listOrder = $order->getAllOrdersById(session()->get('customer_id'));

        return view('web/pages/profile_history', [
            'data' => $data,
            'listOrder' => $listOrder,
            'pager' => $order->pager,
        ]);
    }

    public function profile_history_details($id)
    {
        $data = array('title' => 'Historique');
        $order = new OrderModel();
        $order_details = $order->getItemsOrdersById($id);
        $shipping_details = $order->getShippingById(session()->get('customer_id'));
        $order_info = $order->getOrderByIdOrder($id);
        $points = $order->calculate_points_from_order_price($order_info['order_total']);

        return view('web/pages/profile_history_details', [
            'data' => $data,
            'order_details' => $order_details,
            'shipping_details' => $shipping_details,
            'order_info' => $order_info,
            'points' => $points

        ]);
    }

    public function profile_wishlist($page = 'Ma liste d\'envie')
    {
        $data = array('title' => $page);
        $list = new ProductModel();
        $liked_product = $list->getWishListAllItems(session()->get('customer_id'));
        if ($this->request->getMethod() == 'post') {
            $id_produit = $this->request->getVar('idProd');
            if (!empty($id_produit)) {
                $id_wishlist = $list->getWishlist(session()->get('customer_id'));
                $list->removeFromWishlist($id_produit, $id_wishlist['id_wishlist']);
                return redirect()->to(base_url('profile/wishlist'));
            }
        }
        return view('web/pages/profile_wishlist', ['data' => $data, 'liked_product' => $liked_product]);
    }

    public function profile_avantage($page = 'Mes avantages')
    {
        $data = array('title' => $page);
        $customer = new CustomerModel();
        $points = $customer->getVenusPoints(session()->get('customer_id'));
        $rank = $customer->getCustomerRank($points['points']);


        return view('web/pages/profile_avantage', ['data' => $data, 'points' => $points, 'rank' => $rank]);
    }

    public function profile_messagerie($id = null)
    {
        $data = array('title' => 'Mes messages');
        $customer = new CustomerModel();

        if ($_SERVER['PATH_INFO'] == '/profile/messagerie') {
            $msgs = $customer->getConversationInbox(session()->get('customer_id'));
            return view('web/pages/profile_messagerie', ['data' => $data, 'msgs' => $msgs]);
        } else {
            //on affiches les messages de la conversation
            $msg_details = $customer->getMessagesFromConversationInbox(session()->get('customer_id'), $id);

            // on marque la conversation comme lue
            $customer->updateConversationReadStatus(session()->get('customer_id'), $id, 1);
            return view('web/pages/profile_messagerie', ['data' => $data, 'msg_details' => $msg_details, 'id_conversation' => $id]);
        }
    }

    public function ajax_msg()
    {
        $data = $this->request->getVar();
        $customer = new CustomerModel();
        $insert = [
            'id_conversation' => $data['conversation'],
            'message_status_read' => 0,
            'text_msg' => $data['texte'],
            'id_user' => session()->get('customer_id'),
        ];
        $customer->createNewMessage($insert);
    }


    public function logout()
    {
        //si panier boutique
        if (session()->get('customer_id') && !empty(session('cart'))) {
            $cart = new CartModel();
            //creation du panier en base ou update si existe
            $cart->create_or_update_cart();
            //suppression des anciens articles et insert des nouveaux
            $cart->create_items_cart();
            //relance panier par email
            $email = new Email();
            $name = session()->get('customer_name');
            $mail = session()->get('customer_email');

            $email->relance_panier($name, $mail);
        }
        session()->destroy();
        return redirect()->to('home');
    }


    public function active_account($activation_key)
    {
        $data = array('title' => 'Activation');
        $customer = new CustomerModel();
        $customer->activate_account($activation_key);
        return view('web/pages/active_account_confirmation', ['data' => $data]);
    }


    public function client_register($page = 'Inscription')
    {
        $data = array('title' => $page);
        if ($this->request->getMethod() == 'post') {
            $values = $this->request->getVar();

            $rules = [
                'customer_name' => 'trim|required|min_length[2]|max_length[30]',
                'customer_password' => 'trim|required|min_length[8]',
                'customer_city' => 'trim|required|min_length[2]|max_length[30]',
                'customer_phone' => 'trim|required|min_length[10]|max_length[10]',
                'customer_email' => 'trim|required|valid_email',
                'customer_address' => 'trim|required|min_length[10]|max_length[200]',
                'customer_zipcode' => 'trim|required|min_length[5]|max_length[5]',

            ];
            $message = [
                'customer_name' => [
                    'required' => 'Merci de remplir un nom',
                    'min_length' => 'Le nom doit comporter au moins 2 lettres',
                    'max_length' => 'Le nom choisi est trop long'
                ],
                'customer_email' => [
                    'required' => 'Merci de remplir une adresse email',
                    'valid_email' => 'Veuillez renseigner un email valide : adresse@messagerie.fr'
                ],
                'customer_phone' => [
                    'required' => 'Merci de remplir un numero de téléphone',
                    'min_length' => 'le numero doit comporter 10 chiffres',
                    'max_length' => 'le numero doit comporter 10 chiffres',
                    'valid_phone' => 'Le numéro doit contenir des chiffres uniquement'
                ],
                'customer_address' => [
                    'required' => 'Veuillez renseigner une adresse postale',
                    'min_length' => 'Votre adresse est trop courte',
                    'max_length' => 'Votre adresse ne doit pas dépasser 200 caractères'

                ],
                'customer_city' => [
                    'required' => 'Veuillez renseigner une ville',
                    'min_length' => 'Le nom de ville renseigné est trop court',
                    'max_length' => 'Le nom de ville ne doit pas dépasser 100 caractères'

                ],
                'customer_zipcode' => [
                    'required' => 'Veuillez renseigner un code postal',
                    'min_length' => 'Le code postal doit contenir 5 chiffres',
                    'max_length' => 'Le code postal doit contenir 5 chiffres'
                ],
                'customer_password' => [
                    'required' => 'Veuillez renseigner un password',
                    'min_length' => 'Le password doit comporter au moins 8 caractères',
                ],
            ];
            $validation = \Config\Services::validation();

            if (!$this->validate($rules, $message)) {
                return view('web/pages/register_client', ['validation' => $this->validator, 'values' => $values, 'data' => $data]);
            } else {

                $model = new CustomerModel();
                $newData = [
                    'customer_name' => $this->request->getVar('customer_name'),
                    'customer_email' => $this->request->getVar('customer_email'),
                    'customer_password' => password_hash($this->request->getVar('customer_password'), PASSWORD_DEFAULT),
                    'customer_address' => $this->request->getVar('customer_address'),
                    'customer_city' => $this->request->getVar('customer_city'),
                    'customer_zipcode' => $this->request->getVar('customer_zipcode'),
                    'customer_phone' => $this->request->getVar('customer_phone'),
                    'customer_active' => 0,
                    'valid_key' => md5(microtime(true) . mt_rand(10000, 90000))
                ];
                $insert = $model->save($newData);

                $to = $this->request->getVar('customer_email');
                $name = $this->request->getVar('customer_name');

                $userKey = $newData['valid_key'];

                $email = \Config\Services::email();
                $sendEmail = new Email();
                $sendEmail->sendMail($name, $to, $userKey);

                $history = new HistoryModel();
                $history->addHistory('Nouveau client crée : '  . $name,  1, 'customer');

                $session = session();
                $session->setFlashdata('success', 'Votre compte est crée avec succès, veuillez utiliser le lien de confirmation recu par email pour activer votre compte');
                return redirect()->to(base_url('client/connexion'));
            }
        }
        return view('web/pages/register_client', ['data' => $data]);
    }
}
