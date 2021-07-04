<?php

namespace App\Http\Controllers;

use App\Models\Notifyer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $guest;

    public function guestAdd(Request $req,$type)
    {
        
        if(!Auth::check()){
            $user = $this->checkUserStatus($req);   
            if(gettype($user) != 'object'){
                return back()->with('error',$user);
            }
        }else{
            $user = Auth::user();
        }

        if($type == 'item'){
            $req->validate([
                "item_title" => "string",
                "swap_with" => "string",
                "item_description" => "string",
                "amount" => "numeric|max:1000000|nullable",
                "item_img" => "required|array",
                "item_img.*" => "max:5000000",
            ]);
        }else{
            $req->validate([
                "user_exact_location" => "required|string",
                "pekia_price" => "required|string|numeric",
                "pekia_title" => "required|string",
                "pekia_img" => "required|array",
                "pekia_img.*" => "max:5000000",
            ]);
        }

        $new = new AddNewController($req);
        $new->getItemType($type,$this->guest);
        $item = Item::where('user_id','=',$user->id)->get()->sortByDesc('created_at')->first();
        if($this->guest == true){
          Notifyer::store('swaply',$user->id,'لن تتم الموافقة على منشورك إلى ان تكمل البيانات المطلوبة',$item->id);  
        }        
        if($new == true){
            return redirect()->route('home');
        }        
    }

    private function checkUserStatus($req)
    {
        $user = null ;
        if($req->new_user == '1'){
            $this->guest = true;
            $req->validate([
                'name' => 'required|string|max:90|unique:users',
                'password' => 'required|string|min:8',
            ]);
            $user = User::create([
                'name' => $req->name,
                'email'=> $req->name.'@Swaply.com',
                'password' => Hash::make($req->password),
                'status' => 'new',
            ]);
            Auth::login($user);
            Cookie::queue(Cookie::forever('_RU', $user->id));
        }else{
            $this->guest = false;
            $cookie = Cookie::get('_RU'); 
            $user = User::where('name','=',$req->name)->first();
            if($user){
                if(Hash::check($req->password,$user->password) && $cookie == $user->id) {
                    try {
                        Auth::login($user); 
                    } catch (\Throwable $th) {
                        $user ='خطأ في تسجيل الدخول';
                    }                      
                }else{
                    $user ='خطأ في كلمة المرور';
                }     
            }else{
                $user ='خطأ في اسم المستخدم';
            }
        }
        return $user;
    }
}
