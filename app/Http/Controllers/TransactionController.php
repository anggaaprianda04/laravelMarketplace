<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
        $totalQuantity = OrderItem::sum('quantity');
        $totalProduct = Product::count('name');
        $totalMarket = Store::count('id');
        $totalUser = User::count('id');
        $totalPrice = OrderItem::sum('price');
        $totalCategory = CategoryProduct::count('id');

        return view('order.index', [
            'order' => $order,
            'totalQuantity' => $totalQuantity,
            'totalProduct' => $totalProduct,
            'totalMarket' => $totalMarket,
            'totalUser' => $totalUser,
            'totalPrice' => $totalPrice,
            'totalCategory' => $totalCategory,
        ]);
    }

    // public function print()
    // {
    //     return view('order.print');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = Order::all();
        $totalQuantity = OrderItem::sum('quantity');
        $totalProduct = Product::count('name');
        $totalMarket = Store::count('id');
        $totalUser = User::count('id');
        $totalPrice = OrderItem::sum('price');
        $totalCategory = CategoryProduct::count('id');

        return view('order.create', [
            'order' => $order,
            'totalQuantity' => $totalQuantity,
            'totalProduct' => $totalProduct,
            'totalMarket' => $totalMarket,
            'totalUser' => $totalUser,
            'totalPrice' => $totalPrice,
            'totalCategory' => $totalCategory,
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
