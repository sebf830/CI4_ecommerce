<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

//home
$routes->get('/',  function () {
	return redirect()->to(base_url('home'));
});
$routes->get('home', 'Home::index');

//web
$routes->match(['get', 'post'], '/produit/(:num)', 'Home::produit/$1');
$routes->get('/produits', 'Home::produits');
$routes->get('/categories', 'Home::categories');
$routes->get('/categorie/(:num)', 'Home::category_post/$1');
$routes->match(['get', 'post'], '/contact', 'Home::contactPage');
$routes->match(['get', 'post'], '/search', 'Home::search');
$routes->post('ajax_wishlist', 'Home::ajax_wishlist');
$routes->get('blog', 'Blog::index');
$routes->get('article/(:num)', 'Blog::read_article/$1');
$routes->get('/categorie_blog/(:num)', 'Blog::categorie/$1');
$routes->match(['get', 'post'], 'recherche_blog', 'Blog::blog_search');
$routes->get('/about', 'Home::about_page');


//shopping cart
$routes->get('/panier', 'Cart::index');
$routes->get('/panier/ajouter/(:num)', 'Cart::add_to_cart/$1');
$routes->match(['get', 'post'], 'panier/modifier', 'Cart::update_cart');
$routes->match(['get', 'post'], 'panier/supprimer/(:num)', 'Cart::remove_cart/$1');
$routes->match(['get', 'post'], '/checkout',  'Checkout::index');
$routes->get('/order_confirmation', 'Checkout::confirmation');
$routes->get('/exit_order', 'Checkout::exit_order');

//client-connexion/inscription
$routes->get('/connexion', 'customer::login_page');
$routes->post('/client/connexion', 'Customer::client_login',  ['filter' => 'noauth']);
$routes->match(['get', 'post'], '/client/inscription', 'Customer::client_register', ['filter' => 'noauth']);
$routes->match(['get', 'post'], '/client/reinitialiser', 'Customer::send_password', ['filter' => 'noauth']);
$routes->get('/logout', 'Customer::logout');

//page client
$routes->match(['get', 'post'], '/profile', 'Customer::profile_page', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/profile/informations', 'Customer::profile_informations', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/profile/history', 'Customer::profile_history', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/profile/history/(:num)', 'Customer::profile_history_details/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/profile/wishlist', 'Customer::profile_wishlist', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/profile/avantage', 'Customer::profile_avantage', ['filter' => 'auth']);
$routes->get('/profile/messagerie', 'Customer::profile_messagerie', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/profile/messagerie/(:num)', 'Customer::profile_messagerie/$1', ['filter' => 'auth']);
$routes->post('ajax_msg', 'Customer::ajax_msg');

//admin-connexion
$routes->match(['get', 'post'], '/admin', 'Admin::login',  ['filter' => 'noauth']);
$routes->get('/admin/deconnexion', 'Admin::admin_logout');

//dashboard
$routes->get('/admin/dashboard', 'Dashboard::index', ['filter' => 'auth']);

//dashboard clients
$routes->get('/admin/clients', 'Dashboard::admin_clients', ['filter' => 'auth']);
$routes->post('search_user', 'Dashboard::search_user');

//dashboard produits
$routes->get('/admin/produits', 'Dashboard::admin_produits', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/admin/produit/(:num)', 'Dashboard::admin_produit/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/admin/produit/supprimer/(:num)', 'Dashboard::delete_produit/$1', ['filter' => 'auth']);
$routes->post('search_product', 'Dashboard::search_product');
$routes->match(['get', 'post'], '/produit/avis/(:num)', 'Home::product_comment/$1', ['filter' => 'auth']);
$routes->post('ajax_comment_datas', 'Home::ajax_comment_datas');
$routes->match(['get', 'post'], '/admin/produit/new', 'Dashboard::produit_new', ['filter' => 'auth']);

//dashboard categories
$routes->get('/admin/categories', 'Dashboard::admin_categories', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/admin/category/(:num)', 'Dashboard::admin_category/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/admin/category/new', 'Dashboard::category_new', ['filter' => 'auth']);
$routes->get('admin/supprimer_categorie/(:num)', 'Dashboard::delete_category/$1');

//dashboard marques
$routes->get('/admin/marques', 'Dashboard::admin_marques', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/admin/marque/(:num)', 'Dashboard::admin_marque/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/admin/marque/new', 'Dashboard::marque_new', ['filter' => 'auth']);
$routes->get('admin/marque/supprimer/(:num)', 'Dashboard::delete_brand/$1');

//dashboard orders
$routes->get('/admin/commandes', 'Dashboard::admin_commandes', ['filter' => 'auth']);

//dashboard blog
$routes->get('/admin/articles', 'Dashboard::admin_articles', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/admin/article/(:num)', 'Dashboard::admin_article/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/admin/article/new', 'Dashboard::article_new', ['filter' => 'auth']);
$routes->get('admin/article/supprimer/(:num)', 'Dashboard::delete_article/$1');


//dashboard messagerie
$routes->match(['get', 'post'], '/admin/messages', 'Dashboard::messageries', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/admin/email/(:num)', 'Dashboard::read_email/$1', ['filter' => 'auth']);


//validation email
$routes->get('validation/(:any)', 'Customer::active_account/$1');

//RGPD
$routes->post('accept_cookie', 'Home::ajax_accept_cookie');

//erreur recherche
$routes->get('/erreur', 'Errors::error');
//erreur 404
$routes->set404Override(function () {
	return view('web/pages/404');
});

//tools accessible via CLI uniquement
$routes->cli('tools/message/(:segment)', 'Tools::message/$1');

//payments 
$routes->get("stripe", "StripeController::stripe");
$routes->post("payment", "StripeController::payment");




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
