<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LowQuantity;

class LowQuantityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lowquantities = LowQuantity::all();
        return view('alert.index', compact('lowquantities'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LowQuantity $lowquantity)
    {
        $lowquantity->delete();
        return redirect()->route('alert.index');
    }
}
