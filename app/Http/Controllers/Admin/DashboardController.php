<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginAdminRequest;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Avatar;
use App\Models\Order;
use App\Models\User;
use App\Models\ProductDetail;

class DashboardController extends Controller
{
    public function index(){
        $countOrderNew=Count(Order::where('order_status','=',0)->get());
        $countCustomer=Count(User::where('level','=',2)->get());
        $productQuantity=ProductDetail::where([
            ['quantity','=',0],
            ['product_detail_status','=',1]
        ])->count();
        return view('backEnd.dashboard.index',[
            'countOrderNew'=>$countOrderNew,
            'countCustomer'=>$countCustomer,
            'productQuantity'=>$productQuantity
        ]);
    }
    public function getLogin(){
        if (Auth::check()) {
            return redirect('admin');
        }
        return view('backEnd.dashboard.login');
    }
    public function listProduct(){
        $productQuantitys=ProductDetail::where([
            ['quantity','=',0],
            ['product_detail_status','=',1]
        ])->get();
        return view('backEnd.productDetail.listProduct',compact('productQuantitys'));
    }
    public function postLogin(LoginAdminRequest $request){
        $remember=($request->remember==1)?true:false;
        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials,$remember)) {
            return redirect()->route('admin')->with('success','Logged in successfully');
        }
        return redirect()->back()->with('error','Email or password is incorrect');
    }
    public function getLogout()
    {
        Auth::logout(); 
        return redirect()->route('admin.getLogin');
    }

}

