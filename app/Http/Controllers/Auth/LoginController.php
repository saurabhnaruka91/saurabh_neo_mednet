<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOTP;
use App\Models\Role;
use App\Notifications\TwoFactorCode;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * This function is written For Login
     * Added at: 29 Sep 2021
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
//    public function login(Request $request)
//    {
//        try {
//            $input = $request->all();
//
//            $this->validate($request, [
//                'email' => 'required|email',
//                'password' => 'required',
//            ]);
//            if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
//                if (auth()->user()->is_deleted == 1) {
//                    throw new \Exception("User no longer registered with us.");
//                }
////                return $this->redirectUserByRole();
//            }
//            throw new \Exception("Email-Address And Password Are Wrong.");
//        } catch (\Exception $e) {
//            return redirect()->route('login')
//                ->with('error', $e->getMessage());
//        }
//    }

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

    /**
     * The user has been authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());
    }
}
