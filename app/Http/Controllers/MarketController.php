<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Store::with('products')->find($request->user()->store);
        if ($products) {
            foreach ($products as $item) {
                if ($item->verification_store == 0) {
                    return view('market.notVerificationStore');
                }
                $product = $item->products;
                return view('market.index', [
                    'product' => $product
                ]);
            }
        } else {
            return view('market.notRegistrasion');
        }


        // foreach ($store as $stores) {
        //     dd($stores);
        //     if ($stores->store != null) {
        //         $product = Store::with('products');
        //         $product = Product::all();
        //         return view('market.index', [
        //             'product' => $product
        //         ]);
        //     } else {
        //         return view('market.notRegistrasion');
        //     }
        // }
        // $markets = Store::all();
        // foreach ($markets as $market){
        //     $market = Store::with('user')->get();
        //     if ($market->store != null) {
        //         $product = Product::paginate(20);
        //         return view('market.index', [
        //             'product' => $product
        //         ]);
        //     } else {
        //         return view('market.notRegistrasion');
        //     }
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryProduct::all();
        return view('market.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'categories_id' => 'required|exists:category_product,id',
            'name' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'stock' => 'required|string',
            'price' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'description' => 'required|string'
        ]);

        $product = auth()->user()->store;
        if ($product) {
            $product->products()->create([
                'categories_id' => $request->categories_id,
                'name' => $request->name,
                'weight' => $request->weight,
                'stock' => $request->stock,
                'price' => $request->price,
                'image' => $request->hasFile('image') ?  $request->file('image')->store('public') : null,
                'description' => $request->description
            ]);
            return redirect()->route('market.index');
        }
        return redirect()->route('market.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = auth()->user()->store->products();
        $product = Product::find($id);
        $categories = CategoryProduct::all();
        return view(
            'market.edit',
            compact('categories'),
            [
                'item' => $product,
            ]
        );
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
        $data = $request->validate([
            'categories_id' => 'required|exists:category_product,id',
            'name' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'stock' => 'required|string',
            'price' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'description' => 'required|string'
        ]);

        $product = auth()->user()->store;
        if ($product) {
            $product = Product::findOrFail($id);
            $data = $request->all();
            $product->update($data);
            return redirect()->route('market.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('market.index');
    }
}
