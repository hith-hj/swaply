<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function index()
    {
        return view('home');
    }

    public function addNew(Request $req,$type)
    {
        $new = new AddNewController($req);
        $add = $new->getItemType($type);
        if($add === true){
            $response= response()->json([
                'msg'=>$type,
                'status'=>'done'
            ]);
        }else{
            $response= response()->json([
                'msg'=>$add,
                'status'=>'error'
            ]);
        }
        return $response;
    }
}
