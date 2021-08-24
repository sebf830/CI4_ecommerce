<?php

namespace App\Controllers;

use App\Models\WebModel;
use App\Models\ProductModel;


class Errors extends BaseController
{

    public function error($page = 'erreur')
    {
        $data = array('title' => $page);
        return view('web/pages/erreur', ['data' => $data]);
    }

    public function show_404_page($page = '404')
    {
        $data = array('title' => $page);
        return view('web/pages/404', ['data' => $data]);
    }
}
