<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\WebModel;

use App\Controllers\BaseController;


class Cart extends BaseController
{

    public function index($page = 'panier')
    {
        $data = array('title' => $page);
        if (session()->has('cart')) {

            $itemData = array_values(session('cart'));
            $subtotal = 0;
            for ($i = 0; $i < count($itemData); $i++) {
                $subtotal += $itemData[$i]['price'] * $itemData[$i]['quantite'];
            }
            return view('web/pages/cart', ['data' => $data, 'items' => $itemData, 'subtotal' => $subtotal]);
        } else {
            return view('web/pages/cart', ['data' => $data]);
        }
    }

    public function add_to_cart($id)
    {
        $product = new WebModel();
        $item = $product->getProductById($id);
        $itemArray = [
            'id' => $item['product_id'],
            'title' => $item['product_title'],
            'image' => $item['product_image'],
            'price' => $item['product_price'],
            'desc' => $item['short_description'],
            'quantite' => 1,
        ];
        $session = session();
        if ($session->has('cart')) {
            $index = Cart::exists($id);
            echo $index;
            $cart = array_values(session('cart'));

            if ($index == -1) {
                array_push($cart, $itemArray);
            } else {
                $cart[$index]['quantite']++;
                print_r($cart);
            }
            $session->set('cart', $cart);
        } else {
            $cart = array($itemArray);
            $session->set('cart', $cart);
        }
        return redirect()->to('panier');
    }

    public static function exists($id)
    {
        $items = array_values(session('cart'));
        for ($i = 0; $i < count($items); $i++) {
            if ($items[$i]['id'] == $id) {
                return $i;
            }
        }
        return -1;
    }


    public function update_cart()
    {
        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getVar('id_item');
            $qte = $this->request->getVar('qte');
            $items = array_values(session('cart'));
            $session = session();

            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]['id'] == $id) {
                    $items[$i]['quantite'] = $qte;
                    $session->set('cart', $items);
                }
            }
        }
        return redirect()->to(base_url('panier'));
    }

    public function remove_cart($id)
    {
        if ($this->request->getMethod() == 'post') {
            //$id = $this->request->getVar('id_item');
            $index = Cart::exists($id);
            $items = array_values(session('cart'));
            unset($items[$index]);
            $session = session();
            $session->set('cart', $items);
            return redirect()->to('panier');
        }
    }
}
