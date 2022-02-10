<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProgress()
    {
        return view('backEnd.order.index', [
            'orders' => Order::where('order_status', '=', 0)->get()
        ]);
    }
    public function indexAccept()
    {

        return view('backEnd.order.index', [
            'orders' => Order::where('order_status', '=', 1)->get()
        ]);
    }
    public function indexSuccessful()
    {

        return view('backEnd.order.index', [
            'orders' => Order::where('order_status', '=', 2)->get()
        ]);
    }
    public function indexRefuse()
    {

        return view('backEnd.order.index', [
            'orders' => Order::where('order_status', '=', 3)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order, $id)
    {
        $order = Order::find($id);
        $user = $order->user;
        $status_order = [
            0 => 'Processing', 1 => 'Accept', 2 => 'Successful', 3 => 'Refuse'
        ];
        if (Carbon::parse($order->updated_at)->addMinutes(15)->isPast()) {
            $status_arr = [];
            if ($order->order_status == 2) {
                for ($i = $order->order_status; $i < count($status_order) - 1; $i++) {
                    $status_arr[$i] = $status_order[$i];
                }
            } else {
                for ($i = $order->order_status; $i < count($status_order); $i++) {
                    $status_arr[$i] = $status_order[$i];
                }
            }

            $status_order = $status_arr;
        }
        $allOrderOfUser = Order::where('user_id', '=', $user->id);
        $numberOrderUser = count($allOrderOfUser->get());
        $numSuccess = count(Order::where([['user_id', '=', $user->id],['order_status','=',2]])->get());
        $succ = Order::where([['user_id', '=', $user->id],['order_status','=',2]])->get();
        $numberFail = count(Order::where([['user_id', '=', $user->id],['order_status','=',3]])->get());
        $sum = 0;
        foreach ($succ as $value) {
            $sum += $value->sum;
        }
        $statusF = $order->order_status;
        if ($order->order_status == 0) {
            $status = 'Processing';
        }

        return view('backEnd.order.edit', [
            'ord' => $order,
            'orders' => $order->orderDetail,
            'user' => $user,
            'numberOrderUser' => $numberOrderUser,
            'numSuccess' => $numSuccess,
            'numFail' => $numberFail,
            'sum' => $sum,
            'status_orders' => $status_order
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        $order = Order::find($id);
        $status_order = [
            0 => 'Processing', 1 => 'Accept', 2 => 'Successful', 3 => 'Refuse'
        ];
        $statuRequest = request()->order_status;
        $checkStatus = 0;
        if (Carbon::parse($order->updated_at)->addMinutes(15)->isPast()) {
            $checkStatus = 2;
            if ($order->order_status == 2) {

                for ($i = $order->order_status; $i < count($status_order) - 1; $i++) {
                    if ($i == (int) request()->order_status) {
                        $checkStatus = 1;
                        break;
                    }
                }
            } else {
                for ($i = $order->order_status; $i < count($status_order); $i++) {

                    if ($i == (int) request()->order_status) {
                        $checkStatus = 1;
                        break;
                    }
                }
            }
        }
        if ($checkStatus == 2) {
            return redirect()->back()->with('error', 'Update not success!');
        }
        $order->setQuantityProduct();
        $order->update([
            'order_status' => request()->order_status,
        ]);

        return redirect()->route('order.indexProgress')->with('success', 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
