<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\HistoryModel;
use App\Models\AdminModel;
use App\Models\RoleModel;
use App\Models\ArticleModel;




class Dashboard extends BaseController
{

    public function index($page = "Dashboard")
    {
        $data = array('title' => $page);

        $role = new RoleModel();
        $userRole = $role->getRole();
        $allAdmins = $role->getAdmins();

        $customer = new CustomerModel();
        $allCustomers = $customer->getCustomers();
        $lastCustomers = $customer->getLastCustomers();
        // $bestCustomers = $customer->getBestCustomers();
        // print_r($bestCustomers);

        $product = new ProductModel();
        $allProducts = $product->getProducts();

        $order = new OrderModel();
        $total =  $order->getTotal();
        $all_orders = $order->get_all_orders();

        $history = new HistoryModel();
        $last_history = $history->getTenLastHistory();

        return view('admin/pages/dashboard', [
            'data' => $data,
            'allCustomers' => $allCustomers,
            'lastCustomers' => $lastCustomers,
            'allProducts' => $allProducts,
            'total' => $total,
            'all_orders' => $all_orders,
            'allAdmins' => $allAdmins,
            'userRole' => $userRole,
            'last_history' => $last_history,
        ]);
    }

    public function admin_clients($page = "Clients")
    {
        $data = array('title' => $page);
        $customer = new CustomerModel();
        $getAll = $customer->getCustomers();

        return view('admin/pages/clients', ['data' => $data, 'getAll' => $getAll]);
    }

    public function admin_produits($page = "Produits")
    {
        $data = array('title' => $page);
        $product = new ProductModel();
        $getAll = $product->getProductsWithDetails();

        return view('admin/pages/produits', ['data' => $data, 'getAll' => $getAll]);
    }
    public function admin_produit($id_produit)
    {
        $data = array('title' => 'Produits');
        $product = new ProductModel();
        $data_product = $product->getProductByIdWithDetails($id_produit);
        $categories = $product->getProductCategory();
        $message = '';

        if ($this->request->getMethod() == 'post') {
            //upload image
            if (in_array('upload_image', $this->request->getVar())) {
                $file = $this->request->getFile('file');
                $type = $file->getClientMimeType();
                $valid = array("image/png", "image/jpeg", "image/jpg");

                if (in_array($type, $valid)) {

                    $name = $file->getName();
                    $file->move('public/uploads', $name);
                    $product->updateImage($id_produit, $name);
                    session()->setFlashdata('produit', 'Image modifiée avec succès');
                    return redirect()->to(current_url());
                }
            }
            //update des infos
            if (in_array('update_infos', $this->request->getVar())) {
                $values = $this->request->getVar();
                $insert = [
                    'product_title' => $values['title'],
                    'product_price' => $values['price'],
                    'product_quantity' => $values['stock'],
                    'product_category' => $values['categorie'],
                    'short_description' => $values['short_description'],
                    'long_description' => $values['long_description'],
                ];
                $product->updateInfosProduct($id_produit, $insert);
                session()->setFlashdata('produit', 'Informations modifiées avec succès');
                return redirect()->to(current_url());
            }
        }
        return view('admin/pages/produit', [
            'data' => $data,
            'data_product' => $data_product,
            'categories' => $categories,
        ]);
    }

    public function delete_produit($id)
    {
        $product = new ProductModel();
        $product->deleteProduct($id);
        session()->setFlashdata('produit_suppression', 'Le produit est supprimé');
        return redirect()->to(base_url('admin/produits'));
    }

    public function admin_categories($page = 'Catégories')
    {
        $data = array('title' => $page);
        $product = new ProductModel();
        $details_category =  $product->getCategoriesDetails();
        return view('admin/pages/categories', [
            'data' => $data,
            'details_category' => $details_category
        ]);
    }

    /*******************************************************************************************************/
    public function admin_category($id_category)
    {
        $data = array('title' => 'Catégories');
        $product = new ProductModel();
        return view('admin/pages/categories', [
            'data' => $data,
        ]);
    }
    /*******************************************************************************************************/

    public function admin_marques()
    {
        $data = array('title' => 'Marques');
        $product = new ProductModel();
        $brand = $product->getBrandsDetails();
        return view('admin/pages/marques', [
            'data' => $data,
            'brand' => $brand
        ]);
    }

    public function admin_commandes()
    {
        $data = array('title' => 'Commandes');
        $order = new OrderModel();
        $order_details = $order->orderDetailsAdmin();
        return view('admin/pages/commandes', [
            'data' => $data,
            'order_details' => $order_details
        ]);
    }

    public function admin_articles()
    {
        $data = array('title' => 'Articles');
        $article = new ArticleModel();
        $article_details = $article->getArticles();
        return view('admin/pages/articles', [
            'data' => $data,
            'article_details' => $article_details
        ]);
    }

    public function messageries($page = 'Messageries')
    {
        $data = array('title' => $page);
        $email = new AdminModel();
        $all_email = $email->getEmails();

        return view('admin/pages/messageries', ['data' => $data, 'all_email' => $all_email]);
    }

    public function read_email($id_email = null)
    {
        $data = array('title' => 'Email');
        $email = new AdminModel();
        $read_email = $email->getEmailById($id_email);
        $email->updateEmailStatus($id_email);


        return view('admin/pages/messageries', ['data' => $data, 'read_email' => $read_email]);
    }

    public function search_user()
    {
        $customer = new CustomerModel();
        if (!empty($this->request->getVar())) {
            $search = $this->request->getVar('value');
            $datas_search = $customer->search_users($search);
            echo json_encode(array(
                'result_search' => $datas_search
            ));
        }
    }
    public function search_product()
    {
        $product = new productModel();
        if (!empty($this->request->getVar())) {
            $search = $this->request->getVar('value');
            $datas_search = $product->search_products($search);
            echo json_encode(array(
                'result_search' => $datas_search
            ));
        }
    }
}
