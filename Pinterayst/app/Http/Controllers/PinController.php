<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Pin;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PinController extends Controller
{
    //
    public function detail_page($pin_id){
        $pin = Pin::find($pin_id);
        $user = User::find($pin->user_id);
        $isSaved = Saved::where('user_id', '=', Auth::id())->where('pin_id', '=', $pin_id)->get();
        $comments = Comment::where('pin_id', '=', $pin_id)->get();
        return view('Pins.pin_detail', compact('pin', 'user', 'isSaved', 'comments'));
    }
    public function save($pin_id, $user_id){
        DB::table('saveds')->insert([
            'user_id' => $user_id,
            'pin_id' => $pin_id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        return back();
    }
    public function unsave($pin_id, $user_id){
        Saved::where('user_id', '=', $user_id)
         ->where('pin_id', '=', $pin_id)
         ->delete();
        return back();
    }
    public function create(Request $request){
        $rules = [
            'pin_url' => 'required|mimes:jpeg,png,jpg',
            'pin_title' => 'required|min:5|max:23'
        ];
        $validation = Validator::make($request->all(), $rules);
        if($validation->fails()){
            return back()->withErrors($validation);
        }
        $file = $request->file('pin_url');
        $image_name = time().'.'.$file->getClientOriginalExtension();
        Storage::putFileAs("public/images", $file, $image_name);
        $image_url = 'images/'.$image_name;
        $data = [
            'user_id' => Auth::id(),
            'pin_url' => $image_url,
            'pin_title' => $request->pin_title,
            'pin_desc' => $request->pin_desc,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        DB::table('pins')->insert($data);
        return redirect()->route('home_page', ['user_id' =>   Auth::id()]);
    }

    public function update_pin_page($pin_id){
        $pin = Pin::find($pin_id);
        return view('Pins.created_update', compact('pin'));
    }

    public function admin_pin_detail($pin_id){
        $pin = Pin::find($pin_id);
        $user = User::find($pin->user_id);
        $comments = Comment::where('pin_id', '=', $pin_id)->get();
        return view('Pins.admin_pin_detail', compact('pin', 'user', 'comments'));
    }

    public function created_pin_detail($pin_id){
        $pin = Pin::find($pin_id);
        $user = User::find($pin->user_id);
        $comments = Comment::where('pin_id', '=', $pin_id)->get();
        return view('Pins.created_detail', compact('pin', 'user', 'comments'));
    }

    public function admin_delete_pin($pin_id){
        Saved::where('pin_id', '=', $pin_id)->delete();
        Comment::where('pin_id', '=', $pin_id)->delete();
        Pin::destroy($pin_id);
        return redirect()->route('admin_home');
    }

    public function delete_pin($pin_id){
        Saved::where('pin_id', '=', $pin_id)->delete();
        Comment::where('pin_id', '=', $pin_id)->delete();
        Pin::destroy($pin_id);
        return redirect()->route('profile_created', ['user_id'=>Auth::id()]);
    }

    public function update_pin($pin_id, Request $request){
        $pin = Pin::find($pin_id);
        $image_url=null;
        if($request->hasFile('pin_url')){
            $rules = [
                'pin_url' => 'mimes:jpeg,png,jpg',
                'pin_title' => 'min:5|max:23'
            ];
            $validation = Validator::make($request->all(), $rules);
            if($validation->fails()){
                return back()->withErrors($validation);
            }
            $file = $request->file('pin_url');
            $image_name = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs("public/images", $file, $image_name);
            $image_url = 'images/'.$image_name;
        }
        else{
            $rules = [
                'pin_title' => 'min:5|max:23'
            ];
            $validation = Validator::make($request->all(), $rules);
            if($validation->fails()){
                return back()->withErrors($validation);
            }
            $image_url = $pin->pin_url;
        }
        $pin->pin_url = $image_url;
        $pin->pin_title = $request->pin_title;
        $pin->pin_desc = $request->pin_desc;
        $pin->save();
        return redirect()->route('profile_created', ['user_id'=>Auth::id()]);
    }

    public function comment(Request $request, $user_id, $pin_id){
        $rules = [
            'comment' => 'required'
        ];
        $validation = Validator::make($request->all(), $rules);
        if($validation->fails()){
            return back()->withErrors($validation);
        }
        $data = [
            'user_id' => $user_id,
            'pin_id' => $request->pin_id,
            'comment' => $request->comment,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        DB::table('comments')->insert($data);
        return redirect()->route('pin_detail', ['pin_id' => $pin_id]);
    }

}
