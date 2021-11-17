<?php

namespace DrPeter\LockUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LockUserController extends Controller
{
    /**
     * Show lock screen
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLockScreen()
    {
        return view('userlock::lockscreen');
    }

    /**
     * Lock authenticated user
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function lockUser(Request $request)
    {
        if(!Session::get('locked', false)) {
            Session::put('locked', true);
        }
        $json = [
            'locked' => Session::get('locked', false),
        ];
        return response()->json($json);
    }

    /**
     * Unlock authenticated user
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function unlockUser(Request $request)
    {
        if(Hash::check($request->password, Auth::user()->password)) {
            if(Session::has('locked')) {
                Session::put('locked', false);
            }
            return redirect(url()->previous());
        } else {
            return redirect(url()->previous())->with('pass_incorrect', __('auth.password'));
        }
        return redirect(url()->previous());
    }
}
