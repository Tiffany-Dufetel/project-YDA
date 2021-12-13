<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = order::all()->toArray();
        return array_reverse($orders);
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
    public function store(Request $request, $id)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'comment' => 'required|string',
        ]);

        $order = [
            'status' => 'en attente',
            'date_order' => new Date(),
            'date_delivery' => $request->input('date_delivery'),
            'comment' => $request->input('comment'),
            'products_id' => $request->input('product'),
            'pdf' => $request->input('pdf'),
            'user_id' => $user_id,
        ];

        Order::create($order);

        return redirect()->route('order.index', $id)
            ->with('success', "Your card has been created!");

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
        $order = order::find($id);
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
        $order = order::find($id);
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
        $order = order::find($id);
        $order->delete();

        return redirect()->back()
            ->with('success', 'The order was successfully cancelled');
    }
}
