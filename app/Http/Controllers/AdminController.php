<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Report;
use App\Models\Requests;
use App\Models\Swap;
use App\Models\User;
use App\Models\Pekia;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminLogin()
    {
        // you should remove this 
        return redirect()->route('admin.dashboard');


        if(Admin::isAdmin() == true) {
            $this->admin = Admin::getAdmin();            
            return view('admin.login');
        }
        return redirect()->route('home');       
    }

    public function checkIfAdmin(Request $req)
    {   
        $attemps = $req->attemps != null ? $req->attemps + 1 : 1;
        if($attemps > 2){
            $attemps = 0;
            return redirect()->route('home');
        }
        $vali = Validator::make($req->all(), [
            "password" => "required|string|min:8",
        ]);        
        if($vali->fails() == false) {
            if(Hash::check($req->password,Admin::getAdmin()->admin_password))
            {
                return redirect()->route('admin.dashboard');
            }
        }
        return back()->with('errors','incorrect password '. 3 - $attemps .' attemps remain')->withInput(['attemps'=>$attemps]);       
    }

    public function adminDashboard()
    {
        $users = User::all();
        $items = Item::all();
        $reqs = Requests::all();
        $swaps = Swap::all();
        $reports = Report::all();
        $pekias = Pekia::all();
        $strict = ['us'=>$users,'its'=>$items,'peks'=>$pekias,'reqs'=>$reqs,'sps'=>$swaps,'repos'=>$reports];
        return view('admin.dashboard',compact('strict'));
    }
    
    public function strict()
    {
        $users = User::all();
        $items = Item::all();
        $reqs = Requests::all();
        $swaps = Swap::all();
        $reports = Report::all();
        $pekias = Pekia::all();
        $strict = ['us'=>$users,'its'=>$items,'peks'=>$pekias,'reqs'=>$reqs,'sps'=>$swaps,'rpos'=>$reports];
        return $strict;
    }
}
