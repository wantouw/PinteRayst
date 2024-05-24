<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $search = $request->searched;
        $pins = Pin::where('pin_title', 'LIKE', '%' . $search . '%')->paginate(12);
        return view('Homepage.home', compact('pins', 'search'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home_page($user_id)
    {
        $pins = Pin::where('user_id', '!=', $user_id)->paginate(12);
        return view('Homepage.home', compact('pins'));
    }

    public function admin_home()
    {
        $pins = Pin::paginate(12);
        return view('Homepage.admin_home', compact('pins'));
    }

    public function admin_users()
    {
        $users = User::where('user_id', '!=', 1)->paginate(12);
        return view('Homepage.admin_users', compact('users'));
    }

    public function search_admin(Request $request)
    {
        $search = $request->searched;
        $pins = Pin::where('pin_title', 'LIKE', '%' . $search . '%')->paginate(12);
        return view('Homepage.admin_home', compact('pins', 'search'));
    }
}
