<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\MainController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends MainController
{
    public function index()
    {
        return $this->render('user.index');
    }

    public function view($id)
    {
        $user = User::findOrFail($id);

        return $this->render('user.view', [
            'user' => $user
        ]);
    }
}
