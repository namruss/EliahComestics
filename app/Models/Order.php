<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helper\CartHelper;
use App\Models\ProductDetail;

class Order extends Model
{
    // Declare INFO BASIC 
    protected $table='order';
    protected $fillable=['user_id','payment_id','sum','order_status','name','phone','address'];

    // Store record to db
    public function storeRecord(){
        $cart= new CartHelper();
        $arr=[
            'user_id'=>request()->id,
            'payment_id'=>request()->payment,
            'sum'=>($cart->total_price-$cart->priceDiscount),
            'order_status'=>0,
            'name'=>request()->name,
            'phone'=>request()->phone, 
            'address'=>request()->address
        ];
        return $this->create($arr);
    }
    public function orderDetail(){
        return $this->hasMany(OrderDetail::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function setQuantityProduct(){
        $productDetail= new ProductDetail();
        $status_order=$this->order_status;
        $status_check=request()->order_status;
        switch ($status_check) {
            case '0':
                foreach ($this->orderDetail as $key => $value) {
                    $productDetail->setAQuantity($value,$status_order);
                }
                break;
            case '1':
               foreach ($this->orderDetail as $key => $value) {
                   $productDetail->setDQuantity($value,$status_order);
               }
            break;
            case '2':
                foreach ($this->orderDetail as $key => $value) {
                    $productDetail->setDQuantity($value,$status_order);
                }
             break;
            case '3':
                foreach ($this->orderDetail as $key => $value) {
                    $productDetail->setAQuantity($value,$status_order);
                }
            break;
            default:
                # code...
                break;
        }
    }
}
