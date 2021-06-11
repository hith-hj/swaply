<?php

namespace App\Http\Controllers;

use App\Models\Indexs;
use App\Models\Item;
use App\Models\Report;
use App\Models\Requests;
use App\Models\Swap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $user = 'swaplyfirstAdmin';
    protected $pass = 'swaply@2025!admin';


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function addItem(Request $req)
    {
        // dd($req->all());
        $location = Auth::user()->location;
        $toReplace = ['%','$','#','@','|','>','=','<',0,1,2,3,4,5,6,7,8,9,'٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        $directory = $this->getDirectory();
        $data = $req->all();        
        $collection = [];
        $vali = Validator::make($req->all(), [
            "item_title" => "string",
            "swap_with" => "string",
            "item_description" => "string",
            "amount" => "integer|max:1000000|nullable",
            "item_img" => "required|array",
            "item_img.*" => "max:5000000",
        ]);
        if($vali->fails())
        {
            $ara =  'اما المعلومات المدخلة غير صحيحة او غير مناسبة';
            $msg = var_dump($vali->getMessageBag()) ?? $ara;
            dd($msg);
            return response()->json(['status'=>'400','msg'=>$msg]);
        }

        foreach($data['item_img'] as $key => $img){
            $img = $this->base64ToImage($img);
            if(gettype($img) == 'object'){
                $nameToStore = $this->imgResizer($img,$directory);
            }else{
                $nameToStore = 'dark-logo.png';
            }
            array_push($collection,$nameToStore);
        }

        if($data['item_type'] == '2')
        {
            $data['amount'] += $data['amount'] *0.05;
        }

        $item = new Item();
        $item->user_id = Auth::id();
        $item->item_type = $data['item_type'] ;
        $item->item_title = str_replace($toReplace,'',$data['item_title']);
        $item->item_info = str_replace($toReplace,'',$data['item_description']);
        $item->item_location = str_replace($toReplace,'',$location);
        $item->swap_with = str_replace($toReplace,'',$data['swap_with']);
        $item->collection = serialize($collection);
        $item->amount = $data['amount'] ?? 0;
        $item->directory = $directory;
        $item->save();
        Indexs::store($item->id,str_replace($toReplace,'',$data['item_title']));
        return response()->json([
            'msg'=>'done',
            'status'=>200
        ]);
    }

    private function base64ToImage($b64){
        if(!Storage::disk('public')->exists('temps')){
            Storage::disk('public')->makeDirectory('temps');
        }
        $name = 'sw_'.Auth::user()->name.'_'.rand(1,99999).'.jpg';
        $file = fopen('temps/'.$name, "wb");  
        $data = explode(',', $b64);
        fwrite($file, base64_decode($data[1]));
        fclose($file);
        $img = Image::make('temps/'.$name);
        unlink('temps/'.$name);
        return $img;        
    }

    private function imgResizer(object $img,string $directory):string
    {
        $CD = Carbon::now()->format('h-i-s-ms');
        $ext = $img->extension;
        $nameWithExt = str_replace(' ','_',$img->basename);
        $fileName = pathinfo($nameWithExt,PATHINFO_FILENAME);     
        $nameToStore = $fileName.'_'.$CD.'.'.$ext;     
        $filePath = public_path('/assets/items/'.$directory);
        try {
            $img->insert('imgs/mark.png', 'bottom-right',10,10)
            ->save($filePath.'/'.$nameToStore);       
        } catch (\Throwable $th) {
            dd($th);
            $nameToStore = 'dark-logo.png';
            $noti = ['حدث خطا اثناء رفع الصور','r','خطا'];
            $this->emit('notifi',$noti);
        }finally{
            return $nameToStore;
        }        
    }

    /**
     * @return string directory name in which images should be stored
     */
    private function getDirectory():string
    {
        $CD = Carbon::now()->format('y-m-d_h');
        if(!Storage::disk('public')->exists('assets')){
            Storage::disk('public')->makeDirectory('assets');
        }
        if(!Storage::disk('assets')->exists('items')){
            Storage::disk('assets')->makeDirectory('items');
        }
        $directory=Auth::user()->name.'_'.$CD.'_'.'items';
        if(!Storage::disk('items')->exists($directory)){
            Storage::disk('items')->makeDirectory($directory);
        }
        return $directory;
    }

    public function strict($user,$pass)
    {
        if($user == $this->user && $pass == $this->pass)
        {
            $users = User::all();
            $items = Item::all();
            $reqs = Requests::all();
            $swaps = Swap::all();
            $reports = Report::all();
            $strict = ['us'=>$users,'its'=>$items,'reqs'=>$reqs,'sps'=>$swaps,'rpos'=>$reports];
            return view('auth.strict',compact('strict'));
        }else{
            return redirect('404');
        }
        
    }

}
