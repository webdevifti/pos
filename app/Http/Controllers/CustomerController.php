<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_customer = Customer::all();
        return view('customer.index', compact('all_customer'));
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
            'name' => 'required',
            'phone_number' => 'required|unique:customers'
        ]);

        try{
            Customer::create([
                'fullname' => $request->name,
                'phone_number' => $request->phone_number,
                'status' => $request->status
            ]);
            return back()->with('success','Customer Added Successfully.');
        }catch(Exception $e){
            return back()->with('error','Something happened wrong');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique:customers'
        ]);

        try{
            Customer::find($customer)->update([
                'fullname' => $request->name,
                'phone_number' => $request->phone_number,
                'status' => $request->status
            ]);
            return back()->with('success','Customer Updated Successfully.');
        }catch(Exception $e){
            return back()->with('error','Something happened wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer)
    {
        //

        $customer = Customer::find($customer);
        try{
            $customer->delete();
            return back()->with('success', 'Deleted');
        }catch(Exception $e){
            return back()->with('error','Something wrong');
        }
    }
}
