<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Gate;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(string $lang, User $user)
    {
        $roles= Role::all();
        return view('admin.users.edit')->with(['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $lang, User $user)
    {
        if($request->roles){
            $user->roles()->sync($request->roles);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
       
        if($user->save()) {
            $request->session()->flash('success', 'Usuário atualizado');
        }else{
            $request->session()->flash('danger', 'Erro ao atualizar usuário');
        }
        
        return redirect()->route('admin.users.index', \App::getLocale());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $lang, User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index', \App::getLocale()));
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index', \App::getLocale());
    }
}
