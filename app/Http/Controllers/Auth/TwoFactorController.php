<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Notifications\TwoFactorCode;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class TwoFactorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'twofactor']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.twoFactor');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'integer|required',
        ]);
        try {
            $user = auth()->user();

            if ($request->input('two_factor_code') == $user->two_factor_code) {

                if ($user->is_deleted == 1) {
                    throw new \Exception("User no longer registered with us.");
                }
                return $this->redirectUserByRole();
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['two_factor_code' => $e->getMessage()]);
        }
        return redirect()->back()->withErrors(['two_factor_code' => 'The two factor code you have entered does not match']);
    }

    /**
     * @return mixed
     */
    public function resend()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());

        return redirect()->back()->withMessage('The two factor code has been sent again');
    }

    /**
     * This function is written to override the provider function of auth
     * Added at: 29 Sep 2021
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function redirectUserByRole()
    {
        switch (auth()->user()->role_id) {
            case Role::SUPER_ADMIN:
                return redirect()->route('admin.dashboard');
            case Role::USER:
                return redirect()->route('user.dashboard');
            case Role::SALES_MANAGER:
                return redirect()->route('sales.dashboard');
        }
    }
}
