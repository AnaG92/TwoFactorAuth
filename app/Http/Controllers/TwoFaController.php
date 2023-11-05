<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCredentialsRequest;
use App\Http\Requests\ValidateCodeRequest;
use App\Repositories\UserRepositoryInterface;
use App\Services\TwoFactorServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class TwoFaController extends Controller
{
    public function __construct(
        public UserRepositoryInterface $userRepository,
        public TwoFactorServiceInterface $twoFactorService
    ) {
    }

    public function index(): View
    {
        return view('twoFa.index');
    }

    public function store(StoreCredentialsRequest $request): View
    {
        $label = $request->input('label');
        $username = $request->input('username');

        // Get the logged user from the repo
        $user = $this->userRepository->getUserByUsername($username);
        $user->label = $label;

        // Generate the secret for the TOTP codes
        $this->twoFactorService->link($user);

        return view('twoFa.qrCode', [
            'label'     => $user->label,
            'username'  => $user->username,
            'qrCode'    => $user->twoFactorQrCodeSvg(),
            'id'        => $user->id
        ]);
    }

    public function setCode(): View
    {
        return view('twoFa.setCode');
    }

    public function validateCode(ValidateCodeRequest $request): View|RedirectResponse
    {
        $username = $request->input('username');
        $user = $this->userRepository->getUserByUsername($username);

        try {
            $code = $request->input('code');
            $this->twoFactorService->verify($user, $code);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors([
                'code' => $e->getMessage()
            ]);
        }

        return view('twoFa.success', [
            'username' => $user->username
        ]);
    }
}
