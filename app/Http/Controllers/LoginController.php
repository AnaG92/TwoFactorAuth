<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCredentialsRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\View\View;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;

class LoginController extends Controller
{
    public function __construct(public UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('login.index');
    }

    public function store(
        StoreCredentialsRequest $request,
        EnableTwoFactorAuthentication $twoFa
    ): View {

        $label = $request->input('label');
        $username = $request->input('username');

        // Get the logged user from the repo
        $user = $this->userRepository->getUserByUsername($username);
        $user->label = $label;

        // Generate the secret for the TOTP codes
        $twoFa->__invoke($user);

        return view('login.qrCode', [
            'label'     => $user->label,
            'username'  => $user->username,
            'qrCode'    => $user->twoFactorQrCodeSvg()
        ]);
    }
}
