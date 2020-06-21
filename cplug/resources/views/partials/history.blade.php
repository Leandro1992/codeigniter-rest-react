@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card margin-menu">
            <div class="card-header text-white bg-primary">{{ __('history.Title') }}</div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{ __('history.Type') }}</th>
                                <th scope="col">{{ __('history.Quantity') }}</th>
                                <th scope="col">{{ __('history.User') }}</th>
                                <th scope="col">{{ __('history.Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($movements as $movement)
                            <tr @if($movement->type =='out') class="out-line" @else class="in-line" @endif>
                                <th scope="row">{{$movement->id}}</th>
                                @if($movement->type =='out')
                                <td>{{ __('history.Out') }}</td>
                                @else 
                                <td>{{ __('history.In') }}</td>
                                @endif
                                <td>{{$movement->quantity}}</td>
                                <td>{{$movement->users->name}}</td> 
                                <td>{{$movement->created_at}}</td>    
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection