<?php

namespace App\Controllers;


use App\Models\ProductModel;
use App\Models\WebModel;
use App\Models\OrderModel;
use App\Models\CustomerModel;



use App\Controllers\BaseController;


class Checkout extends BaseController
{
    public function index($page = 'Enregistrement')
    {
        $data = array('title' => $page);
        if ($this->request->getMethod() == 'post') {

            $values = $this->request->getVar();
            if ($this->request->getVar('adress') != 'new_address') {

                $infosCustomer = new CustomerModel();
                $infos = $infosCustomer->getCustomerInfosBySession(session()->get('customer_id'));
                $rules = [
                    'payment' => 'required',
                    'adress' => 'required',
                    'facturation' => 'required',
                    'accept' => 'required',
                ];
                $errors = [
                    'payment' => [
                        'required' => 'Veuillez choisir un mode de paiement'
                    ],
                    'adress' => [
                        'required' => 'Veuillez choisir une adresse'
                    ],
                    'facturation' => [
                        'required' => 'Veuillez choisir une adresse de facturation'
                    ],
                    'accept' => [
                        'required' => 'Veuillez accepter les conditions d\'utilisation du site'
                    ],
                ];
                $data_shipping = [
                    'customer_id' => session()->get('customer_id'),
                    'shipping_name' => $infos['customer_name'],
                    'shipping_address' => $infos['customer_address'],
                    'shipping_city' => $infos['customer_city'],
                    'shipping_zipcode' => $infos['customer_zipcode'],

                ];
            } else {
                $rules = [
                    'nom' => 'required|min_length[2]|max_length[100]',
                    'adresse' => 'required|min_length[10]|max_length[200]',
                    'zip' => 'required|min_length[5]|max_length[5]',
                    'city' => 'required|min_length[2]|max_length[50]',
                    'payment' => 'required',
                    'adress' => 'required',
                    'facturation' => 'required',
                    'accept' => 'required',

                ];
                $errors = [
                    'payment' => [
                        'required' => 'Veuillez choisir un mode de paiement'
                    ],
                    'adress' => [
                        'required' => 'Veuillez choisir une adresse'
                    ],
                    'facturation' => [
                        'required' => 'Veuillez choisir une adresse de facturation'
                    ],
                    'accept' => [
                        'required' => 'Veuillez accepter les conditions d\'utilisation du site'
                    ],
                    'nom' => [
                        'required' => 'Veuillez renseigner un nom',
                        'min_length' => "Le nom doit comporter au moins 2 lettres",
                        'max_length' => "Le nom est trop long",

                    ],
                    'adresse' => [
                        'required' => 'Veuillez renseigner une adresse',
                        'min_length' => "L\'adresse doit comporter au moins 10 caracteres",
                        'max_length' => "L\'adresse est trop longue",
                    ],
                    'zip' => [
                        'required' => 'Veuillez renseigner un code postal',
                        'min_length' => "Le code postal doit comporter 5 chiffres",
                        'max_length' => "Le code postal doit comporter 5 chiffres",
                    ],
                    'city' => [
                        'required' => 'Veuillez renseigner une ville',
                        'min_length' => "La ville doit comporter 2 lettres",
                        'max_length' => "Le nom de  ville est trop long",
                    ],
                ];
                $data_shipping = [
                    'customer_id' => session()->get('customer_id'),
                    'shipping_name' => $this->request->getVar('nom'),
                    'shipping_address' => $this->request->getVar('adresse'),
                    'shipping_city' => $this->request->getVar('city'),
                    'shipping_zipcode' => $this->request->getVar('zip'),

                ];
            }

            if (!$this->validate($rules, $errors)) {

                return view('web/pages/checkout', [
                    "validation" => $this->validator,
                    'data' => $data,
                    'values' => $values
                ]);
            } else {
                $order = new OrderModel();
                $items = array_values(session('cart'));
                $total = 0;
                for ($i = 0; $i < count($items); $i++) {
                    $total += $items[$i]['quantite'] * $items[$i]['price'];
                }
                $ref = substr(session()->get('customer_name'), 0, 3) . substr(md5(microtime(true)), 0, 10) . rand(1000, 9000);
                session()->set('numero_commande', $ref);
                $datas_order = [
                    'order_ref' => $ref,
                    'customer_id' => session()->get('customer_id'),
                    'payment_mode' => $values['payment'],
                    'order_total' => $total,
                ];


                //creation d'une commande
                $order->createOrder($datas_order);
                $id_order = $order->getOrderById(session()->get('customer_id'));

                //creation d'un shipping
                $order->createOrUpdateShipping($data_shipping);
                $order->updateInfo(session()->get('customer_id'), $id_order['order_id']);

                //calcul des points
                $points = $order->calculate_points_from_order_price($total);

                //recuperations des points du client
                $customer_points = $order->get_customer_points(session()->get('customer_id'));
                //ajout des points
                $customer_points['points'] += $points;
                //attribution des points - insert
                $order->update_customer_points(session()->get('customer_id'), $customer_points['points']);
                session()->set('points', $points);

                for ($i = 0; $i < count($items); $i++) {
                    $datas_order_item = [
                        'order_id' => $id_order['order_id'],
                        'product_id' => $items[$i]['id'],
                        'product_name' => $items[$i]['title'],
                        'product_price' => $items[$i]['price'],
                        'product_sales_quantity' => $items[$i]['quantite'],
                        'product_image' => $items[$i]['image'],
                    ];
                    //cration des articles de commande
                    $order->createOrderItems($id_order, $datas_order_item);
                }
                //envoi d'un email de confirmation
                Email::confirmation_commande(session()->get('customer_name'), $ref, session()->get('customer_email'));

                //redirection
                return redirect()->to(base_url('order_confirmation'));
            }
        }
        return view('web/pages/checkout', ['data' => $data]);
    }

    public function confirmation($page = 'confirmation')
    {
        $data = array('title' => $page);
        $items = array_values(session('cart'));
        $shipping = new OrderModel();
        $shipping_infos = $shipping->getShippingById(session()->get('customer_id'));

        return view('web/pages/confirmation_order', ['data' => $data, 'items' => $items, 'shipping_infos' => $shipping_infos]);
    }
    public function exit_order()
    {
        //suppression de la session panier
        session()->remove('cart');
        return redirect()->to('/');
    }
}
