<?php

namespace App\Controllers;

use App\Models\ArticleModel;


class Blog extends BaseController
{

    public function index($page = 'Blog')
    {
        $data = ['title' => $page];
        $article = new ArticleModel();
        $getArticles = $article->getArticles();
        $lastFiveArticles = $article->getLastArticles(5);
        $categories = $article->getCategories();
        $url = explode('/', current_url(true));

        return view('web/pages/blog', [
            'data' => $data,
            'getArticles' => $getArticles,
            'lastFiveArticles' => $lastFiveArticles,
            'categories' => $categories,
            'url' => $url,
        ]);
    }
    public function read_article($id)
    {
        $data = ['title' => 'Blog'];
        $article = new ArticleModel();
        $getArticle = $article->getArticleById($id);
        $lastFiveArticles = $article->getLastArticles(5);
        $categories = $article->getCategories();
        $url = explode('/', current_url(true));

        return view('web/pages/blog', [
            'data' => $data,
            'getArticle' => $getArticle,
            'lastFiveArticles' => $lastFiveArticles,
            'categories' => $categories,
            'url' => $url,


        ]);
    }

    public function categorie($id)
    {
        $data = ['title' => 'Blog'];
        $article = new ArticleModel();
        $getArticles = $article->getArticles();
        $lastFiveArticles = $article->getLastArticles(5);
        $categories = $article->getCategories();
        $articles_category = $article->getArticleByIdCategory($id);
        $idCat = $article->getCategoriesById($id);
        $default_result = $article->getLastArticles(3);

        $url = explode('/', current_url(true));
        return view('web/pages/blog', [
            'data' => $data,
            'getArticles' => $getArticles,
            'lastFiveArticles' => $lastFiveArticles,
            'categories' => $categories,
            'url' => $url,
            'articles_category' => $articles_category,
            'idCat' => $idCat,
            'default_result' => $default_result
        ]);
    }

    public function blog_search($page = 'Blog')
    {
        $data = ['title' => $page];
        if (!empty($this->request->getVar('search_blog'))) {
            $request = trim($this->request->getVar('search_blog'));
            $article = new ArticleModel();
            $url = explode('/', current_url(true));
            $search_result  = $article->search_article($request);
            $lastFiveArticles = $article->getLastArticles(5);
            $categories = $article->getCategories();
            return view('web/pages/blog', [
                'data' => $data,
                'url' => $url,
                'search_result' => $search_result,
                'lastFiveArticles' => $lastFiveArticles,
                'categories' => $categories,
            ]);
        } else {
            return redirect()->to(base_url('blog'));
        }
    }
}
