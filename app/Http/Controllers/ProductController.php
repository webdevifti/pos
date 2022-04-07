<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('products.index', compact('products'));
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

        $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'brand' => 'required'            
        ]);

        try{
            Product::create([
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'brand' => $request->brand
            ]); 
            return back()->with('success','Product has been added successfully');
        }catch(Exception $e){
            return back()->with('error','Error occured');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        //
        // dd($request->all());
        $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'brand' => 'required'            
        ]);

        try{
            Product::find($product)->update([
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'brand' => $request->brand,
                'alert_stock' => $request->stock,
                'status' => $request->status
            ]); 
            return back()->with('success','Product has been updated successfully');
        }catch(Exception $e){
            return back()->with('error','Error occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        //
        $delete = Product::find($product)->delete();
        if($delete){
            return back()->with('success','Deleted success');
        }else{
            return back()->with('error','Error Occured');
        }
    }
}
