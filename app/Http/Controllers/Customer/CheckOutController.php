<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\CartHelper;
use App\Models\Payment;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Requests\CheckOutRequest;

class CheckOutController extends Controller
{
    public function index(){
        $Cart= new CartHelper();
        if (count($Cart->items)==0) {
            return redirect()->route('cart')->with('error','Cart not product!');
        }
        return view('frontEnd/Checkout',[
            'cart'=>$Cart,
            'payments'=>Payment::all()
        ]);
    }
    public function createOrder(CheckOutRequest $request,Order $order,OrderDetail $orderDetail){
        $id=$request->id;
        $Cart= new CartHelper();
        $order_item=$order->storeRecord();
        $idOrder=$order_item->id;
        foreach ($Cart->items as $key => $product) {
            $productDetail=OrderDetail::find($key);
            $arrDetail=[
                'product_detail_id'=>$key,
                'order_id'=>$idOrder,
                'sum'=>$product['quantity']*$product['price'],
                'quantity'=>$product['quantity']
            ];
            $orderDetail->create($arrDetail);
        }
        $Cart->clear(); 
        return redirect()->route('shop')->with('success','You order success!');
        
    }
}
