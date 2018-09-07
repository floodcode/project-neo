<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\MainController;
use Illuminate\Http\Request;

class HomeController extends MainController
{
    public function index()
    {
        return $this->render('home.index');
    }
}
