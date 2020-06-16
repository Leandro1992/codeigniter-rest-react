@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card margin-menu">
                <div class="card-header text-white bg-primary">Users</div>

                <div class="card-body">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Roles</th>
                                  <th scope="col">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                            @can('edit-users')
                            @foreach ($users as $user)
                              <tr>
                                  <th scope="row">{{$user->id}}</th>
                                  <td>{{$user->name}}</td>
                                  <td>{{$user->email}}</td>
                                  <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
                                  <td>
                                    <a href="{{ route('admin.users.edit', ['lang' => app()->getLocale(), 'user' => $user->id]) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a> 
                                    <form class="float-left" action="{{ route('admin.users.destroy',  ['lang' => app()->getLocale(), 'user' => $user]) }}" method="POST">
                                      @csrf
                                      {{method_field('DELETE')}} 
                                      <button type="submit" class="btn btn-warning">Delete</button>
                                    </form> 
                                 </td>
                              </tr>
                            @endforeach
                            @endcan
                            @can('common-users')
                              <tr>
                                  <th scope="row">{{Auth::user()->id}}</th>
                                  <td>{{Auth::user()->name}}</td>
                                  <td>{{Auth::user()->email}}</td>
                                  <td>{{ implode(', ', Auth::user()->roles()->get()->pluck('name')->toArray())}}</td>
                                  <td>
                                    <a href="{{ route('admin.users.edit', ['lang' => app()->getLocale(), 'user' => Auth::user()->id]) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                 </td>
                              </tr>
                            @endcan
                          </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
