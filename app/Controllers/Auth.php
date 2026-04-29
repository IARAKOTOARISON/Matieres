<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $model = new UserModel();

        $email = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));

        // ❌ validation champs vides
        if ($email == '' || $password == '') {
            return redirect()->to('/login')
                ->with('error', 'Veuillez remplir tous les champs');
        }

        // 🔍 recherche user
        $user = $model->where('email', $email)
                      ->where('password', $password)
                      ->first();

       if ($user) {
    session()->set([
        'user' => $user['email']
    ]);

    return redirect()->to('/list');
}

        // ❌ erreur login
        return redirect()->to('/login')
            ->with('error', 'Identifiants incorrects');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}