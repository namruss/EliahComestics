<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Rank extends Model
{
    protected $table='rank';
    protected $fillable=['user_id','product_detail_id','rank','star'];
    public function storeRecord(){
        $idUser= Auth::user()->id;
 
        $last=Rank::where([
            ['user_id','=',$idUser],
            ['product_detail_id','=',request()->idProductDetail]
        ])->orderBy('created_at','desc')->get();
        
        $Chekcranks=Rank::where([
            ['user_id','=',$idUser],
            ['product_detail_id','=',request()->idProductDetail]
        ])->count();
       
        if ($Chekcranks==0) {
           if (request()->rate!=0) {
               
                $arr=[
                    'user_id'=>$idUser,
                    'product_detail_id'=>request()->idProductDetail,
                    'star'=>request()->rate,
                    'rank'=>request()->rate
                ];
                Rank::create($arr);
                return true;
           }
           return false;
          
        }else{
            if (request()->rate!=0) {
            $arr=[
                'user_id'=>$idUser,
                'product_detail_id'=>request()->idProductDetail,
                'star'=>request()->rate,
                'rank'=>floor(($last['0']->rank+request()->rate)/2)
            ];
            Rank::create($arr);
            return true;
        }
        return false;
        }
    }
}
