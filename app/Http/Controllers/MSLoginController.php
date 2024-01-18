<?php

namespace App\Http\Controllers;

use App\Services\MoySklad\Api\Api;
use App\Services\User;
use Illuminate\Http\Request;

class MSLoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth(Request $request, )
    {
        $validated = $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'pass' => ['required', 'string', 'max:255'],
        ]);

        $login = $validated['login'];
        $pass = $validated['pass'];

        $api = new Api($login, $pass);

        $response = $api->fast('security/token', 'POST');

        if (isset($response['access_token'])) {
            User::save($login, $pass);
            return redirect()->route('index');
        }

        session()->flash('login', $login);
        session()->flash('pass', $pass);
        return back()->withErrors('error');
    }

    public function logout()
    {
        User::logout();
        return redirect()->to('login');
    }
}
