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
        return $orders = Order::with('product', 'user', 'user.company')->get();
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
        //
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
        $order = Order::find($id);
        $order->update($request->all());
        $order->save();

        return redirect()->back()
            ->with('success', 'Your order has been modified');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->back()
            ->with('success', 'The order was successfully cancelled');
    }
}
