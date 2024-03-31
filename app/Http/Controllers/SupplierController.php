<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return view('supplier.index', ['suppliers'=>$suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'city' =>  'nullable|string|max:255',
            'country' =>  'nullable|string|max:255',
            'address' =>  'nullable|string|max:255',
            'phone' =>  'numeric|digits_between:8,14',
            'type' => 'nullable|string|',
        ]);
        $supplier= new Supplier;
        $supplier->name=$request->name;
        $supplier->city=$request->city;
        $supplier->country=$request->country;
        $supplier->address=$request->address;
        $supplier->phone=$request->phone;
        $supplier->type=$request->type;
        $supplier->save();
        return redirect()->route('supplier.show', ['supplier' => $supplier->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
{
    return view('supplier.show', ['supplier' => $supplier]);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', ['supplier'=>$supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'digits_between:8,14',
            'type' => 'nullable|string',
        ]);
    
        $supplier->update([
            'name' => $request->name,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'phone' => $request->phone,
            'type' => $request->type,
        ]);
    
        return redirect()->route('supplier.show', ['supplier' => $supplier->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route("supplier.index");
    }
}
