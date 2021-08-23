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
use App\Models\CategoryModel;



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

    /*********************************************************************/
    /******************** ADMIN PRODUITS BOUTIQUE ************************/
    /*********************************************************************/

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
        $category = new CategoryModel();
        $data_product = $product->getProductByIdWithDetails($id_produit);
        $categories = $category->getProductCategory();

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

    public function delete_produit($id)
    {
        $product = new ProductModel();
        $product->deleteProduct($id);
        session()->setFlashdata('produit_suppression', 'Le produit est supprimé');
        return redirect()->to(base_url('admin/produits'));
    }

    /*********************************************************************/
    /************************* ADMIN CLIENTS *****************************/
    /*********************************************************************/

    public function admin_clients($page = "Clients")
    {
        $data = array('title' => $page);
        $customer = new CustomerModel();
        $getAll = $customer->getCustomers();

        return view('admin/pages/clients', ['data' => $data, 'getAll' => $getAll]);
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

    /*********************************************************************/
    /********************** ADMIN CATEGORIES *****************************/
    /*********************************************************************/


    public function admin_categories($page = 'Catégories')
    {
        $data = array('title' => $page);
        $product = new CategoryModel();
        $details_category =  $product->getCategoriesDetails();
        return view('admin/pages/categories', [
            'data' => $data,
            'details_category' => $details_category
        ]);
    }

    public function admin_category($id_category)
    {
        $data = array('title' => 'Catégories');
        $category = new CategoryModel();
        $details_category = $category->get_category_detail_byId($id_category);


        if ($this->request->getMethod() == 'post') {
            //upload image
            if (in_array('upload_image', $this->request->getVar())) {
                $file = $this->request->getFile('file');

                $type = $file->getClientMimeType();
                $valid = array("image/png", "image/jpeg", "image/jpg");

                if (in_array($type, $valid)) {
                    $name = $file->getName();
                    $file->move('public/uploads', $name);
                    session()->setFlashdata('msg_success', 'Image modifiée avec succès');
                    session()->setFlashdata('image', $name);
                }
            }

            //traitement formulaire right
            if (in_array('edit_category', $this->request->getVar())) {
                $values = $this->request->getVar();

                $rules = [
                    'title' => 'trim|required|min_length[2]|max_length[30]',
                    'description' => 'trim|required|min_length[5]'
                ];
                $message = [
                    'title' => [
                        'required' => 'Merci de remplir un nom',
                        'min_length' => 'Le titre doit comporter au moins 2 lettres',
                        'max_length' => 'Le titre choisi est trop long'
                    ],
                    'description' => [
                        'required' => 'Merci de remplir une adresse email',
                        'min_length' => 'La description doit comporter au moins 5 caractères',
                        'max_length' => 'La description choisi est trop long'
                    ]
                ];

                $validation = \Config\Services::validation();

                if (!$this->validate($rules, $message)) {
                    return view('admin/pages/category_editer', ['validation' => $this->validator, 'values' => $values, 'data' => $data]);
                } else {
                    $name_image = session()->setFlashdata('image') ? session()->setFlashdata('image') : $details_category['category_img'];
                    $insert_data = [
                        'id' => $id_category,
                        'category_name' => $values['title'],
                        'category_description' => $values['description'],
                        'category_img' => $name_image,
                    ];
                    $category = new CategoryModel();
                    $category->update_category($insert_data);
                    session()->setFlashdata('success_category', 'La catégorie est modifiée');
                    return redirect()->to(base_url('admin/categories'));
                }
            }
        }
        return view('admin/pages/category_editer', [
            'data' => $data,
            'details_category' => $details_category
        ]);
    }

    public function category_new($page = 'Catégories')
    {
        $data = array('title' => $page);

        if ($this->request->getMethod() == 'post') {
            //upload image
            if (in_array('upload_image', $this->request->getVar())) {
                $file = $this->request->getFile('file');

                $type = $file->getClientMimeType();
                $valid = array("image/png", "image/jpeg", "image/jpg");

                if (in_array($type, $valid)) {
                    $name = $file->getName();
                    $file->move('public/uploads', $name);
                    session()->setFlashdata('msg_success', 'Image uploadée avec succès');
                    session()->setFlashdata('image', $name);
                }
            }

            if (in_array('new_category', $this->request->getVar())) {
                $values = $this->request->getVar();

                $rules = [
                    'title' => 'trim|required|min_length[2]|max_length[30]',
                    'description' => 'trim|required|min_length[5]'
                ];
                $message = [
                    'title' => [
                        'required' => 'Merci de remplir un nom',
                        'min_length' => 'Le titre doit comporter au moins 2 lettres',
                        'max_length' => 'Le titre choisi est trop long'
                    ],
                    'description' => [
                        'required' => 'Merci de remplir une adresse email',
                        'min_length' => 'La description doit comporter au moins 5 caractères',
                        'max_length' => 'La description choisi est trop long'
                    ]
                ];

                $validation = \Config\Services::validation();

                if (!$this->validate($rules, $message)) {
                    return view('admin/pages/categories_creer', ['validation' => $this->validator, 'values' => $values, 'data' => $data]);
                } else {
                    if (!session()->getFlashdata('image')) {
                        $noImage = 'veuillez choisir une image de catégorie';
                        return view('admin/pages/categories_creer', [
                            'data' => $data,
                            'noImage' => $noImage
                        ]);
                    } else {
                        $insert_data = [
                            'category_name' => $values['title'],
                            'category_description' => $values['description'],
                            'category_img' => session()->getFlashdata('image'),
                            'publication_status' => 1
                        ];
                        $category = new CategoryModel();
                        $category->create_category($insert_data);
                        session()->setFlashdata('success_category', 'La catégorie est crée');
                        return redirect()->to(base_url('admin/categories'));
                    }
                }
            }
        }
        return view('admin/pages/categories_creer', [
            'data' => $data,
        ]);
    }

    public function delete_category($id_categorie)
    {
        $category = new CategoryModel();
        $category->deleteCategory($id_categorie);
        session()->setFlashdata('success_category', 'La catégorie est supprimée');
        return redirect()->to(base_url('admin/categories'));
    }


    /********************************************************************/
    /************************* ADMIN MARQUES ****************************/
    /********************************************************************/

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

    /********************************************************************/
    /************************* ADMIN ORDERS *****************************/
    /********************************************************************/
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


    /********************************************************************/
    /********************** ADMIN BLOG ARTICLES *************************/
    /********************************************************************/
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

    /********************************************************************/
    /************************ ADMIN MESSAGERIE **************************/
    /********************************************************************/

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
}
