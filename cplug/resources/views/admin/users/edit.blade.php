@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card margin-menu">
            <div class="card-header text-white bg-primary">Edit users {{$user->name}}</div>

                <div class="card-body">
                <form class="form" action="{{route('admin.users.update', ['lang' => app()->getLocale(), 'user' => $user])}}" method="POST">
                   

                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  $user->name }}" required>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label text-md-right">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group row">
                        <label for="for" class="col-md-3 col-form-label text-md-right">Roles</label>
                        <div class="col-md-6">
                            @if(Auth::user()->roles->pluck('name')->contains('admin')) 
                            @foreach ($roles as $role)
                                <div class="form-check">
                                <input type="checkbox" name="roles[]" value="{{$role->id}}" @if($user->roles->pluck('id')->contains($role->id)) checked @endif> 
                                <label for="">{{$role->name}}</label>
                                </div>
                            @endforeach
                            @else 
                                @foreach ($user->roles as $role)
                                <li> 
                                    {{$role->name}}
                                </li>
                                @endforeach 
                            @endif 
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection