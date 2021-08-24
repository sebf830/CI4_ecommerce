<?php

namespace App\Controllers;

use App\Models\WebModel;
use App\Models\ProductModel;


class Home extends BaseController
{
	public function index($page = 'Accueil')
	{
		$data = ['title' => $page];
		$product = new WebModel();
		$popular_products = $product->get_popular_products();
		$slider_products = $product->get_slider_products();
		$feature_product = $product->get_all_featured_product();
		$new_products = $product->get_all_new_product();


		return view(
			'web/pages/home',
			[
				'popular_prod' => $popular_products,
				'sliders_products' => $slider_products,
				'data' => $data,
				'featured' => $feature_product,
				'news_products' => $new_products,
			]
		);
	}

	public function ajax_accept_cookie()
	{
		helper("cookie");
		if ($this->request->getVar('accept') == true) {
			set_cookie("Venus-Shop", 'acceptation des cookies', 24 * 3600);
		} else {
			set_cookie("Venus-Shop", "Refus des cookies", 24 * 3600);
		}
	}



	public function produit($id)
	{
		$data  = array('title' => 'Produits');
		$product = new WebModel();
		$list = new ProductModel();

		//datas du produit séléctionné
		$single = $product->getProductById($id);
		//affichage liens catégories
		$categories  = $product->getAllCategory();
		//produits slider suggestions
		$all_products = $list->getProducts();
		//on récupère la wishlist
		$liked_product = $list->getWishListAllItems(session()->get('customer_id'));
		$like = [];

		//on crée un tableau des produit favoris du client...
		//..pour verifier si le produit déja dans les favoris
		foreach ($liked_product as $liked) {
			array_push($like, $liked['product_id']);
		}
		//liste des produits déja évalués par le client
		$hasRank = $list->hasRank(session()->get('customer_id'), $id);

		//on recupère l'évaluation du produit
		$avg = $list->averageRank($id);
		if ($avg['rank']) {
			//on récupère les commentaires du produit
			$comments = $list->getComments($id);
			// //on récupère le nombre d'évaluation du produit
			$total_vote = $list->getTotalVote($id);
			//on compte les votes 5 étoiles
			$five = $list->getEvaluationsByRank(5, $id);
			//on traduit les votes 5 etoiles en pourcentage du total de vote
			$five_ranking_percent = $list->getRankPercentByProduct($five['id_ranking'], $total_vote['id_ranking']);
			//on compte les votes 4 étoiles
			$four = $list->getEvaluationsByRank(4, $id);
			//on traduit les votes 4 etoiles en pourcentage du total de vote...
			$four_ranking_percent = $list->getRankPercentByProduct($four['id_ranking'], $total_vote['id_ranking']);
			//and so on..
			$three = $list->getEvaluationsByRank(3, $id);
			$three_ranking_percent = $list->getRankPercentByProduct($three['id_ranking'], $total_vote['id_ranking']);
			$two = $list->getEvaluationsByRank(2, $id);
			$two_ranking_percent = $list->getRankPercentByProduct($two['id_ranking'], $total_vote['id_ranking']);
			$one = $list->getEvaluationsByRank(1, $id);
			$one_ranking_percent = $list->getRankPercentByProduct($one['id_ranking'], $total_vote['id_ranking']);



			return view('web/pages/produit', [
				'data' => $data,
				'single' => $single,
				'categories' => $categories,
				'like' => $like,
				'all_products' => $all_products,
				'hasRank' => $hasRank,
				'avg' => $avg,
				'comments' => $comments,
				'five_ranking_percent' => $five_ranking_percent,
				'four_ranking_percent' => $four_ranking_percent,
				'three_ranking_percent' => $three_ranking_percent,
				'two_ranking_percent' => $two_ranking_percent,
				'one_ranking_percent' => $one_ranking_percent
			]);
		} else {
			return view('web/pages/produit', [
				'data' => $data,
				'single' => $single,
				'categories' => $categories,
				'like' => $like,
				'all_products' => $all_products,
				'hasRank' => $hasRank,
				'avg' => $avg
			]);
		}
	}

	public function product_comment($id_produit)
	{
		$data  = array('title' => 'Avis');
		$product = new WebModel();
		$single = $product->getProductById($id_produit);

		if (session()->get('customer_id')) {
			return view('web/pages/product_comment', [
				'data' => $data,
				'single' => $single,
			]);
		} else {
			return redirect()->to(base_url('client/connexion'));
		}
	}

	public function ajax_comment_datas()
	{
		$insert = [
			'rank' => trim($this->request->getVar('rank')),
			'customer_id' => session()->get('customer_id'),
			'product_id' =>  trim($this->request->getVar('product_id')),
			'customer_comment' => trim($this->request->getVar('comment')),
			'title_comment' => trim($this->request->getVar('title'))
		];
		$product = new ProductModel();

		if ($hasRank = $product->createCustomerRanking($insert)) {
			echo json_encode(array('msg' => 'Votre commentaire est bien pris en compte'));
		} else {
			echo json_encode(array('msg' => 'Vous avez déja noté ce produit <a href="#" onclick="window.history.go(-1)">retour</a>'));
		}
	}

	public function ajax_wishlist()
	{
		$data = $this->request->getVar('id_produit');
		$product = new ProductModel();
		$product->createWishlist(session()->get('customer_id'));
		$id_wishlist = $product->getWishlist(session()->get('customer_id'));
		$insert = [
			'id_wishlist' => $id_wishlist['id_wishlist'],
			'product_id' => $data
		];
		if (!$product->check_wishlist_item($data, $id_wishlist['id_wishlist'])) {
			$product->addToWishlist($insert);
		} else {
			$product->removeFromWishlist($data, $id_wishlist['id_wishlist']);
		}
	}

	public function produits()
	{
		$data  = array('title' => 'Produits');
		$product = new ProductModel();
		$product->findAll();
		//$product->get_all_product();
		//$produits = $product->findAll();
		return view('web/pages/produits', ['data' => $data, 'produits' => $product->paginate(8), 'pager' => $product->pager]);
	}

	public function categories($page = 'Catégories')
	{
		$data = array('title' => $page);
		$category = new WebModel();
		$categories = $category->getAllCategory();
		return view('web/pages/categories_page', ['data' => $data, 'categories' => $categories]);
	}

	public function category_post($id)
	{
		$data = array('title' => 'Catégories');
		$product = new WebModel();
		$allCategories = $product->get_all_product_by_cat($id);
		$category = $product->getCategoryById($id);
		return view('web/pages/category', ['data' => $data, 'category' => $category, 'allCategories' => $allCategories]);
	}

	public function contactPage($page = 'Contact')
	{
		$data  = array('title' => $page);
		$option =  new WebModel();
		$options_contact = $option->get_contact_options();

		if ($this->request->getMethod() == 'post') {
			$values = $this->request->getVar();

			$rules = [
				'nom' => 'trim|required|min_length[2]|max_length[30]',
				'email' => 'trim|required|valid_email',
				'objet' => 'trim|required|min_length[3]|max_length[200]',
				'sujet' => 'trim|required|min_length[3]|max_length[500]',
			];
			$message = [
				'nom' => [
					'required' => 'Merci de remplir un nom',
					'min_length' => 'Le nom doit comporter au moins 2 lettres',
					'max_length' => 'Le nom choisi est trop long'
				],
				'email' => [
					'required' => 'Merci de remplir un mail',
					'valid_email' => 'Veuillez renseigner un email valide : adresse@messagerie.fr'
				],
				'objet' => [
					'required' => 'Merci de remplir un numero de téléphone',
					'min_length' => 'l\'objet doit comporter 3 lettres minimum',
					'max_length' => 'l\'objet décrit est trop long',
				],
				'sujet' => [
					'required' => 'Veuillez renseigner un texte',
					'min_length' => 'Votre texte semble court',
					'max_length' => 'Le sujet ne doit pas dépasser 500 caractères'

				],
			];
			$validation = \Config\Services::validation();

			if (!$this->validate($rules, $message)) {
				return view('web/pages/contact', ['validation' => $this->validator, 'values' => $values, 'options_contact' => $options_contact, 'data' => $data]);
			} else {
				$success = 'Nous avons bien reçu votre message';
				if (session()->get('customer_id')) {
					$idSession = session()->get('customer_id');
					$isCustomer = 1;
				} else {
					$idSession = null;
					$isCustomer = 0;
				}
				$data_sending = [
					'sender_name' => $this->request->getVar('nom'),
					'sender_email' => $this->request->getVar('email'),
					'object_email' => $this->request->getVar('objet'),
					'msg_email' => $this->request->getVar('sujet'),
					'is_customer' => $isCustomer,
					'id_customer' => $idSession,
				];
				$send_email = new WebModel();
				if ($send_email->save_email_customer($data_sending)) {
					$email = new Email();
					$email->customer_email($this->request->getVar('email'), $this->request->getVar('objet'), $this->request->getVar('sujet'), $this->request->getVar('nom'));
				}

				return view('web/pages/contact', ['data' => $data, 'options_contact' => $options_contact, 'success' => $success]);
			}
		}

		return view('web/pages/contact', ['data' => $data, 'options_contact' => $options_contact]);
	}




	public function search($page = 'Recherche')
	{
		$data = array('title' => $page);
		$search = new WebModel();

		$datas = $search->randCategory();
		shuffle($datas);
		$random_category = 	$datas[0];
		$random_category = $search->get_product_by_category_limt($random_category);
		$datas = $search->randCategory();

		if ($this->request->getMethod() == 'post') {

			$value = $this->request->getVar('search');
			$result_search = $search->get_all_search_product($value);
			if (empty($this->request->getVar('search'))) {
				return view('web/pages/error', ['data' => $data, 'random_category' => $random_category]);
			}
			if (count($result_search) > 0) {
				return view('web/pages/search', ['result_search' => $result_search, 'data' => $data, 'value' => $value]);
			} else {
				return view('web/pages/error', ['data' => $data, 'random_category' => $random_category]);
			}
		}
		return view('web/pages/search', ['data' => $data]);
	}
}
