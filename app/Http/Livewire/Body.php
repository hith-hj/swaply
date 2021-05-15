<?php

namespace App\Http\Livewire;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class Body extends Component
{
    protected $listeners = ['changeBody','goBack','goNext'];
    protected $body = 'feeds';
    public $g_id = null;
    public $show = null;
    public $visted = [['feeds',0]];
    public $forward = [0];
    public $problem;
    public $user_location;
    public $user_phone;

    public function changeBody($to){
        $cid = 0;
        if(is_array($to)){
            $this->g_id = $to[1];
            $cid = $to[1];
            if($to[0] == 'showitem' && $this->show == 'showitem'){
                $to = $to[0].'1';
            }else{
                $to = $to[0];
            }
            $this->show = $to;
            // $to = $to[0];
        }
        $last = [$to,$cid];
        array_push($this->visted,$last);     
        $this->body = $to;
        $this->body == 'feeds' ? $this->emitTo('menu','refresh') : '' ;
    }

    public function goBack()
    {
        if(sizeof($this->visted) > 1 ){
            array_values($this->visted);
            end($this->visted);
            $temp = count($this->visted) == 1 ? $this->visted[0] : prev($this->visted);
            $this->body = $temp[0];
            $this->g_id = $temp[1];           
            $last = array_pop($this->visted);  
            array_push($this->forward ,$last);
        }else{
            $noti = ['','b','خلصو خلاص'];
            $this->emit('notifi',$noti);
        }
    }

    public function goNext()
    {
        if(sizeof($this->forward) >1){
            $temp = end($this->forward);
            $this->body = $temp[0];
            $this->g_id = $temp[1];
            array_pop($this->forward);
        }else{
            $noti = ['هتروح فين','b','في ايه'];
            $this->emit('notifi',$noti);
        }
    }

    public function reportProblem()
    {
        $prob='x00Swaply-Problem00x';
        $res = false;
        if($this->problem != null && count($this->problem) > 0)
        {
            $res = Report::create([
                'user_id'=>$prob,
                'maker_id'=>Auth::user()->id,
                'post_id'=>$prob,
                'report_type'=>$prob,
                'report_info'=>$this->problem['info'],
            ]);
            $notis = [['شكرا لك لمساعدتنا على تحسين الموقع تم استلام المشكلة و سنعمل على حلها باسرع وقت','g','حسنا']
                ,['لم يتم ارسال المشكلة , الرجاء ملئ الحقول و الإعادة مرة اخرى','r','خطا']];
        $res == true 
        ? $this->emit('notifi',$notis[0]) 
        : $this->emit('notifi',$notis[1]);
        }
    }

    public function setLocation()
    {
        $noti = [['تم اضافة معلومات ','g','حسنا'],['املئ الحقول المطلوبة','r','خطا'],['الرثم المدخل لايطابق الشروط','r','خطا'],];
        if(is_array($this->user_location) && count($this->user_location) >2 && isset($this->user_phone)){
            preg_match('/(02)(01)[0145]\d{7}/',$this->user_phone,$mat);
            if(count($mat) < 3)
            {
                return $this->emit('notifi',$noti[2]);
            }
            $this->user = User::find(Auth::user()->id);
            $this->user->location = $this->user_location['covernent'].'-'.$this->user_location['area'].'-'.$this->user_location['naighbor'];
            $this->user->phone = $this->user_phone;
            $this->user->save();
            $this->emit('notifi',$noti[0]);
        }else{
            $this->emit('notifi',$noti[1]);
        }

        $this->emit('changeBody','feeds');
    }

    public function render()
    {
        return view('livewire.body', ['body'=>$this->body,]);
    }
}
