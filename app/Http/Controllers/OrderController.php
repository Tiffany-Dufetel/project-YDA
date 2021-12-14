<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\OrderController as ResourcesOrderController;

use function GuzzleHttp\Promise\all;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id; //récupération de l'id de l'utilisateur connecté
        $products_id = Product::user()->id; //récupération du nom de l'utilisateur connecté

        $orders = Order::with('product', 'user') // requete de la table title et user en relation
            ->where('user_id', $user_id)
            ->orderByDesc('created_at')
            ->get();

            return response()->json("Order history displayed");
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
            'comment' => 'string',
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

        return redirect()->route('orders', $user_id)
            ->with('success', "Your order has been processed!");

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
