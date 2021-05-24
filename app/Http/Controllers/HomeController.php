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
        $directory = $this->getDirectory();
        $data = $req->all();        
        $collection = [];
        $vali = Validator::make($req->all(), [
            "item_title" => "string",
            "swap_with"=>"string",
            "item_description"=>"string",
            "amount"=>"integer|max:1000000|nullable",
            "item_imgs"=> "required|array",
            "item_imgs.*"=> "image|max:5000",
        ]);
        if($vali->fails())
        {
            // $msg =  'اما المعلومات المدخلة غير صحيحة او احجام الصور كبيرة او غير مناسبة';
            $msg = var_dump($vali->getMessageBag());
            dd($msg);
            return response()->json(['status'=>'400',
             'msg'=>$msg]);
        }
        foreach($data['item_imgs'] as $key => $img){
            if($img->isFile()){
                $nameToStore = $this->imgResizer($img,$directory);
            }else{
                $nameToStore = 'dark-logo.png';
            }
            array_push($collection,$nameToStore);
        }
                
        $location = Auth::user()->location;
        $toReplace = [0,1,2,3,4,5,6,7,8,9,'٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
       
        $item = new Item();
        $item->user_id = Auth::id();
        $item->item_type = $data['item_type']  ?? 1;
        $item->item_title = str_replace($toReplace,'',$data['item_title']);
        $item->item_info = str_replace($toReplace,'',$data['item_description']);
        $item->item_location = str_replace($toReplace,'',$location);
        $item->swap_with = $data['swap_with'] == 'x' ? 'اي شيء' : str_replace($toReplace,'',$data['swap_with']) ?? 'doonation';
        $item->collection = serialize($collection);
        $item->amount = $data['amount'] ?? 0;
        $item->directory = $directory;
        $item->save();
        $data = str_replace($toReplace,'',$data['item_title']);
        Indexs::store($item->id,$data);
        return response()->json([
            'msg'=>'done',
            'status'=>200
        ]);
    }
    
    /**
     * @return string image name to store it  
     */
    private function imgResizer(object $image,string $directory):string
    {
        $CD = Carbon::now()->format('h-i-s-ms');
        $size = [800,600];
        $ext = $image->extension();
        $nameWithExt = $image->getClientOriginalName();
        $fileName = pathinfo($nameWithExt,PATHINFO_FILENAME);     
        $nameToStore = $fileName.'_'.$CD.'.'.$ext;     
        $filePath = public_path('/assets/items/'.$directory);
        $img = Image::make($image->path());
        try {
            // $img->fit(ceil($img->width()/4),ceil($img->height()/4),
            // function ($constraint) { $constraint->upsize();})
            $img->resize(ceil($img->width()/4),ceil($img->height()/4))
            ->insert('imgs/mark.png', 'bottom-right',10,10)
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
        $CD = Carbon::now()->format('y-m-d_h-i-s-ms');
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
