<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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

        return view('product')->with(['products' => $products]);
    }

    public function indexStore()
    {
         return view('store');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $form = $request->all();
        if($request->hasFile('image')){
            $path = $request->image->store('images', 'public');
            $form['image'] = $path;
        }
        unset($form['_token']);
        unset($form['_method']);
        $product = Product::create($form);
        if($product){
            $request->session()->flash('success', 'Produto Criado');
        }else{
            $request->session()->flash('danger', 'Erro ao criar usuário');
        }
        return redirect()->route('product.index', \App::getLocale());
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $product = Product::find($id);
        return view('partials.product_edit')->with(['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $lang, Product $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->color = $request->color;
        $product->size = $request->size;
        if($request->hasFile('image')){
            $path = $request->image->store('images', 'public');
            $product->image = $path;
        }
       
        if($product->save()) {
            $request->session()->flash('success', 'Produto atualizado');
        }else{
            $request->session()->flash('danger', 'Erro ao atualizar produto');
        }
        
        return redirect()->route('product.index', \App::getLocale());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        return Product::where('id', $id)->delete();
    }
}
