<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuthController
 * @package App\Http\Controllers\Dashboard\Auth
 */
class AuthController extends BaseApiController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
    {
        try {
            return view('dashboard.auth.login');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        try {
            $rules = [
                'password' => 'required',
                'email' => 'email|required'
            ];
            $credentials = $request->only('password', 'email');
            $validator = Validator::make($credentials, $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag());
            }
            if ($token = Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                session()->push('showToastr', 'msg');
                return redirect(route('dashboard.home'));
            } else {
                return redirect()->back()->withErrors('المعلومات المدخلة غير صحيحة');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        try {
            if (Auth::check()) {
                Auth::logout();
            }
            return redirect(route('dashboard.PageLogin'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
