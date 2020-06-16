<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $request->session()->flash('success', 'Mensagem de sucesso');
        // $request->session()->flash('warning', 'Mensagem de alerta');
        // $request->session()->flash('danger', 'Mensagem de erro');
        return view('home');
    }
}
