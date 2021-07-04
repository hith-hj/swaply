<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Indexs;
use App\Models\Item;
use App\Models\Report;
use App\Models\Requests;
use App\Models\Swap;
use App\Models\User;
use App\Models\Pekia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AddNewController extends Controller
{
    private $request;
    
    public function __construct($req)
    {
        $this->request = $req;
    }

    private static function getToReplace()
    {
        return ['%','$','#','@','|','>','=','<',0,1,2,3,4,5,6,7,8,9,'٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
    }

    public function getItemType($type,$guest = false)
    {
        if($type == 'item'){
            return $this->newItem($guest);
        }else{
            return $this->newPekia($guest);
        }
    }

    public function newItem($guest){
        $req = $this->request;        
        if($guest == true && Auth::user()->location == 'not-set'){
            $location = 'not-set';
        }else{
            $location = Auth::user()->location;
        }        
        $toReplace = self::getToReplace();
        $directory = $this->setDirectory('items');
        $data = $req->all();        
        $collection = [];
        $vali = Validator::make($req->all(), [
            "item_title" => "string",
            "swap_with" => "string",
            "item_description" => "string",
            "amount" => "numeric|max:1000000|nullable",
            "item_img" => "required|array",
            "item_img.*" => "max:5000000",
        ]);
        
        if($vali->fails()) {
            $err = $vali->errors();
            $note =  'المعلومات المدخلة غير مناسبة';
            $msg = $note ;
            return $msg;
        }

        foreach($data['item_img'] as $key => $img){
            $img = $this->base64ToImage($img);
            if(gettype($img) == 'object'){
                $url = '/assets/items/';
                $nameToStore = $this->imgResizer($img,$directory,$url);
            }else{
                $nameToStore = 'dark-logo.png';
            }
            array_push($collection,$nameToStore);
        }

        // if($data['item_type'] == '2'){
        //     $data['amount'] += $data['amount'] *0.05;
        // }

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
        if($guest == true){
            $item->status = 'not-complete';
        }
        $item->save();
        Indexs::store($item->id,str_replace($toReplace,'',$data['item_title']));
        return true;
    }

    public function newPekia($guest){
        $req = $this->request;
        if($guest == true && Auth::user()->location == 'not-set'){
            $location = 'not-set';
        }else{
            $location = Auth::user()->location;
        }
        $directory = $this->setDirectory('pekias');      
        $collection = [];
        $data = $req->all();
        $vali = Validator::make($req->all(), [
            "user_exact_location" => "required|string",
            "pekia_price" => "required|string|numeric",
            "pekia_title" => "required|string",
            "pekia_img" => "required|array",
            "pekia_img.*" => "max:5000000",
        ]);
        if($vali->fails()) {
            $err = $vali->errors();
            $note =  'المعلومات المدخلة غير مناسبة';
            $msg = $note ;
            return $msg;
        }
        foreach($data['pekia_img'] as $key => $img){
            $img = $this->base64ToImage($img,'sw_pekia_');
            if(gettype($img) == 'object'){
                $url = '/assets/pekias/';
                $nameToStore = $this->imgResizer($img,$directory,$url);
            }else{
                $nameToStore = 'dark-logo.png';
            }
            array_push($collection,$nameToStore);
        }

        $pekia = new Pekia();
        $pekia->user_id = Auth::id();
        $pekia->pekia_coordinates = $req->user_exact_location;
        $pekia->pekia_location = $location;
        $pekia->pekia_title = $req->pekia_title;
        $pekia->pekia_price = $req->pekia_price;
        $pekia->collection = serialize($collection);
        $pekia->directory = $directory;
        if($guest == true){
            $pekia->status = 'not-complete';
        }
        $pekia->save();
        return true;
    }

    private function base64ToImage($b64,$type = false){
        if(!Storage::disk('public')->exists('temps')){
            Storage::disk('public')->makeDirectory('temps');
        }
        if($type == false ){
            $name = 'sw_item_'.rand(1,99999).'.jpg';
        }else{
            $name = $type.rand(1,99999).'.jpg';            
        }
        $file = fopen('temps/'.$name, "wb");  
        $data = explode(',', $b64);
        fwrite($file, base64_decode($data[1]));
        fclose($file);
        $img = Image::make('temps/'.$name);
        unlink('temps/'.$name);
        return $img;        
    }

    private function imgResizer(object $img,string $directory,$url):string
    {
        $CD = Carbon::now()->format('h-i-s-ms');
        $ext = $img->extension;
        $nameWithExt = str_replace(' ','_',$img->basename);
        $fileName = pathinfo($nameWithExt,PATHINFO_FILENAME);     
        $nameToStore = $fileName.'_'.$CD.'.'.$ext;     
        $filePath = public_path($url.$directory);
        try {
            $img->insert('imgs/mark.png', 'bottom-right',10,10)
            ->save($filePath.'/'.$nameToStore);       
        } catch (\Throwable $th) {
            $nameToStore = 'dark-logo.png';
            $noti = ['حدث خطا اثناء رفع الصور','r','خطا'];
            $this->emit('notifi',$noti);
            dd($th);
        }finally{
            return $nameToStore;
        }        
    }

    /**
     * @return string directory name in which images should be stored
     */
    private function setDirectory($folder):string
    {
        $CD = Carbon::now()->format('y-m-d');
        if(!Storage::disk('public')->exists('assets')){
            Storage::disk('public')->makeDirectory('assets');
        }
        if(!Storage::disk('assets')->exists($folder)){
            Storage::disk('assets')->makeDirectory($folder);
        }
        $directory=Auth::user()->name.'_'.$folder.'@'.$CD;
        if(!Storage::disk($folder)->exists($directory)){
            Storage::disk($folder)->makeDirectory($directory);
        }
        return $directory;
    }
}
