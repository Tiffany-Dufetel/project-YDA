<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;


class OrderController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('auth');
    } */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::with('product', 'user', 'user.company')->get();
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
    public function store(Request $request/* , $id */)
    {
        $date = date('Y-m-d');
        $user_id = Auth::user()->id;
        /* $product_id = Product::user()->products_id;  */

        $request->validate([]);

        $order = [
            'date_delivery' => $request->date_delivery,
            'comment' => $request->comment,
            'products_id' => $request->products_id,
            'pdf' => "fichier.pdf",
            'user_id' => $user_id,
            'date_order' => $date,
        ];

        Order::create($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::where('id', $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $date = date('Y-m-d');
        $user_id = Auth::user()->id;

        $order = Order::find($id);

        $request->validate([]);

        $order->status = $request->status;
        $order->date_order = $date;
        $order->date_delivery = $request->date_delivery;
        $order->products_id = $request->products_id;
        $order->user_id = $user_id;

        $order->save();

        if ($order) {
            $data = [
                'status' => '1',
                'msg' => 'success'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail'
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order)
    {
        $res = Order::findOrFail($order)->delete();

        /* Check the status response */
        if ($res) {
            $data = [
                'status' => '1',
                'msg' => 'success'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail'
            ];
        }

        /* Return the response as json */
        return response()->json($data);
    }
}
