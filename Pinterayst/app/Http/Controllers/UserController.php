<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Pin;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function start()
    {
        return view('StartPage.login');
    }



    public function login(Request $request)
    {
        $credential = [
            'user_name' => $request->user_name,
            'password' => $request->user_password
        ];
        if (Auth::attempt($credential)) {
            if (Auth::id() === 1) {
                return redirect()->route('admin_home');
            }
            return redirect()->route('home_page', ['user_id' =>   Auth::id()]);
        } else {
            // dd('fail');
            return back()->withErrors($credential);
        }
    }

    public function admin_delete_user($user_id)
    {
        $user_pins = Pin::where('user_id', '=', $user_id)->pluck('pin_id');
        Saved::whereIn('pin_id', $user_pins)->delete();
        Comment::whereIn('pin_id', $user_pins)->delete();
        Pin::where('user_id', '=', $user_id)->delete();
        Saved::where('user_id', '=', $user_id)->delete();
        Comment::where('user_id', '=', $user_id)->delete();
        User::destroy($user_id);
        return redirect()->route('admin_users');
    }

    public function admin_profile()
    {
        return view('Profile.admin_profile');
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('start');
    }

    public function create_page($user_id)
    {
        return view('Pins.create_pin', compact('user_id'));
    }

    public function regis_page()
    {
        return view('StartPage.register');
    }



    public function regis(Request $request)
    {
        // dd($request->user_url);
        $rules = [
            'user_url' => 'required|mimes:jpeg,png,jpg',
            'user_name' => 'required|min:5|max:23',
            'user_password' => 'required|min:5|max:23',
            'user_email' => 'required|email',
            'user_dob' => 'required|before:1/1/2006'
        ];
        $validation = Validator::make($request->all(), $rules);
        // dd(Storage::mimeType($request->user_url));
        if ($validation->fails()) {
            return back()->withErrors($validation);
        }
        $file = $request->file('user_url');
        $image_name = time() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs("public/images", $file, $image_name);
        $image_url = 'images/' . $image_name;
        $data = [
            'user_name' => $request->user_name,
            'user_password' => bcrypt($request->user_password),
            'user_email' => $request->user_email,
            'user_dob' => $request->user_dob,
            'user_bio' => $request->user_bio,
            'user_url' => $image_url,
            'user_role' => 'user',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        DB::table('users')->insert($data);
        // return view('StartPage.login');
        return redirect()->route('start');
    }

    public function profile_created($user_id)
    {
        $user = User::find($user_id);
        $pins = Pin::where('user_id', '=', $user_id)->paginate(8);
        return view('Profile.profile_created', compact('user', 'pins'));
    }

    public function profile_saved($user_id)
    {
        $user = User::find($user_id);
        $savedPinIds = Saved::where('user_id', '=', $user_id)->pluck('pin_id');
        // $pins = Pin::where('pin_id', '=', )->paginate(8);
        $pins = Pin::whereIn('pin_id', $savedPinIds)->paginate(8);
        return view('Profile.profile_saved', compact('user', 'pins'));
    }

    public function update_profile_page($user_id)
    {
        $user = User::find($user_id);
        return view('Profile.profile_update', compact('user'));
    }

    public function update_profile($user_id, Request $request)
    {
        $user = User::find($user_id);
        $image_url = null;
        if ($request->hasFile('user_url')) {
            $rules = [
                'user_url' => 'mimes:jpeg,png,jpg',
                'user_name' => 'min:5|max:23',
                'user_email' => 'email',
                'user_dob' => 'before:1/1/2006'
            ];
            $validation = Validator::make($request->all(), $rules);
            // dd(Storage::mimeType($request->user_url));
            if ($validation->fails()) {
                return back()->withErrors($validation);
            }
            $file = $request->file('user_url');
            $image_name = time() . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs("public/images", $file, $image_name);
            $image_url = 'images/' . $image_name;
        } else {
            $rules = [
                'user_name' => 'min:5|max:23',
                'user_email' => 'email',
                'user_dob' => 'before:1/1/2006'
            ];
            $validation = Validator::make($request->all(), $rules);
            // dd(Storage::mimeType($request->user_url));
            if ($validation->fails()) {
                return back()->withErrors($validation);
            }
            $image_url = $user->user_url;
        }

        $user->user_url = $image_url;
        $user->user_name = $request->user_name;
        $user->user_email = $request->user_email;
        $user->user_dob = $request->user_dob;
        $user->user_bio = $request->user_bio;
        $user->save();
        return redirect()->route('profile_created', ['user_id' => $user_id]);
    }

    public function guest_home()
    {
        $pins = Pin::paginate(12);
        return view('Homepage.guest_home', compact('pins'));
    }

    public function search_guest(Request $request)
    {
        $search = $request->searched;
        $pins = Pin::where('pin_title', 'LIKE', '%' . $search . '%')->paginate(12);
        return view('Homepage.guest_home', compact('pins'));
    }
}
