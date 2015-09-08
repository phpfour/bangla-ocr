<?php

namespace App\Http\Controllers;

use App\Services\Google;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /** @var Google */
    private $google;

    /** @var UserRepository */
    private $userRepository;

    public function __construct(Google $google, UserRepository $userRepository)
    {
        $this->google = $google;
        $this->userRepository = $userRepository;
    }

    public function getLogin()
    {
        $client = $this->google->getClient();
        return redirect($client->createAuthUrl());
    }

    public function getLogout(Request $request)
    {
        $request->session()->clear();
        return redirect('/')->with('message', 'Successfully logged out.');
    }

    public function getCallback(Request $request)
    {
        $client = $this->google->getClient();
        $client->authenticate($_GET['code']);

        $token = $client->getAccessToken();
        $request->session()->put('access_token', $token);

        $profile = $this->google->getProfile();
        $user = $this->userRepository->createOrUpdate($profile, $token);

        Auth::login($user);

        return redirect('/')->with('message', 'Successfully logged in with Google.');
    }
}