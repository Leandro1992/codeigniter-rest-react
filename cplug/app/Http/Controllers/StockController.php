<?php

namespace App\Http\Controllers;

use App\stock;
use App\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $products = Product::all();
        // $stock = Product::find(1)->stock;
        // dd($stock);
        return view('stock')->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $form = $request->all();
        // dd($request->all());
        unset($form['_token']);
        unset($form['_method']);
        $stock = Stock::create($form);
        if($stock){
            $request->session()->flash('success', 'Movimentação criada');
        }else{
            $request->session()->flash('danger', 'Erro ao criar movimentação');
        }
        return redirect()->route('stock', \App::getLocale());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request, $lang, $id)
    {   
        $stock = stock::where('product_id', $id)->get();

        return view('partials.history')->with(['movements' => $stock]);
    }
}
